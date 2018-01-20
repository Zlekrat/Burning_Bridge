<?php
	session_start();
	exec("/var/www/html/python/web_scraper.py -t ../uploads/upload.txt", $output);
	$_SESSION['s2'] = $output;
	header("Location: ./resultfile.php");
	exit();
?>
