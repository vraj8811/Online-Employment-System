<?php
                setcookie("username","",time() - 3600);
                setcookie("userfullname","" , time() - 3600);
                setcookie("errorlogin","", time() - 3600);


                setcookie("cmpusername", "" , time() - 3600);
                setcookie("cmpfullname", "" , time() - 3600);
                setcookie("errorlogin","" , time() - 3600);
header("Location: http://localhost:8080/");
?>