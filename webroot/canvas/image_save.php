<?php

$data = $_POST['imagedata'];
$filename = rand(100000,999999).'_'.rand(100000,999999).'.png';
//Need to remove the stuff at the beginning of the string
$data = substr($data, strpos($data, ",")+1);
$data = base64_decode($data);
$imgRes = imagecreatefromstring($data);
if($imgRes !== false && imagepng($imgRes, $filename) === true)
    echo "{$filename}";
