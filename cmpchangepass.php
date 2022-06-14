<?php
if( isset($_COOKIE['cmpid']) ) {
	if($_COOKIE['cmpid'] == "" ) {
		header("Location: companylogin.php");
	}
} else {
	header("Location: companylogin.php");
}

setcookie("newpasserr", false , time() - 1);
setcookie("newpasserr1" , false , time() - 1);


$conn = mysqli_connect("localhost:3306" , "root" , "" , "test");
$sql = "select * from companytb where cmpid=".$_COOKIE['cmpid'];

$result = mysqli_query($conn , $sql);

$row = mysqli_fetch_assoc($result);



if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_POST['oldpassword'])) {
        if($_POST['oldpassword'] == $row['cmppassword']) {
            if($_POST['newpass']  == $_POST['cnfnewpass']) {
                $sql = "update companytb set cmppassword='".$_POST['newpass']."' where cmpid=".$_COOKIE['cmpid'];
                $result = mysqli_query($conn,$sql);
                if(!$result) {
                } else {
                    setcookie("newpasserr", "" , time() - 3600);
                    header("Location: cmpprofile.php");
                }
            } else {
                setcookie("newpasserr1", true);
                header("Location: cmpchangepass.php");
            }
        } else {
            setcookie("newpasserr" , true);
            header("Location: cmpchangepass.php");
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>
        Hello World
    </title>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Naukri.COM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="featuredjobs.php">Featured Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewapplications.php">Applications</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="viewcompanies.php">View Companies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="subdetails.php">Subscription Details</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="cmpprofile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cmpcontactus.php">Contact Us</a>
                    </li>
                </ul>

                <form class="d-flex text-white">
                    <div class="m-2">
                        <strong>
                            Welcome,
                            <?php echo $_COOKIE['cmpfullname']; ?>
                        </strong>
                    </div>
                    <a class="btn btn-primary" href="logout.php" type="button">Logout</a>
                </form>
            </div>
        </div>
    </nav>
    <br />
    <br />
    <br />
    <br />
    <div class="container">
        <?php
        echo $_POST['oldpassword'];
        echo $_POST['newpass'];
        echo $_POST['cnfnewpass'];
        if(isset($_COOKIE['newpasserr'])) {
            if($_COOKIE['newpasserr']) {
                echo '<div class="alert alert-warning alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>Warning!</strong> Current password is wrong!
              </div>';
            }
        }
        if(isset($_COOKIE['newpasserr1'])) {
            if($_COOKIE['newpasserr1']) {
                echo '<div class="alert alert-warning alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>Warning!</strong> Passwords do not match!
              </div>';
            }
        }
        ?>
        <form action="cmpchangepass.php" method="POST">
            <div class="form-group">
                <label for="oldpassword">Old password : </label>
                <input name="oldpassword" type="password" class="form-control" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" />
                <label for="newpass">New password : </label>
                <input name="newpass" type="password" class="form-control" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" />
                <label for="cnfnewpass">Confirm New password : </label>
                <input name="cnfnewpass" type="password" class="form-control" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" />
                <input type="submit" value="Change" class="btn btn-warning my-3" />
                <a href="cmpprofile.php" class="btn btn-primary">Go Back</a>
            </div>
        </form>
    </div>
</body>
</html>