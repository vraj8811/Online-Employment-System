<?php
$date = date('Y-m-d');
$duration = $_GET['pkgduration'];
$cmpid = $_COOKIE['cmpid'];
$pkgid = $_GET['pkgid'];
$end_date = date('Y-m-d' , strtotime($date. " + $duration months"));
$connection = mysqli_connect("localhost:3306", "root", "" , "test");
$sql = "INSERT INTO `subscriptiontb` (pkgid, cmpid, endingdate) VALUES ($pkgid, $cmpid, '$end_date');";

$result = mysqli_query($connection, $sql);


header("Location: featuredjobs.php");
?>