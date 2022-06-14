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

    $conn = mysqli_connect("localhost:3306","root","","test");

    //$sql = "select * from companytb where cmpid=".$_GET['cmpid'];
    $sql = "SELECT cmp.cmpfullname ,cmp.cmpdesc, cmp.cmpemail , cmp.cmpestdate , COUNT(joblisttb.jobid) as numjobs FROM `companytb` AS cmp INNER JOIN joblisttb ON joblisttb.cmpid=cmp.cmpid WHERE joblisttb.cmpId = ".$_GET['cmpid'].";";

    $result = mysqli_query($conn,$sql);

    $row = mysqli_fetch_assoc($result);
    if($row['cmpfullname'] == "") {
        header("Location: viewcompanies.php");
    }

    echo '<div class="card container bg-primary p-5 my-5 text-white shadow-lg" style="background-image : linear-gradient(to bottom right , #00C0FF , #4218B8)">';
    echo '<div class="card-body">';
    echo '<h2 class="card-title mb-3"> <strong>'.$row['cmpfullname'].'</strong></h2>';
    echo '<div class="card-subtitle mb-1 ">Since : '.$row['cmpestdate'].'</div>';
    echo '<div class="card-subtitle mb-1 ">E-mail : '.$row['cmpemail'].'</div>';
    echo '<div class="card-subtitle mb-3 ">Jobs Posted : '.$row['numjobs'].'</div>';
    echo '<h6 class="card-text bg-info text-white p-3">'.nl2br($row['cmpdesc']).'</h6>';
    echo '</div></div>';

    ?>

    <?php

    $sql = "select * from joblisttb where cmpid=".$_GET['cmpid'];
    $result = mysqli_query($conn,$sql);

    $num = mysqli_num_rows($result);

    $sqlcheckapp = "select * from applicationtb where userid=".$_COOKIE['userid'];
    $result2 = mysqli_query($conn,$sqlcheckapp);
    $flag = false;
    if($num==0) {
        echo '<div class="container shadow-lg bg-white p-5 d-flex justify-content-center">This Company Hasn\'t Added Any Jobs Yet!</div>';
    } else {
        while($row = mysqli_fetch_array($result)) {
            $flag = false;
            $result2 = mysqli_query($conn,$sqlcheckapp);
            while($row2 = mysqli_fetch_array($result2)) {
                if($row2['jobid'] == $row['jobid']) {
                    $flag = true;
                }
            }
            if(!$flag) {
                echo '<div class="card container p-5 my-5 shadow-lg">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title mb-3"> <strong>'.$row['jobtitle'].'</strong></h5>';
                echo '<div class="card-subtitle mb-1 text-muted">Category : '.$row['jobcategory'].'</div>';
                echo '<div class="card-subtitle mb-1 text-muted">Type : '.$row['jobtype'].'</div>';
                echo '<div class="card-subtitle mb-1 text-muted">Location : '.$row['jobcity'].'</div>';
                echo '<div class="card-subtitle mb-1 text-muted">Role : '.$row['jobrole'].'</div>';
                echo '<div class="card-subtitle mb-3 text-muted">Salary : '.$row['minsalary'].'+</div>';
                echo '<p class="card-text ">'.nl2br($row['jobdesc']).'</p>';
                //echo '<a href="cmpeditjob.php?jobid='.$row['jobid'].'" class="btn btn-info text-white mx-2">Edit</a>';
                echo '<a href="userapply.php?jobid='.$row['jobid'].'" class="btn btn-primary p-3"><strong>Apply</strong></a>';
                //echo '<a href="userviewcompany.php?cmpid='.$row['cmpid'].'" class="btn btn-info p-3 mx-3 text-white"><strong>View Company</strong></a>';
                echo '<a href="userreportjob.php?jobid='.$row['jobid'].'" class="btn btn-danger p-3 mx-3 text-white"><strong>Report</strong></a>';
                echo '</div></div>';
            }
        }
    }

    ?>

</body>
</html>