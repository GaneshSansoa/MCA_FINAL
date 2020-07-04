<?php 
	include_once('config.php');
	include_once("verify_token.php");
	require("sendverification.php");
	//$db = new DBConnect();
	class Insert{
		public $conn;
		//protected $db_name;
		public function __construct($db){
			$this->conn = $db;
			
		}
		public function insertSignup($arr){
			//echo "Add Data to database";
//			echo print_r($arr);

			try{
				$stmt = $this->conn->prepare("INSERT INTO register (username, email, password, verified,token)
				VALUES (:username, :email, :password, :verified, :token)");
				$stmt->bindParam(':username', $username);
				$stmt->bindParam(':email', $email);
				$stmt->bindParam(':password', $password);
				$stmt->bindParam(':verified', $verified);
				$stmt->bindParam(':token',$token);
				$username = $arr["username"];
				$email = $arr["email"];
				$password = password_hash($arr['password'], PASSWORD_DEFAULT);
				$verified = 'N';		
				$token = bin2hex(random_bytes(50)); // generate unique token	
//				$this->db->exec($sql);
				$validateFromDb = new Validator($this->conn);
				//$validateFromDb->userEmailValidator($username,$email);
				//$stmt->execute();
//				return true;
				$userValidate = $validateFromDb->userValidator($username);
				$emailValidate = $validateFromDb->emailValidator($email);
				if($userValidate == false && $emailValidate == false){
					$stmt->execute();
					//return true;
					sendVerificationEmail($email,$token);
					echo json_encode(array("response"=> array("status"=>"success")));
				}
				else{
					echo json_encode(array("response"=> array("status"=>"error")));
				}

			}
			catch(PDOException $e){
				echo $sql . "</br>" . $e->getMessage();
			}
		}
		public function insertBibliography($bibName,$bibStyle,$token){
			$verifyToken = new Verify();
			$tokenData = $verifyToken->verify_token($token);
			if($tokenData['status']== 'success'){
				$id = $tokenData['data']['id'];
				$bibValidate = new Validator($this->conn);
				$bibValidate = $bibValidate->bibliographyValidator($id,$bibName);
				if($bibValidate['status'] == 'success'){
					$stmt = $this->conn->prepare("INSERT INTO citation_groups (user_id, group_name,citation_style)
						VALUES (:user_id, :group_name,:citation_style)");
					$stmt->bindParam(':user_id', $id);
					$stmt->bindParam(':group_name', $bibName);
					$stmt->bindParam(':citation_style', $bibStyle);
					$stmt->execute();
					return array('status'=>'success','group_id'=>$bibValidate['group_id']);					
				}
				else{
					return $bibValidate;
				}
				

			}
			else{
				
			}

		}
		public function insertGroup($token,$bib_id,$bibString){
			$verifyToken = new Verify();
			$tokenData = $verifyToken->verify_token($token);
			if($tokenData['status']== 'success'){
				$id = $tokenData['data']['id'];
				$stmt = $this->conn->prepare("INSERT INTO user_citations(group_id,citations) values(:group_id, :citations)");
				$stmt->bindParam(':group_id',$bib_id);
				$stmt->bindParam(':citations',$bibString);
				$stmt->execute();
				//$stmt = $this->conn->prepare();
				return array('status'=>'success');
			}
			else{
				return array('status'=>'error');
			}
		}
		public function uploadCustomStyle($token, $cslFile){
			$verifyToken = new Verify();
			$tokenData = $verifyToken->verify_token($token);
//			print_r($tokenData['data']['id']);die;
			if($tokenData['status']== 'success'){
				$user_id = $tokenData["data"]["id"];
				$upload_dir = ROOT_PATH . "vendor/citation-style-language/styles-distribution/custom-styles/";
				$target_dir = $upload_dir .$user_id . "/";
				//echo $target_dir;die;
				$target_file = $target_dir . basename($cslFile["name"]);
				if(is_dir($target_dir)){
					if (file_exists($target_file)) {
						return array('status'=>'error', 'message' => 'File already exists!');
					//	$uploadOk = 0;
					}
					else{
						if (move_uploaded_file($cslFile["tmp_name"], $target_file)) {
							return array('status'=>'success');
						}
					}
				}
				else{
					echo $target_dir;
					mkdir($target_dir, 0777);
					if (move_uploaded_file($cslFile["tmp_name"], $target_file)) {
						return array('status'=>'success');
					}
				}

			}
			else{
				return array('status'=>'error', 'message' => 'Invalid Token!');
			}	
		}
	}


?>