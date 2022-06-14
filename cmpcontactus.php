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
    <div class="container shadow-lg p-5 mt-4">
        <form action="cmpcontactus.php" method="post">
            <label for="subject">Subject : </label>
            <br />
            <input class="form-control" name="subject" type="text" minlength="4" />
            <br />
            <label for="txtbody">Body : </label>
            <br />
            <textarea class="form-control" name="txtbody" required minlength="10"></textarea>
            <br />
            <input type="submit" class="btn btn-primary mt-2" />
        </form>
    </div>
</body>
</html>


<?php



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;




if($_SERVER['REQUEST_METHOD'] == "POST") {
    $esub = $_POST['subject'];
    $ebody = $_POST['txtbody'];

    ob_start();

    session_start();
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    //Load Composer's autoloader
    require 'vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'kalppariya1234@outlook.com';                     //SMTP username
        $mail->Password   = '@\#12kalp12#\@';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('kalppariya1234@outlook.com',  "Project | Email from :".$row['cmpemail']);
        $mail->addAddress("kalppariya1234@gmail.com", $row['cmpfullname']);

        //Attachments  //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $esub;
        $mail->Body    = $ebody;
        $mail->AltBody = 'This E-mail does not support obsolete Mail clients without HTML support!';

        $mail->send();
        header("Location: cmpcontactus.php");
    }
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

?>