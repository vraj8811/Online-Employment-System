<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $userfullname = $_POST['userfullname'];
    $userpassword = $_POST['userpassword'];
    $useremail = $_POST['useremail'];
    $usercity = $_POST['usercity'];



    $insertsql = "INSERT INTO `usertb`(`username`, `userfullname`, `userpassword`, `useremail`, `usercity`)"
    ."VALUES ('$username','$userfullname','$userpassword','$useremail','$usercity');";

    session_start();
    // generates random 6 digit number
    $_SESSION['secretcode'] = random_int(100000, 999999);
    $_SESSION['useremail'] = $useremail;
    $_SESSION['usrqueryreg'] = $insertsql;

    $conn = mysqli_connect("localhost:3306" , "root" , "" , "test");
    //check if username exist already
    $sql = "select * from usertb where username like '".$username."';";

    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    // erroruserreg is true then there is error
    // so redirect to registration page again
    if($num > 0 ) {
        setcookie("erroruserreg" , true);
        header("Location: userregister.php");
    } else {
        // else go for OTP
        setcookie("erroruserreg",false);
        header("Location: test-email.php");
    }


} else {
    header("Location: index.php");
}

?>