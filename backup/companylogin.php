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
					<a class="nav-link" href="/">Home</a>
					</li>
					<li class="nav-item">
					<a class="nav-link" href="about.php">About</a>
					</li>
                    <!--
					<li class="nav-item">
					<a class="nav-link" href="services.php">Services</a>
					</li>
-->
				</ul>
                <!--
				<form class="d-flex">
					<button class="btn btn-primary" type="button">Logout</button>
				</form>
-->
				</div>
			</div>
	</nav>
</br>
</br>
</br>
</br>
</br>
<div class="container bg-white p-8 text-dark text-center" >
    <h1>
    LOGIN AS A COMPANY
    </h1>
</div>
<form action="companylogin.php" method="post">
    <div class="mb-3 mt-3 container">
    <?php
        if(isset($_COOKIE['successcompanyreg'])) {
            if($_COOKIE['successcompanyreg']) {
                echo '<div class="alert alert-success" role="alert">
                Your Company Has been Successfully Registered! Login to continue!
              </div>';
            }
        }
        ?>
    <br/>
    <label for="username">Company Username :-</label>
    <input name="username" type="text" placeholder="username" class="form-control" required>
    <br/>
    <label for="password">Password :-</label>
    <input type="password" name="password" placeholder="password" class="form-control" required>
    </label>
    <br/>
    <input type="submit" value="Login" class="btn btn-primary">
    <br/>
    <?php
        if(isset($_COOKIE['errorlogin'])) {
            if($_COOKIE['errorlogin']) {
                echo '<div class="alert alert-warning alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>Warning!</strong> Entered Credentials are incorrect! Remember they are case sensitive!
              </div>';
            }
        }
    ?>
    </div>
</form>
    </body>
</html>
<?php

if(isset($_COOKIE['successcompanyreg'])) {
    setcookie("successcompanyreg","",time() - 3600);
}

if(isset($_COOKIE['cmpusername'])) {
    header("Location: ifsubscribed.php");
}


if($_SERVER["REQUEST_METHOD"]== "POST") {
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $conn = mysqli_connect("localhost:3306","root","","test");
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "select * from companytb where cmpusername like '".$username."'";
        $result = mysqli_query($conn,$query);
        if($result == false) {
            setcookie("errorlogin",true);
            header("Location: companylogin.php");
        } else {
            $row = mysqli_fetch_assoc($result);
            if($row == null) {
                setcookie("errorlogin",1);
                header("Location: companylogin.php");
            }
            if($username == $row['cmpusername'] && $password == $row['cmppassword']) {
                setcookie("cmpusername",$username);
                setcookie("cmpid",$row['cmpid']);
                setcookie("cmpfullname", $row['cmpfullname']);
                setcookie("errorlogin",0);
                header("Location: ifsubscribed.php");
            } else {
                setcookie("errorlogin",true);
                header("Location: companylogin.php");
            }
        }
    }
}
?>