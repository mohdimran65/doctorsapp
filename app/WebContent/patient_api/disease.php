<?php

include ("connect.php");

$sql = mysql_query("select DISEASE_NAME from disease");
$results = array();
while($row = mysql_fetch_array($sql))
{
	$results[] = array(
			'DISEASE_NAME' => ($row['DISEASE_NAME']),
			);
}
$root = array('Disease' => $results);
$json = json_encode($root);

echo $json;

?>