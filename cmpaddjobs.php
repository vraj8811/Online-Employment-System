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

    <br />
    <br />
    <br />
    <br />

<div class="container bg-white p-8 text-dark text-center" >
    <h1>
    ADD VACANCY DETAILS
    </h1>
</div>
<div class="container border-secondary p-5 center-block">
    <div class="row">
        <div class="col-md-6 off-md-3">
            <div class="signup-form">
                <form method="post" action="cmpinsertjob.php">
                    <div class="mb-3">
                        <label for="jobtitle">Job Title :- </label>
                        <input name="jobtitle" class="form-control shadow-sm p-1 mb-2 bg-body rounded" 
						type="text" required>

                    </div>
                    <div class="mb-3">
                        <label for="jobrole">Employee Role :- </label>
                        <input name="jobrole" class="form-control shadow-sm p-1 mb-2 bg-body rounded" 
                        type="text" required>

                    </div><div class="mb-3">
                        <label for="jobdesc">Description :- </label>
                        <textarea name="jobdesc" class="form-control shadow-sm p-1 mb-2 bg-body rounded" 
                        required value=""></textarea>

                    </div><div class="mb-3">
                        <label for="location">City :- </label>
						<select name="location" class="form-select">
							<option value="Surat">Surat</option>
							<option value="Mehsana">Mehsana</option>
							<option value="Navsari">Navsari</option>
							<option value="Dwarka">Dwarka</option>
							<option value="Ahmedabad">Ahmedabad</option>
							<option value="Rajkot">Rajkot</option>
							<option value="Botad">Botad</option>
							<option value="Gandhi Nagar">Gandhi Nagar</option>
						</select>
                        <!--
							<input name="useremail" class="form-control shadow-sm p-1 mb-2 bg-body rounded" 
                        type="email" required>
-->
                    </div><div class="mb-3">
					<label for="jobcategory">Category :- </label>
						<select name="jobcategory" class="form-select">
							<option value="Information & Technology">Information & Technology</option>
							<option value="Marketing & Sales">Marketing & Sales</option>
							<option value="Data Science">Data Science</option>
							<option value="HR Department">HR Department</option>
							<option value="Engineering Related">Engineering Related</option>
							<option value="Business Related">Business Related</option>
							<option value="Cyber Security">Cyber Security</option>
							<option value="UI/UX Designer">UI/UX Designer</option>
						</select>
                    </div><div class="mb-3">
					<label for="jobtype">Type :- </label>
						<select name="jobtype" class="form-select">
							<option value="Based On Hours">Based On Hours</option>
							<option value="Part-Time">Part-Time</option>
							<option value="Full-Time">Full-Time</option>
						</select>
                    </div><div class="mb-3">
                        <label for="minexpyears">Minimun Experience in Years :- </label>
                        <input name="minexpyears" class="form-control shadow-sm p-1 mb-2 bg-body rounded" 
						type="number" required value="0" min="0">

                    </div><div class="mb-3">
                        <label for="minsalary">Minimun Salary :- </label>
                        <input name="minsalary" class="form-control shadow-sm p-1 mb-2 bg-body rounded" 
						type="number" required value="10000" min="10000">

                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" value="ADD VACANCY">
                        <input type="reset" class="btn btn-warning" value="RESET">
						<a href="featuredjobs.php" class="btn btn-info text-white text-center">CANCEL</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    </body>
</html>