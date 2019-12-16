<?php
session_start();
$Name = $_POST['username'];
$Pass = $_POST['password'];
date_default_timezone_set('Asia/Calcutta');
$now = date('Y-m-d H:i:s', time());

        if (!empty($Name)){
        if (!empty($Pass)){
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
        $sql = "SELECT * FROM iuserlogin WHERE USERNAME = '$Name' AND PASSWORD = '$Pass'";
        $result = $conn->query($sql); 
        if ($result->num_rows){
            $sql2 = "UPDATE iuserlogin SET LAST_LOGIN = '$now' WHERE USERNAME = '$Name'";
            $result2 = $conn->query($sql2);
            $_SESSION['userName']=$Name;
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