<html>
<header><title>Burning Bridge</title></header>

<head>
<link rel="icon" href="./images/favicon.ico">
<link rel="stylesheet" href="./css/style.css">

</head>


<body>

<video id="bgvid" defaultMuted playsinline autoplay muted loop>
<source src="/videos/printbw.webm" type="video/webm">
<source src="/videos/printbw.mp4" type="video/mp4">
</video>

<div id="CaNun">
<h1>Burning Bridge</h1>
<p>Created by Matěj Hrabal and Patrik Holop
<p><a href="./php/czindex.php">Czech/Česky</a>
<a href="./php/skindex.php">Slovak/Slovensky</a>
<p>
Burning bridge is what protects you from the traps of modern age. Have you ever felt that you no longer know, what is the truth? This webside is the right solution for you! It helps you analyze the given text or website to give you better look at what's real and what's so called FAKE NEWS.

<p><a href="https://github.com/Zlekrat/Carpe_nuntium">GitHub</a>
</div>


<div id="Engine">

<!-- Link copy-paste -->
<form method="post" action="<?=$_SERVER['PHP_SELF']?>">
	
	You can paste the link to your article here:</br></br>	
	<?=$error['source']?>
	Article link: <input type="text" id="source" name="source" value="<?=($_POST['source'] ? htmlentities($_POST['source']) : '')?>" />
  	
	<input type="submit" name="submit" value="Submit" />

</form>

<!-- File upload -->
<form action="./php/upload.php" method="post" enctype="multipart/form-data">
	Or you can upload text file here:</br></br>	
	Filename:&nbsp; <input type="file" name="fileToUpload" id="fileToUpload" /> 

	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="submit" name="upload" value="Submit" />
	
	</br>
</form>

<!-- Text copy-paste -->
<form action="./php/filewrite.php" method="POST">
	Or you can paste raw text here:</br></br>	
    Raw text: &nbsp;&nbsp;<input name="field" type="text" />
    <input type="submit" name="submit2" value="Submit">
</form>

<?php
//Form submitted
if(isset($_POST['submit'])) {
	//Error checking
	if(!$_POST['source']) {
		$error['source'] = "<p>Please supply source link</p>\n";
	}


  //No errors, process
if(!is_array($error)) {
    session_start();
	$_SESSION['s1'] = $_POST['source'];
	header("Location: ./php/loading.php");
    exit;
  }
}
?>



</body>
</html>
