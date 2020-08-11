<?php
//print_r($_GET["token"]);
require_once("../config/connection.php");
$token = $_GET["token"];
$db = new DBConnect();
$conn = $db->getConnection();
$query = "select token,verified from register where token='".$token."' and verified = 'N' LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();
$message = false;
if($result){
    foreach($result as $r){
        $sql = "UPDATE register SET verified='Y' WHERE token='".$token."'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        //echo $stmt->rowCount() . "Updated Successfully";
        //print_r($r); 
    }
    $message =  true;
}
else{
    $message = false;
}
include_once('../config/config.php');
include(ROOT_PATH ."header.php");
?>
    <div class="page-wrapper">
        <div class="container fluid">
        <section id="citation-result">
            <div class="spacer banner" style="background-image:url(images/background-6.png);">
                        <div class="container">
                        <h4>Verification</h4>
                            <div class="row">
                                <div class="col-md-8 ">
                                    <div class="card p-4">
                                        <div class="row ">
                                            <div class="col-md-12" id="cite" ><p class="font-weight-bold text-uppercase mb-0"><?php echo $message ? "Verified <br><a class='btn btn-success mt-2' href='".BASE_URL."login.php'>Login Now </a>" : "Invalid Token or Expired!";?></p></div>
                                            
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                <div class="card bg-success-gradiant text-white">
                                    <div class="card-body">
                                        <h6 class="font-medium text-white">Join Now</h6>
                                        <p class="m-t-20">Join Now to create, manage and upload custom citations.</p>
                                        <a href="<?php echo BASE_URL;?>signup.php" class="linking">Register Here <i class="fa fa-arrow-right"></i></a>
                                    </div>
                                </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                </section>
        </div>
    </div>


<?php
include(ROOT_PATH . "footer.php");
?>