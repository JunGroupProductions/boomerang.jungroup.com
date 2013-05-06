<?php

### This script will show a publisher the payouts that they have been responsible for through the JG network
### It will show the payouts by month, the payouts by day for the current and past month, and then show the campaigns currently running/view allocation

# Auto-refresh every 180 seconds.
    #echo "<meta http-equiv=\"refresh\" content=\"180\">";

if (!isset($_GET['last_month']))
{
	$_GET['last_month'] = "0";
}

$last_month = $_GET['last_month'];

if($last_month == 1) {
	$date_range = "where date(v.created_at) >= date_sub(DATE_FORMAT(NOW() ,'%Y-%m-01'), interval 1 MONTH)
	and date(v.created_at) < (DATE_FORMAT(NOW() ,'%Y-%m-01'))";
}

else {
	$date_range = "where date(v.created_at) >= DATE_FORMAT(NOW() ,'%Y-%m-01')
	and date(v.created_at) < date_add(DATE_FORMAT(NOW() ,'%Y-%m-01'), interval 1 MONTH)";
}



##################### COLLECTING THE DATA WITH MYSQL ###############################
# First, get the ad network ID from the name that is provided from $SERVER AUTH array, by querying the ad_network table.
$ad_network_id = mysql_fetch_array(mysql_query("select id from ad_networks where name = '$publisher_name'", $embed));

# But, for the current month, we're really concerned with showing the payouts by day.
$payouts_by_day_for_current_month = mysql_query( "select impressions.*, profit.profit from 
(
                                                select date(v.created_at) as date, count(*) as impressions, sum((duration >= 0)) as starts, 100 * sum((duration >= 0)) / count(*) as start_rate, sum(completed) as completions, 100 * sum(completed) / sum((duration > 0)) as completion_rate from viewings v
                                                join ad_network_users anu on anu.id = v.ad_network_user_id
                                                $date_range
                                                and anu.ad_network_id = ". $ad_network_id['id'] . "
                                                and v.offer_id > 3
                                                group by date(v.created_at)
                                     ) impressions
                                     left join
                                     (
                                     select date(v.created_at) as date, sum(value)*(1-avg(v.hypr_rev_share)) as profit from viewings  v
                                                join ad_network_users anu on anu.id = v.ad_network_user_id
                                                $date_range
                                                and ad_network_id = ". $ad_network_id['id'] . "
												and completed = 1
												group by date(v.created_at)
                                     
                                     ) profit on impressions.date = profit.date" );

#### START OUTPUTTING OF DATA AROUND PAYOUT DELIVERY BY MONTH

$payouts_current_month = 0;
$profit_current_month = 0;


if($last_month == 1) {
	echo "<B>Last month: <BR/></B>";
}

else {
	echo "<a href=\"?last_month=1\"> Look at last month's data </a></br></br>";
	
	echo "<B>Current month: <BR/></B>";
}

echo "<BR/>";

# Go through our payouts by day for the current month, output the data so the user can see it.
echo "<table class=\"gridtable\">";
echo "<tr>";
echo "<th>Date</th><th>Completions</th><th>Completion Rate</th><th>Net Revenues</th>";
echo "</tr>";
                                                
while ($row = mysql_fetch_array($payouts_by_day_for_current_month)) {  
    echo "<tr>";
    echo "<td>" . $row['date']. " </td><td> " . number_format($row['completions']) . " </td><td> " . number_format($row['completion_rate'], 2) . "%</td><td> $" . number_format($row['profit'], 2);
    echo "</tr>";
    
    $payouts_current_month += $row['completions'];
    $profit_current_month += $row['profit'];
                                                
    }
                                                
echo "</table>";                                                

echo "<BR/>";

echo "<b>Month statistics:</b> <br/></br>" . number_format($payouts_current_month) . " payouts";
echo "<BR/>";
echo "</br> $" . number_format($profit_current_month, 2) . " in net revenues";
echo "<BR/>";
echo "</br> $" . number_format($profit_current_month / $payouts_current_month, 4) . " eCPV";
echo "<BR/>";

?>
</html>

