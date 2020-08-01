<?php 
	include_once('../config/connection.php');
	include_once('../config/insert.php');
	include_once('../config/fetch.php');
	include_once('../config/update.php');
	$db = new DBConnect();
	$conn = $db->getConnection($db);

	if(isset($_POST)){
		if(isset($_POST['type']) && $_POST['type'] == "create-bib"){
			$bibName = $_POST['bibName'];
			$bibStyle = $_POST['bibStyle'];
			$bibType = $_POST['bibType'];
			$token = $_COOKIE['token'];	
					
			$insertBibObj = new Insert($conn);
			$res = $insertBibObj->insertBibliography($bibName,$bibStyle,$bibType,$token);
			echo json_encode($res);
		}
		if(isset($_POST['type']) && $_POST['type'] == "save-bibliography"){
			$bibString = $_POST['bibJson'];
			$bib_id = $_POST['bibValue'];
			$bib_style = $_POST['bibStyle'];
			$token = $_COOKIE['token'];
			$saveBibObj = new Insert($conn);
			$res = $saveBibObj->insertGroup($token,$bib_id,$bibString);
			echo json_encode($res);
		}
		if(isset($_POST['type']) && $_POST['type'] == "change-style"){
			$bib_id = $_POST["bib_id"];
			$bibStyle = $_POST["bibStyle"];
			$token = $_COOKIE['token'];
			$updateStyle = new Update($conn);
			$res = $updateStyle->updateStyle($token, $bib_id, $bibStyle);
			echo json_encode($res);
		}
		if(isset($_POST['type']) && $_POST['type'] == "old-password-check"){
			$password = $_POST["oldPassword"];
			$token = $_COOKIE["token"];
			$fetch = new Fetch($conn);
			$res = $fetch->checkPassword($token,$password);
			echo json_encode($res);
			//echo json_encode (array("status"=>"error"));
		}
		if(isset($_POST['type']) && $_POST['type'] == "change-password"){
			$password = $_POST["newPassword"];
			$token = $_COOKIE["token"];
			$update = new Update($conn);
			$res = $update->updatePassword($token,$password);
			echo json_encode($res);
		}
		if(isset($_POST['type']) && $_POST['type'] == "upload-style"){
//			print_r($_POST);
//			print_r($_FILES);
			$token = $_COOKIE["token"];
			$cslFile = $_FILES['file'];
			$insert = new Insert($conn);
			$res = $insert->uploadCustomStyle($token,$cslFile);
			echo json_encode($res);
		}
	}
	if(isset($_GET)){
		if(isset($_GET['type']) && $_GET['type'] == "get-bib"){
			$token = $_COOKIE['token'];
				
			$fetchbib = new Fetch($conn);
			$bib_data = $fetchbib->get_bibliographies($token);
			echo json_encode($bib_data);
		}
		if(isset($_GET['type']) && $_GET['type'] == "get-bib-groups"){
			$token = $_COOKIE['token'];
			$bibId = $_GET['bibId'];
			$fetchbib = new Fetch($conn);
			$bib_data = $fetchbib->get_bibliographies_groups($token,$bibId);
			echo json_encode($bib_data);
		}
	}
?>