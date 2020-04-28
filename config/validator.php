<?php
//include_once('connection.php');
class Validator{
    public $conn;
    protected $username;
    protected $email;
    public function __construct($db){
        $this->conn = $db;
    }
    public function userValidator($username){
        $query = "select username from register where username='".$username."'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $response = array();
        if($result){
            return true;
            //echo json_encode(array("response"=>$response));
        }
        else{
            return false;
            //echo json_encode(array("response"=>$response));
        }
    }
    public function emailValidator($email){
        $query = "select email from register where email='".$email."'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $response = array();
        if($result){
            return true;
            //echo json_encode(array("response"=>$response));
        }
        else{
            return false;
            //echo json_encode(array("response"=>$response));
        }
    }
    public function userEmailValidator($username, $email){
        $query = "select username, email from register";
        $stmt = $this->conn->prepare($query);
        //$stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $result = $stmt->fetchAll();
        //$result = 
//        echo print_r($result);
        $val["error"] = [];
        $this->username = $username;
        $this->email = $email;
        foreach($result as $r){
//            echo print_r($r["username"]);
            if($this->username == $r["username"]){
                $val["error"] += array("username"=>true);
                
            }
            else if($this->email == $r["email"]){
                $val["error"] +=array("email"=>true);
            }
            else{
                $val["error"]+= array("");
            }
            echo json_encode($val);
//            echo print_r($val);
        }
    }
}