<?php
require 'function.php';
$state_id = $_GET['state_codename'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout Default - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
</head>

<body>
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
                        <div class="auth-logo">
                            <a href="#"><img src="assets/images/logo/logo.png" alt="Logo"></a>
                        </div>
                        <h1 class="auth-title">Check-in.</h1>
                        <p class="auth-subtitle mb-5">เช็คชื่อผ่านรหัสนักเรียน</p>
                        <form method="POST">
                            <div class="form-group position-relative">
                                <label for="state_codename">รหัสการเช็คชื่อ:</label>
                                <input type="text" class="form-control form-control-lg" id="state_codename" name="state_codename" value="<?php echo $state_id; ?>" readonly>
                            </div>
                            <div class="form-group position-relative">
                            <label for="std_id">รหัสนักเรียน:</label>
                                <input type="text" class="form-control form-control-lg" id="std_id" name="std_id">
                            </div>
                            <div class="form-group position-relative">
                            <label for="displayname">วันนี้อยากกินอะไร:</label>
                                <input type="text" class="form-control form-control-lg" id="displayname" name="displayname" placeholder="บอกมา 1 เมนู">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="check_in">เช็คชื่อ</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-7 d-none d-lg-block">
                    <div id="auth-right">
                    <?php require_once 'viewnew_check_std.php'; 
                            checked_table_std($conn,$state_id);
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </body>

    </html>
    