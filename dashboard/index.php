<?php require_once('../config/config.php'); ?>
<?php require_once('../config/verify_token.php'); ?>
<?php require_once('../config/fetch.php'); ?>
<?php 
include "../vendor/autoload.php";
use Seboettg\CiteProc\StyleSheet;
use Seboettg\CiteProc\CiteProc;

?>
<?php if(!isset($_COOKIE['token'])){
	
	$home = BASE_URL;
	//echo $home;
	header("Location: $home");
}?>
<?php
$token_obj = new Verify();
$status = $token_obj->verify_token($_COOKIE["token"]);
if($status['status'] == "error"){
	$home = BASE_URL;
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
																<li class="">
																	<a href="#schedule-3" role="tab" data-toggle="tab" aria-expanded="true">
																		<i class="material-icons">file_copy</i>
																		Upload Styles
																	</a>
																</li>
																
															</ul>
														</div>
														<div class="col-md-10">
															<div class="tab-content">
																<div class="tab-pane active" id="dashboard-2">
																	<div class="row justify-content-center">
																		<div class="col-sm-12">
																			<div style="color:black;" class="mb-5">
																				<h3 class="m-b-20">Basic Information</h3>
																				<?php //echo print_r($_COOKIE['token']);?>
																				<div class="form-group row">
																					<div class="col-sm-2">
																						<label for="username">Username:</label>
																					</div>
																					<div class="col-sm-10">
																						<div class="username">
																							<?php echo isset($status['data']['username']) ? $status['data']['username']: '';?>
																						</div>
																					</div>
																				</div>
																				<div class="form-group row">
																					<div class="col-sm-2">
																						<label for="username">Email:</label>
																					</div>
																					<div class="col-sm-10">
																						<div class="email">
																							<?php echo isset($status['data']['email']) ? $status['data']['email']: '';?>
																						</div>
																					</div>
																				</div>
																			</div>
																			<form action="" style="color:black;" onsubmit="return false;" id="change-password-form">
																				<h3 class="m-b-20">Change Password</h3>
																				<div class="form-group row">
																					<div class="col-sm-3">
																						<label for="username">Old Password:</label>
																					</div>
																					<div class="col-sm-9">
																						<input type="password" name="old_password" class="form-control form-control-sm" id="old-password" data-toggle="popover" data-html="true" data-trigger="manual" data-placement="right">																				
																						<div class="old-validation-msg"></div>
																					</div>
																				</div>
																				<div class="form-group row">
																					<div class="col-sm-3">
																						<label for="username">New Password:</label>
																					</div>
																					<div class="col-sm-9">
																						<input type="password" name="new_password" class="form-control form-control-sm" id="new-password" data-toggle="popover" data-html="true" data-trigger="manual" data-placement="right">																				
																						<div class="new-validation-msg"></div>
																					</div>
																				</div>
																				<div class="form-group row">
																					<div class="col-sm-3">
																						<label for="username">Re-enter New Password:</label>
																					</div>
																					<div class="col-sm-9">
																						<input type="password" name="renew_password" class="form-control form-control-sm" id="renew-password" data-toggle="popover" data-html="true" data-trigger="manual" data-placement="right">																				
																						<div class="new-repeat-validation-msg"></div>
																					</div>
																				</div>
																				<div class="password-validation-msg">
																				
																				</div>
																				<button type="submit" class="btn btn-primary">Change Password</button>
																			</form>																		
																		</div>	
																	</div>

																</div>
																	<div class="tab-pane" id="schedule-2">
																		
																		
																		<form action="" method="POST" onsubmit="return false;"  id="create-my-submit">
																			<div class="form-group">
																				<label for="new-bibliograrphy">Create New Bibliography</label>
																				<input type="text" id="new-bibliograrphy" name="new-bibliograrphy" class="form-control">
																				<div class="validation-msg">
																				  
																				</div>
																				
																			</div>
																			<!-- <div class="form-group">
																				<label for="style-type" class="d-block">Select Style Type</label>
																				<input type="radio" class="style-type" name="style-type" value="pre-defined"> Pre-Defined Styles
																				<input type="radio" class="style-type" name="style-type" value="custom-style"> Custom Styles
																			</div> -->
																			<div class="form-check form-check-inline">
																			<input class="form-check-input" type="radio" name="style-type" id="inlineRadio1" value="pre-defined" checked>
																			<label class="form-check-label" for="inlineRadio1">Pre Defined Styles</label>
																			</div>
																			<div class="form-check form-check-inline">
																			<input class="form-check-input" type="radio" name="style-type" id="inlineRadio2" value="custom-style">
																			<label class="form-check-label" for="inlineRadio2">Custom Styles</label>
																			</div>
																			<div id="pre-defined" class="form-group">
																			<label for="">Select In-Built Style</label>
																				<select class="form-control selectpicker pre-defined" data-live-search="true" data-size="5" data-dropup-auto="false" id="format" title="Select Format..." required>
																						<?php
																						$directory = '../vendor/citation-style-language/styles-distribution';

																							// Will exclude everything under these directories
																							$exclude = array('.git', 'dependent');
																							$filter = function ($file, $key, $iterator) use ($exclude) {
																								if ($iterator->hasChildren() && !in_array($file->getFilename(), $exclude)) {
																									return true;
																								}
																								return $file->isFile();
																							};

																							$innerIterator = new RecursiveDirectoryIterator(
																								$directory,
																								RecursiveDirectoryIterator::SKIP_DOTS
																							);
																							$iterator = new RecursiveIteratorIterator(
																								new RecursiveCallbackFilterIterator($innerIterator, $filter)
																							);

																							foreach ($iterator as $pathname => $fileInfo) {
																								// do your insertion here
																								$file = $fileInfo->getFilename();
																								$without_extension = substr($file, 0, strrpos($file, "."));
																								$string = str_replace('-', ' ', $without_extension);
																								$formatted = ucwords($string);
																								$words = explode(" ", $formatted);
																									$acronym = "";

																									foreach ($words as $w) {
																									$acronym .= $w[0];
																									}
																								echo "<option value=".$without_extension." data-tokens=".$acronym.">" . ucwords($string) . "</option>";
																							}	
																							?>
																						</select>
																						<div class="validation-pre-style">
																				  
																						</div>
																					</div>
																					<div class="form-group d-none" id="custom-style">
																						<?php 
																							$user_id = $status["data"]["id"];
																						?>
																						<label for="">Select Custom Style</label>
																							<select  class="form-control selectpicker custom-style" data-live-search="true" data-size="5" data-dropup-auto="false" id="format" title="Select Format..." required>
																								<?php
																									$directory = '../vendor/citation-style-language/styles-distribution/custom-styles/'. $user_id;
																									if(is_dir($directory)){
// Will exclude everything under these directories
																									$exclude = array('.git', 'dependent');
																									$filter = function ($file, $key, $iterator) use ($exclude) {
																										if ($iterator->hasChildren() && !in_array($file->getFilename(), $exclude)) {
																											return true;
																										}
																										return $file->isFile();
																									};

																									$innerIterator = new RecursiveDirectoryIterator(
																										$directory,
																										RecursiveDirectoryIterator::SKIP_DOTS
																									);
																									$iterator = new RecursiveIteratorIterator(
																										new RecursiveCallbackFilterIterator($innerIterator, $filter)
																									);

																									foreach ($iterator as $pathname => $fileInfo) {
																										// do your insertion here
																										$file = $fileInfo->getFilename();
																										$without_extension = substr($file, 0, strrpos($file, "."));
																										$string = str_replace('-', ' ', $without_extension);
																										$formatted = ucwords($string);
																										$words = explode(" ", $formatted);
																											$acronym = "";

																											foreach ($words as $w) {
																											$acronym .= $w[0];
																											}
																										echo "<option value=".$without_extension." data-tokens=".$acronym.">" . ucwords($string) . "</option>";
																									}
																									
																									
																									}
																									else{
																										echo "<option value='' data-tokens='0' selected disabled>No Style Available</option>";
																									}	
																								?>
																							</select>
																						<div class="validation-custom-style">
																				  
																						</div>
																			</div>
																			<div class="form-group">
																				<input type="submit" class="create-bib btn btn-success" value="Create">
																			</div>
																		</form>
																		<div class="mt-5">
																		<h3>Bibliographies</h3>
																		<div class="">
																		<select class="form-control" id="bib-list">
																			
																		</select>
																		</div>
																		<div class="mt-5" id="bib-results">
																			<h3 class="d-inline-block">Results</h3>
																			<h6 id="style"></h6>
																			 <div class="d-flex flex-column align-items-center cursor-pointer float-right mx-2" id="copy" data-clipboard-action="copy" data-clipboard-target="#bib-data">
																				<i class="fa fa-copy"></i>
																				<p id="copy-alert">copy</p>
																			</div>
																			<div class="d-flex flex-column align-items-center cursor-pointer float-right mx-2" id="change-style"  data-toggle="modal" data-target="#changeStyleDialog">
																				<i class="fa fa-language"></i>
																				<p id="copy-alert">change style</p>
																			</div>
																			<div class="" id="bib-data">
																			
																			</div>
																		</div>
																		</div>
																</div>
																<div class="tab-pane" id="schedule-3">
																		<h3>Upload Styles</h3>
																		<div class="row justify-content-center text-dark mt-5">
																			<div class="col-sm-8">
																			<h6>Things to follow to upload your own styles</h6>
																				<ul>
																					<li>Generate your styles at <a href="http://editor.citationstyles.org" target="_blank">editor.citationstyle.org</a></li>
																					<li>After building your custom styles save the style with .csl format.</li>
																					<li>The name of the .csl file should be similar to the style name. since your style will be recognized by your .csl filename.</li>

																				</ul>
																				<form id="upload-style-submit" onsubmit="return false;" enctype="multipart/form-data">
																				<div class="form-group col-sm-12">
																					<label for="input file">Upload Custom Style:</label>
																					<div class="custom-file">
																						<input type="file" class="custom-file-input" id="customFile" name="filename">
																						<label class="custom-file-label" for="customFile">Your Style.csl</label>
																						<div class="validation-upload-msg"></div>
																					</div>
																				</div>
																				<div class="col-sm-12">
																					
																				</div>
																				<div class="col-sm-12">
																				<button type="submit" class="btn btn-primary btn-block">Submit</button>
																				</div>
																				</form>
																			</div>
																		</div>

																		<?php 
																		$token = $_COOKIE["token"];
																		$verifyToken = new Verify();
																		$tokenData = $verifyToken->verify_token($token);
																		$user_id;
																		if($tokenData['status']== 'success'){
																			// $user_id = $tokenData["data"]["id"];
																			// //$stylePath = 
																			// $customstyle = StyleSheet::loadCustomStyleSheet($user_id,"apa");
																			// // pimp the title
																			// 		$titleFunction = function($cslItem, $renderedText) {
																			// 			return '<a href="https://example.org/publication/' . $cslItem->id . '">' . $renderedText . '</a>';
																			// 		};

																			// 		//pimp author names
																			// 		$authorFunction = function($authorItem, $renderedText) {
																			// 			if (isset($authorItem->id)) {
																			// 				return '<a href="https://example.org/author/' . $authorItem->id . '">' . $renderedText . '</a>';
																			// 			}
																			// 			return $renderedText;
																			// 		};
																			// $additionalMarkup = [
																			// 	"bibliography" => $titleFunction
																			// ];
																			// $citeProc = new CiteProc($customstyle, "en-US", $additionalMarkup);
																			// $get_data = '[{"title":"Introduction to Parallel Algorithms","author":[{"given":"C.","family":"Xavier"},{"given":"S. S.","family":"Iyengar"}],"issued":{"date-parts":[["1998"]]},"publisher-place":"","publisher":"John Wiley & Sons","page":"","edition":"","type":"book"}]';
																			// $bibliography = $citeProc->render(json_decode($get_data), "bibliography");
																			// $cssStyles = $citeProc->renderCssStyles();
																			// echo $bibliography;
																		}
																		?>
																		<!-- <select class="form-control selectpicker" data-live-search="true" data-size="5" data-dropup-auto="false" id="format" title="Select Format..." required> -->
																			<?php
																				// $directory = '../vendor/citation-style-language/styles-distribution/custom-styles/'. $user_id;

																				// // Will exclude everything under these directories
																				// $exclude = array('.git', 'dependent');
																				// $filter = function ($file, $key, $iterator) use ($exclude) {
																				// 	if ($iterator->hasChildren() && !in_array($file->getFilename(), $exclude)) {
																				// 		return true;
																				// 	}
																				// 	return $file->isFile();
																				// };

																				// $innerIterator = new RecursiveDirectoryIterator(
																				// 	$directory,
																				// 	RecursiveDirectoryIterator::SKIP_DOTS
																				// );
																				// $iterator = new RecursiveIteratorIterator(
																				// 	new RecursiveCallbackFilterIterator($innerIterator, $filter)
																				// );

																				// foreach ($iterator as $pathname => $fileInfo) {
																				// 	// do your insertion here
																				// 	$file = $fileInfo->getFilename();
																				// 	$without_extension = substr($file, 0, strrpos($file, "."));
																				// 	$string = str_replace('-', ' ', $without_extension);
																				// 	$formatted = ucwords($string);
																				// 	$words = explode(" ", $formatted);
																				// 		$acronym = "";

																				// 		foreach ($words as $w) {
																				// 		$acronym .= $w[0];
																				// 		}
																				// 	echo "<option value=".$without_extension." data-tokens=".$acronym.">" . ucwords($string) . "</option>";
																				// }	
																			?>
																		<!-- </select> -->
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
<div class="modal" tabindex="-1" role="dialog" id="changeStyleDialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Change Citation Style</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="" method="POST" onsubmit="return false;"  id="change-my-style">
	
		<!-- <div class="form-group">
			<label for="style-type" class="d-block">Select Style Type</label>
			<input type="radio" class="style-type" name="style-type" value="pre-defined"> Pre-Defined Styles
			<input type="radio" class="style-type" name="style-type" value="custom-style"> Custom Styles
		</div> -->
		<input type="hidden" name="hidden_value" id="hidden_bib_id">
		<div class="form-check form-check-inline">
		<input class="form-check-input" type="radio" name="change-style-type" id="inlineRadio3" value="pre-defined" checked>
		<label class="form-check-label" for="inlineRadio3">Pre Defined Styles</label>
		</div>
		<div class="form-check form-check-inline">
		<input class="form-check-input" type="radio" name="change-style-type" id="inlineRadio4" value="custom-style">
		<label class="form-check-label" for="inlineRadio4">Custom Styles</label>
		</div>
		<div id="change-pre-defined" class="form-group">
		<label for="">Select In-Built Style</label>
			<select class="form-control selectpicker change-pre-defined" data-live-search="true" data-size="5" data-dropup-auto="false" id="format" title="Select Format..." required>
					<?php
					$directory = '../vendor/citation-style-language/styles-distribution';

						// Will exclude everything under these directories
						$exclude = array('.git', 'dependent');
						$filter = function ($file, $key, $iterator) use ($exclude) {
							if ($iterator->hasChildren() && !in_array($file->getFilename(), $exclude)) {
								return true;
							}
							return $file->isFile();
						};

						$innerIterator = new RecursiveDirectoryIterator(
							$directory,
							RecursiveDirectoryIterator::SKIP_DOTS
						);
						$iterator = new RecursiveIteratorIterator(
							new RecursiveCallbackFilterIterator($innerIterator, $filter)
						);

						foreach ($iterator as $pathname => $fileInfo) {
							// do your insertion here
							$file = $fileInfo->getFilename();
							$without_extension = substr($file, 0, strrpos($file, "."));
							$string = str_replace('-', ' ', $without_extension);
							$formatted = ucwords($string);
							$words = explode(" ", $formatted);
								$acronym = "";

								foreach ($words as $w) {
								$acronym .= $w[0];
								}
							echo "<option value=".$without_extension." data-tokens=".$acronym.">" . ucwords($string) . "</option>";
						}	
						?>
					</select>
				</div>
				<div class="form-group d-none" id="change-custom-style">
					<?php 
						$user_id = $status["data"]["id"];
					?>
					<label for="">Select Custom Style</label>
						<select  class="form-control selectpicker change-custom-style" data-live-search="true" data-size="5" data-dropup-auto="false" id="format" title="Select Format..." required>
							<?php
								$directory = '../vendor/citation-style-language/styles-distribution/custom-styles/'. $user_id;
								if(is_dir($directory)){
								// Will exclude everything under these directories
									$exclude = array('.git', 'dependent');
									$filter = function ($file, $key, $iterator) use ($exclude) {
										if ($iterator->hasChildren() && !in_array($file->getFilename(), $exclude)) {
											return true;
										}
										return $file->isFile();
									};

									$innerIterator = new RecursiveDirectoryIterator(
										$directory,
										RecursiveDirectoryIterator::SKIP_DOTS
									);
									$iterator = new RecursiveIteratorIterator(
										new RecursiveCallbackFilterIterator($innerIterator, $filter)
									);

									foreach ($iterator as $pathname => $fileInfo) {
										// do your insertion here
										$file = $fileInfo->getFilename();
										$without_extension = substr($file, 0, strrpos($file, "."));
										$string = str_replace('-', ' ', $without_extension);
										$formatted = ucwords($string);
										$words = explode(" ", $formatted);
											$acronym = "";

											foreach ($words as $w) {
											$acronym .= $w[0];
											}
										echo "<option value=".$without_extension." data-tokens=".$acronym.">" . ucwords($string) . "</option>";
									}
								}
									else{
										echo "<option value='' data-tokens='0' selected disabled>No Style Available</option>";
									}
							?>
						</select>
					
		</div>
	</form>
	  <div class="form-group">

		<!-- <label for="">Select Style</label>
		<select class="form-control selectpicker" data-live-search="true" data-size="5" data-dropup-auto="false" id="changeFormat" title="Select Format..." required>
			<?php
			// $directory = '../vendor/citation-style-language/styles-distribution';

			// 	// Will exclude everything under these directories
			// 	$exclude = array('.git', 'dependent');
			// 	$filter = function ($file, $key, $iterator) use ($exclude) {
			// 		if ($iterator->hasChildren() && !in_array($file->getFilename(), $exclude)) {
			// 			return true;
			// 		}
			// 		return $file->isFile();
			// 	};

			// 	$innerIterator = new RecursiveDirectoryIterator(
			// 		$directory,
			// 		RecursiveDirectoryIterator::SKIP_DOTS
			// 	);
			// 	$iterator = new RecursiveIteratorIterator(
			// 		new RecursiveCallbackFilterIterator($innerIterator, $filter)
			// 	);

			// 	foreach ($iterator as $pathname => $fileInfo) {
			// 		// do your insertion here
			// 		$file = $fileInfo->getFilename();
			// 		$without_extension = substr($file, 0, strrpos($file, "."));
			// 		$string = str_replace('-', ' ', $without_extension);
			// 		$formatted = ucwords($string);
			// 		$words = explode(" ", $formatted);
			// 			$acronym = "";

			// 			foreach ($words as $w) {
			// 			$acronym .= $w[0];
			// 			}
			// 		echo "<option value=".$without_extension." data-tokens=".$acronym.">" . ucwords($string) . "</option>";
			// 	}	
				?>
			</select> -->
					<div class="validation-change-style-msg">
				
					</div>
			</div>
	  </div>
	   <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="change-bibliography">Change</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
	  </div>
	  </div>
	  </div>
<script type="text/javascript" defer="defer"> 
window.addEventListener('load', function() {
	
	$(document).ready(function(){
			$('form').trigger('reset');
			$(".pre-defined").selectpicker();
			$(".custom-style").selectpicker();
	$("#bib-results").hide();
	$.ajax({
		url:'user_actions.php',
		type:'GET',
		dataType:'json',
		data:{
			type:'get-bib',
		},
		success:function(res){
			var html='';
			html += '<option value="0">Select Bibliography</option>'
//			console.log(res);
			$.each(res,function(i){
				console.log(res[i]);
				for(var j in res[i]){
					console.log(res[i][j].group_name);
					html+="<option value='"+res[i][j].group_id+"'>"+res[i][j].group_name+"</option>"

	//				console.log(res[i][j]);
		//			console.log(j);
				}

				
			})
			$("#bib-list").html(html);
		}
	});
	$("#change-bibliography").click(function(){
		var bib_id = $("#hidden_bib_id").val();
		var bibStyle = '';
		var showChecked = $("input[name=change-style-type]:checked").val();	
			if(showChecked == "custom-style"){
				console.log(showChecked);
				bibStyle = $(".selectpicker.change-custom-style").val();
			}
			else if(showChecked == "pre-defined"){
				console.log(showChecked);
				bibStyle = $(".selectpicker.change-pre-defined").val();
			}
			console.log(bibStyle);
			if(bibStyle == "" || bibStyle == null){
					$('.validation-change-style-msg').removeClass('valid-feedback');
					$('.validation-change-style-msg').addClass('invalid-feedback d-block');
					$('.validation-change-style-msg.invalid-feedback').html("Please Select a Style");
					$('.validation-custom-style-msg.invalid-feedback').show();
			}	
			else{
				$.ajax({
					url:'user_actions.php',
					type:'POST',
					dataType:'json',
					data:{
						type:'change-style',
						bib_id:bib_id,
						bibStyle:bibStyle,
						bibType:showChecked,
					},
					success:function(res){
						if(res.status == "success"){
							$("#bib-data").html('');
							$("#bib-data").append(res.bib_data);
							$("#style").html("Style: " + res.style.replace(/\-/g," "));
							$("#bib-results").show();
							
							$(".validation-change-style-msg").removeClass("invalid-feedback");
							$(".validation-change-style-msg").addClass("valid-feedback d-block");
							$(".validation-change-style-msg").html("Changed Successfully!");
							setTimeout(() => {
								$("#changeStyleDialog").modal('hide');	
								$(".validation-change-style-msg").html("");					
							}, 1000);
							

						}
						else{
							$("#bib-data").html(res.message);
							$("#style").html("Style: " + res.style.replace(/\-/g," "));
							$("#bib-results").show();
							setTimeout(() => {
								$("#changeStyleDialog").modal('hide');	
								$(".validation-change-style-msg").html("");					
							}, 1000);
						}
					}
				})
			}
				
			
		// console.log(bib_id);
		// console.log(bibStyle);
		
	})
	$("#bib-list").change(function(){
		var bibId = $("#bib-list").children("option:selected").val();
		$("#hidden_bib_id").val(bibId);
		$.ajax({
			url:'user_actions.php',
			type:'get',
			dataType:'json',
			data:{
				type:'get-bib-groups',
				bibId: bibId,
			},
			success:function(res){
				if(res.status == "success"){
					$("#bib-data").html('');
					$("#bib-data").append(res.bib_data);
					$("#style").html("Style: " + res.style.replace(/\-/g," "));
					$("#bib-results").show();
								
				}
				else{
					$("#bib-data").html('No Bibliographies');
					$("#style").html("Style: " + res.style.replace(/\-/g," "));
					$("#bib-results").show();
				}

			}
		});
	});
	$(".create-bib").on("click", function(){
		//alert("sdad");
		var bibName = $("#new-bibliograrphy").val();
		var bibStyle = "";
		//console.log(bibStyle);
		var bibType = $("input[name=style-type]:checked").val();
		if(bibType == "pre-defined"){
			console.log($(".selectpicker.pre-defined").val());
			bibStyle = $(".selectpicker.pre-defined").val();
		}
		if(bibType == "custom-style"){
			console.log($(".selectpicker.custom-style").val());
			bibStyle = $(".selectpicker.custom-style").val();
		}
		console.log(bibType);
		console.log(bibStyle);
		if(bibName == 0 || bibStyle == "" || bibStyle == null){
			if(bibName == 0){
					$("#new-bibliograrphy").removeClass('valid');
					$("#new-bibliograrphy").addClass('is-invalid');
					$('#create-my-submit .validation-msg').removeClass('valid-feedback');
					$('#create-my-submit .validation-msg').addClass('invalid-feedback');
					$('#create-my-submit .validation-msg.invalid-feedback').html("Please Provide a Name");
					$('#create-my-submit .validation-msg.invalid-feedback').show();
			}
			
			if(bibStyle == "" || bibStyle == null){
				if(bibType === "pre-defined"){
					$('#create-my-submit .validation-pre-style').removeClass('valid-feedback');
					$('#create-my-submit .validation-pre-style').addClass('invalid-feedback');
					$('#create-my-submit .validation-pre-style.invalid-feedback').html("Please Provide a Style");
					 $('#create-my-submit .validation-pre-style.invalid-feedback').show();
				}
				if(bibType ==="custom-style"){
					$('#create-my-submit .validation-custom-style').removeClass('valid-feedback');
					$('#create-my-submit .validation-custom-style').addClass('invalid-feedback');
					$('#create-my-submit .validation-custom-style.invalid-feedback').html("Please Provide a Style");
					 $('#create-my-submit .validation-custom-style.invalid-feedback').show();
				}
					
			}
		}
		else{
			
			console.log(bibType);
			console.log(bibStyle);
			console.log("asadad");
			$.ajax({
			url:'user_actions.php',
			type:'POST',
			dataType:'json',
			data:{
				type:'create-bib',
				bibName: bibName,
				bibStyle: bibStyle,
				bibType: bibType,
			},
			success:function(res){
				if(res.status == 'error'){
					$("#new-bibliograrphy").removeClass('valid');
					$("#new-bibliograrphy").addClass('is-invalid');
					$('#create-bib-submit .validation-msg').removeClass('valid-feedback');
					$('#create-bib-submit .validation-msg').addClass('invalid-feedback');
					$('#create-bib-submit .invalid-feedback').html(res.message);
					$('#create-bib-submit .invalid-feedback').show();
				}
				else{
					$('#create-bib-submit .validation-msg').addClass('valid-feedback');
					$('#create-bib-submit .validation-msg').removeClass('invalid-feedback');					
					$("#new-bibliograrphy").removeClass('is-invalid');
					$("#new-bibliograrphy").addClass('is-valid');
					$('#create-bib-submit .valid-feedback').html("Added!");
					$('#create-bib-submit .valid-feedback').show();
					window.location.reload();
				}
			}
		})
		}
		
	});		
	})
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
		$("#upload-style-submit").submit(function(){
            var ext = $('input[type=file]').val().split('.').pop().toLowerCase();

            if($.inArray(ext, ['csl']) == -1) {
                			$(".validation-upload-msg").removeClass("valid-feedback");
							$(".validation-upload-msg").addClass("invalid-feedback d-block");
							$(".validation-upload-msg").html("Only .csl extenson allowed");
                }
            else{
//				var formdata =new FormData($("#upload-style-submit")[0]);
				var fd = new FormData(); 
                var files = $('.custom-file-input')[0].files[0]; 
				fd.append('file', files); 
				fd.append('type','upload-style');
				$.ajax({
					url:'user_actions.php',
					type:'POST',
					dataType:'json',
					data:fd,
					processData: false,
				    contentType: false,
					success:function(res){
						if(res.status == "success"){
							$(".validation-upload-msg").removeClass("invalid-feedback");
							$(".validation-upload-msg").addClass("valid-feedback d-block");
							$(".validation-upload-msg").html("Uploaded Successfully!");
							$("#upload-style-submit").trigger('reset');
							window.location.reload();
						}
						else{
							$(".validation-upload-msg").removeClass("valid-feedback");
							$(".validation-upload-msg").addClass("invalid-feedback d-block");
							$(".validation-upload-msg").html(res.message);
							
						}
					}
				})	;
			}
});


$("input[name=style-type]").on("change", function(){
	var showChecked = $("input[name=style-type]:checked").val();
	if(showChecked == "custom-style"){
		$("#custom-style").removeClass("d-none");
		$("#pre-defined").addClass("d-none");
	}
	else{
		$("#pre-defined").removeClass("d-none");
		$("#custom-style").addClass("d-none");
	}
//	alert($("input[name=style-type]:checked").val());
})
$("input[name=change-style-type]").on("change", function(){
	var showChecked = $("input[name=change-style-type]:checked").val();
	
	if(showChecked == "custom-style"){
		console.log("custom style");
		$("#change-custom-style").removeClass("d-none");
		$("#change-pre-defined").addClass("d-none");
	}
	else{
		console.log("pre-defined style");
		$("#change-pre-defined").removeClass("d-none");
		$("#change-custom-style").addClass("d-none");
	}
//	alert($("input[name=style-type]:checked").val());
})

}, false);


</script>
<?php include(ROOT_PATH."footer.php");?>