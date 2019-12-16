<?php
session_start();
$Nuser = $_POST['txtnuser'];
$User = $_SESSION['userName'];
date_default_timezone_set('Asia/Calcutta');
$now = date('Y-m-d H:i:s', time());


        if (!empty($User)){
        if (!empty($Nuser)){
        $host = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "organisation";
        // Create connection
        $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
        if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') '. mysqli_connect_error());
        }
        else{
        $sql = "UPDATE iuserlogin SET USERNAME = '$Nuser' WHERE USERNAME = '$User'";
        $result = $conn->query($sql);
        if ($result){
            $_SESSION['userName'] = $Nuser;
            $sql2 = "UPDATE iuserlogin SET MOD_DATE = '$now' WHERE USERNAME = '$Nuser'";
            $result2 = $conn->query($sql2);
            header("location:./account.php");
        }
        else{
        echo "Wrong Username or Password. Redirecting....";
        header("refresh:3; url=./login.html" );
        }
        $conn->close();
        }
        }
        }
?>