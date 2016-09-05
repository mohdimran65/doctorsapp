<?php
include ("connect.php");

$name = $_REQUEST['name'];
$userID = $_REQUEST['userID'];
$password = $_REQUEST['password'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$street = $_REQUEST['street'];
$city = $_REQUEST['city'];
$state = $_REQUEST['state'];
$designation = null;

//echo $name, $userID,$password,$email,$phone,$street,$city,$state;

$query1 = "INSERT INTO AUTHENTICATION(USERID,EMAIL,PHONE,PASSWORD,DESIGNATION) VALUES('$userID','$email',$phone,'$password','$designation')";
if(mysql_query($query1)=== true)
{
	$result = mysql_query("select SEQ from AUTHENTICATION where userID = '$userID'  ");
	
	$row = mysql_fetch_array($result);
	$query2 = "INSERT INTO ENTITY(SEQ,NAME) VALUES({$row['SEQ']},'$name')";
	if(mysql_query($query2) === true)
	{
		$query3 = "INSERT INTO ADDRESS(SEQ,STREET,CITY,STATE) VALUES({$row['SEQ']},'$street','$city','$state')";
		
		if(mysql_query($query3) === true)
			
		{
			$result = mysql_query("select max(ADDRESS_SEQ) as ADDRESS_SEQ from ADDRESS");
			$row1 = mysql_fetch_array($result);
			
			$query4 = "INSERT INTO PHONE(SEQ,ADDRESS_SEQ,PHONE) VALUES({$row['SEQ']},{$row1['ADDRESS_SEQ']},$phone)";
			
			if (mysql_query($query4) === true)
				
			{
				echo 1;
			}
		}
	}
}
else 0;






?>