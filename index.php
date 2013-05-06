<html>

<script type="text/javascript">
<!--
    function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
//-->
</script>

<?php

if($_SERVER['SERVER_NAME'] == "pubtrack.jungroup.com") {
	echo "<center><img src=\"jun_logo.jpg\"><br></center>";
	}
elseif($_SERVER['SERVER_NAME'] == "reporting.hyprmx.com") {
	echo "<center><img src=\"http://i.imgur.com/HVuWk.png\"><br></center>";
	}

?>

<style type="text/css" media="all">@import "css_gfx/extranet.css";</style>

<div id="content">


<?php

### This script really is a redirector. It parses your login, and will direct you either to the publisher.php or the admin.php depending on your usenr.
### It's some CSS, a title, and a redirect.

require 'config.php';

# Use the logged in user to dynamically generate the ad network site.
# We'll give the ad network or game publisher access from an .htaccess name, and that
# will generate their page.

# In this case, it is ESSENTIALLY important that we do not give htaccess names that do
# not match ad_network names.

if (!isset($_SERVER['PHP_AUTH_USER']))
{
    $_SERVER['PHP_AUTH_USER'] = 0;
}

$publisher_name = $_SERVER['PHP_AUTH_USER'];

#### Get the video names and video ids from the database by looking up the campaign 

# What is the name of the campaign we're running? This appears as the heading.
$name_of_campaign = 'Payout Tracker';

# Show the name of the ad network on the right of the pane.
$watermark = $publisher_name;

echo "<div id='clientTitleModule'>";

echo "<div id='clientTitle'>:: Client Extranet :: [ Payout Tracker v2 ] </a></div>";
echo "<div id='backNav'>&nbsp;</div><br /><br>";

# Use CSS to show the nice top banner and such for the design.
?>
		<div id="asset">
			<div id="assetTitleModule">
				<div id="assetTitle"><?php echo $name_of_campaign?></div>
				<div id="assetDate"><?php echo $watermark?></div>
			</div>
			<br>
<?php

# Instead of having the MYSQL below, we're going to pull in the required PHP file based on the user you are.
# If you are an admin user, we'll pull in admin.php. If you're a regular publisher user, we'll pull in publisher.php

if($publisher_name != "admin") {
	require 'publisher.php';
	}
else {
	require 'admin.php';
	}
	
?>