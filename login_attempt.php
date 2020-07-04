<?php
include_once('config/connection.php');
include_once('config/validator.php');
require "./vendor/autoload.php";
use \Firebase\JWT\JWT;


// print_r($_POST);
$db = new DBConnect();
$conn = $db->getConnection();
$validator = new Validator($conn);
$email = $_POST["email"];
$password = $_POST["password"];
$emailValid = $validator->emailValidator($email);
if($emailValid == false){
    echo json_encode(array("status"=>"error","type"=>"Incorrect Username/Password"));
}
 else{
    $sql = "select id,username,email,password,verified from register where email = '".$email."' LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if($result){
        foreach($result as $r){
            $hashed_password = $r["password"];
                if(password_verify($password,$hashed_password)){
                    if($r["verified"] == 'Y'){
                        $now = time();
                        $key = "citation_project";
                        $payload = array(
                            "iss" => "http://example.org",
                            "aud" => "http://example.com",
                            "iat" => 1356999524,
                            "nbf" => 1357000000,
                            "data"=>array(
                                // "name" => "ganesh",
                                "id"    => $r["id"],
                                "email" => $r["email"],
                                "username"=> $r["username"]
                            ),
                        );            
                        $jwt = JWT::encode($payload, $key);  
						setcookie("token", $jwt, time()+3600, "/");
                        echo json_encode(array("status"=>"success","token"=>$jwt));  
                    }
                    else{
                        echo json_encode(array("status"=>"error","type"=>"User not Verified"));
                    }
                }
                else{
                    echo json_encode(array("status"=>"error","type"=>"Incorrect Username/Password"));
                }


        }
    }
 }
