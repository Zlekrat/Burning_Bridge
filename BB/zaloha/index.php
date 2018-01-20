<html>
<header><title>Carpe Nuntium</title></header>

<head>
<style>

input[type="submit"] {
    width: 200px; /* width of image */
    height: 50px; /* height of image */
    border: 1;
}

h2 {
    margin-left: 44%;
    margin-top: 2%;
	font: Georgia, serif;
} 


input[type=text] {
    width: 35%;
	display: inline-block;
    padding: 12px 20px;
    box-sizing: border-box;
	border: 2px solid #555;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}

body {
  margin: 0;
  background: #000; 
}
video { 
    position: fixed;
    top: 50%;
    left: 50%;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    z-index: -100;
    transform: translateX(-50%) translateY(-50%);
 background: url('/images/fake-news.jpg') no-repeat;
  background-size: cover;
  transition: 1s opacity;
}
.stopfade { 
   opacity: .5;
}

#CaNun { 
  font-family: Agenda-Light, Agenda Light, Agenda, Arial Narrow, sans-serif;
  font-weight:100; 
  background: rgba(0,0,0,0.85);
  color: white;
  padding: 2rem;
  width: 33%;
  margin:2rem;
  float: right;
  font-size: 1.2rem;
}

h1 {
  font-size: 3rem;
  text-transform: uppercase;
  margin-top: 0;
  letter-spacing: .3rem;
}

#CaNun button { 
  display: block;
  width: 80%;
  padding: .4rem;
  border: none; 
  margin: 1rem auto; 
  font-size: 1.3rem;
  background: rgba(255,255,255,0.23);
  color: #fff;
  border-radius: 3px; 
  cursor: pointer;
  transition: .3s background;
}

#CaNun button:hover { 
   background: rgba(0,0,0,0.5);
}

a {
  display: inline-block;
  color: #fff;
  text-decoration: none;
  background:rgba(0,0,0,0.5);
  padding: .5rem;
  transition: .6s background; 
}
a:hover{
  background:rgba(0,0,0,0.9);
}
@media screen and (max-width: 500px) { 
  div{width:70%;} 
}
@media screen and (max-device-width: 800px) {
  html { background: url(/images/fake-news.jpg) #000 no-repeat center center fixed; }
  #bgvid { display: none; }
}

</style>

<link rel="icon" href="./images/favicon.ico">

</head>


<body>

<video poster="/videos/fake-news.jpg" id="bgvid" playsinline autoplay muted loop>
<source src="/videos/print.webm" type="video/webm">
<source src="/videos/print.mp4" type="video/mp4">
</video>

<div id="CaNun">
<h1>Carpe Nuntium</h1>
<p>Created by Matěj Hrabal and Patrik Holop
<p><a href="index.php">Czech/Česky</a>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur porta dictum turpis, eu mollis justo gravida ac. Proin non eros blandit, rutrum est a, cursus quam. Nam ultricies, velit ac suscipit vehicula, turpis eros sollicitudin lacus, at convallis mauris magna non justo. Etiam et suscipit elit. Morbi eu ornare nulla, sit amet ornare est. Sed vehicula ipsum a mattis dapibus. Etiam volutpat vel enim at auctor.</p>
<p>Aenean pharetra convallis pellentesque. Vesti.</p>
<p><a href="index.php">GitHub</a>
</div>


<?php
//Form submitted
if(isset($_POST['submit'])) {
  //Error checking
  if(!$_POST['source1']) {
    $error['source1'] = "<p>Please supply source 1</p>\n";
  }

  if(!$_POST['source2']) {
    $error['source2'] = "<p>Please supply source 2</p>\n";
  }

  //No errors, process
  if(!is_array($error)) {
    session_start();
	$_SESSION['s1'] = $_POST['source1'];
	$_SESSION['s2'] = $_POST['source2'];

	header("Location: /php/result.php");
    exit;
  }
}
?>


<form method="post" action="<?=$_SERVER['PHP_SELF']?>">
	
	<?=$error['source1']?>
	Source 1: <input type="text" id="source1" name="source1" value="<?=($_POST['source1'] ? htmlentities($_POST['source1']) : '')?>" />

	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;

	<?=$error['source2']?>
	Source 2: <input type="text" id="source2" name="source2" value="<?=($_POST['source2'] ? htmlentities($_POST['source2']) : '')?>" />

  	<p><input type="submit" name="submit" value="Submit" /></p>
</form>

<form action="upload_file.php" method="post" enctype="multipart/form-data">
      <label for="file">Filename:</label>
      <input type="file" name="file" id="file" /> 

      <br />

      <input type="submit" name="submit" value="Submit" />
</form>

<?php
//$command = escapeshellcmd('/var/www/html/python/web_scrapper.py');
//$output = shell_exec($command);
//echo $output;

//ob_start();
//passthru('./python/web_scrapper.py');
//$output = ob_get_clean(); 
//echo $output;

//ini_set('display_errors',1); error_reporting(-1);
//$command = '/usr/bin/python3 ./python/beautifulsoup4-4.6.0/hello2.py';
//exec($command, $out, $status);
//echo $out[0];
//echo $status;

// use system for full print
$output = exec('/var/www/html/python/web_scrapper.py', $retval);
echo $output;
//echo $retval;
exit;
?>


</body>
</html>
