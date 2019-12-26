<?php
session_start();
$Nemail = $_POST['email'];
$Nemailc = $_POST['email2'];
$User = $_SESSION['userName'];
date_default_timezone_set('Asia/Calcutta');
$now = date('Y-m-d H:i:s', time());

        if (!empty($User)){
        if (!empty($Nemail)){
        $host = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "casino";
        // Create connection
        $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
        if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') '. mysqli_connect_error());
        }
        else if($Nemail == $Nemailc){
        $sql = "UPDATE iuserlogin SET EMAIL = '$Nemail' WHERE USERNAME = '$User'";
        $result = $conn->query($sql);
        if ($result){
            $sql2 = "UPDATE iuserlogin SET MOD_DATE = '$now' WHERE USERNAME = '$User'";
            $result2 = $conn->query($sql2);
            header("location:./account.php");
        }
        else{
        echo "Wrong Username or Password. Redirecting....";
        header("refresh:3; url=./endsession.php" );
        }
        $conn->close();
        }
        else{
            echo "Email IDs donot match...";
            header("location:./account_settings.php");
        }
        }
        }
?>