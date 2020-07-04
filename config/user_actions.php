<?php 
include_once('config/connection.php');
	include_once('config/insert.php');
	$db = new DBConnect();
	$conn = $db->getConnection($db);
	if(isset($_POST)){
		if($_POST['type']=="create-bib"){
			
		}
	}
?>