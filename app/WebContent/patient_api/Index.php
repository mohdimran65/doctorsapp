<?php
session_start();
include ("connect.php");
$Email = $_POST['postuserId'];
$Password = $_POST['postpassword'];

$_SESSION['Email'] = $Email ;

$query = "SELECT SEQ FROM authentication WHERE EMAIL = '$Email' and password = '$Password'";

$result = mysql_query($query);

$count = mysql_num_rows($result);

if($count > 0){
	echo 1;
}
else{
	echo 0;
}

//$result = mysqli_query($conn, $sql);


//if (mysqli_num_rows($result) > 0) {
	//echo "<ul>";
	//while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		//echo "<li>{$row['userID']}{$row['email']}
		//</li>";
	//}
	//echo "</ul>";
	//} else {
        // echo $_GET['userId'];
		
	//}
?>
