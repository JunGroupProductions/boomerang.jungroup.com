<?php

###################################
# Connect to embed MySQL server
# Login and password to DB

$username = "realtimereport";
$password = "COzf7^W2Scz";

// shell_exec('ssh -L 3306:applications.read-only.db.embed.jungroup.com:3306 bc@relay.jungroup.com');

//$embed = mysqli_connect("applications.read-only.db.embed.jungroup.com",$username,$password);

# Assign the embed database
$database = "embed";

$embed = mysql_connect("127.0.0.1",$username,$password);

# Check to make sure we can connect to the "embed" db
mysql_select_db($database) or die("Unable to select embed database");

?>