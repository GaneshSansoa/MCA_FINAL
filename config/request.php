<?php
    include_once('verify_token.php');
    $token = $_POST['token'];
    $verify = new Verify();
    $returned_data = $verify->verify_token($token);
    if($returned_data['status'] == 'success'){
        echo json_encode($returned_data['data']);
    }
    else{
        echo json_encode(array('msg'=>$returned_data['msg']));
    } 

?>