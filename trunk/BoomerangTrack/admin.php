<?php

### This script is the administrative side of pubtrack. It seeks to do the following:
###
### 1) Show an all-inclusive list of all of the publishers that are live this month, showing payouts by month for that publisher (DONE)
### 2) For months that are complete, it should have a button saying "Generate RFI", where an email will be generated to the publisher (THE TEXT IS DONE, BUT NO EMAIL ADDRESSES IN DB)
### 3) Maybe even have a CSV output button for the current month, that can be imported into a ledger software? (DONE)
### 4) Ultimately match up the campaign names we have with the advertiser name, for the RFI. This will require master.. (DONE)
### 5) Add revenue to this sheet. Is this possible? Goal would be to: (MAYBE)
###		a) Connect to both mobile & embed and collect the data for revenue
### 6) AdMob mobile costs? (MAYBE)

### Let's begin.

#############################
# Connect to masterdb
# 
# We need to connect to masterdb because it's the only database that has information about 'advertisers' rather than campaigns. Advertiser names are significantly
# better to send to publisher partners.
$username = "phptrack";
$password = "JonsBcN5p3Kg";
$masterdb = "masterdb";

# Connect to masterDB SQL
$master = mysql_connect("masterdb.junlabs.com",$username,$password);

# Check to make sure we can connect to the "master" db
@mysql_select_db($masterdb) or die("Unable to select master database");

########## MYSQL QUERIES ###########
# We're going to have to run a master query, that will hopefully be one of the only query we need to run. It will collect the following data: 
# a) A list of all of the ad networks that are active for this month and last
# b) Payouts by month for the current and past month for each publisher, broken down by campaign name

# Here's the query to collect that data. This query will take a little while to run.. (17 seconds, yipes!)
# Also added an exemption for DummyNet and AppssavvyDisplay hardcoded.
# Added an exemption for the "Fake" campaign.
$publisher_by_campaign_by_month = mysql_query("
                                        	  select month(viewings.created_at) as month, ad_networks.name as ad_network_name, campaigns.name as campaign_name, count(*) as count, sum(value)*(1-viewings.hypr_rev_share) as profit from viewings
											  join ad_network_users on ad_network_users.id = viewings.ad_network_user_id
											  join offers on offers.id = viewings.offer_id
											  join campaigns on offers.campaign_id = campaigns.id
											  join ad_networks on ad_network_users.ad_network_id = ad_networks.id
											  where (ad_networks.id > 1 and offers.id > 3)
											  and date(viewings.created_at) >= date_sub(DATE_FORMAT(NOW() ,'%Y-%m-01'), interval 1 MONTH)
											  and date(viewings.created_at) < DATE_FORMAT(NOW() ,'%Y-%m-01')
                                              and completed = 1
											  group by ad_networks.name, campaigns.name
											  order by ad_networks.name desc"
											  , $embed);
											  
# The second query we're going to do is collect the advertiser name from master, linking them to the campaign_name, so we can generate RFI text and then email it
$advertisers_by_campaign = mysql_query("select advertisers.external_name as advertiser_name, campaigns.name as campaign_name from campaigns
										join advertisers on advertisers.id = campaigns.advertiser_id
										where campaigns.end_date > '". date("Y-m-t", strtotime("-3 month")) ." ' 
										group by campaign_name", $master);

########### ARRAYS AND OPENING CSV #############
# Create an array that will house the campaign_name->advertiser_name key
$camp_name_to_advert_name = array();

while ($row = mysql_fetch_array($advertisers_by_campaign)) {  
	$camp_name_to_advert_name[$row['campaign_name']] = $row['advertiser_name'];
	}

# Make an array of ad_network names as they come out. Everytime we're about to output, we'll check if it's already in the array. If it is, we'll only show the 
# campaign data. This will ensure we don't show the same ad network twice.
$ad_network_names = array();

# Make an array that will be used to store the emails by ad network for generating RFIs
$email_by_ad_network = array();

# Make an array that will store all of the campaigns by ad network
$all_campaigns_by_ad_network = array();
	
# Make an array that will store the CPV by ad network
$cpv_by_ad_network = array();

# Open a local file, called file.csv, where we'll dump the information so it can be imported to a ledger software.
$fp = fopen('file.csv', 'w');

############ FUNCTIONS FOR DISPLAYING DATA ###############

### This function displays the number of payouts a campaign has for a particular ad network
function output_campaign_payouts_by_network($campaign_name, $count, $advertiser_name) {
	echo $campaign_name ." - ". number_format($count). " payouts";
}

# We'll enter the data we have as we have it, into a CSV file. 
# The date of the transaction will be 3 months ahead of when the distribution took place, because 90 days is our "average" pay length
# The distribution will be based off $cpv CPV, even though that's not exclusively true (Matomy). Ultimately we'll need to add a CPV field to ad_networks
function input_to_csv_campaign_payouts_by_network($count, $ad_network_name, $campaign_name, $cpv, $fp) {
	$enter_into_csv = array($count*($cpv)*-1,$campaign_name . ' - ' . $ad_network_name . ' - ' . $count . ' views',date("F", strtotime("-1 month") ) . ' delivery expense');
    fputcsv($fp, $enter_into_csv);
    }
    
    
# This function will add the data to an array so we can use it to output RFI emails ultimately.
function add_data_to_array($ad_network, $total, $all_advertisers_by_ad_network, $profit) {		
	# Generate the email for that ad_network.
	$email_by_ad_network[$ad_network] = ("Hello Partner,
										 
										 This is a Request for Invoice for the month of " . date("F, Y.", strtotime("-1 month")) . "
										 
										 Please include the following information on all invoices:
										 
										 <b>Delivery Month:</b> " . date("F, Y", strtotime("-1 month")) . "
										 <b>RFI Amount:</b> $" . number_format($profit, 2) . "							 
										 <b>Number of payouts: </b>" . number_format($total) . "
										 
										 <b>Contact name:</b> Corey Weiner
										 <b>Email:</b> corey@jungroup.com
										 
										 <b>Send all invoices to:</b>
										 accountspayable@jungroup.com
										 
										 The following campaigns were run during this period: 
										 
										 " . $all_advertisers_by_ad_network . "
										 
										 Thanks!
										 
										 Corey");
		
	$print_ad_network_email = str_replace("\n", "</BR>", $email_by_ad_network[$ad_network]);
		
	echo "</BR></BR>";
	
	# Generate the href dynamically, using the ad_network name to make it unique.
	echo "<a href=\"#\" onclick=\"toggle_visibility('email_". $ad_network ."'); return false;\">Toggle Partner Email</a>";
	
	# Same thing here, use the div id dynamically combining email_ and the $ad_network
	echo "</BR></BR><div id=\"email_". $ad_network ."\" style=\"display:none;\">
	--------------------------------------------------------------------------------</BR>
	" . $print_ad_network_email;
	
	echo "</BR>--------------------------------------------------------------------------------";
	
	echo "</div>";
	
}

########### OUTPUT THE DATA ##############
# Show a display for the Download CSV file link
echo "<a href=\"csv.php\" target=\"_blank\"><b>Download CSV file</b></a>";
echo "</BR></BR>";

# Just show a disclaimer about what you're seeing on the screen
echo "The following displays the payouts for ". date("F, Y.", strtotime("-1 month")) . " This software is used to collect data about our expenses that we owe each partner, and dynamically generate emails to send to those partners.";
echo "</BR></BR>";

# Declare this variable so that it doesn't bomb saying that it doesn't exist later.
$total = 0;
# Add new variable for tracking profit
$profit = 0;

# Reduce the transaction level
mysql_query( "SET TRANSACTION ISOLATION LEVEL READ COMMITTED" ) or die ( "Unable to lower transaction level to READ COMMITTED" );

# Go through the publisher by campaign by month query, and output the data.
while ($row = mysql_fetch_array($publisher_by_campaign_by_month)) {  
	
	# Add the CPV for the ad network to the CPV by ad network array.
    if(!isset($cpv_by_ad_network[$row["ad_network_name"]])) {
    	$cpv_by_ad_network[$row["ad_network_name"][$row["campaign_name"]]] = ($row["profit"] / $row["count"]);
	}
	
	# When we go through the loop, we're going to check if the ad network name we're going through exists in the $ad_network_names array. 
	# We're doing this because if it doesn't, we'll add it, and then leave it as a marker to make sure that instead of constantly outputting
	# the name of the ad network along with metadata, we want to make sure that we only output it once, and then put all the corresponding data underneath.
	if (in_array($row["ad_network_name"], $ad_network_names)) {
    	echo "</BR>";
               	
    	# Use the function above to output the data about the campaign_name by ad_network
		output_campaign_payouts_by_network($row["campaign_name"],$row["count"], $camp_name_to_advert_name[$row['campaign_name']]);
		
		# Check to see if the advertiser name is already in the list, if it is, skip it.
		if(!strpos($all_advertisers_by_ad_network[$row["ad_network_name"]], $camp_name_to_advert_name[$row["campaign_name"]])) {
			# Add the advertiser name to the advertiser list by ad network string.
			$all_advertisers_by_ad_network[$row["ad_network_name"]] = ($all_advertisers_by_ad_network[$row["ad_network_name"]] . "\n" . $camp_name_to_advert_name[$row["campaign_name"]]);
			}
			
    	# Use the function above to add to the csv about the campaign_name by ad_network    	
    	input_to_csv_campaign_payouts_by_network($row["count"], $row["ad_network_name"], $row["campaign_name"], $cpv_by_ad_network[$row["ad_network_name"][$row["campaign_name"]]], $fp);
    	    	
    	# We're going to keep adding to a $total variable that gets cleared every time we have a new network. This allows us to output the total
    	# payouts for that network at the bottom of each publisher.
    	$total = $total + $row["count"];
    	$profit = $profit + $row["profit"];
    	}
    
    # This is the case where the ad_network_name doesn't yet exist. We'll go through two pieces here. If $total isn't 0, that means we just finished
    # collecting all the data for the network, and we just changed over, from MySQL, into a new network name. That means we need to output the total payouts.
    # Otherwise, we set $total to 0, and continue on with creating a new ad_network level entry.
    else {
    		
    	# Checking to see if total is 0, if it isn't, output the total for the previous network that just completed.
    	if($total != 0){
    		echo "</br></br>";	
    		echo number_format($total) . " total payouts for the month";
    		    		
    		# Add all the data we've collected to the array we'll use to generate emails.
    		add_data_to_array( end($ad_network_names), $total, $all_advertisers_by_ad_network[end($ad_network_names)], $profit );
    		
    		echo '<HR>';
    		}
    	# If it is, set it to 0 so we can continue on fresh.
    	else {

    		$total = 0;
    		$profit = 0;
    		
    		}
    	
    	# Add the new ad_network_name to ad_network_name array, and then we output it.
    			
    	$ad_network_names[] = $row["ad_network_name"];
    	
    	echo '<b>' . $row["ad_network_name"];
    	echo "</BR></b>";

    	# Since this is the measure of a new network, don't append to the previous value in the array, create it.
		$all_advertisers_by_ad_network[$row["ad_network_name"]] = $camp_name_to_advert_name[$row["campaign_name"]];
    	
    	# Use the function above to output the data about the campaign_name by ad_network
    	output_campaign_payouts_by_network($row["campaign_name"],$row["count"], $camp_name_to_advert_name[$row['campaign_name']]);
    	
    	# Use the function above to add to the csv about the campaign_name by ad_network    	
    	input_to_csv_campaign_payouts_by_network($row["count"], $row["ad_network_name"], $row["campaign_name"], $cpv_by_ad_network[$row["ad_network_name"][$row["campaign_name"]]], $fp);
		
    	$total = $row["count"];
    	$profit = $row["profit"];
    	
    	}
    
    	    
}

# The last total payout won't execute because the last MySQL fetch will end, so this is run after the while loop is over.
echo "</BR></BR>";
echo number_format($total) . " total payouts for the month";

# Add all the data we've collected to the array we'll use to generate emails.
add_data_to_array( end($ad_network_names), $total, $all_advertisers_by_ad_network[end($ad_network_names)], $profit );

echo '<HR>';

fclose($fp);

?>
