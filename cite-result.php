

<?php
include_once('config/config.php');
include_once(ROOT_PATH.'header.php');

include "vendor/autoload.php";
use Seboettg\CiteProc\StyleSheet;
use Seboettg\CiteProc\CiteProc;

$get_data = $_POST["data"];
$new_data = preg_replace('/\s\s+/', '', $get_data);
//echo $get_data;
//echo $new_data;
//echo implode(',',$posts);
//print_r( $posts[0]->title);
$type = $_POST["formatType"];
//print_r($type);
//$data = file_get_contents($get_data);
$style = StyleSheet::loadStyleSheet($type);
//$customstyle = StyleSheet::loadCustomStyleSheet("Lola");
//echo $customstyle;

$citeProc = new CiteProc($style);
$bibliography = $citeProc->render(json_decode($get_data), "bibliography");
$cssStyles = $citeProc->renderCssStyles();
// echo $bibliography;
//echo json_encode(array('bibliography'=> $bibliography));
//die;
?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Static Slider 1  -->
                <!-- ============================================================== -->
                <section id="citation-result">
                    <div class="spacer banner" style="background-image:url(images/background-6.png);">
                        <div class="container">
                        <h4>Generated Result</h4>
                            <div class="row">
                                <div class="col-md-8 ">
                                    <div class="card p-4">
                                        <div class="row text-center align-items-center">
                                            <div class="col-md-9" id="cite" ><?php echo $bibliography;?></div>
                                            <div class="col-md-3" id="actions">
                                                <?php if(isset($_COOKIE["token"])):?>
                                                    <div class="d-inline-block cursor-pointer" id="copy" data-clipboard-action="copy" data-clipboard-target="#cite">
                                                        <i class="fa fa-copy"></i>
                                                        <p id="copy-alert">copy</p>
                                                    </div>
                                                    <div class="d-inline-block cursor-pointer" id="save" data-toggle="modal" data-target="#saveDialog">
                                                        <i class="fa fa-save"></i>
                                                        <p id="save-alert">save</p>
                                                    </div>
                                                <?php else:?>
                                                    <div class="d-inline-block cursor-pointer" id="copy" data-clipboard-action="copy" data-clipboard-target="#cite">
                                                        <i class="fa fa-copy"></i>
                                                        <p>copy</p>
                                                    </div>
                                                <?php endif;?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                <div class="card bg-success-gradiant text-white">
                                    <div class="card-body">
                                        <h6 class="font-medium text-white">Join Now</h6>
                                        <p class="m-t-20">Lorem ipsum dolor sit amet, consecte tuam porttitor, nunc et fringilla.</p>
                                        <a href="#f4" class="linking">Learn More <i class="fa fa-arrow-right"></i></a>
                                    </div>
                                </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
<div class="modal" tabindex="-1" role="dialog" id="saveDialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Save Citation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="" method="POST" onsubmit="return false;"  id="create-bib-submit">
		<div class="form-group">
			<label for="new-bibliograrphy">Create New Bibliography</label>
			<input type="text" id="new-bibliograrphy" name="new-bibliograrphy" class="form-control">
				<div class="validation-msg">
																					  
				</div>
			</div>
			<div class="form-group">
																			<label for="">Select Style</label>
																				<select class="form-control selectpicker" data-live-search="true" data-size="5" data-dropup-auto="false" id="format" title="Select Format..." required>
																						<?php
																						$directory = 'vendor/citation-style-language/styles-distribution';

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
																						<div class="validation-msg-style">
																				  
																						</div>
																			</div>
			<button type="submit" class="btn btn-success">Create</button>
	</form>
		<div class="mt-5 bib-list">
		<label for="bib-list">Select Bibliography</label>
        <select class="form-control" id="bib-list">
																			
		</select>
		<div class="validation-msg">
		</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="save-bibliography">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
window.addEventListener('load', function() {
	$(document).ready(function(){
		$.ajax({
		url:'dashboard/user_actions.php',
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
				for(var j in res[i]){
					html+="<option value='"+res[i][j]+"'>"+j+"</option>"

	//				console.log(res[i][j]);
		//			console.log(j);
				}

				
			})
			$("#bib-list").html(html);
		}
	});
	$("#create-bib-submit").submit(function(){
		var bibName = $("#new-bibliograrphy").val();
		var bibStyle = $(".selectpicker").val();
		$.ajax({
			url:'dashboard/user_actions.php',
			type:'POST',
			dataType:'json',
			data:{
				type:'create-bib',
				bibName: bibName,
				bibStyle:bibStyle,
			},
			success:function(res){
				var html = '';
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
					html+='<option value="'+res.group_id+'">'+bibName+'</option>';
					$("#bib-list").append(html);
					//window.location.reload();
				}
			}
		})
	});	
	var x = <?php echo $new_data;?>;
	var jsonString = JSON.stringify(x);
	
		$("#save-bibliography").click(function(){
			var bibValue = $("#bib-list").val();
			var bibStyle = '<?php echo isset($formatType) ? $formatType : '';?>';
			if(bibValue == 0){
				$('.bib-list .validation-msg').removeClass('valid-feedback');
				$('.bib-list .validation-msg').addClass('invalid-feedback');
				$("#bib-list").removeClass('is-valid');
				$("#bib-list").addClass('is-invalid');
				$('.bib-list .invalid-feedback').html("Please Select a Bibliography");
				$('.bib-list .validation-msg').show();
			}
			else{
				$.ajax({
					url:'dashboard/user_actions.php',
					type:'post',
					dataType:'json',
					data:{
						type:'save-bibliography',
						bibValue:bibValue,
						bibJson:jsonString,
						bibStyle:bibStyle,
					},
					success:function(res){
						if(res.status == 'success'){
							$('.bib-list .validation-msg').removeClass('invalid-feedback');
							$('.bib-list .validation-msg').addClass('valid-feedback');
							$("#bib-list").removeClass('is-invalid');
							$("#bib-list").addClass('is-valid');
							$('.bib-list .valid-feedback').html("Added!");
							$('.bib-list .validation-msg').show();
						}
						else{
							$('.bib-list .validation-msg').removeClass('valid-feedback');
							$('.bib-list .validation-msg').addClass('invalid-feedback');
							$("#bib-list").removeClass('is-valid');
							$("#bib-list").addClass('is-invalid');
							$('.bib-list .invalid-feedback').html("Could not add to Bibliography");
							$('.bib-list .validation-msg').show();
						}
					}
				});
				
			}
		});
	});
},false);
</script>

<?php include_once(ROOT_PATH.'footer.php');
?>