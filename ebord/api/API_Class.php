<?php
function get_config()
{
  // get mySql config data
  $filename = "../res/config.txt";
  $handle = fopen($filename, "r");
  $contents = fread($handle, filesize($filename));
  $config = json_decode($contents);
  $sql_Cconfig = $config -> database;
  fclose($handle);
  return $sql_Cconfig;
}
class API
{
  // use : $sql_Cconfig -> database_Status;
  private $sql_Con ;

  function __construct()
	{
		$this->mysql_connection();
	}

	function mysql_connection()
	{
    // connect mysql database
    $sql_Cconfig = get_config();
    if (strcmp($sql_Cconfig -> database_Status, "none") !== 0) {
		$this-> sql_Con = new mysqli($sql_Cconfig -> database_Server, $sql_Cconfig -> database_User, $sql_Cconfig -> database_Password, $sql_Cconfig -> database_Name);
    mysqli_query($this-> sql_Con, "set names utf8");
    }
	}
  function get_all_subject()
{
  // get all bulletin
  $table_Name = 'table_bulletin';
  $query =sprintf("SELECT ID, subject FROM %s", $table_Name) ;
  $result = $this-> sql_Con->query($query);
  foreach ($result as $key => $value) {
    $result_return[] = $value;
  }
  return $result_return;
}

function edit_Bulletin()
{
  $bulletin_Ation = $_POST["bulletin_Ation"];
  $data = "";
  $result_return = "";
  if ($bulletin_Ation == "insert") {

    if(!isset($bulletin_Subject))
    {
      $bulletin_ID = $_POST["bulletin_ID"];
      $bulletin_Subject = $_POST["bulletin_Subject"];
      $bulletin_Connect = $_POST["bulletin_Connect"];
      $bulletin_Upload_Date = $_POST["bulletin_Upload_Date"];
      $bulletin_Upload_Time = $_POST["bulletin_Upload_Time"];
      $insert_Option = "  ID, subject, content, upload_Date, upload_Time";
      $insert_Option_Value = sprintf("'%s', '%s', '%s', '%s', '%s'",$bulletin_ID,$bulletin_Subject,$bulletin_Connect,$bulletin_Upload_Date,$bulletin_Upload_Time);
      $table_Name = 'table_bulletin';
      $query = sprintf("INSERT INTO table_bulletin (%s) VALUES ( %s );",$insert_Option,$insert_Option_Value);
      $result = $this -> sql_Con->query($query);
      if($result === true)
      {
        $data = array(
          'success'	=>	"<meta http-equiv='refresh' content='0'>"
        );
      }
      else
      {
        $query = sprintf("SELECT IF(COUNT(*) > 0, 1, 0) AS check_Result FROM %s WHERE ID = '%s';",$table_Name,$bulletin_ID);
        $result = $this -> sql_Con->query($query);
        foreach ($result as $key => $value) {
          $result_return = $value;
        }
        if ($result_return['check_Result']>0) {
          $data = array(
            'success'	=>	'2'
          );
        }else {
          $data = array(
            'success'	=>	'0'
          );
        }
      }
    }
  }elseif ($bulletin_Ation == "update") {
    $bulletin_ID = $_POST["bulletin_ID"];
    $bulletin_Subject = $_POST["bulletin_Subject"];
    $bulletin_Connect = $_POST["bulletin_Connect"];
    $bulletin_Upload_Date = $_POST["bulletin_Upload_Date"];
    $bulletin_Upload_Time = $_POST["bulletin_Upload_Time"];
    $table_Name = 'table_bulletin';
    $query = sprintf("UPDATE %s SET subject = '%s', content = '%s', upload_Date = '%s', upload_Time = '%s' WHERE ID = '%s';",$table_Name,$bulletin_Subject,$bulletin_Connect,$bulletin_Upload_Date,$bulletin_Upload_Time,$bulletin_ID);
    $result = $this -> sql_Con->query($query);
    if($result === true)
    {
      $data = array(
        'success'	=>	"<meta http-equiv='refresh' content='0'>"
      );
    }
    else
    {
      $query = sprintf("SELECT IF(COUNT(*) > 0, 1, 0) AS check_Result FROM %s WHERE ID = '%s';",$table_Name,$bulletin_ID);
      $result = $this -> sql_Con->query($query);
      foreach ($result as $key => $value) {
        $result_return = $value;
      }
      if ($result_return['check_Result']>0) {
        $data = array(
          'success'	=>	'2'
        );
      }else {
        $data = array(
          'success'	=>	'0'
        );
      }
    }
  }
  return $data;
  }

function get_single_subject($bulletin_ID)
{
  $table_Name = 'table_bulletin';
  $query = sprintf("SELECT ID,subject,content FROM %s WHERE ID = '%s';",$table_Name,$bulletin_ID);
  $result = $this -> sql_Con->query($query);
  foreach ($result as $key => $value) {
    $result_return = $value;
  }
  if (count($result_return)>0) {
    $data = $result_return;
  }else {
    $data = "error";
  }
    return $data;
  }
function delete($bulletin_ID)
{
  $table_Name = 'table_bulletin';
  $query = sprintf("DELETE FROM %s WHERE ID = '%s';",$table_Name,$bulletin_ID);
  $result = $this -> sql_Con->query($query);
  $query = sprintf("SELECT IF(COUNT(*) > 0, 1, 0) AS check_Result FROM %s WHERE ID = '%s';",$table_Name,$bulletin_ID);
  $result = $this -> sql_Con->query($query);
  foreach ($result as $key => $value) {
    $result_return = $value;
  }
  if ($result_return['check_Result']>0) {
    $data = array(
      'success'	=>	'0'
    );
  }else {
    $data = array(
      'success'	=>	'1'
    );
  }
  return $data;
  }
}
?>
