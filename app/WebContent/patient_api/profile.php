<?php
include ("connect.php");

session_start();

$Email = $_SESSION['Email'];

$sql = mysql_query("SELECT entity.NAME,authentication.USERID,authentication.EMAIL,address.STREET,
		address.CITY,address.STATE,phone.PHONE, update_user.ACHIEVEMENT,update_user.FACEBOOK_LINK,
		update_user.IMAGE,update_user.LINKEDIN_LINK,update_user.SPECAILIST, update_user.TWITTER_LINK 
		FROM authentication LEFT OUTER JOIN entity ON authentication.SEQ=entity.SEQ 
		LEFT OUTER JOIN address ON authentication.SEQ = address.SEQ 
		LEFT OUTER JOIN phone ON authentication.SEQ = phone.SEQ 
		LEFT OUTER JOIN update_user ON authentication.SEQ = update_user.SEQ 
		WHERE authentication.EMAIL = '$Email'");
$results = array();
while($row = mysql_fetch_array($sql))
{
	$results[] = array(
			'NAME' => ($row['NAME']),
			'USERID' => $row['USERID'],
			'EMAIL' => ($row['EMAIL']),
			'STREET' => $row['STREET'],
			'CITY' => $row['CITY'],
			'STATE' => $row['STATE'],
			'PHONE' => ($row['PHONE']),
			'ACHIEVEMENT' => ($row['ACHIEVEMENT']),
			'FACEBOOK_LINK' => $row['FACEBOOK_LINK'],
			'IMAGE' => $row['IMAGE'],
			'LINKEDIN_LINK' => $row['LINKEDIN_LINK'],
			'SPECAILIST' => $row['SPECAILIST'],
			'TWITTER_LINK' => $row['TWITTER_LINK'],
			
	);
}
$json = json_encode($results);

echo $json;
?>