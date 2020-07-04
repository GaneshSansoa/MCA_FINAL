<?php 
    require "../vendor/autoload.php";
    use \Firebase\JWT\JWT;

    
    //$jwt = $_POST["token"]; 

    class Verify extends JWT{
        public $inp_token;
        public $key = "citation_project";
        public function verify_token($token){
            $this->inp_token = $token;
            try{
                $decoded = JWT::decode($this->inp_token, $this->key, array('HS256'));
                // print_r($decoded);
                $decoded_array = (array) $decoded;
                $data = (array) $decoded_array['data'];
                // echo $data['email'];
                // $data_array = (array) $data;
                return array('status'=>'success',"data"=>array("id"=>$data['id'],"email"=>$data['email'],"username"=>$data['username']));
                // print_r($decoded_array['data']);
                // foreach( $decoded_array as $ar){
                //     print_r($decoded_array[$ar]);
                // }

            }
            catch(Exception $e){
                //print_r($e->message);
                // echo $e->message;
                // print_r($e->getMessage());
                return array('status'=>'error','msg'=>$e->getMessage());
                // echo "da";
            }
        }        
    }

    
    // print_r($decoded);
?>