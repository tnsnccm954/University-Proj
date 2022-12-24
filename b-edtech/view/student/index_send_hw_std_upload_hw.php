<?php
require '../../routes/web.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B-EDTech</title>
    <link rel="shortcut icon"  type=”image/png” href="../../assets/images/logo.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">

    <link rel="stylesheet" href="../../assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="../../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/app.css">
    <!--<link rel="shortcut icon" href="../../assets/images/favicon.svg" type="image/x-icon">!-->
</head>

<body>
    <div id="app">
        <?php include_once $layout."sidebar.php"; ?>
        <div id="main">
            <header class="mb-3">
                <?php include_once $layout."navbar.php"; ?>
            </header>


            <div class="page-heading">

                <h3>การบ้านที่ต้องส่ง</h3>

            </div>

            <div class="page-content">
                <section class="row">
                    <div class="row">
                        <div class="col-12 col-xl-8">
                            <div class="card">
                                
                                
                                    <div class="row">
                                        <div class="col-12">
                                            <?php require_once "../../model/student/views_homework_std.php";?>
                                        </div>    
                                    </div>
                                    
                                    
                                
                            </div>
                        </div>
                        <div class="col-12 col-xl-4">
                            
                                
                                            <?php require_once "../../model/student/send_f_hw_std.php";?>
                                </div>
                            
                        </div>
                    </div>

                </section>
            </div>

            <?php //require_once "../../controllers/footer.php"; ?>
        </div>
    </div>
    <script src="../../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>

    <script src="../../assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="../../assets/js/pages/dashboard.js"></script>

    <script src="../../assets/js/main.js"></script>
</body>


</html>