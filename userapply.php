<?php

session_start();

if($_SERVER['REQUEST_METHOD'] == "GET") {
    if($_GET['jobid'] == "") {
        header("Location: home.php");
    } else {
        $_SESSION['jobid'] = $_GET['jobid'];
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
    <style></style>
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
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="userviewcompanies.php">View Companies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="userpendingapp.php">Applications Pending</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="userproblemreport.php">Report problem</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="userviewprofile.php">Profile</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <a class="btn btn-primary" href="logout.php">Logout </a>
                </form>
            </div>
        </div>
    </nav>

    <br />
    <br />
    <br />
    <?php
    $conn = mysqli_connect("localhost:3306","root","" ,"test");
    $sql = "select * from joblisttb where jobid=".$_SESSION['jobid'];
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    echo '<div class="card container p-5 my-5 shadow-lg text-white" style="background-image : linear-gradient(to bottom right , #00C0FF , #4218B8)">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title mb-3"> <strong>'.$row['jobtitle'].'</strong></h5>';
    echo '<hr style="height: 2px;border:0px; background-color:black" />';
    echo '<div class="card-subtitle mb-1 ">Category : '.$row['jobcategory'].'</div>';
    echo '<div class="card-subtitle mb-1 ">Type : '.$row['jobtype'].'</div>';
    echo '<div class="card-subtitle mb-1 ">Location : '.$row['jobcity'].'</div>';
    echo '<div class="card-subtitle mb-1 ">Role : '.$row['jobrole'].'</div>';
    echo '<div class="card-subtitle mb-3 ">Salary : '.$row['minsalary'].'+</div>';
    echo '<hr style="height: 2px;border:0px; background-color:black" />';
    echo '<p class="card-text ">'.nl2br($row['jobdesc']).'</p>';
    echo '</div></div>';
    ?>
    <div class="container my-5">
        <form action="userapply.php" method="post" class="form">
            <textarea class="form-control" name="appdesc" placeholder="Describe Why do you think you're eligible for this Job" id="appdesc" required minlength="20"></textarea>
            <input class="btn btn-primary mt-3 p-2" style="font-weight:bold" type="submit" value="Apply" />
            <a class="btn btn-info mt-3 p-2 text-white" href="home.php">
                <strong>Go Back</strong>
            </a>
        </form>
    </div>
</body>
</html>

<?php

if(isset($_COOKIE['userid']) ) {
	if($_COOKIE['userid'] == "" ) {
		header("Location: userlogin.php");
	}
} else {
	header("Location: userlogin.php");
}


if($_COOKIE["errorlogin"] == 1) {
	setcookie("errorlogin", 0);
}


if($_SERVER['REQUEST_METHOD'] == "POST") {
    if($_SESSION['jobid'] != "") {
        $sql = "insert into applicationtb (jobid,userid,appresponse) values (".$_SESSION['jobid'].", " . $_COOKIE['userid']." , '".$_POST['appdesc']."')";
        $conn = mysqli_connect("localhost:3306","root","","test");
        try {
            $result=mysqli_query($conn,$sql);
            setcookie("successapply",true);
            setcookie("jobtitle",$row['jobtitle']);
            header("Location: home.php");
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>