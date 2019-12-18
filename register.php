<?php
session_start();
$Name = $_POST['username'];
$Pass = $_POST['password'];
$Pass2 = $_POST['password2'];
$Email = $_POST['email'];
date_default_timezone_set('Asia/Calcutta');
$now = date('Y-m-d H:i:s', time());

if ($Pass == $Pass2)
{
    if (!empty($Name)){
        if (!empty($Email)){
        if (!empty($Pass)){
        $host = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "casino";
        // Create connection
        $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
        if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') '. mysqli_connect_error());
        }
        else{
        $sql = "INSERT INTO iuserlogin (USERNAME, PASSWORD, EMAIL) values ('$Name','$Pass','$Email')";
        if ($insert = $conn->query($sql)){
        $sql2 = "UPDATE iuserlogin SET LAST_LOGIN = '$now' WHERE USERNAME = '$Name'";
        $result = $conn->query($sql2);
        echo "New record is inserted sucessfully";
        }
        else{
        echo "Error: ". $sql ." ". $conn->error;
        }
        $conn->close();
        }
        }
        }
        }
        $_SESSION['userName']=$Name;
        echo "Hi, ",$_SESSION['userName']," Logging you in....";
        header("location:./account.php");
exit;
}
else
{
    header("location:./login.html");
}
?>