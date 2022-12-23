<?php
require 'function.php';
require 'viewnew_check.php';
$state_id = $_GET['statment_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mazer Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <h4 class="auth-title">QR Check-in</h4>
                    <p class="auth-subtitle mb-5">กรุณาแสกนเพื่อเช็คชื่อ</p>
                     <?php qr_generate($state_id);?>
                     <button onclick="returntohome()" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="login">Back</button>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                   <?php checked_table($conn,$state_id);?>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
<script type="text/javascript">
        function returntohome(){
            window.location = 'index_logged-te.php';
        }
        </script>