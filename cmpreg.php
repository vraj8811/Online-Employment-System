<?php
$cmpusername = $_POST['cmpusername'];
$cmpfullname = $_POST['cmpfullname'];
$cmppassword = $_POST['cmppassword'];
$cmpemail = $_POST['cmpemail'];
$cmpdesc = $_POST['cmpdesc'];
$cmpestdate = $_POST['cmpestdate'];

$conn = mysqli_connect("localhost:3306" , "root" , "" , "test");



$sql = "INSERT INTO `companytb`(`cmpusername`, `cmpfullname`, `cmppassword`, `cmpemail`, `cmpdesc`,`cmpestdate`) VALUES ('$cmpusername','$cmpfullname','$cmppassword','$cmpemail','$cmpdesc','$cmpestdate')";

session_start();
$_SESSION['secretcode'] = random_int(100000, 999999);
$_SESSION['cmpemail'] = $cmpemail;
$_SESSION['insertcmpreg'] = $sql;


$checksql = "select * from companytb where cmpusername like '".$cmpusername."';";
$result = mysqli_query($conn,$checksql);
$num = mysqli_num_rows($result);
if($num > 0 ) {
    setcookie("errorcmpreg" , true);
    header("Location: companyregister.php");
} else {
    header("Location: cmptestemail.php");
}



/* if(!mysqli_query($conn,$sql)) {
    setcookie("errorcmpreg" , true);
    header("Location: companyregister.php");
} else {
    setcookie("errorcmpreg", "" , time() - 3600);
    setcookie("successcompanyreg",true);
    header("Location: companylogin.php");
} */
?>