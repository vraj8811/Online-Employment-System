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
    <div class="card container justify-content-center p-5">
        <form action="cmpeditprofile.php" method="post">
            <div class="form-group">
                <label for="cmpfullname">Company Name : </label>
                <br />
                <input name="cmpfullname" value="<?php echo $row['cmpfullname']; ?>" class="form-control"/>
                <br />
                <label for="cmpfullname">Company Description : </label>
                <br />
                <textarea name="cmpdesc" value="" class="form-control">
                    <?php echo $row['cmpdesc']; ?>
                </textarea>
                <br />
                <label for="cmpemail">Company Email : </label>
                <br />
                <input name="cmpemail" type="email" class="form-control" value="<?php echo $row['cmpemail']; ?>" />
                <br />
                <input class="btn btn-primary my-3" type="submit" value="Update" />
                <a href="cmpprofile.php" class="btn btn-info my-3 text-white" >Go Back</a>
            </div>
        </form>
        <?php
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            if($_POST['cmpdesc'] != "" && $_POST['cmpfullname'] != "" && $_POST['cmpemail'] != "") {
                $sql = "update companytb set cmpdesc='".$_POST['cmpdesc']."', cmpfullname='".$_POST['cmpfullname']."' , cmpemail='".$_POST['cmpemail']."' where cmpid=".$_COOKIE['cmpid'];
                if(mysqli_query($conn,$sql)) {
                    header("Location: cmpprofile.php");
                } else {
                    echo "Failed to update profile!";
                }
            }
        }
        ?>
    </div>
</body>
</html>