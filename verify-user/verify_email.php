<?php
//print_r($_GET["token"]);
require_once("../config/connection.php");
$token = $_GET["token"];
$db = new DBConnect();
$conn = $db->getConnection();
$query = "select token,verified from register where token='".$token."' and verified = 'N' LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();
if($result){
    foreach($result as $r){
        $sql = "UPDATE register SET verified='Y' WHERE token='".$token."'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        //echo $stmt->rowCount() . "Updated Successfully";
        //print_r($r); 
    }
    echo "Verified!";
}
else{
    echo "Invalid Token or Expired!";
}

?>