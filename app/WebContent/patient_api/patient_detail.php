<?php
session_start();
include ("connect.php");

$Email = $_SESSION['Email'];

$sql = mysql_query("select entity.name,patient.SEQ,patient.EMAIL,address.STREET, address.CITY,
		address.STATE,update_user.IMAGE,patient.PHONE FROM patient
		LEFT OUTER JOIN entity ON patient.SEQ=entity.SEQ 
		LEFT OUTER JOIN address ON patient.SEQ = address.SEQ 
		LEFT OUTER JOIN update_user ON patient.SEQ = update_user.SEQ
        WHERE patient.DOCTOR_EMAIL = '$Email'");
$results = array();
while($row = mysql_fetch_array($sql))
{
	$results[] = array(
			'PATIENT_NAME' => ($row['name']),
			'STREET' => $row['STREET'],
			'CITY' => $row['CITY'],
			'STATE' => $row['STATE'],
			'IMAGE' => $row['IMAGE'],
			'PHONE' => $row['PHONE'],
			'EMAIL' => $row['EMAIL'],
	);
}
$root = array('Patient_Details' => $results);
$json = json_encode($root);

echo $json;
?>