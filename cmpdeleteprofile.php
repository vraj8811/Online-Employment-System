<?php
if( isset($_COOKIE['cmpid']) ) {
	if($_COOKIE['cmpid'] == "" ) {
		header("Location: companylogin.php");
	}
} else {
	header("Location: companylogin.php");
}


$conn = mysqli_connect("localhost:3306" , "root" , "" , "test");

$sql_deljob = "delete from joblisttb where cmpid=".$_COOKIE['cmpid'];
$sql_delcmp = "delete from companytb where cmpid=".$_COOKIE['cmpid'];
$sql_delsub = "delete from subscriptiontb where cmpid=".$_COOKIE['cmpid'];

echo $sql_delcmp;
echo $sql_deljob;
if(!mysqli_query($conn,$sql_deljob)) {
    echo "<br/>Jobs by this company cannot be deleted!";
}

if(!mysqli_query($conn,$sql_delsub)) {
    echo "<br />Cannot delete from subscription table!";
}

if(!mysqli_query($conn,$sql_delcmp)) {
    echo "<br />This company profile cannot be deleted!";
} else {
    header("Location: logout.php");
}
?>