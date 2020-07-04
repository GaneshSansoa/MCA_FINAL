<?php 
include_once('config/config.php');
include(ROOT_PATH ."header.php");?>
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
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
                        <div id="banner2" class="banner spacer" style="background-image:url(images/background-4.svg);">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-7 col-lg-5 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1500">
                                       
                                        <div class="mt-md-5">
                                          <div class="card card-login">
											<form class="form" id="login_form" method="post" action="" onsubmit="return false;">
												<div class="header header-primary text-center">
													<h4 class="card-title">LOG IN</h4>
													<div class="social-line">
														<a href="#pablo" class="btn btn-just-icon btn-simple">
															<i class="fa fa-facebook-square"></i>
														</a>
														<a href="#pablo" class="btn btn-just-icon btn-simple">
															<i class="fa fa-twitter"></i>
														</a>
														<a href="#pablo" class="btn btn-just-icon btn-simple">
															<i class="fa fa-google-plus"></i>
														</a>
													</div>
												</div>
												
												<div class="card-content">


													<div class="input-group">
														<label class="" for="inlineFormInputGroup">Email</label>
													  <div class="input-group mb-2">
														<div class="input-group-prepend">
														  <div class="input-group-text">
															<i class="material-icons">email</i>
														
														  </div>
														</div>
														<input type="text" class="form-control" name="email" id="login_email" placeholder="Email" data-toggle="popover" data-html="true" data-trigger="manual" data-content="lola" data-placement="right">
													</div>
													</div>
													<div class="input-group">
														<label class="" for="inlineFormInputGroup">Password</label>
													  <div class="input-group mb-2">
														<div class="input-group-prepend">
														  <div class="input-group-text">
															<i class="material-icons">lock_outline</i>
														
														  </div>
														</div>
                                                        <input type="password" class="form-control" name="password" id="login_password" placeholder="Password" data-toggle="popover" data-html="true" data-trigger="manual" data-placement="right">
                                                        
                                                    </div>

													</div>
                                                    <div class="form-control-feedback text-center hide">Success! You've done it.</div>
													<!-- If you want to add a checkbox to this form, uncomment this code

													<div class="checkbox">
														<label>
															<input type="checkbox" name="optionsCheckboxes" checked>
															Subscribe to newsletter
														</label>
													</div> -->
												</div>
												<div class="footer text-center">
													<button type="submit" id="form-submit" class="btn btn-primary btn-simple btn-wd btn-blue-gradiant">Get Started</button>
												</div>
											</form>
					</div>
											</div> 
                                            
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            <script>
                if(localStorage.token){
                    window.location = '<?php echo BASE_URL;?>dashboard';
                }
            </script>
            <?php include('footer.php');?>