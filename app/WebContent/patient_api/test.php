<?php

include 'connect.php';
$sth = mysql_query("SELECT * FROM authentication");
$rows = array();
while($r = mysql_fetch_assoc($sth)) {
	$rows[] = $r;
}
$baris = array('Auth' => $rows);
print json_encode($baris);
?>