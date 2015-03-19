<?php
//var_dump($_FILES['uploaded_files']['tmp_name']);
header("Access-Control-Allow-Origin: *");
header('Content-type: application/javascript');


require_once 'google/appengine/api/cloud_storage/CloudStorageTools.php';
use google\appengine\api\cloud_storage\CloudStorageTools;
$object_url=$_FILES['uploaded_files']['tmp_name'];
$bucket="lylaimages2";
$t=time();
$newfilename="image_".$t."_".$_FILES['uploaded_files']['name'];
move_uploaded_file($object_url, "gs://$bucket/$newfilename");
$_FILES['uploaded_files']['tmp_name']="gs://$bucket/$newfilename";
echo json_encode($_FILES['uploaded_files']);
//$object_image_url = CloudStorageTools::getImageServingUrl($object_url,
//                                                          ['size' => 400, 'crop' => true]);
//echo $object_image_url;
?>