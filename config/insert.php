<?php 
	include_once("connection.php");
	include_once("validator.php");
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
	}


?>