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
		<nav class="navbar navbar-expand-sm mb-5 navbar-dark bg-dark fixed-top">
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
				</ul>
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
    Enter 6 Digit code :- 
    </h1>
</div>
<div class="container">
<?php



session_start();

    if(isset($_COOKIE['incorrectcode'])) {
        if($_COOKIE['incorrectcode'] == 1) {
            echo '<div class="alert alert-warning alert-dismissible fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Warning!</strong>Code is Wrong!
          </div>';
        }
    }
    ?>
</div>
<br />
<div class="container border-secondary p-5 center-block">
                <form method="post" action="verificationuser.php">
                <div class="card text-center">
                        <div class="card-header">
                            Verify Your E-mail
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Enter 6 digit code</h5>
                            <p class="card-text"><b>Sent to</b> <?php session_start(); echo $_SESSION['useremail'] ?></p>
                            <input type="text" pattern="\d*" maxlength="6" minlength="6" name="usercode" placeholder="6 Digit Code"/>
                            <br/>
                            <br/>
                            <input type="submit" class="btn btn-primary">
                            <input type="reset" class="btn btn-warning"> 
                        </div>
                </div>
                </form>
</div>
    </body>
</html>

<?php


if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_SESSION['secretcode'])) {
        $sesscode = $_SESSION['secretcode'];
        $usersqlreg = $_SESSION['usrqueryreg'];
        $userenteredcode = $_POST['usercode'];
        if($sesscode != $userenteredcode) {
            echo $_SESSION['secretcode'];
            setcookie("incorrectcode",true);
            
            header("Location: verificationuser.php");
        } else {

            setcookie("incorrectcode",false);
            echo $usersqlreg;
            $conn = mysqli_connect("localhost:3306", "root" , "" );
            $db = mysqli_select_db($conn,"test");
            if(!$conn) {
                echo "Connection failed :- ".mysqli_connect_error();
            } else {
                echo "Connection success!";
            }
            try {
                echo "Trying to insert";
                if(mysqli_query($conn,$usersqlreg)) {
                    echo "Successfully Inserted";
                } else {
                    echo "Error : ".mysqli_error($conn);
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            setcookie("successuserreg",true);
            header("Location: userlogin.php");
        }
    }
}




?>