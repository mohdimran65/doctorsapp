<?php
session_start();
include ("connect.php");

$Email = $_SESSION['Email'];

$sql = mysql_query("SELECT assign.ASSIGNED_TO,authentication.USERID,entity.NAME 
		FROM assign,authentication,entity WHERE assign.ASSIGNED_TO = authentication.SEQ 
		and assign.ASSIGNED_TO = entity.SEQ and assign.ASSIGNEE = '$Email'" );
$results = array();
while($row = mysql_fetch_array($sql))
{
	$results[] = array(
			'USERID' => ($row['USERID']),
			'NAME' => ($row['NAME'])
			);
}
$root = array('Doctors' => $results);
$json = json_encode($root);

echo $json;

?>