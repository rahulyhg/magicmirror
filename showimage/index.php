<?php
//var_dump($_FILES['uploaded_files']['tmp_name']);
require_once 'google/appengine/api/cloud_storage/CloudStorageTools.php';
use google\appengine\api\cloud_storage\CloudStorageTools;
//var_dump( $_GET);
$object_url=$_GET["image"];
$size=intval($_GET["size"]);
$object_image_url = CloudStorageTools::getImageServingUrl($object_url,['size' => $size, 'crop' => false]);
header("location: $object_image_url");
?>