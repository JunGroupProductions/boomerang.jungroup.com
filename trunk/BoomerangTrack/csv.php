<?php

$username = $_SERVER['PHP_AUTH_USER'];

if($username == "admin") {
        header('Content-Disposition: attachment; filename="file.csv"');
        header("Content-Type: text/csv");
        readfile("file.csv");
        }
else {
	echo "404 - This file does not exist on this server.";
	}
?>