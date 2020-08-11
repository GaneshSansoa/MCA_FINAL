
<?php 
include_once('config/config.php');
if(isset($_COOKIE['token'])){
	
	$home = BASE_URL;
	//echo $home;
	header("Location: $home");
}
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
                                    <div class="col-md-9 col-lg-12 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1500">
                                       
                                        <div class="m-t-40">
                                         
										<div class="card card-signup">
											<h2 class="card-title text-center">Register</h2>
											<div class="row">
												<div class="col-md-6">
													<div class="info info-horizontal">
														<div class="icon icon-rose">
															<i class="material-icons">timeline</i>
														</div>
														<div class="description">
															<h4 class="info-title">Control Your Citations</h4>
															<p class="description">
																Change your created bibliographies to any style available.
															</p>
														</div>
													</div>

													<div class="info info-horizontal">
														<div class="icon icon-primary">
															<i class="material-icons">code</i>
														</div>
														<div class="description">
															<h4 class="info-title">Save and Use Anytime</h4>
															<p class="description">
																Save your bibliographies so that you can use them later.
															</p>
														</div>
													</div>

													<div class="info info-horizontal">
														<div class="icon icon-info">
															<i class="material-icons">group</i>
														</div>
														<div class="description">
															<h4 class="info-title">Create Different Groups</h4>
															<p class="description">
																Create as many bibliographies as possible.
															</p>
														</div>
													</div>
												</div>
												<div class="col-md-5">
											<form class="form" id="signup_form" method="post" action="" onsubmit="return false;">
												
												
												<div class="card-content">

													<div class="input-group">
														<label class="" for="inlineFormInputGroup">Username</label>
													  <div class="input-group mb-2">
														<div class="input-group-prepend">
															<div class="input-group-text">
																<i class="material-icons">face</i>
															</div>
														</div>
															<input type="text" class="form-control" name="username" id="username" placeholder="Username" data-toggle="popover" data-html="true" data-trigger="manual" data-placement="right">
														</div>
													</div>
													<div class="input-group">
														<label class="" for="inlineFormInputGroup">Email</label>
													  <div class="input-group mb-2">
														<div class="input-group-prepend">
														  <div class="input-group-text">
															<i class="material-icons">email</i>
														
														  </div>
														</div>
														<input type="text" class="form-control" name="email" id="email" placeholder="Email" data-toggle="popover" data-html="true" data-trigger="manual" data-content="lola" data-placement="right">
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
														<input type="password" class="form-control" name="password" id="password" placeholder="Password" data-toggle="popover" data-html="true" data-trigger="manual" data-placement="right">
													</div>
													</div>
													<div class="input-group">
														<label class="" for="inlineFormInputGroup">Re-Password</label>
													  <div class="input-group mb-2">
														<div class="input-group-prepend">
														  <div class="input-group-text">
															<i class="material-icons">lock_outline</i>
														
														  </div>
														</div>
														<input type="password" class="form-control" name="re-password" id="re-password" placeholder="Re-Enter Password" data-toggle="popover" data-html="true" data-trigger="manual" data-placement="right">
													</div>
													</div>
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
                            </div>
                        </div>
                    </section>
					<section>
						<div class="container-fluid">
							<div class="row">
								<div class="col-sm-6">
									
								</div>
						</div>
					</section>

				</div>
				<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="mySmallModalLabel">Success</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body"></div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                </div>
				<script>
            </script>
<?php include('footer.php');?>