<?php

// set the expiration date to one hour ago
setcookie("token", "", time() - 3600,"/");
echo json_encode(array("status"=>"success"));
die;
?>