<?php
session_start();
if($_SESSION['userName'] == "")
{
    header("location:./login.html");
}
$Name = $_SESSION['userName'];
date_default_timezone_set('Asia/Calcutta');
$now = date('Y-m-d H:i:s', time());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <style>
        body{
            margin: 0px;
            background-image: url(resources/images/backg2.jpg);
            background-position: center;
            background-repeat: none;
            background-size: cover;
        }
        .nav-wrapper{
            display: flex;
            justify-content: space-between;
            padding: 38px;
        }

        .left-side{
            font-size: 15px;
            display: flex;
        }

        .right-side{
            font-size: 15px;
            color: white;
        }

        .nav-wrapper > .left-side > div{
            margin-right: 20px;
            font-size: 0.9em;
            text-transform: uppercase;
        }

        .nav-link-wrapper{
            height: 22px;
            border-bottom: 1px solid transparent;
            transition: border-bottom 0.5s;
        }

        .nav-link-wrapper a{
            color: white;
            text-decoration: none;
            transition: color 0.5s;
        }

        .nav-link-wrapper:hover{
            border-bottom: 1px solid white;
        }

        .nav-link-wrapper a:hover{
            color: white;
        }

        .nav-link-active{
            color: white;
            border-bottom: 1px solid white;
        }
        .form-group {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 0 0 20px;
        }
        .form-group input {
            outline: none;
            display: block;
            background: rgba(256, 256, 256, 0.1);
            width: 100%;
            border: 0;
            border-radius: 4px;
            box-sizing: border-box;
            padding: 12px 20px;
            color: rgba(256, 256, 256, 0.6);
            font-family: inherit;
            font-size: inherit;
            font-weight: 500;
            line-height: inherit;
            transition: 0.3s ease;
        }
</style>
</head>
<body translate="no">
    <div class="nav-wrapper">
        <div class="left-side">
            <div class="nav-link-wrapper nav-link-active">
                <a href="account.php">THE CASINO</a>
            </div>
            <div class="nav-link-wrapper">
                <a href="account_settings.php">ACCOUNT SETTINGS</a>
            </div>
        </div>
        <div class="right-side">
            <div class="nav-link-wrapper">Welcome, <?php echo $Name?>
                <form method="post" action="endsession.php">
                    <div class="form-group">
                        <input type="submit" value="LOG OUT"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
