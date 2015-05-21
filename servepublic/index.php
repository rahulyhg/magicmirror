<?php
require_once 'google/appengine/api/cloud_storage/CloudStorageTools.php';
use google\appengine\api\cloud_storage\CloudStorageTools;
header('Content-Type: text/csv');

$name=$_GET["name"];
header('Content-Disposition: attachment; filename='.$name);
//$bucket="magicmirroruploads/uploads";
CloudStorageTools::serve("gs://magicmirroruploads");



?>