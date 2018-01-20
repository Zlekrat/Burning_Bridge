<html>
<header><title>Burning Bridge - Your results</title></header>

<head>

<link rel="icon" href="../images/favicon.ico">
<link rel="stylesheet" href="../css/style.css">

<style>


img{
    height: auto; 
    width: auto; 
    max-width: 70%; 
    max-height: 70%;
	display: block;
	margin-left: auto;
    margin-right: auto;

}

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

#Keywords a {
	color: #fff;
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

<div class='input'>
<?php
session_start();
$source = $_SESSION['s1'];
$result = $_SESSION['s2'];
$shorturl = substr($source, 0, 57).'...';

echo "<a href='".$source."'>$shorturl</a>";
?>
</div>
<div class='score'>
</br>
Article quality score:
</br>

<?php
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
<p><a href="../index.php">Try another link</a>
</div>
</div>


<?php
echo "<div id=\"Keywords\">";
if ($result[3] != '' && $result[1] != '')
{
echo "<div class='score'>";
echo "</br>";
echo "Author(s):";
echo "</div>";
echo "</br>";

	echo $result[1];

echo "<div class='score'>";
echo "</br>";
echo "Date:";
echo "</div>";
echo "</br>";

	echo $result[2];

echo "<div class='score'>";
echo "</br>";
echo "Keywords:";
echo "</div>";
echo "</br>";

	echo $result[3];

echo "<div class='score'>";
echo "</br>";
echo "Genealogy:";
echo "</div>";
echo "</br>";
echo "<img src=\"../uploads/graph.png\" />";
}
else
{
echo "<div class='score'>";
echo "</br>";
echo "Wall of shame";
echo "</div>";
echo "</br>";
echo "These pages managed to get scores of 0:"; 
echo "</br>";
echo "</br>";
echo "<img src=\"../uploads/shame.jpg\" />";
echo "</br>";
echo "<a href='https://aeronet.cz/news/podle-lidovych-novin-jsou-typickymi-volici-milose-zemana-hlavne-ctenari-aeronetu-ktere-pry-charakterizuje-nizsi-socialni-uroven-nizky-prijem-a-pokrocily-vek-analytik-ln-presto-doporucuje/
'>https://aeronet.cz/news/podle...</a>";
echo "</br>";
echo "<a href='https://www.vutbr.cz/absolventi/aktuality-f56712/lukas-putna-zkusenost-ze-seznamu-byla-k-nezaplaceni-nyni-jsem-ale-spokojenejsi-v-mensi-firme-d163758'>https://www.vutbr.cz/absolven...</a>";
echo "</br>";
echo "<a href='https://www.theguardian.com/lifeandstyle/2018/jan/20/why-i-chose-polyamory-anita-cassidy'>https://www.theguardian.com/...</a>";
}
echo "</div>";
?>

<?php
	// Save last search
	$myfile = fopen("../uploads/log.txt", "a");
	// Basic filter for bad links
	if (strpos($source, '.') === false ||
		strpos($source, ' ') !== false || 
		strpos($source, 'ě') !== false || 
		strpos($source, 'š') !== false || 
		strpos($source, 'č') !== false || 
		strpos($source, 'ř') !== false || 
		strpos($source, 'ž') !== false || 
		strpos($source, 'ý') !== false || 
		strpos($source, 'á') !== false || 
		strpos($source, 'í') !== false || 
		strpos($source, 'é') !== false || 
		strpos($source, 'ú') !== false || 
		strpos($source, 'ů') !== false || 
		strpos($source, 'dick') !== false || 
		strpos($source, 'pussy') !== false || 
		strpos($source, 'shit') !== false || 
		strpos($source, 'fuck') !== false || 
		strpos($source, 'porn') !== false || 
		strpos($source, 'hovno') !== false || 
		strpos($source, 'debil') !== false || 
		strpos($source, 'kokot') !== false  
	) {
		header('Location: ./badlink.php');
	}
	else
	{
		fwrite($myfile, "\n".$source);
		fwrite($myfile, "\n".$result[0]/$ten."/10");
		fclose($myfile);
	}
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
