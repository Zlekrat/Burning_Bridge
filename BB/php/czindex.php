<html>
<header><title>Burning Bridge</title></header>

<head>
<link rel="icon" href="../images/favicon.ico">
<link rel="stylesheet" href="../css/style.css">

</head>


<body>

<video id="bgvid" defaultMuted playsinline autoplay muted loop>
<source src="/videos/printbw.webm" type="video/webm">
<source src="/videos/printbw.mp4" type="video/mp4">
</video>

<div id="CaNun">
<h1>Burning Bridge</h1>
<p>Vytvořili Matěj Hrabal a Patrik Holop
<p><a href="../index.php">Anglicky/English</a>
<a href="./skindex.php">Slovak/Slovensky</a>

<p>
Burning bridge vám pomůže se vyvarovat pastím moderní doby. Měli jste někdy pocit, že nedokážete rozeznat pravdu od lži? Potom je pro vás tato stránka jako stvořená! Pomůže vám analyzovat texty nebo články a rozhodnout se, zda se jedná o pravdivé a nebo FAKE NEWS.
<p><a href="https://github.com/Zlekrat/Carpe_nuntium">GitHub</a>
</div>


<div id="Engine">

<!-- Link copy-paste -->
<form method="post" action="<?=$_SERVER['PHP_SELF']?>">
	
	Sem vložte odkaz na váš článek:</br></br>	
	<?=$error['source']?>
	Odkaz na článek: <input type="text" id="source" name="source" value="<?=($_POST['source'] ? htmlentities($_POST['source']) : '')?>" />
  	
	<input type="submit" name="submit" value="Submit" />

</form>

<!-- File upload -->
<form action="./upload.php" method="post" enctype="multipart/form-data">
	Nebo nahrajte textový dokument:</br></br>	
	Soubor: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
	 <input type="file" name="fileToUpload" id="fileToUpload" /> 

	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="submit" name="upload" value="Submit" />
	
	</br>
</form>

<!-- Text copy-paste -->
<form action="./filewrite.php" method="POST">
	Nebo vložte text v přímé podobě:</br></br>	
    Váš text: &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
	 <input name="field" type="text" />
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
	header("Location: ./loading.php");
    exit;
  }
}
?>



</body>
</html>
