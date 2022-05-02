<?php

//action.php
$bulletin_Ation = $_POST["bulletin_Ation"];
if(isset($bulletin_Ation))
{
	if($bulletin_Ation == 'insert')
	{
		$form_data = array(
      "bulletin_ID" => $_POST["bulletin_ID"],
      "bulletin_Subject" => $_POST["bulletin_Subject"],
      "bulletin_Connect" => $_POST["bulletin_Connect"],
      "bulletin_Upload_Date" => $_POST["bulletin_Upload_Date"],
      "bulletin_Upload_Time" => $_POST["bulletin_Upload_Time"],
      "bulletin_Ation" => $bulletin_Ation
		);
		$api_url = "http://localhost/ebord/api/ebord_api.php?bulletin_Ation=insert";  //change this url as per your folder path for api folder
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		curl_close($client);
		$result = json_decode($response, true);
    echo json_encode($response);
	}

	if($bulletin_Ation == 'get_single_subject')
	{
		$bulletin_ID = $_POST["bulletin_ID"];
		$api_url = "http://localhost/ebord/api/ebord_api.php?bulletin_Ation=get_single_subject&bulletin_ID=".$bulletin_ID."";  //change this url as per your folder path for api folder
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		echo $response;
	}
	if($bulletin_Ation  == 'update')
	{
		$form_data = array(
      "bulletin_ID" => $_POST["bulletin_ID"],
      "bulletin_Subject" => $_POST["bulletin_Subject"],
      "bulletin_Connect" => $_POST["bulletin_Connect"],
      "bulletin_Upload_Date" => $_POST["bulletin_Upload_Date"],
      "bulletin_Upload_Time" => $_POST["bulletin_Upload_Time"],
      "bulletin_Ation" => $bulletin_Ation
		);
		$api_url = "http://localhost/ebord/api/ebord_api.php?bulletin_Ation=update";  //change this url as per your folder path for api folder
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		curl_close($client);
		$result = json_decode($response, true);
    echo json_encode($response);
	}
	if($bulletin_Ation == 'delete')
	{
		$bulletin_ID = $_POST['bulletin_ID'];
		$api_url = "http://localhost/ebord/api/ebord_api.php?bulletin_Ation=delete&bulletin_ID=".$bulletin_ID.""; //change this url as per your folder path for api folder
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		echo $response;
	}
}


?>
