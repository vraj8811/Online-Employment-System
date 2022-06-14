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
        <br />
        <br />
        <br />
        <br />
        <br />
<div class="container bg-white p-8 text-dark text-center" >
    <h1>
    REGISTER YOUR NEW COMPANY
    </h1>
</div>
<div class="container">
<?php
if(isset($_COOKIE['errorcmpreg'])) {
    if($_COOKIE['errorcmpreg'] == 1) {
        echo '<div class="alert alert-warning alert-dismissible fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Warning!</strong> Same username exist! Choose a different one!
          </div>';
    }
}
?>
</div>
<div class="container border-secondary p-5 center-block">
    <div class="row">
        <div class="col-md-6 off-md-3">
            <div class="signup-form">
                <form method="post" action="cmpreg.php">
                    <div class="mb-3">
                        <label for="cmpusername" required>Username :- </label>
                        <input name="cmpusername" class="form-control shadow-sm p-1 mb-2 bg-body rounded" 
                        pattern="^(?=[a-zA-Z0-9._]{8,20}$)(?!.*[_.]{2})[^_.].*[^_.]$" type="text" required>

                    </div>
                    <div class="mb-3">
                        <label for="cmpfullname" required>Company Name :- </label>
                        <input name="cmpfullname" class="form-control shadow-sm p-1 mb-2 bg-body rounded" 
                        pattern="^+{8,32}\S{1,}" type="text" required>

                    </div><div class="mb-3">
                        <label for="cmppassword" required>Password :- </label>
                        <input name="cmppassword" class="form-control shadow-sm p-1 mb-2 bg-body rounded" 
                        pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                        type="password" required>

                    </div><div class="mb-3">
                        <label for="cmpremail" required>E-mail :- </label>
                        <input name="cmpemail" class="form-control shadow-sm p-1 mb-2 bg-body rounded" 
                        type="email" required>
                        </div><div class="mb-3">
                        <label for="cmpdesc" required>Description :- </label>
                        <input name="cmpdesc" class="form-control shadow-sm p-1 mb-2 bg-body rounded" 
                        type="text" required>
                        </div><div class="mb-3">
                        <label for="cmpestdate" required>Established Date :- </label>
                        <input name="cmpestdate" class="form-control shadow-sm p-1 mb-2 bg-body rounded" 
                        type="date" required>
<!--
                    </div><div class="mb-3">
                        <label for="cmpcity" required>Home City :- </label>
                        <input name="cmpcity" class="form-control shadow-sm p-1 mb-2 bg-body rounded" 
                        pattern="^\S+{3,32}\S{1,}" type="text" required>

                    </div>
-->
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary">
                        <input type="reset" class="btn btn-warning"> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    </body>
</html>

<?php
setcookie('errorlogin',"",time() - 3600); 
?>