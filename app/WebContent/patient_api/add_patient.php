<?php

include ("connect.php");

$name = $_REQUEST['name'];
$DOB = '2015-04-08';
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$street = $_REQUEST['street'];
$city = $_REQUEST['city'];
$state = $_REQUEST['state'];
$doctor_seq = $_REQUEST['doctor_seq'];


//echo $password;

//echo "na--$name, em--$email, ph--$phone, st --$street, ci --$city, st--$state";

$query1 = "INSERT INTO PATIENT(EMAIL,PHONE,DOCTOR_SEQ) VALUES('$email',$phone,$doctor_seq)";
if(mysql_query($query1)=== true)
{ 
	$result = mysql_query("select max(SEQ) from AUTHENTICATION");

	$row = mysql_fetch_array($result);
	$SEQ = $row['max(SEQ)']+1;
	$query2 = "INSERT INTO ENTITY(SEQ,NAME,DOB) VALUES($SEQ,'$name',$DOB)";
	if(mysql_query($query2) === true)
	{
		$query3 = "INSERT INTO ADDRESS(SEQ,STREET,CITY,STATE) VALUES($SEQ,'$street','$city','$state')";

		if(mysql_query($query3) === true)
			
		{
			$result = mysql_query("select max(ADDRESS_SEQ) as ADDRESS_SEQ from ADDRESS");
			$row1 = mysql_fetch_array($result);
				
			$query4 = "INSERT INTO PHONE(SEQ,ADDRESS_SEQ,PHONE) VALUES($SEQ,{$row1['ADDRESS_SEQ']},$phone)";
				
			if (mysql_query($query4) === true)

			{
				echo 1;
			}
			else {mysql_query("DELETE FROM patient WHERE EMAIL = '$email'");mysql_query("DELETE FROM entity WHERE SEQ = $SEQ");mysql_query("DELETE FROM ADDRESS WHERE SEQ = $SEQ"); echo 0;}
		}
	   else {mysql_query("DELETE FROM patient WHERE EMAIL = '$email'");mysql_query("DELETE FROM entity WHERE SEQ = $SEQ"); echo 0;}
	}
	else {mysql_query("DELETE FROM patient WHERE EMAIL = '$email'"); echo 0;}
	}
else echo 0;
?>