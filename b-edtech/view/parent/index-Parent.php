<?php
require '../../routes/web.php';
require $model.$role_route.'main-parent.php';

$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B-EDTECH</title>
    <link rel="shortcut icon" type="image/x-icon" href="https://cdn.sstatic.net/Sites/stackoverflow/Img/favicon.ico?v=ec617d715196" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">

    <link rel="stylesheet" href="../../assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="../../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/app.css">
    <link rel="shortcut icon" href="../../assets/images/favicon.svg" type="image/x-icon">
</head>
<body>
    <div id="app">
        <?php require_once $layout."sidebar.php"; ?>
        <div id="main">
            <header class="mb-3">

                <?php require_once $layout."navbar.php"; ?>
            </header>

            <div class="page-heading px-lg-5 d-flex justify-content-lg-start justify-content-center ">

                <h3>ส่วนงานผู้ปกครอง</h3>

            </div>
            <div class="page-content px-lg-5 justify-content-lg-start justify-content-center   ">
                <section class="row px-lg-3">
                    <div class=" col-12 col-lg-12 ">
                        <div class="row">
                            <div class="col-12 col-lg-3 col-md-6 ">
                                <a href="std_list-parent.php">
                                    <div class="card mx-sm-3">
                                        <div class="card-body px-3 py-4-5  ">
                                            <div class="row ">
                                                <div class="col-md-4 col-sm-4 ">
                                                    <div class="stats-icon purple ">
                                                        <i class="iconly-boldShow"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-sm-8">
                                                    <h6 class="text-muted font-semibold">ข้อมูลผู้เรียน</h6>
                                                    <h6 class="font-extrabold mb-0">จำนวน: <?php echo count_std_f_par($conn, $user_id); ?> คน</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 col-lg-3 col-md-6">
                                <a href="<?php echo $view.$role_route."std_list-parent_hw.php"; ?>" >
                                    <div class="card mx-sm-3">
                                        <div class="card-body px-3 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="stats-icon blue">
                                                        <i class="iconly-boldProfile"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="text-muted font-semibold">การบ้าน <b>สัปดาห์นี้</b></h6>
                                                    <h6 class="font-extrabold mb-0">งานที่ยังไม่ส่ง: 
                                                    <?php 
                                                    $std_tb=std_list($conn,$user_id);
                                                    $sum_hw=0;
                                                    while($std_tb_list=mysqli_fetch_array($std_tb)){
                                                        $sum_hw+=sum_hw_std($conn,$std_tb_list['std_id']);
                                                    }
                                                    echo $sum_hw;?> งาน</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 col-lg-3 col-md-6">
                                <a href="<?php echo $view.$role_route."std_list-parent_proj.php"; ?>" >
                                    <div class="card mx-sm-3">
                                        <div class="card-body px-3 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="stats-icon green">
                                                        <i class="iconly-boldAdd-User"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="text-muted font-semibold">โครงงานนักเรียน</h6>
                                                    <h6 class="font-extrabold mb-0">วิชาที่สั่ง: - วิชา</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!--
                            <div class="col-12 col-lg-3 col-md-6">
                                <div class="card mx-sm-3">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon red">
                                                    <i class="iconly-boldBookmark"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">เช็คเกรด</h6>
                                                <h6 class="font-extrabold mb-0"></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                        </div>
                        <div class="row">
                            
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