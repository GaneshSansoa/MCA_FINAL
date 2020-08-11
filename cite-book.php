<?php 
// if ($_SERVER['REQUEST_METHOD'] != 'POST') {
//    exit;
//  }
 ?>
<?php //print_r($_POST);
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $data = json_decode($_POST['data'],true);
}


//  print_r($data);
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
												<h4 class="ml-3">Cite Book</h4>
											</div>
											<div class="card-content">
                                                <form class="needs-validation" method="post" action="cite-result.php" id="frm-submit" onsubmit="return false;">
                                                    <div class="form-row" id="contrib">
                                                        
                                                        <?php if(isset($data['authors'])):?>
                                                            <?php $count=0;?>
                                                        <?php foreach($data['authors'] as $author):

                                                            $names = split_name($author);
                                                            //print_r($names);
                                                            ?>
                                                            <div class="col-md-6 mb-3">    
                                                            <div class="input-group"> 
                                                                <input type="text" class="form-control" id="validationCustom01" placeholder="First name" name="given-<?php echo $count;?>" required="" value="<?php echo isset($names['first_name']) ? $names['first_name'] : '';?>">
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
                                                                <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" name="family-<?php echo $count;?>" required="" value="<?php echo isset($names['last_name'])? $names['last_name'] : '';?>">
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
                                                            <input type="text" class="form-control" id="validationCustom03" placeholder="Title" name="title" required="" value="<?php echo isset($data['title']) ? $data['title']: '';?>">
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
                                                            <input type="text" class="form-control" id="validationCustom03" placeholder="Published Year" name="issued" required="" value="<?php echo isset($data['publishedDate']) ? date('Y',strtotime($data['publishedDate'])): '';?>">
                                                            <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroupPrepend">*</span>
                                                            </div>
                                                            <div class="invalid-feedback">
                                                            Please provide a valid year.
                                                        </div>
                                                        </div>
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                        <input type="text" class="form-control" id="validationCustom05" placeholder="Edition" name="edition">
                                                        <div class="invalid-feedback">
                                                            Please provide a valid edition.
                                                        </div>
                                                        </div>
                                                        <div class="col-md-5 mb-3">
                                                        <input type="text" class="form-control" id="validationCustom05" placeholder="City" name="city">
                                                        <div class="invalid-feedback">
                                                            Please provide a valid city.
                                                        </div>
                                                        </div>
                                                        <div class="col-md-8 mb-3">
                                                        <input type="text" class="form-control" id="validationCustom05" placeholder="Publisher" name="publisher" value="<?php echo isset($data['publisher']) ? $data['publisher']: '';?>">
                                                        <div class="invalid-feedback">
                                                            Please provide a valid publisher.
                                                        </div>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                        <input type="text" class="form-control" id="validationCustom05" placeholder="Pages Used" name="pages">
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
            var book = [];
				book[0] = {};
				book[0].title = newarr["title"];
				book[0].author = [];
				book[0].author.push({});
				console.log(id);
				if(id > 0){
				// book[0].author.unshift({});
				for (var im = 0; im <= id; im++){
                    // console.log(newarr["given-"+im]);
                    console.log(id);
                    // console.log(newarr["family-"+im]);
                    if(im>0){
                        book[0].author.push({});
                    }
                    book[0].author[im]["given"] = capitalize(newarr["given-"+im]);
                    book[0].author[im]["family"] = capitalize(newarr["family-"+im]);

					console.log(im);

				}
				}
				else{
				book[0].author[id]["given"] = capitalize(newarr["given-"+id]);
				book[0].author[id]["family"] = capitalize(newarr["family-"+id]);
				console.log("yooo");
				}
				book[0].issued = {};

				book[0].issued["date-parts"] = [];
				book[0].issued["date-parts"][0] = [];
				book[0].issued["date-parts"][0][0] = newarr["issued"];
				book[0]["publisher-place"] = newarr["city"];
				book[0].publisher = newarr["publisher"];
				book[0].page = newarr["pages"];
				book[0].edition = newarr["edition"];
				book[0].type = "book";
				book = JSON.stringify(book,null,4);
				console.log(book);
                var formatType = $(".selectpicker").val();
               $.redirect('cite-result.php', {'formatType': formatType, 'data': book});
                // $.ajax({
                //     url:'cite-result.php',
                //     type:'post',
                //     dataType:'json',
                //     data:{
                //         'formatType':formatType,
                //         'data':book,
                //     },
                //     success:function(res){
                //         // localStorage.clear();
                //         console.log(res.bibliography);
                //         if(!localStorage.counter && !localStorage.citations){
                //             localStorage.counter = 0;
                //             localStorage.citations = [];
                //         }

                //         else{
                //             localStorage.counter++;
                //             localStorage.citations[localStorage.counter] = res.bibliography;
                //             console.log(localStorage.citations[localStorage.counter]);
                //         }


                //     }

                // })

});






}, false); 
 </script>               
<?php include('footer.php');?>