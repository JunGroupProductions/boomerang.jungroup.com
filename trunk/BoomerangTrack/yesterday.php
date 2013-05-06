<?php

require 'config.php';

if (!isset($_SERVER['PHP_AUTH_USER']))
{
    $_SERVER['PHP_AUTH_USER'] = 0;
}

$ad_network_name = $_SERVER['PHP_AUTH_USER'];

##################### COLLECTING THE DATA WITH MYSQL ###############################
# First, get the ad network ID from the name that is provided from $SERVER AUTH array, by querying the ad_network table.
$ad_network_id = mysql_fetch_array(mysql_query("select id from ad_networks where name = '$ad_network_name'", $embed));

# We are going to show a few things. We will show, by month (descending) how many payouts we've sent to the network.
$payouts_for_yesterday = mysql_query("select DATE_SUB(CONCAT(CURDATE()), INTERVAL 1 DAY) as date, count(distinct(viewing_id)) as count from ad_network_completed_views
								join ad_network_users on ad_network_users.id = ad_network_completed_views.ad_network_user_id
								join viewings on viewings.id = ad_network_completed_views.viewing_id
								join clients on clients.id = viewings.client_id
								where ad_network_id = ". $ad_network_id['id'] . "
								and clients.country_code = 'us'
								and date(ad_network_completed_views.created_at) = DATE_SUB(CONCAT(CURDATE(), ' 00:00:00'), INTERVAL 1 DAY)");
								
$row = mysql_fetch_array($payouts_for_yesterday);

echo $row['date'] . ' - ' . $row['count'];

?>