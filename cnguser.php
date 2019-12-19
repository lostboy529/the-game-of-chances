<?php
session_start();
$Nuser = $_POST['username'];
$User = $_SESSION['userName'];
$pass = $_POST['password'];
date_default_timezone_set('Asia/Calcutta');
$now = date('Y-m-d H:i:s', time());


        if (!empty($User)){
        if (!empty($Nuser)){
        $host = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "casino";
        // Create connection
        $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
        $sql0 = "SELECT * FROM iuserlogin WHERE USERNAME = '$User' AND PASSWORD = '$pass'";
            $result = $conn->query($sql0);
        if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') '. mysqli_connect_error());
        }
        elseif($result->num_rows){
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
        else{
            echo "Wrong Username or Password. Redirecting....";
            header("refresh:3; url=./login.html" );
            $conn->close();
        }
        }
        }
?>