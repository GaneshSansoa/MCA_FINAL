<?php 
	include_once("connection.php");
	include_once("validator.php");
	include_once("verify_token.php");
	include "../vendor/autoload.php";
	use Seboettg\CiteProc\StyleSheet;
	use Seboettg\CiteProc\CiteProc;
	class Fetch{
		public $conn;
		
		public function __construct($db){
			$this->conn = $db;
		}
		public function get_bibliographies($token){
			$verifyToken = new Verify();
			$tokenData = $verifyToken->verify_token($token);
//			echo print_r($tokenData);
			if($tokenData['status']== 'success'){
			$id = $tokenData['data']['id'];
			$stmt = $this->conn->prepare("SELECT group_id,group_name,citation_type FROM citation_groups where user_id=".$id."");
				$stmt->execute();
				$result = $stmt->fetchAll();
				$rows = $stmt->fetchColumn();
				$bib_groups_name = array();
				$bib_groups_id = array();
				$bib_groups = array();
				$bib_citation_type = array();
				if(count($result) > 0){
					foreach($result as $r){
						array_push($bib_groups_name,$r['group_name']);
						array_push($bib_groups_id,$r['group_id']);
						array_push($bib_citation_type, $r['citation_type']);
					}					
				}
				else{
					array_push($bib_groups,"No Bibliogrpahy Found");
				}
				

				//$bib_groups = array_combine($bib_groups_name,$bib_groups_id,$bib_citation_type);
				$result = array_map(function ($bib_groups_name, $bib_groups_id, $bib_citation_type) {
					return array_combine(
					  ['group_name', 'group_id', 'citation_type'],
					  [$bib_groups_name, $bib_groups_id, $bib_citation_type]
					);
				  }, $bib_groups_name, $bib_groups_id, $bib_citation_type);
				return array($result);
			}
			else{
				return array('status'=>'error', 'message'=>'Unverified Token');
			}
		}
		public function get_bibliographies_groups($token,$bib_id){
			$verifyToken = new Verify();
			$tokenData = $verifyToken->verify_token($token);
//			echo print_r($tokenData);
			if($tokenData['status']== 'success'){
				$id = $tokenData['data']['id'];
				
				$stmt = $this->conn->prepare("SELECT * FROM user_citations INNER JOIN citation_groups ON user_citations.group_id = citation_groups.group_id where citation_groups.group_id = '".$bib_id."' and citation_groups.user_id='".$id."'");
				$stmt->execute();
				$results = $stmt->fetchAll();
				// print_r($results);
				$stmt1 = $this->conn->prepare("SELECT citation_style,citation_type,user_id FROM citation_groups WHERE group_id = '".$bib_id."'");
				$stmt1->execute();
				$results1 = $stmt1->fetchAll();
				// print_r($results1);die;
				
				$citation_style =  $results1[0]['citation_style'];
				// echo $citation_style;
				$citation_type = $results1[0]['citation_type'];
				$user_id = $results1[0]["user_id"];
				//  echo $citation_type;
				$bibliographies = array();
				$styled_bibs = array();
				//echo print_r($results);die;
				if(count($results) > 0){
					foreach($results as $r){
						//echo $r['citations'];
						array_push($bibliographies,$r['citations']);
					}
					$test_arr = array();
					foreach($bibliographies as $bibliography){
					$bibliography = rtrim($bibliography,']');
					$bibliography = ltrim($bibliography,'[');
					
					array_push($test_arr,$bibliography);
					}
					
					$meta = implode(', ',$test_arr);
					$meta_data = "[" . $meta . "]";
					//echo $meta_data;
					$style;
					if($citation_type === "pre-defined"){
						// echo "in predefined";
						$style = StyleSheet::loadStyleSheet($citation_style);
					}
					if($citation_type === "custom-style"){
						// echo "In CUstom style";die;
						 $style = StyleSheet::loadCustomStyleSheet($user_id,$citation_style);
					}
					//print_r($style);die;
					
					$citeProc = new CiteProc($style);
						$bibliography = '';
						$bibliography = $citeProc->render(json_decode($meta_data), "bibliography");
						$cssStyles = $citeProc->renderCssStyles();
						return array('status'=>'success','style'=>$citation_style,'bib_data'=>$bibliography);
//						echo $bibliography;
						die;
					foreach($bibliographies as $bibliography){
						$bibliography = $citeProc->render(json_decode($bibliography), "bibliography");
						$cssStyles = $citeProc->renderCssStyles();
						array_push($styled_bibs,$bibliography);
					}

					//print_r($bibliographies);
					return array('status'=>'success','style'=>$citation_style,'bib_data'=>$styled_bibs);
				}
				else{
//					echo "dsad";
					return array('status'=>'error','message'=>'No Citations Added in this Bibliogrpahy','style'=>$citation_style);
				}
			}
			else{
				return array('status'=>'error', 'message'=>'Unverified Token');
			}
		}
		public function checkPassword($token,$password){
			$verifyToken = new Verify();
			$tokenData = $verifyToken->verify_token($token);
//			echo print_r($tokenData);
			if($tokenData['status']== 'success'){
				$id = $tokenData['data']['id'];
				$email = $tokenData['data']['email'];
				$stmt = $this->conn->prepare("SELECT password from register where id='".$id."' and email='".$email."' LIMIT 1");
				$stmt->execute();
				$result = $stmt->fetchAll();
				$db_password = '';
				if(count($result)> 0){
					$db_password = $result[0]["password"];
					if(password_verify($password,$db_password)){
						return array("status"=>"success");
					}
					else{
						return array("status"=>"error","message"=>"Password Dosen't Matched");
					}
				}
				else{
						return array("status"=>"error","message"=>'DB Error');
				}
				
			}
			else{
				return array('status'=>'error', 'message'=>'Unverified Token');
			}
		}
	}
?>