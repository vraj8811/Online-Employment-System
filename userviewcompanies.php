<?php

if(isset($_COOKIE['userid']) ) {
	if($_COOKIE['userid'] == "" ) {
		header("Location: userlogin.php");
	}
} else {
	header("Location: userlogin.php");
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
    $conn = mysqli_connect("localhost:3306","root","","test");
    //$sql = "select * from joblisttb where cmpid like '".$_COOKIE['cmpid']."';";

    $sql = "SELECT Cmp.cmpfullname AS fullname, cmp.cmpid, cmp.cmpdesc AS cmpdesc, cmp.cmpemail , cmp.cmpestdate, count(Jb.jobid) AS numjobs FROM `companytb` as cmp LEFT JOIN joblisttb AS jb ON jb.cmpid= cmp.cmpid GROUP BY cmpfullname;";

    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    //echo $sql;
    if($num==0) {
        echo '<div class="container shadow-lg bg-white p-5 d-flex justify-content-center">No Companies to show Yet!</div>';
    } else {
        while($row = mysqli_fetch_array($result)) {
            echo '<div class="card container p-5 my-5 shadow-lg">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title mb-3"> <strong>'.$row['fullname'].'</strong></h5>';
            echo '<div class="card-subtitle mb-1 text-muted">Since : '.$row['cmpestdate'].'</div>';
            echo '<div class="card-subtitle mb-1 text-muted">E-mail : '.$row['cmpemail'].'</div>';
            echo '<div class="card-subtitle mb-1 text-muted">Jobs Posted : '.$row['numjobs'].'</div>';
            echo '<p class="card-text ">'.nl2br($row['cmpdesc']).'</p>';
            //echo '<a href="cmpeditjob.php?jobid='.$row['jobid'].'" class="btn btn-info text-white mx-2">Edit</a>';
            echo '<a href="userviewcompany.php?cmpid='.$row['cmpid'].'" class="btn btn-info text-white p-3"><strong>View Vacancies</strong></a>';
            echo '</div></div>';
        }
    }
    ?>
</body>
</html>
