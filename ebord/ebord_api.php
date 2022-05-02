<?php
header("Content-Type:application/json");
$response_json;
$what_Iget = array('FUC' => $_GET['FUC']."api", 'ID' => $_GET['ID']."api");
if (isset($what_Iget['ID']) && $what_Iget['ID']!="") {
    $response_json = $what_Iget;
	}else{
    $response_json = array('FUC' => $_GET['FUC'], 'ID' => "inotgetanything");

		}
response($response_json);
function response($what_Iget_rp){
	$json_response = json_encode($what_Iget_rp);
	echo $json_response;
}
?>
