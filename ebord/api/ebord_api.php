<?php
include('API_Class.php');

$api_object = new API();

if($_GET["bulletin_Ation"] == 'get_all_subject')
{
	$data = $api_object->get_all_subject();
}

if($_GET["bulletin_Ation"] == 'insert' || $_GET["bulletin_Ation"] == 'update')
{
	$data = $api_object->edit_Bulletin();
}

if($_GET["bulletin_Ation"] == 'get_single_subject')
{
	$data = $api_object->get_single_subject($_GET["bulletin_ID"]);
}

if($_GET["bulletin_Ation"] == 'update')
{
	$data = $api_object->edit_Bulletin();
}

if($_GET["bulletin_Ation"] == 'delete')
{
	$data = $api_object->delete($_GET["bulletin_ID"]);
}

echo json_encode($data);
?>
