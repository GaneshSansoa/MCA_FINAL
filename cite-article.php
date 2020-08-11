
<?php //print_r($_POST);
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $data = json_decode($_POST['data'],true);
}

// print_r($data);
// echo count($data['authors']);
?>
<?php include("header.php");?>
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
                        <div id="banner2" class="banner spacer" style="background-image:url(images/background-2.svg);">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-7 col-lg-7 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1500">
                                       
                                        <div class="m-t-40">
                                          <div class="card card-nav-tabs">
											<div class="header header-primary">
												<!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
												<h4 class="text-dark ml-3">Cite Article</h4>
											</div>
											<div class="card-content">
                                                <form class="needs-validation"  method="post" action="cite-result.php" id="frm-submit" onsubmit="return false;">
                                                <div class="form-row" id="contrib">
                                                        <?php if(isset($data['creators'])):?>
                                                        <?php $count=0;?>
                                                        <?php foreach($data['creators'] as $author):

                                                            $names = split_article_name($author['creator']);
                                                            // print_r($names);
                                                            ?>
                                                            <div class="col-md-6 mb-3">    
                                                            <div class="input-group"> 
                                                                <input type="text" class="form-control" id="validationCustom01" placeholder="First name" name="given-<?php echo $count;?>" required="" value="<?php echo isset($names['first_name']) ? $names['first_name'] : 'dad';?>">
                                                                    <div class="input-group-prepend">          
                                                                        <span class="input-group-text" id="inputGroupPrepend">*</span>        
                                                                    </div>
                                                                    <div class="invalid-feedback">
                                                                    Please enter first name.        
                                                                    </div>
                                                            </div>
                                                        </div>    
                                                        <div class="col-md-6 mb-3">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" name="family-<?php echo $count;?>" required="" value="<?php echo isset($names['last_name'])? $names['last_name'] : 'dada';?>">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="inputGroupPrepend">*</span>
                                                                </div>
                                                                <div class="invalid-feedback">
                                                                    Please enter Last name.       
                                                                </div>
                                                            </div>
                                                        </div>

                                                        
                                                           <?php $count++;?>
                                                        <?php endforeach;?>
                                                        <?php else:?>
                                                            <?php $count=1;?>
                                                            <div class="col-md-6 mb-3">    
                                                            <div class="input-group"> 
                                                                <input type="text" class="form-control" id="validationCustom01" placeholder="First name" name="given-0" required="" >
                                                                    <div class="input-group-prepend">          
                                                                        <span class="input-group-text" id="inputGroupPrepend">*</span>        
                                                                    </div>
                                                                    <div class="invalid-feedback">
                                                                    Please enter first name.        
                                                                    </div>
                                                            </div>
                                                        </div>    
                                                        <div class="col-md-6 mb-3">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" name="family-0" required="">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="inputGroupPrepend">*</span>
                                                                </div>
                                                                <div class="invalid-feedback">
                                                                    Please enter Last name.       
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php endif;?>
                                                    </div>
                                                    <div class="form-row col-12">
                                                            <a href="#" id="add_another"> Add Another Contributor +</a>
                                                        </div>
                                                    <div class="form-row">
                                                        <div class="col-md-12 mb-3">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="validationCustom03" placeholder="Article Title" name="title" required="" value="<?php echo isset($data['title']) ? $data['title']: '';?>">
                                                            <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroupPrepend">*</span>
                                                            </div>
                                                        <div class="invalid-feedback">
                                                            Please enter a title.
                                                        </div>
                                                            </div>


                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="validationCustom03" placeholder="Published Year" name="issued" required="" value="<?php echo isset($data['publicationDate']) ? date('Y',strtotime($data['publicationDate'])): '';?>">
                                                            <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroupPrepend">*</span>
                                                            </div>
                                                            <div class="invalid-feedback">
                                                            Please provide a valid year.
                                                        </div>
                                                        </div>
                                                        </div>
                                                        <div class="col-md-8 mb-3">
                                                        <input type="text" class="form-control" id="validationCustom05" placeholder="Name of the Journal" name="container-title" value="<?php echo isset($data['publicationName']) ? $data['publicationName']: '';?>">
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                        <input type="text" class="form-control" id="validationCustom05" placeholder="Volume No." name="volume" value="<?php echo isset($data['volume']) ? $data['volume']: '';?>">
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                        <input type="text" class="form-control" id="validationCustom05" placeholder="Issue No." name="issue">

                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                        <input type="text" class="form-control" id="validationCustom05" placeholder="Pages Used" name="pages" value="<?php echo isset($data['startingPage']) && isset($data['endingPage']) ? $data['startingPage']. '-' . $data['endingPage']  : '';?>">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                        <input type="text" class="form-control" id="validationCustom05" placeholder="DOI" name="doi" value="<?php echo isset($data['identifier']) ? $data['identifier']: '';?>">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                        <input type="text" class="form-control" id="validationCustom05" placeholder="ISSN" name="issn" value="<?php echo isset($data['issn']) ? $data['issn']: '';?>">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                        <input type="text" class="form-control" id="validationCustom05" placeholder="URL: http://" name="url">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
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
                                                        </div>
                                                    </div>
                                                    
                                                    <button class="btn btn-primary" type="submit">Submit form</button>
                                                </form>
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
 <script>
window.addEventListener('load', function() {
    var id = <?php echo $count-1;?>;
    console.log(id);
	var add_contri = (id) => {
	
		var contrib = $("#contrib");
		contrib.append('<div class="col-md-6 mb-3">'+
'    <div class="input-group">'+
'      <input type="text" class="form-control" id="validationCustom01" placeholder="First name" name="given-'+id+'"  required>'+
'        <div class="input-group-prepend">'+
'          <span class="input-group-text" id="inputGroupPrepend">*</span>'+
'        </div>'+
'		<div class="invalid-feedback">'+
'          Please enter first name.'+
'        </div>'+
'    </div>'+
'	</div>'+
'    <div class="col-md-6 mb-3">'+
'		'+
'		<div class="input-group">'+
'		<input type="text" class="form-control" id="validationCustom02" placeholder="Last name" name="family-'+id+'" required>'+
'			<div class="input-group-prepend">'+
'				<span class="input-group-text" id="inputGroupPrepend">*</span>'+
'			</div>'+
'		<div class="invalid-feedback">'+
'          Please enter Last name.'+
'        </div>'+
'		</div>'+
'	</div>');
	}
	// add_contri(id);
$("#add_another").click(function(){
  id++;
  add_contri(id);
});
function capitalize(str){
			return str.charAt(0).toUpperCase() + str.slice(1);
}
$("#frm-submit").on('submit',function(){
    var formData = $("#frm-submit");
			var inputArray = formData.serializeArray();
			var newarr = {};
				for (var i = 0; i < inputArray.length; i++){
					newarr[inputArray[i]["name"]] = inputArray[i]["value"];
				}
			console.log(newarr);
            var journal = [];
				journal[0] = {};
				journal[0].title = newarr["title"];
				journal[0].author = [];
				journal[0].author.push({});
				
				if(id > 0){
                    // journal[0].author.unshift({});
                    
                    for (var im = 0; im <= id; im++){
                        console.log(im);
                    if(im>0){
                        journal[0].author.push({});
                    }
                    journal[0].author[im]["given"] = capitalize(newarr["given-"+im]);
                    journal[0].author[im]["family"] = capitalize(newarr["family-"+im]);
                    // console.log(journal);
                    }
				}
				else{
                    journal[0].author[id]["given"] = capitalize(newarr["given-"+id]);
                    journal[0].author[id]["family"] = capitalize(newarr["family-"+id]);
//				console.log("yooo");
				}
				journal[0].issued = {};

				journal[0].issued["date-parts"] = [];
				journal[0].issued["date-parts"][0] = [];
				journal[0].issued["date-parts"][0][0] = newarr["issued"];
				journal[0]["issue"] = newarr["issue"];
				journal[0]["container-title"] = newarr["container-title"];
				journal[0].page = newarr["pages"];
				journal[0].volume = newarr["volume"];
				journal[0].DOI = newarr["doi"];
				journal[0].ISSN = newarr["issn"];
				journal[0].url = newarr["url"];
				journal[0].type = "article-journal";
				journal = JSON.stringify(journal,null,4);
				console.log(journal);
                var formatType = $(".selectpicker").val();
				$.redirect('cite-result.php', {'formatType': formatType, 'data': journal});

});






}, false); 
 </script>               
<?php include('footer.php');?>