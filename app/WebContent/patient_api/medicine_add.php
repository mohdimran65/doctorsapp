<?php

include ("connect.php");

$medicine_name1 = $_REQUEST['item'];
$medicine_name2 = null;
$medicine_name3 =null;
$medicine_name4 = null;
$medicine_name5 = null;
$medicine_name6 = null;
$medicine_name7 = null;
$medicine_name8 = null;
$medicine_name9 = null;
$medicine_name10 = null;
$medicine_name11 = null;

$disease_name1 = $_REQUEST['item1'];
$disease_name2 = null;
$disease_name3 = null;
$disease_name4 = null;
$disease_name5 = null;
$disease_name6 = null;

$USERID = $_REQUEST['USERID'];


//$medicine = "Test1";
//$power = "Test2";
//$brand = "Test3";
//$speciality = "Test4";
//echo substr($medicine_name,9);
$medicine_name1 = trim($medicine_name1,"{\"NAME\":}");
$disease_name1 = trim($disease_name1,"{\"DISEASE_NAME\":}");

$result = mysql_query("SELECT authentication.SEQ,authentication.USERID,entity.DOB from authentication,entity
where authentication.SEQ = entity.SEQ and authentication.USERID = '$USERID'");

$row = mysql_fetch_array($result);


$query = "INSERT INTO patient VALUES({$row['SEQ']},'{$row['USERID']}','{$row['DOB']}','$disease_name1',
		'$disease_name2','$disease_name3','$disease_name4','$disease_name5','$disease_name6',
		'$medicine_name1','$medicine_name2','$medicine_name3','$medicine_name4','$medicine_name5',
		'$medicine_name6','$medicine_name7','$medicine_name8','$medicine_name9','$medicine_name10',
		'$medicine_name11')";

if (mysql_query($query) === true)
	{
	echo 1;
   }
else 
	echo 0;

?>