<html>
<center><img src="jun_logo.jpg"><br></center>

<style type="text/css" media="all">@import "css_gfx/extranet.css";</style>

<div id="content">

<?php

# Login and password to DB

$username = "appinstallread";
$password = "COzf7^W2Scz";
$database = "mobile";

# Connect to jotbit SQL, to check for installs
mysql_connect("video.jotbit.com",$username,$password);

# Check to make sure we can connect to the "mobile" db
@mysql_select_db($database) or die("Unable to select database");

# Count all installs before we started by date
$raw_data = mysql_query("SELECT time,inet_ntoa(ip),user_id from app_install where app_id = 'a14bfc39cbe4e5c' order by time desc");

echo "<div id='clientTitleModule'>";

echo "<div id='clientTitle'>:: Grand Marnier - Extranet :: [ App Install Tracker ]</a></div>";
echo "<div id='backNav'>&nbsp;</div><br /><br>";

?>

		<div id="asset">
			<div id="assetTitleModule">
				<div id="assetTitle">Grand Marnier Raw Data</div>
				<div id="assetDate">7/1/2010</div>
			</div>
			<br>
<?

echo "<a href='index.php'>Go back to top-line view</a>";

echo "<div id='assetDate'>";

echo "<br />";


# Iterate through all the rows in the DB and output the date and # of installs for pre-launch

while($raw_data_row = mysql_fetch_array($raw_data)){
	echo $raw_data_row['time']. " - ". $raw_data_row['inet_ntoa(ip)']. " - ". $raw_data_row['user_id'];
	echo "<br />";
}

echo "</div></div></div>";

mysql_close();

?>

<center><img src="vm_logo.jpg"></center>
</html>
