<?php
$ename = $_GET['ename'];
$deptid = $_GET['deptid'];

$conn = mysqli_connect("localhost:3306", "root", "" );
$db = mysqli_select_db($conn,"test");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "INSERT INTO `emp`( `ename`, `deptid`) VALUES ('$ename',$deptid);";

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header('Location: index.php');
} else {
    echo "Error deleting record";
}
?>