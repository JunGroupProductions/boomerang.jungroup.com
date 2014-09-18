<html>
	<head>
		<title> :: boomerang_tracker :: </title>
		<link href='bct.css' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div id='header'>
			<div class='header-left'><h1>boomerang_tracker</h1></div>
			<div class='header-right'><img src='logo.png' id='logoimg'></div>
			<div class='clear'></div>
		</div>
	<div id="content">

<?php

//connect to mysql database
$username = "realtimereport";
$password = "COzf7^W2Scz";
$database = "embed";
$embed = mysqli_connect("applications.read-only.db.embed.jungroup.com",$username,$password,$database) or die('Could not connect: ' . mysqli_connect_error());

//set dates
date_default_timezone_set('UTC');
$today = date("Y-m-d");

//get comma seperated list of accounts handled by user
$partners = filter_input(INPUT_GET, 'partners');
$partner_array = explode(',', $partners);

//get user-specified timezone
$tz = filter_input(INPUT_GET, 'tz');

if (empty($partners)) {
	echo "<div class='welcome'><p>";
	echo "Welcome to the Boomerang Tracker! Please enter a search parameter to proceed.";
	echo "</p></div>";
	exit();
}

//1. Select active campaigns for each account
foreach ($partner_array as $partner_row) {

	//section header
	echo "<h2>.".strtolower($partner_row)."()</h2>";	

	//reset campaign array
	$campaign_data = array();

	//query to select active campaigns
	$campaign_query = "select id as campaign_id, name as campaign_name, date(flight_start) as start_date, date(flight_end) as end_date, active from embed.campaigns where name like '".$partner_row."%' and active = 1 and date(flight_end) >= date(now()) -2";
	$active_campaigns = mysqli_query($embed, $campaign_query);
	$num_cam = mysqli_num_rows($active_campaigns);

	//check for results
	if ($num_cam == 0) {
		echo "<div class='error'><p>No active campaigns listed under the name ".$partner_row.".</p></div>";
	}
	else {
		
		//campaign array
		while($active_campaigns_array = mysqli_fetch_array($active_campaigns)){			
		$campaign_data[] = array(
				"campaign_name" => $active_campaigns_array['campaign_name'],
				"campaign_id" => $active_campaigns_array['campaign_id'],
				"flight_start" => $active_campaigns_array['start_date'],
				"flight_end" => $active_campaigns_array['end_date']
			);
		}

		//2. Select active offers for each campaign
		foreach ($campaign_data as $campaign_data_row) {

			//calculate days left in campaign
			$days_left = number_format((1 + (strtotime($campaign_data_row['flight_end']) - strtotime($today)) / 86400));

			//campaign-level details
			echo "<div class='campaign_container'>";
			echo "<div class='campaign_info'>";
			echo "<strong>Campaign:</strong> <a href='http://admin.jungroup.com/admin/campaigns/".$campaign_data_row['campaign_id']."'>".$campaign_data_row['campaign_name']."</a><br/>";
			echo "<strong>Flight_Start:</strong> ".$campaign_data_row['flight_start']."<br/>";
			echo "<strong>Flight_End:</strong> ".$campaign_data_row['flight_end']."<br/>";
			echo "<strong>Days_Remaining:</strong> ".$days_left."</p></div>";

			//reset offer array
			$offer_data = array();

			//query to select active campaigns
			$offer_query = "select o.id as offer_id, o.name as offer_name, o.maximum_views as max_views from embed.offers o join embed.campaigns c on c.id = o.campaign_id where c.id =".$campaign_data_row['campaign_id'];
			$active_offers = mysqli_query($embed, $offer_query);

			//offer array
			while($active_offers_rows = mysqli_fetch_array($active_offers)){			
				$offer_data[] = array(
					"offer_id" => $active_offers_rows['offer_id'],
					"offer_name" => $active_offers_rows['offer_name'],
					"max_views" => $active_offers_rows['max_views'],
				);
			}

			//3. Select page views by day by url for each offer
			foreach ($offer_data as $offer_data_row) {
			
				//offer-level details
				echo "<hr>";
				echo "<div class='offer_container'>";
				echo "<p class='offer_name'>";
				echo "Offer #".$offer_data_row['offer_id'].": ".$offer_data_row['offer_name']."</br>";
				echo "</p>";
				
				//reset page view counter
				$total_page_views = 0;

				//query results for offer id
				$offer_day_query = querySelect($tz, $offer_data_row['offer_id']);
				$offer_query_results = mysqli_query($embed, $offer_day_query) or die("Doesn't work. You did something wrong.");

				//output results by day
				$results_by_day = filterQuery($offer_query_results, 'date');
				outputTable($results_by_day, 'date');

				//output general results 
				$num_urls = numActiveURLs($offer_data_row['offer_id']);
				$max_views = $num_urls * $offer_data_row['max_views'];
				$rem_views = $max_views - $total_page_views;
				$rem_views_day = $rem_views / $days_left;
				echo "<div class='offer_details'><p>";
				echo "Maximum_Views:<br/>&nbsp;".number_format($max_views)."</br>";
				echo "Total_Views:<br/>&nbsp;".number_format($total_page_views)."</br>";
				echo "Views_Remaining:<br/>&nbsp;".number_format($rem_views)."</br>";
				echo "Views_Remaining_By_Day:<br/>&nbsp;".number_format($rem_views_day)."</br>";
				echo "</p></div>";

				//output results by url
				$results_by_url = filterQuery($offer_query_results, 'url');
				outputTable($results_by_url, 'url');
				echo "</div>";
				echo "<div class='clear'></div>";

			}
			echo "<br/>";
			echo "</div>";

		}

	}
	
}

//inputs mysql results by url by day; outputs results by url or by day
function filterQuery($query_input, $param) {
	
	//resets mysqli pointer
	mysqli_data_seek($query_input, 0);

	while($query_results = mysqli_fetch_array($query_input)){			
		$query_data[] = array(
			"date" => $query_results['date'],
			"page_views" => $query_results['page_views'],
			"url" => $query_results['url']
		);
	}

	//unzip results
	$var_input = array_column($query_data, $param);
	$pv_input = array_column($query_data, 'page_views');
	
	//empty arrays
	$var_results = array();
	$pv_results = array();

	//reset array pointers
	reset($var_input);
	reset($pv_input);

	//condense results using date or url
	foreach($var_input as $var_value) {
		if (!in_array($var_value, $var_results)) {
			array_push($var_results, $var_value);
			array_push($pv_results, current($pv_input));
			next($pv_input);
		}
		else if (in_array($var_value, $var_results)) {	
			reset($var_results);
			reset($pv_results);
			while ($var_value != current($var_results)) {
				next($var_results);
				next($pv_results);
			}
			$pv_results[key($pv_results)] += current($pv_input);
			next($pv_input);
		}
 
	}

	//zip up arrays
	if ((count($var_results)) == (count($pv_results))) {
		if ($param == 'date') {
			$var_output = array_map(function ($var_results, $pv_results) {$output = array('date' => $var_results, 'page_views' => $pv_results); return $output;}, $var_results, $pv_results);
		}
		else {
			$var_output = array_map(function ($var_results, $pv_results) {$output = array('url' => $var_results, 'page_views' => $pv_results); return $output;}, $var_results, $pv_results);
		}
	}
	else {
		echo "ERROR: Something broke. Go tell someone.";
	}

	return $var_output;
}

//inputs query results; outputs table
function outputTable ($input, $param) {
	
	global $total_page_views;

	//open the table
	echo "<div class='".$param."_results'>";
	echo "<div class='".$param."_table'>";
	echo "<table><tr><th>".$param."</th><th>page_views</th></tr>";

	//reset counter
	$ii = 0;

	//enter page view results for each day
	foreach ($input as $input_row) {
		echo "<tr style=".getbgc($ii).">";
		if ($param == 'date') {
			echo "<td>".date("F j, Y", strtotime($input_row['date']))." </td><td>".number_format($input_row['page_views'])."</td>";
		}
		elseif ($param == 'url') {
			echo "<td>".$input_row['url']."</td><td>".number_format($input_row['page_views'])."</td>";
		}
		echo "</tr>";

		//increase counter
		$ii++;

		//add results to total counter
		$total_page_views += $input_row['page_views'];
	}
			
	//close the table
	echo "</table>";
	echo "</div>";
	echo "</div>";
}

//inputs offer and time zone; outputs query
function querySelect($tz, $offer) {
	
	if (empty($tz)) {
		$select_statement = "(select date(wtuv.created_at) as date, web_traffic_url_id, count(*) as page_views ";
	}
	else {
		$select_statement = "(select date(convert_tz((wtuv.created_at),'GMT','".$tz."')) as date, web_traffic_url_id, count(*) as page_views ";
	}

	$query = "select wtuv.date, wtuv.page_views, wtu.url from".
		$select_statement.
		"from embed.web_traffic_url_visits wtuv
		join embed.viewings on viewings.id = wtuv.viewing_id
		where viewings.offer_id in ( ".$offer." )
		group by date, web_traffic_url_id
		) AS wtuv
		join 
		(select id, url from embed.web_traffic_urls wtu
		where wtu.offer_id in ( ".$offer." )
		) AS wtu ON wtu.id = wtuv.web_traffic_url_id
		order by date asc";
	return $query;
}

//inputs offer number; outputs number of active urls
function numActiveURLs($input) {
	global $embed;
	$urls_query = "select id, active from embed.web_traffic_urls wtu where active = '1' and offer_id = ".$input;
	$urls = mysqli_query($embed, $urls_query);
	$num_urls = mysqli_num_rows($urls);	
	return $num_urls;				
}

//background color alternator
function getbgc($trcount) {
	$blue="\"background-color: #021b00;\"";
	$green="\"background-color: #000000;\"";
	$odd=$trcount%2;
	if($odd==1){return $blue;}
    else{return $green;}    
}

function array_column($array, $column){
    $a2 = array();
    array_map(function ($a1) use ($column, &$a2){
        array_push($a2, $a1[$column]);
    }, $array);
    return $a2;
}

?>

		</div>
	</body>
</html>