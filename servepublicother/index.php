<?php
require_once 'google/appengine/api/cloud_storage/CloudStorageTools.php';
use google\appengine\api\cloud_storage\CloudStorageTools;
$name=$_GET["name"];
//$bucket="magicmirroruploads/uploads";
CloudStorageTools::serve("gs://magicmirroruploads/other/$name");



?>