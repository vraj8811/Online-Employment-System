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
    <div class="container p-5 mt-2 d-flex shadow-lg justify-content-center" style="background-image : linear-gradient(to bottom right , #00C0FF , #4218B8)">
	<form method="get" action="home.php">
		<div class="row">
			<div class="col">
		<select name="location" class="form-select">
		<option selected hidden value="">Location</option>
							<option value="Surat">Surat</option>
							<option value="Mehsana">Mehsana</option>
							<option value="Navsari">Navsari</option>
							<option value="Dwarka">Dwarka</option>
							<option value="Ahmedabad">Ahmedabad</option>
							<option value="Rajkot">Rajkot</option>
							<option value="Botad">Botad</option>
							<option value="Gandhi Nagar">Gandhi Nagar</option>
		</select>
		</div>
		<div class="col">
						<select name="jobcategory" class="form-select">
						<option selected hidden value="">Category</option>
							<option value="Information & Technology">Information & Technology</option>
							<option value="Marketing & Sales">Marketing & Sales</option>
							<option value="Data Science">Data Science</option>
							<option value="HR Department">HR Department</option>
							<option value="Engineering Related">Engineering Related</option>
							<option value="Business Related">Business Related</option>
							<option value="Cyber Security">Cyber Security</option>
							<option value="UI/UX Designer">UI/UX Designer</option>
						</select>
						</div>
						<div class="col">
							<input type="submit" class="btn btn-info text-white shadow-lg" value="Search" >
						</div>
						</div>
	</form>
</div>
	<?php
    if(isset($_COOKIE['successapply'])) {
        if($_COOKIE['successapply']) {
            echo '<div class="alert alert-success alert-dismissible fade show container mt-3" role="alert">
				<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                Successfully applied to '.$_COOKIE['jobtitle'].'
              </div>';
        }
    }

	setcookie("successapply",false,time()-3600);
    ?>
<?php
$conn = mysqli_connect("localhost:3306","root","","test");
//$sql = "select * from joblisttb where cmpid like '".$_COOKIE['cmpid']."';";

if($_SERVER['REQUEST_METHOD'] == "GET") {
	if($_GET['jobcategory'] != ""){
		if($_GET['location'] != "" ) {
			$sql = "select * from joblisttb where jobcategory like '".$_GET['jobcategory']."' and jobcity like '".$_GET['location']."';";
		} else {
			$sql = "select * from joblisttb where jobcategory like '".$_GET['jobcategory']."';";			
		}
	} else if ($_GET['location'] != "") {
		if($_GET['jobcategory'] != "" ) {
			$sql = "select * from joblisttb where jobcategory like '".$_GET['jobcategory']."' and jobcity like '".$_GET['location']."';";
		} else {
			$sql = "select * from joblisttb where jobcity like '".$_GET['location']."';";
		}
	} else {
		$sql = "select * from joblisttb";
	}
} else {
	$sql = "select * from joblisttb";
}
$result = mysqli_query($conn,$sql);

$sqlcheckapp= "select * from applicationtb where userid=".$_COOKIE['userid'];
$result2 = mysqli_query($conn,$sqlcheckapp);
$num = mysqli_num_rows($result);
$flag = false;
//echo $sql;
if($num==0) {
	echo '<div class="container shadow-lg bg-white p-5 d-flex justify-content-center mt-3">No jobs available that meet your criteria!</div>';
} else {
    $isvalid = false;
	while($row = mysqli_fetch_array($result)) {
        $flag = false;
        $result2 = mysqli_query($conn,$sqlcheckapp);
		while($row2 = mysqli_fetch_array($result2)) {
            if($row2['jobid'] == $row['jobid']) {
				$flag = true;
            }
        }
		if(!$flag) {
            $isvalid = true;
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
            echo '<a href="userviewcompany.php?cmpid='.$row['cmpid'].'" class="btn btn-info p-3 mx-3 text-white"><strong>View Company</strong></a>';
            echo '<a href="userreportjob.php?jobid='.$row['jobid'].'" class="btn btn-danger p-3 text-white"><strong>Report</strong></a>';
            echo '</div></div>';
        }
	}
    if(!$isvalid) {
        echo '<div class="container shadow-lg bg-white p-5 d-flex justify-content-center mt-3">No jobs available that meet your criteria!</div>';
    }
}
?>
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
?>