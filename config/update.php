<?php 
	include_once("connection.php");
	include_once("validator.php");
	include_once("verify_token.php");
	include "../vendor/autoload.php";
	use Seboettg\CiteProc\StyleSheet;
	use Seboettg\CiteProc\CiteProc;
	class Update{
		public $conn;
		public function __construct($db){
			$this->conn = $db;
		}
		public function updateStyle($token, $bib_id, $bibStyle){
			$verifyToken = new Verify();
			$tokenData = $verifyToken->verify_token($token);
//			echo print_r($tokenData);
			if($tokenData['status']== 'success'){
				$stmt = $this->conn->prepare("UPDATE citation_groups set citation_style= '".$bibStyle."' WHERE group_id = '".$bib_id."'");
				$stmt->execute();
				$fetch_updated_bibs = new Fetch($this->conn);
				$res = $fetch_updated_bibs->get_bibliographies_groups($token,$bib_id);
				return $res;
			}
			else{
				return array("status"=>"error", "message" => "Token Not Verified!");
			}
		}
		public function updatePassword($token, $password){
			$verifyToken = new Verify();
			$tokenData = $verifyToken->verify_token($token);
//			echo print_r($tokenData);
			if($tokenData['status']== 'success'){
				$id = $tokenData['data']['id'];
				$email = $tokenData['data']['email'];
				$hashed_password = password_hash($password, PASSWORD_DEFAULT);
				$stmt = $this->conn->prepare("UPDATE register set password = '".$hashed_password."' where id='".$id."' and email = '".$email."'");
				$stmt->execute();
				return array("status"=>"success");
			}
			else{
				return array("status"=>"error", "message" => "Token Not Verified!");
			}
		}
	}
?>