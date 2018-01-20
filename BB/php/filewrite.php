<?php
if(isset($_POST['field'])) {
    $data = $_POST['field'];
    $ret = file_put_contents('../uploads/upload.txt', $data, FILE_WRITE | LOCK_EX);
	header("Location: loadingfile.php");
    if($ret === false) {
        die('There was an error writing this file');
    }
    else {
        echo "$ret bytes written to file";
    }
}
else {
   die('no post data to process');
}
?>
