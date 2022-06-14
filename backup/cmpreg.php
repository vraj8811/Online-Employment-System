<?php
$cmpusername = $_POST['cmpusername'];
$cmpfullname = $_POST['cmpfullname'];
$cmppassword = $_POST['cmppassword'];
$cmpemail = $_POST['cmpemail'];
$cmpcity = $_POST['cmpcity'];

$conn = mysqli_connect("localhost:3306" , "root" , "" , "test");
$sql = "INSERT INTO `companytb`(`cmpusername`, `cmpfullname`, `cmppassword`, `cmpemail`) VALUES ('$cmpusername','$cmpfullname','$cmppassword','$cmpemail')";
if(!mysqli_query($conn,$sql)) {
    setcookie("errorcmpreg" , true);
    header("Location: companyregister.php");
} else {
    setcookie("errorcmpreg", "" , time() - 3600);
    setcookie("successcompanyreg",true);
    header("Location: companylogin.php");
}
?>