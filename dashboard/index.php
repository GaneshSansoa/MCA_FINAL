<?php
require_once('../config/config.php');
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
                        <div id="banner2" class="banner spacer" style="background-image:url(<?php echo BASE_URL; ?>images/background-4.svg);">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-12 col-lg-12 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1500">
                                       
                                        <div class="m-t-40">
                                         
										<div class="card card-dashboard p-40">
											<h2 class="card-title text-center">Dashboard</h2>
											<div class="row">
												
												<div class="col-md-12">
													<div class="row p-t-30">
														<div class="col-md-2">
															<ul class="nav nav-pills nav-pills-icons nav-stacked flex-column" role="tablist">
																<!--
																	color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
																-->
																<li class="">
																	<a class="active" href="#dashboard-2" role="tab" data-toggle="tab" aria-expanded="false">
																		<i class="material-icons">person</i>
																		My Profile
																	</a>
																</li>
																<li class="">
																	<a href="#schedule-2" role="tab" data-toggle="tab" aria-expanded="true">
																		<i class="material-icons">file_copy</i>
																		My Citations
																	</a>
																</li>
																
															</ul>
														</div>
														<div class="col-md-10">
															<div class="tab-content">
																<div class="tab-pane active" id="dashboard-2">
																	<div class="row justify-content-center">
																		<div class="col-sm-12">
																			<form action="" style="color:black;">
																				<h3 class="m-b-20">Basic Information</h3>
																				<div class="form-group row">
																					<div class="col-sm-2">
																						<label for="username">Username:</label>
																					</div>
																					<div class="col-sm-10">
																						<div class="username">
																						Username
																						</div>
																					</div>
																				</div>
																				<div class="form-group row">
																					<div class="col-sm-2">
																						<label for="username">Email:</label>
																					</div>
																					<div class="col-sm-10">
																						<div class="email">

																						</div>
																					</div>
																				</div>
																				<h3 class="m-b-20">Change Password</h3>
																				<div class="form-group row">
																					<div class="col-sm-3">
																						<label for="username">Old Password:</label>
																					</div>
																					<div class="col-sm-9">
																						<input type="text" name="old_password" class="form-control form-control-sm" id="">																				
																					</div>
																				</div>
																				<div class="form-group row">
																					<div class="col-sm-3">
																						<label for="username">New Password:</label>
																					</div>
																					<div class="col-sm-9">
																						<input type="text" name="new_password" class="form-control form-control-sm" id="">																				
																					</div>
																				</div>
																				<div class="form-group row">
																					<div class="col-sm-3">
																						<label for="username">Re-enter New Password:</label>
																					</div>
																					<div class="col-sm-9">
																						<input type="text" name="renew_password" class="form-control form-control-sm" id="">																				
																					</div>
																				</div>
																			</form>																		
																		</div>	
																	</div>

																</div>
																	<div class="tab-pane" id="schedule-2">
																		<h3>My Citations</h3>
																		<dl>
																			<dt>Group 1
																				<dd>Citation 1 </dd>
																				<dd>Citation 2</dd>
																				<dd>Citation 3</dd>
																			</dt>
																		</dl>
																		Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio sapiente et unde assumenda! Facilis alias, eligendi asperiores et obcaecati, deserunt aperiam similique recusandae magni consequuntur numquam repellendus quas quos ea?
																</div>
																</div>
														</div>	
													</div>
												

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
<script type="text/javascript" defer="defer"> 
window.addEventListener('load', function() {
 // $ should be available
//  console.log(localStorage.token == undefined);
if(localStorage.token == undefined){
	window.location = '../login.html';
}
else{
	
	$.ajax({
		url:'../config/request.php',
		type:'POST',
		dataType:'json',
		data:{
			da:"lala",
			token: localStorage.token
		},
		success:function(res){
			// console.log(res.username);
			$(".username").html(res.username);
			$(".email").html(res.email);

		}
	});
}

}, false);

</script>
<?php include("../footer.php");?>