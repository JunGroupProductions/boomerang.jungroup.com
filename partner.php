<?php

### This script will show a publisher the payouts that they have been responsible for through the JG network
### It will show the payouts by month, the payouts by day for the current and past month, and then show the campaigns currently running/view allocation

# Auto-refresh every 180 seconds.
    echo "<meta http-equiv=\"refresh\" content=\"180\">";

##################### COLLECTING THE DATA WITH MYSQL ###############################
# But, for the current month, we're really concerned with showing the payouts by day.
$payouts_by_day_for_current_month = mysql_query( "select date(created_at) as date, count(*) as sessions
												from viewings
												join offers on offers.id = viewings.offer_id
												join campaigns on campaigns.id = offers.campaign_id
												where campaigns.name = '$partner_name'
												and completed = 1
												group by date(created_at)" );

#### START OUTPUTTING OF DATA AROUND PAYOUT DELIVERY BY MONTH

$pages_per_session_query = mysql_query( "select count(*)
									from web_traffic_urls wt
									join offers on offers.id = wt.offer_id
									join campaigns on campaigns.id = offers.campaign_id
									where campaigns.name = '$partner_name'");

$sessions_overall = 0;

$pages_per_session_row = mysql_fetch_array($pages_per_session_query);
$pages_per_session = $pages_per_session_row[0];

# Go through our payouts by day for the current month, output the data so the user can see it.
echo "<table class=\"gridtable\">";
echo "<tr>";
echo "<th>Date</th><th>Web Sessions</th><th>Page Views</th>";
echo "</tr>";
                                                
while ($row = mysql_fetch_array($payouts_by_day_for_current_month)) {  
    echo "<tr>";
    echo "<td>" . $row['date']. " </td><td> " . number_format($row['sessions']) . " </td><td> " . number_format($row['sessions']*$pages_per_session) . "</td>";
    echo "</tr>";
    
    $sessions_overall += $row['sessions'];
                                                
    }
                                                
echo "</table>";                                                

echo "<BR/>";

echo "<b>Overall statistics:</b> <br/></br>";
echo number_format($sessions_overall) . " sessions</br>";
echo number_format($sessions_overall*$pages_per_session) . " page views";
echo "<BR/>";

?>
</html>

