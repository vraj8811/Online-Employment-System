<?php
if( isset($_COOKIE['cmpid']) ) {
	if($_COOKIE['cmpid'] == "" ) {
		header("Location: companylogin.php");
	}
} else {
	header("Location: companylogin.php");
}
?>

<?php

$conn = mysqli_connect("localhost:3306","root","","test");

$sql = "SELECT * FROM `subscriptiontb` INNER join packagetb ON packagetb.pkgid = subscriptiontb.pkgid and subscriptiontb.cmpid = ".$_COOKIE['cmpid'].";";

try {
    $result = mysqli_query($conn,$sql);
}
catch (Exception $e) {
    echo $e->getMessage();
}

while($row = mysqli_fetch_array($result)) {
    $endingdate = $row['endingdate'];
    $duration = $row['pkgduration'];
    $pkgname = $row['pkgname'];
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
        <div class="card text-center">
            <div class="card-header">
                Subscription Details
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    <?php echo $pkgname; ?>
                </h5>
                <p class="card-text">
                    <?php echo "Valid for $duration Months";
                    ?>
                </p>
            </div>
            <div class="card-footer text-muted">
                <?php echo "Expiry Date : $endingdate";
                ?>
            </div>
        </div>
    </div>
</body>
</html>