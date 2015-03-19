<?php 
require_once 'google/appengine/api/cloud_storage/CloudStorageTools.php';
use google\appengine\api\cloud_storage\CloudStorageTools;

$options = [ 'gs_bucket_name' => 'lylaimages2' ];
$upload_url= new stdClass();
$upload_url->url = CloudStorageTools::createUploadUrl('/uploadsuccess', $options);
header("Access-Control-Allow-Origin: *");
header('Content-type: application/javascript');

echo json_encode($upload_url);
?>