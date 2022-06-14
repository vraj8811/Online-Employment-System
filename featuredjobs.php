<?php
if( isset($_COOKIE['cmpid']) ) {
	if($_COOKIE['cmpid'] == "" ) {
		header("Location: companylogin.php");
	}
} else {
	header("Location: companylogin.php");
}
?>

<!DOCTYPE html>
<html>
	<head>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
					<a class="btn btn-primary" href="logout.php"  type="button">Logout</a>
				</form>
				</div>
			</div>
	</nav>
</br>
</br>
</br>
<div class="container p-5 d-flex justify-content-center">
	<a class="btn btn-primary p-3 m-7 shadow-lg container-fluid" href="cmpaddjobs.php"><strong>Add Jobs</strong></a>
</div>
<div class="container p-5 d-flex shadow-lg justify-content-center" style="background-image : linear-gradient(to bottom right , #00C0FF , #4218B8)">
	<form method="get" action="featuredjobs.php">
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
$conn = mysqli_connect("localhost:3306","root","","test");
//$sql = "select * from joblisttb where cmpid like '".$_COOKIE['cmpid']."';";

if($_SERVER['REQUEST_METHOD'] == "GET") {
	if($_GET['jobcategory'] != ""){
		if($_GET['location'] != "" ) {
			$sql = "select * from joblisttb where cmpid like '".$_COOKIE['cmpid']."' and jobcategory like '".$_GET['jobcategory']."' and jobcity like '".$_GET['location']."';";
		} else {
			$sql = "select * from joblisttb where cmpid like '".$_COOKIE['cmpid']."' and jobcategory like '".$_GET['jobcategory']."';";			
		}
	} else if ($_GET['location'] != "") {
		if($_GET['jobcategory'] != "" ) {
			$sql = "select * from joblisttb where cmpid like '".$_COOKIE['cmpid']."' and jobcategory like '".$_GET['jobcategory']."' and jobcity like '".$_GET['location']."';";
		} else {
			$sql = "select * from joblisttb where cmpid like '".$_COOKIE['cmpid']."' and jobcity like '".$_GET['location']."';";
		}
	} else {
		$sql = "select * from joblisttb where cmpid like '".$_COOKIE['cmpid']."';";
	}
} else {
	$sql = "select * from joblisttb where cmpid like '".$_COOKIE['cmpid']."';";
}
$result = mysqli_query($conn,$sql);
$num = mysqli_num_rows($result);
//echo $sql;
if($num==0) {
	echo '<div class="container shadow-lg bg-white p-5 d-flex justify-content-center">You Haven\'t Added Any Jobs Yet!</div>';
} else {
	while($row = mysqli_fetch_array($result)) {
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
		echo '<a href="cmpdeletejob.php?jobid='.$row['jobid'].'" class="btn btn-danger p-3">Delete</a>';
		echo '</div></div>';
	}
}
?>
    </body>
</html>