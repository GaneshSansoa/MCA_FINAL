

<?php
include_once('config/config.php');
include_once(ROOT_PATH.'header.php');

include "vendor/autoload.php";
use Seboettg\CiteProc\StyleSheet;
use Seboettg\CiteProc\CiteProc;

$get_data = $_POST["data"];
$type = $_POST["formatType"];
//print_r($get_data);die;
//$data = file_get_contents($get_data);
$style = StyleSheet::loadStyleSheet($type);
$citeProc = new CiteProc($style);
$bibliography = $citeProc->render(json_decode($get_data), "bibliography");
$cssStyles = $citeProc->renderCssStyles();
// echo $bibliography;
?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Static Slider 1  -->
                <!-- ============================================================== -->
                <div class="bg-light">
                    <section>
                        <div id="banner2" class="banner spacer" style="background-image:url(<?php echo BASE_URL; ?>images/background-4.svg);">
                            <div class="container">	
                                <div class="row justify-content-center">
                                    <div class="col-md-12 col-lg-12 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1500">
                                       
                                        <div class="m-t-40">
                                            <div class="card">
                                                
                                                <?php echo $bibliography;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>



<?php include_once(ROOT_PATH.'footer.php');
?>