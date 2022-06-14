<?php

$connection = mysqli_connect("localhost:3306", "root", "","test");
			$query = "SELECT * FROM `subscriptiontb` where cmpid like " . $_COOKIE['cmpid'] .";";
			$result = mysqli_query($connection,$query);
            $num = mysqli_num_rows($result);
            if($num==0) {
                header("Location: purchase.php");
            }
            while($row = mysqli_fetch_array($result)) {
                if($row['endingdate'] < date("Y-m-d")) {
                    echo "here";
                    $flag = 0;
                } else {
                    $flag = 1;
                }
            }
            if($flag==1) {
                header("Location: featuredjobs.php");
            } else if ($flag==0) {
                header("Location: purchase.php");
            }

?>
