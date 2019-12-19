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
    <title>Account Settings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons'>
    <style>
        html {
            width: 100%;
            height: 100%;
        }

        body {
            background: linear-gradient(45deg, rgba(66, 183, 245, 0.8) 0%, rgba(66, 245, 189, 0.4) 100%);
            color: rgba(0, 0, 0, 0.6);
            font-family: "Roboto", sans-serif;
            font-size: 14px;
            line-height: 1.6em;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            margin: 0px;
            height: 100%;
            overflow: hidden;
        }

        .overlay, .form-panel.one:before {
            position: absolute;
            top: 0;
            left: 0;
            display: none;
            background: rgba(0, 0, 0, 0.8);
            width: 100%;
            height: 100%;
        }

        .form {
            z-index: 15;
            position: relative;
            background: #FFFFFF;
            width: 600px;
            border-radius: 4px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            margin: -110px auto 10px;
            overflow: hidden;
        }
        .form-toggle {
            z-index: 10;
            position: absolute;
            top: 60px;
            right: 60px;
            background: #FFFFFF;
            width: 60px;
            height: 60px;
            border-radius: 100%;
            -webkit-transform-origin: center;
            transform-origin: center;
            -webkit-transform: translate(0, -25%) scale(0);
            transform: translate(0, -25%) scale(0);
            opacity: 0;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .form-toggle:before, .form-toggle:after {
            content: '';
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            width: 30px;
            height: 4px;
            background: #4285F4;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
        .form-toggle:before {
            -webkit-transform: translate(-50%, -50%) rotate(45deg);
            transform: translate(-50%, -50%) rotate(45deg);
        }
        .form-toggle:after {
            -webkit-transform: translate(-50%, -50%) rotate(-45deg);
            transform: translate(-50%, -50%) rotate(-45deg);
        }
        .form-toggle.visible {
            -webkit-transform: translate(0, -25%) scale(1);
            transform: translate(0, -25%) scale(1);
            opacity: 1;
        }
        .form-group {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 0 0 20px;
        }
        .form-group:last-child {
            margin: 0;
        }
        .form-group label {
            display: block;
            margin: 0 0 10px;
            color: rgba(0, 0, 0, 0.6);
            font-size: 12px;
            font-weight: 500;
            line-height: 1;
            text-transform: uppercase;
            letter-spacing: .2em;
        }
        .two .form-group label {
            color: #FFFFFF;
        }
        .form-group input {
            outline: none;
            display: block;
            background: rgba(0, 0, 0, 0.1);
            width: 100%;
            border: 0;
            border-radius: 4px;
            box-sizing: border-box;
            padding: 12px 20px;
            color: rgba(0, 0, 0, 0.6);
            font-family: inherit;
            font-size: inherit;
            font-weight: 500;
            line-height: inherit;
            transition: 0.3s ease;
        }
        .form-group input:focus {
            color: rgba(0, 0, 0, 0.8);
        }
        .two .form-group input {
            color: #FFFFFF;
        }
        .two .form-group input:focus {
            color: #FFFFFF;
        }
        .form-group button {
            outline: none;
            background: #4285F4;
            width: 100%;
            border: 0;
            border-radius: 4px;
            padding: 12px 20px;
            color: #FFFFFF;
            font-family: inherit;
            font-size: inherit;
            font-weight: 500;
            line-height: inherit;
            text-transform: uppercase;
            cursor: pointer;
        }
        .two .form-group button {
            background: #FFFFFF;
            color: #4285F4;
        }
        .form-group .form-remember {
            font-size: 12px;
            font-weight: 400;
            letter-spacing: 0;
            text-transform: none;
        }
        .form-group .form-remember input[type='checkbox'] {
            display: inline-block;
            width: auto;
            margin: 0 10px 0 0;
        }
        .form-group .form-recovery {
            color: #4285F4;
            font-size: 12px;
            text-decoration: none;
        }
        .form-panel {
            padding: 60px calc(5% + 60px) 60px 60px;
            box-sizing: border-box;
        }
        .form-panel.one:before {
            content: '';
            display: block;
            opacity: 0;
            visibility: hidden;
            transition: 0.3s ease;
        }
        .form-panel.one.hidden:before {
            display: block;
            opacity: 1;
            visibility: visible;
        }
        .form-panel.two {
            z-index: 5;
            position: absolute;
            top: 0;
            left: 95%;
            background: #4285F4;
            width: 100%;
            min-height: 100%;
            padding: 60px calc(10% + 60px) 60px 60px;
            transition: 0.3s ease;
            cursor: pointer;
        }
        .form-panel.two:before, .form-panel.two:after {
            content: '';
            display: block;
            position: absolute;
            top: 60px;
            left: 1.5%;
            background: rgba(255, 255, 255, 0.2);
            height: 30px;
            width: 2px;
            transition: 0.3s ease;
        }
        .form-panel.two:after {
            left: 3%;
        }
        .form-panel.two:hover {
            left: 93%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .form-panel.two:hover:before, .form-panel.two:hover:after {
            opacity: 0;
        }
        .form-panel.two.active {
            left: 10%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            cursor: default;
        }
        .form-panel.two.active:before, .form-panel.two.active:after {
            opacity: 0;
        }
        .form-header {
            margin: 0 0 40px;
        }
        .form-header h1 {
            padding: 4px 0;
            color: #4285F4;
            font-size: 24px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .two .form-header h1 {
            position: relative;
            z-index: 40;
            color: #FFFFFF;
        }

        .pen-footer {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            width: 600px;
            margin: 20px auto 100px;
        }
        .pen-footer a {
            color: #FFFFFF;
            font-size: 12px;
            text-decoration: none;
            text-shadow: 1px 2px 0 rgba(0, 0, 0, 0.1);
        }
        .pen-footer a .material-icons {
            width: 12px;
            margin: 0 5px;
            vertical-align: middle;
            font-size: 12px;
        }

        .cp-fab {
            background: #FFFFFF !important;
            color: #4285F4 !important;
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
    </style>
    <script>
        window.console = window.console || function(t) {};
    </script>
    <script>
        if (document.location.search.match(/type=embed/gi)) {
            window.parent.postMessage("resize", "*");
        }
    </script>
</head>
<body translate="no">
<div class="nav-wrapper">
    <div class="left-side">
        <div class="nav-link-wrapper">
            <a href="account.php">THE CASINO</a>
        </div>
        <div class="nav-link-wrapper nav-link-active">
            <a href="account_settings.php">ACCOUNT SETTINGS</a>
        </div>
    </div>
    <div class="right-side">
        <div>Welcome, <?php echo $Name?>
            <form method="post" action="endsession.php">
                <div class="form-group">
                    <input type="submit" value="LOG OUT"/>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="form">
    <div class="form-toggle"></div>
    <div class="form-panel one">
        <div class="form-header">
            <h1>Change Username</h1>
        </div>
        <div class="form-content">
            <form method="post" action="cnguser.php">
                <div class="form-group">
                    <label for="username">Username: <?php echo $Name?></label>
                </div>
                <div class="form-group">
                    <label for="new username">New Username</label>
                    <input type="text" id="username" name="username" required="required" />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required="required" />
                </div>
                <div class="form-group">
                    <a class="form-recovery" href="#">Change Email?</a>
                </div>
                <div class="form-group">
                    <button type="submit">CHANGE</button>
                </div>
            </form>
        </div>
    </div>
    <div class="form-panel two">
        <div class="form-header">
            <h1>Change Password or Email</h1>
        </div>
        <div class="form-content">
            <form method="post" action="cngpass.php">
                <div class="form-group">
                    <label for="username">Username: <?php echo $Name?></label>
                </div>
                <div class="form-group">
                    <label for="password">Current Password</label>
                    <input type="password" id="password" name="password" required="required" />
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" id="cpassword" name="cpassword" required="required" />
                </div>
                <div class="form-group">
                    <button type="submit" id="cng_pass">Change Password</button>
                </div>
            </form>
        </div>
        <div class="form-content">
            <br>
            <form method="post" action="cngemail.php">
                <div class="form-group">
                    <label for="email">New Email Address</label>
                    <input type="email" id="email" name="email" required="required" />
                </div>
                <div class="form-group">
                    <label for="email2">Confirm Email Address</label>
                    <input type="email" id="email" name="email" required="required" />
                </div>
                <div class="form-group">
                    <button type="submit" id="cng_email">Change Email</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-de7e2ef6bfefd24b79a3f68b414b87b8db5b08439cac3f1012092b2290c719cd.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://codepen.io/andytran/pen/vLmRVp.js'></script>
<script id="rendered-js">
    $(document).ready(function () {
        var panelOne = $('.form-panel.two').height(),
            panelTwo = $('.form-panel.two')[0].scrollHeight;

        $('.form-panel.two').not('.form-panel.two.active').on('click', function (e) {
            e.preventDefault();

            $('.form-toggle').addClass('visible');
            $('.form-panel.one').addClass('hidden');
            $('.form-panel.two').addClass('active');
            $('.form').animate({
                    'height': panelTwo },
                200);
        });

        $('.form-toggle').on('click', function (e) {
            e.preventDefault();
            $(this).removeClass('visible');
            $('.form-panel.one').removeClass('hidden');
            $('.form-panel.two').removeClass('active');
            $('.form').animate({
                    'height': panelOne },
                200);
        });
    });
</script>
<script src="https://static.codepen.io/assets/editor/live/css_reload-5619dc0905a68b2e6298901de54f73cefe4e079f65a75406858d92924b4938bf.js"></script>
</body>
</html>
