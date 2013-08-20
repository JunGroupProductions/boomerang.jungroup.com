<?php

###################################
# Connect to embed MySQL server
# Login and password to DB

$username = "realtimereport";
$password = "COzf7^W2Scz";

$embed = mysql_connect("applications.read-only.db.embed.jungroup.com",$username,$password);

# Assign the embed database
$database = "embed";

# Check to make sure we can connect to the "embed" db
@mysql_select_db($database) or die("Unable to select embed database");

?>