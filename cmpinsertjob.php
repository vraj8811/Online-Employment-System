<?php
if( isset($_COOKIE['cmpid']) ) {
	if($_COOKIE['cmpid'] == "" ) {
		header("Location: companylogin.php");
	}
} else {
	header("Location: companylogin.php");
}

$cmpid = $_COOKIE['cmpid'];
$jobtitle = $_POST['jobtitle'];
$jobdesc = $_POST['jobdesc'];
$jobrole = $_POST['jobrole'];
$location = $_POST['location'];
$minexp = $_POST['minexpyears'];
$minsalary = $_POST['minsalary'];
$jobcategory = $_POST['jobcategory'];
$jobtype = $_POST['jobtype'];

$conn = mysqli_connect("localhost:3306","root","","test");

$sql = "INSERT INTO `joblisttb` (`cmpid`, `jobtitle`,
 `minexpyears`, `minsalary`, `jobcity`, `jobdesc`, `jobrole`, `jobcategory`, `jobtype`)
 VALUES ('$cmpid', '$jobtitle', '$minexp', '$minsalary', '$location', '$jobdesc', '$jobrole', '$jobcategory', '$jobtype')";

try {
    $result = mysqli_query($conn,$sql);
    header("Location: featuredjobs.php");
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
