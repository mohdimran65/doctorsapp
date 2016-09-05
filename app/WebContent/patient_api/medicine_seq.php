<?php
include ("connect.php");

$sql = mysql_query("select MEDICIN_SEQ from medicin");
$results = array();
while($row = mysql_fetch_array($sql))
{
	$results[] = array(
			'MEDICIN_SEQ' => ($row['MEDICIN_SEQ'])
				);
}
$root = array('Medicine_seq' => $results);
$json = json_encode($root);

echo $json;

?>