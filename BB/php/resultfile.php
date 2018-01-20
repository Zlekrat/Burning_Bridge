<html>
<header><title>Burning Bridge - Your results</title></header>

<head>

<link rel="icon" href="../images/favicon.ico">
<link rel="stylesheet" href="../css/style.css">

<style>

#Results { 
	font-family: Agenda-Light, Agenda Light, Agenda, Arial Narrow, sans-serif;
	text-align: center;
	font-weight:100; 
	background: rgba(0,0,0,0.85);
	color: white;
	padding: 2rem;
	width: 55%;
	margin:2rem;
	position: absolute;
	top: 0;
	left: 0;
	font-size: 1.2rem;
}

#Keywords { 
	font-family: Agenda-Light, Agenda Light, Agenda, Arial Narrow, sans-serif;
	font-weight:100; 
	background: rgba(0,0,0,0.85);
	color: white;
	padding: 2rem;
	width: 28%;
	margin:2rem;
	position: absolute;
	top: 0;
	right: 0;
	font-size: 1.2rem;
}

#Last { 
	font-family: Agenda-Light, Agenda Light, Agenda, Arial Narrow, sans-serif;
	font-weight:100; 
	background: rgba(0,0,0,0.85);
	color: white;
	padding: 2rem;
	width: 55%;
	margin:2rem;
	position: absolute;
	left: 0;
	bottom: 0;
	font-size: 1.2rem;
}

#Last a {
	color: #fff;
}

#Results a {
	color: #fff;
}

.input {
    color: #fff;
    font-size: 110%;
}

.score {
    color: #fff;
    font-size: 130%;
}

.back a{
	display: inline-block;
	color: #fff;
	text-decoration: none;
	background:rgba(0,0,0,0.5);
	padding: 0.5rem;
	width: 82%;
	text-align: center;
	transition: .6s background; 
}

.back a:hover{
	background:rgba(0,0,0,0.9);
}

</style>

</head>


<body>

<video id="bgvid" defaultMuted playsinline autoplay muted loop>
<source src="../videos/printbw.webm" type="video/webm">
<source src="../videos/printbw.mp4" type="video/mp4">
</video>

<div id="Results">
<h1>Your results</h1>

<div class='score'>
</br>
Article quality score:
</br>
<?php
	session_start();
	$result = $_SESSION['s2'];
	$ten = 10;
	echo $result[0] / $ten;
	echo "/10";

	echo "</div>";
if ($result[0] < 25)
{
	echo "High chance of "; 
	echo "<span style=\"color: #ff1a1a\">fake</span>"; 
	echo " news";
}
else if($result[0] < 50)
{
	echo "Probably "; 
	echo "<span style=\"color: #ff1a1a\">fake</span>"; 
	echo " news";
}
else
{
	echo "Probably ";
	echo "<span style=\"color: #1aff1a\">real</span>"; 
	echo " news";
}

?>


<div class='back'>
<p><a href="../index.php">Try another file</a>
</div>
</div>

<?php
echo "<div id=\"Keywords\">";

echo "<div class='score'>";
echo "Keywords";
echo "</br>";
echo "</br>";
echo "</div>";

	echo $result[1];
echo "</div>";
?>

<div id="Last">
<h3>LAST SEARCHES</h3>
<?php
exec('tail -n 10 ../uploads/log.txt', $log);
$short8 = substr($log[8], 0, 57).'...';
$short6 = substr($log[6], 0, 57).'...';
$short4 = substr($log[4], 0, 57).'...';
$short2 = substr($log[2], 0, 57).'...';
$short0 = substr($log[0], 0, 57).'...';
echo "<a href='".$log[8]."'>$short8</a>";
echo " ".$log[9];
echo "<br />\n";
echo "<a href='".$log[6]."'>$short6</a>";
echo " ".$log[7];
echo "<br />\n";
echo "<a href='".$log[4]."'>$short4</a>";
echo " ".$log[5];
echo "<br />\n";
echo "<a href='".$log[2]."'>$short2</a>";
echo " ".$log[3];
echo "<br />\n";
echo "<a href='".$log[0]."'>$short0</a>";
echo " ".$log[1];
echo "<br />\n";
?>
</div>

</body>
</html>
