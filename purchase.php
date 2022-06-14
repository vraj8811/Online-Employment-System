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
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">Services</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </form>
            </div>
        </div>
    </nav>
    <br />
    <br />
    <?php
    $query = "SELECT * FROM `packagetb`;";
    $conn = mysqli_connect("localhost:3306","root","","test");
    $result = mysqli_query($conn,$query);

    ?>
    <form method="get">
        <div class="container mt-3 mb-3">
            <div class="row">
                <?php
                $count = 1;
                while($row = mysqli_fetch_array($result)) {
                    if($count % 2 == 0) {
                        echo '<div class="col p-5 bg-primary text-white container-fluid" >';
                        echo "<h1>". $row['pkgname'] ."</h1>";
                        echo "<p> ".$row['pkgduration'] ." Months valid. For " . $row['pkgprice']."/- Only! </p>";
                        echo '<a class="btn btn-info container-fluid text-white" href="buypkg.php?pkgid='.$row['pkgid'].'&pkgduration='.$row['pkgduration'].'" > Buy!</a>';
                        echo "</div>";
                    } else {
                        echo '<div class="col p-5 bg-dark text-white container-fluid" >';
                        echo "<h1>". $row['pkgname'] ."</h1>";
                        echo "<p> ".$row['pkgduration'] ." Months valid. For " . $row['pkgprice']."/- Only!</p>";
                        echo '<a class="btn btn-info container-fluid text-white" href="buypkg.php?pkgid='.$row['pkgid'].'&pkgduration='.$row['pkgduration'].'" > Buy!</a>';
                        echo "</div>";
                    }
                    $count ++;
                }
                ?>
            </div>
        </div>
    </form>
</body>
</html>