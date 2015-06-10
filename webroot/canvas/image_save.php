<?php
if ($this->request->session()->read('debug')) {
    echo "<span style ='color:red;'>subpages/canvas/image_save.php #INC???</span>";
}
$data = $_POST['imagedata'];
$filename = rand(100000,999999).'_'.rand(100000,999999).'.png';//this does not guarantee a unique filename
//Need to remove the stuff at the beginning of the string
$data = substr($data, strpos($data, ",")+1);
$data = base64_decode($data);
/*
if(!isset($_GET['oid']))
$imgRes = imagecreatefromstring($data);
else{
if($_SERVER['SERVER_NAME'] == 'localhost')
$path = $_SERVER["DOCUMENT_ROOT"].'/webroot/orders/'.$_GET['oid'].'/'.$filename;
$imgRes = imagecreatefromstring($data,$path);
}
*/
$imgRes = imagecreatefromstring($data);
if($imgRes !== false && imagepng($imgRes, $filename) === true)
    echo "{$filename}";
