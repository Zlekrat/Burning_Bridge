<?php
	session_start();
	$source = $_SESSION['s1'];
	exec("/var/www/html/python/web_scraper.py -s \"$source\"", $output);
	$_SESSION['s2'] = $output;
	header("Location: ./result.php");
	exit();
?>
