<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $userfullname = $_POST['userfullname'];
    $userpassword = $_POST['userpassword'];
    $useremail = $_POST['useremail'];
    $usercity = $_POST['usercity'];

    $errorflag = false;
    
    $insertsql = "INSERT INTO `usertb`(`username`, `userfullname`, `userpassword`, `useremail`, `usercity`)"
    ."VALUES ('$username','$userfullname','$userpassword','$useremail','$usercity');";

    session_start();
    $_SESSION['secretcode'] = random_int(100000, 999999);
    $_SESSION['useremail'] = $useremail;
    $_SESSION['usrqueryreg'] = $insertsql;

    if($flag) {
        setcookie("erroruserreg", true);
        header("Location: userregister.php");
    } else {
        setcookie("incorrectcode",false);
        header("Location: test-email.php");
    }
} else {
    header("Location: index.php");
}

?>