<?php

include ("connect.php");

$sql = mysql_query("select * from medicin");
$results = array();
while($row = mysql_fetch_array($sql))
{
	$results[] = array(
		
			'NAME' => ($row['MEDICIN_NAME']),		
	);
}
$root = array('Medicine' => $results);
$json = json_encode($root);

echo $json;

?>