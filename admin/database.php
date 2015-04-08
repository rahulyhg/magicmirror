<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "magicmirror";
//$ci=& get_instance();
//$dbname=$ci->config->load('magicmirror');
//$ci->config->item('item name');
// Create connection
//include(APPPATH.'application/config/database'.EXT);
//$conn = mysql_connect($db['default']['hostname'], $db['default']['username'], $db['default']['password']);

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>