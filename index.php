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
    <br />
    <br />
    <div class="container shadow-lg bg-primary p-5 my-5 border text-white">
        <h1>User Login</h1>
        <p>We will help you find relevant Jobs for you!</p>
        <a href="userlogin.php" class="btn btn-danger"> Login ></a>
        <a href="userregister.php" class="btn btn-warning"> Register ></a>
    </div>
    <div class="container shadow-lg bg-dark my-5 p-5 border text-white">
        <h1>Company Login</h1>
        <p>Expand your reach and find the best suited employees for you!</p>
        <a href="companylogin.php" class="btn btn-danger"> Login ></a>
        <a href="companyregister.php" class="btn btn-warning"> Register ></a>
    </div>


    <?php
    session_start();
    session_destroy();
    ?>
</body>
</html>






<?php
setcookie("username","",time() - 3600);
setcookie("userfullname","" , time() - 3600);
setcookie("errorlogin","", time() - 3600);
setcookie("erroruserreg","" , time() - 3600);
setcookie("userid" , "" , time() - 3600);


setcookie("cmpid" , "" , time() - 3600);
setcookie("cmpusername", "" , time() - 3600);
setcookie("cmpfullname", "" , time() - 3600);
setcookie("errorcmpreg","" , time() - 3600);
?>