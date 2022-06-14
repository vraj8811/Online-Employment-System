<?php
if( isset($_COOKIE['cmpid']) ) {
	if($_COOKIE['cmpid'] == "" ) {
		header("Location: companylogin.php");
	}
} else {
	header("Location: companylogin.php");
}

$jobid = $_GET['jobid'];

$conn = mysqli_connect("localhost:3306","root","","test");
$sql ="delete from joblisttb where jobid=".$jobid;
try {
    $result = mysqli_query($conn,$sql);
    header("Location: featuredjobs.php");
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
