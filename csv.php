<?
############## INSECURE ####################
session_start();

$filename = $_SESSION["campaign"] . "___" . date('Y-m-d') . ".csv";
$output = fopen("php://output",'w') or die("Can't open php://output");
header("Content-Type:application/csv"); 
header("Content-Disposition:attachment;filename=".$filename); 		    
fputcsv($output, array('DATE','URL','PAGE VIEWS'));
foreach($_SESSION["tr_day"] as $row) {
    fputcsv($output, $row);
}
fclose($output) or die("Can't close php://output");
############## INSECURE ####################


############## SECURE ####################
// if (!isset($_SERVER['PHP_AUTH_USER'])){
//     	$_SERVER['PHP_AUTH_USER'] = 0;
// }
// $partner_name = $_SERVER['PHP_AUTH_USER'];
// if (!isset($_GET['campaign'])){
//    	$_GET['campaign'] = 0;
// }
// $campaign_name = $_GET['campaign'];
// ##################### COLLECTING THE DATA WITH MYSQL ###############################
// # But, for the current month, we're really concerned with showing the payouts by day.
// if($partner_name == "jungroup") {
// 	$partner_name = $campaign_name;
// }
// $offer_id_query = mysql_query("select offers.id as id from offers 
// 									join campaigns on campaigns.id = offers.campaign_id
// 									where campaigns.name = '$partner_name'" );	
// $offer_id_array = array();                      
// while ($row = mysql_fetch_array($offer_id_query)) {		// asc arr (dict)
// 	    $offer_id_array[] = $row["id"];			// num/str array
// }
// $comma_separated_offers = implode(",", $offer_id_array);	// string

// if($_GET["num"] == 1){
// 		#### START OUTPUTTING OF DATA AROUND TRAFFIC DELIVERY BY DAY BY URL
// 	    // $traffic_by_day_query = mysql_query( "select date, url, sum(page_views) as page_views from web_traffic_performance_summary wtps
// 	    //                                       join web_traffic_urls on web_traffic_urls.id = wtps.web_traffic_url_id
// 	    //                                       where wtps.offer_id in ($comma_separated_offers)
// 	    //                                       group by date, url
// 	    //                                       order by date, url");
// 	    $num_rows = mysql_num_rows($traffic_by_day_query);
// 	    if($num_rows > 0){
// 		    $delimiter = ",";
// 		    $filename = "boomerangReport_" . date('Y-m-d') . ".csv";		 
// 		    //create a file pointer
// 		    $f = fopen('php://memory', 'w');		    
// 		    //set column headers
// 		    $fields = array('DATE', 'URL', 'PAGE VIEWS');
// 		    fputcsv($f, $fields, $delimiter);		    
// 		    //output each row of the data, format line as csv and write to file pointer
// 		    // while($row = $traffic_by_day_query->fetch_assoc()){
// 		    while ($row = mysql_fetch_array($traffic_by_day_query)){
// 		        $lineData = array($row['date'], $row['url'], $row['page_views']);
// 		        fputcsv($f, $lineData, $delimiter);
// 		    }		    
// 		    //move back to beginning of file
// 		    fseek($f, 0);		    
// 		    //set headers to download file rather than displayed
// 		    header('Content-Type: text/csv');
// 		    header('Content-Disposition: attachment; filename="' . $filename . '";');		    
// 		    //output all remaining data on a file pointer
// 		    fpassthru($f);
// 		}
// 		exit;
// }

// if($_GET["num"] == 2){
// 	    $traffic_by_url_query = mysql_query( "SELECT url, SUM(page_views_y) AS tot_page_views
// 	    									  FROM (SELECT date, url, sum(page_views) AS page_views_y 
// 	    									  		FROM web_traffic_performance_summary wtps
// 			                                        JOIN web_traffic_urls ON web_traffic_urls.id = wtps.web_traffic_url_id
// 			                                        WHERE wtps.offer_id IN ($comma_separated_offers)
// 			                                        GROUP BY date, url
// 			                                        ORDER BY date, url) AS T
// 			                                   GROUP BY url");
// 	    // echo mysql_error();
// }
############## SECURE ####################

?>