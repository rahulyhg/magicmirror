<?php
print_r($_GET);
$posted = array();
if(!empty($_GET)) {
  foreach($_GET as $key => $value) {    
    $posted[$key] = $value;
  }
}
print_r($posted);
?>
