<?php 
	include_once('config/connection.php');
	include_once('config/insert.php');
	include_once('config/validator.php');
	$db = new DBConnect();
	$conn = $db->getConnection($db);
	if(isset($_POST["type"])){
		if($_POST["type"]=="userValidate"){
			//		echo "Validate User Here";
			$user_obj = new Validator($conn);
			$username = $_POST["username"];
			$validateFromDb = $user_obj->userValidator($username);
			echo json_encode(array("username"=>$validateFromDb));
			die;
				}
		if($_POST["type"]=="emailValidate"){
			$email_obj = new Validator($conn);
			$email = $_POST["email"];
			$validateFromDb = $email_obj->emailValidator($email);
			echo json_encode(array("email"=>$validateFromDb));
			die;
				}			
	}
		$insert = new Insert($conn);
		echo $insert->insertSignup($_POST);
	
?>