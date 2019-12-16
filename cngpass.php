<?php
session_start();
$Opass = $_POST['txtOpass'];
$NPass = $_POST['txtNpass'];
$User = $_SESSION['userName'];
date_default_timezone_set('Asia/Calcutta');
$now = date('Y-m-d H:i:s', time());

        if (!empty($Opass)){
        if (!empty($NPass)){
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
        $sql = "SELECT * FROM iuserlogin WHERE USERNAME = '$User' AND PASSWORD = '$Opass'";
        $result = $conn->query($sql);
        if ($result->num_rows){
            $sql2 = "UPDATE iuserlogin SET PASSWORD = '$NPass' WHERE USERNAME = '$User'";
            $result2 = $conn->query($sql2);
            if ($result2){
                $sql3 = "UPDATE iuserlogin SET MOD_DATE = '$now' WHERE USERNAME = '$User'";
                $result3 = $conn->query($sql3);
            header("location:./account.php");
            }
            else
            {
                echo "Unable to update password";
            }
        }
        else{
        echo "Wrong Password. Redirecting....";
        header("refresh:3; url=./login.html" );
        }
        $conn->close();
        }
        }
        }

?>