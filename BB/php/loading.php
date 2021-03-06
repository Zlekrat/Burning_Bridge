<html>
<header><title>Burning Bridge - Preparing your results</title></header>

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
<source src="../videos/vecernicek.webm" type="video/webm">
<source src="../videos/vecernicek.mp4" type="video/mp4">
</video>

<div id="Results">
<h1>Your results</h1>

<div class='input'>
<?php
session_start();
$source = $_SESSION['s1'];


echo "<a href='".$source."'>$source</a>"
?>


</div>
<div class='score'>
</br>
Preparing results...
</br>

</div>


<div class='back'>
</div>
</div>

</body>
</html>


<script type="text/javascript">
window.location.href = 'http://www.burningbridge.eu/php/loading2.php';
</script>

