<?php

include ("connect.php");

$sql = mysql_query("select entity.name,authentication.USERID,address.STREET,address.CITY,address.STATE
from entity,authentication,address
WHERE authentication.SEQ=entity.SEQ and authentication.SEQ = address.SEQ and authentication.DESIGNATION = 'Patient'");
$results = array();
while($row = mysql_fetch_array($sql))
{
	$results[] = array(
			'PATIENT_NAME' => ($row['name']),
			'USERID' => $row['USERID'],
			'ADDRESS' => $row['STREET'],
			'CITY' => $row['CITY'],
			'STATE' => $row['STATE']
	);
}
$root = array('Patient' => $results);
$json = json_encode($root);

echo $json;
?>