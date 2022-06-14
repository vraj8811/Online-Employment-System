<!DOCTYPE html>
<html>
	<head>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<title>
			Hello World
		</title>
		<style>
		</style>
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
					<a class="nav-link" href="about.php">About</a>
					</li>
					<li class="nav-item">
					<a class="nav-link" href="services.php">Services</a>
					</li>
				</ul>
				<form class="d-flex">
					<a class="btn btn-primary" href="logout.php" >Logout </a>
				</form>
				</div>
			</div>
	</nav>

	<br/>
	<br/>
	<br/>
<div class="mt-3 mb-3 container" >
<form action="insert.php">
 	<table class="table table-light">
		<tr>
			<th>
				Employee ID
			</th>
			<th>
				Employee Name
			</th>
			<th>
				Department ID
			</th>
			<th>
				Action
			</th>
		</tr>
		<?php
			$connection = mysqli_connect("localhost:3306", "root", "");
			$db = mysqli_select_db($connection,"test");
			$query = "select * from emp";
			$result = mysqli_query($connection,$query);
			while($row = mysqli_fetch_array($result)) {
				echo "<tr>";
				echo "<td>".$row['empid']."</td>";
				echo "<td>".$row['ename']."</td>";
				echo "<td>".$row['deptid']."</td>";
				echo "<td> <a href='delete.php?id=".$row['empid']."'>Delete</a></td>";
				echo "</tr>";
			}
			echo "<tr>";
			echo "<td><input type='number' name='empid' disabled></td>";
			echo "<td><input type='text' name='ename'></td>";
			echo "<td><input type='number' name='deptid'></td>";
			echo "<td><input type='submit'></td>";
			echo "</tr>";
		?>
	 </table>
	 </form>
</div>
	</body>
</html>

<?php 
if($_COOKIE["username"] == null) {
	header("Location: index.php");
}
if($_COOKIE["errorlogin"] == 1) {
	setcookie("errorlogin", 0);
}
?>