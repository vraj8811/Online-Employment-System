<?php
if( isset($_COOKIE['cmpid']) ) {
	if($_COOKIE['cmpid'] == "" ) {
		header("Location: companylogin.php");
	}
} else {
	header("Location: companylogin.php");
}


$conn = mysqli_connect("localhost:3306","root","","test");

$sql = "select * from companytb where cmpid=".$_COOKIE['cmpid'];
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
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
    <div class="card container justify-content-center">
        <div class="card-body">
            <h5 class="card-title">
                <?php echo $row['cmpfullname'];?>
            </h5>
            <p class="card-text">
                <?php echo nl2br($row['cmpdesc']); ?>
            </p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                Email : <?php echo $row['cmpemail']; ?>
            </li>
            <li class="list-group-item">
                Date of establishment : <?php echo $row['cmpestdate'] ?>
            </li>
            <li class="list-group-item">
                Username : <?php echo $row['cmpusername']; ?>
            </li>
        </ul>
        <div class="card-body">
            <a href="cmpchangepass.php" class="btn btn-primary p-2">Change Password</a>
            <a href="cmpeditprofile.php" class="btn btn-primary p-2">Edit Details</a>
            <a href="cmpdeleteprofile.php" class="btn btn-danger p-2" onclick="return confirm('This profile will be permanently deleted! Are you SURE?')">Delete Profile</a>
        </div>
    </div>
</body>
</html>