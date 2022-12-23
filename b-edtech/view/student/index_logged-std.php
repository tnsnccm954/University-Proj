<?php
require '../../routes/web.php';
$stu_id=$_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student_side</title>

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
        <?php include_once $layout."sidebar.php"; ?>
        <div id="main">
            <header class="">
                <?php include_once $layout."navbar.php"; ?>
            </header>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <div class="d-flex justify-content-center  ">
                            <div class="row col-10" >
                                <div class="col-lg-6">
                                    <div>
                                        <div class="card-heading p-3">

                                            <h4 class="text-center text-lg-start" >ส่วนงานนักเรียน</h4>

                                        </div>
                                        <div class="row mx-3 ">

                                            <div class="col-12 col-lg-6 col-md-6 col-sm-6">
                                                <a href="hw_list_per_std-std.php">
                                                    <div class="card">
                                                        <div class="card-body px-3 py-4-5">
                                                            <div class="row ">
                                                                <div class="col-12 col-lg-4 d-flex d-lg-grid justify-content-center mb-sm-2">
                                                                    <div class="stats-icon purple">
                                                                        <i class="iconly-boldShow"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-lg-8  text-center text-lg-start">
                                                                    <h6 class="text-muted font-semibold">เช็คการบ้าน</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-12 col-lg-6 col-md-6 col-sm-6">
                                                <a href="index_score_std.php">
                                                    <div class="card">
                                                        <div class="card-body px-3 py-4-5">
                                                            <div class="row">
                                                                <div class="col-12 col-lg-4 d-flex d-lg-grid justify-content-center mb-sm-2">
                                                                    <div class="stats-icon green">
                                                                        <i class="iconly-boldAdd-User"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-lg-8  text-center text-lg-start">
                                                                    <h6 class="text-muted font-semibold">ดูคะแนน</h6>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-12 col-lg-6 col-md-6 col-sm-6">
                                                <a href="proj_list_per_std-std.php">
                                                    <div class="card">

                                                        <div class="card-body px-3 py-4-5">
                                                            <div class="row">
                                                                <div class="col-12 col-lg-4 d-flex d-lg-grid justify-content-center mb-sm-2">
                                                                    <div class="stats-icon red">
                                                                        <i class="iconly-boldAdd-User"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-lg-8  text-center text-lg-start">
                                                                    <h6 class="text-muted font-semibold">โครงงาน</h6>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-12 col-lg-6 col-md-6 col-sm-6"">
                                                <a href=" index_score_grade.php">
                                                <div class="card">

                                                    <div class="card-body px-3 py-4-5">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-4 d-flex d-lg-grid justify-content-center mb-sm-2">
                                                                <div class="stats-icon red  ">
                                                                    <div class="font-weight-bold text-white">A+</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-8  text-center text-lg-start">
                                                                <h6 class="text-muted font-semibold">ดูเกรด</h6>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                </a>
                                            </div>
                                            <div class="col-12 col-lg-6 col-md-6 col-sm-6"">
                                                <a href=" #">
                                                <div class="card disabled">

                                                    <div class="card-body px-3 py-4-5 ">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-4 d-flex d-lg-grid justify-content-center mb-sm-2">
                                                                <div class="stats-icon green">
                                                                    <i class="ellipsis-h-boldShow"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-8  text-center text-lg-start">
                                                                <h6 class="text-muted font-semibold">อื่นๆ</h6>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mt-lg-5">
                                    <div class="card mt-lg-3">
                                        <div class="card-header">
                                            <h4 class="text-center" >To do list</h4>
                                        </div>
                                        <div class="card-body">
                                            <?php
                                            require_once "../../model/student/to_do_list.php";
                                            to_do_list($conn, $stu_id); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <!-- #ตารางเรียน
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>วิชาที่เรียน</h4>
                                </div>
                                <div class="card-body">

                                    <?php require_once "../../model/student/subject-card.std.php"; ?>
                                </div>
                            </div>
                        </div>-->
                    
                    </div>
                    <!-- #การบ้านทั้งหมด
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>การบ้านที่มี</h4>
                                </div>
                                <div class="card-body">
                                    <?php
                                    require_once "../../model/student/hw_list_stu.php";
                                    hw_list_std_($conn, $stu_id); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>วิจัยอิสระ</h4>
                                </div>
                                <div class="card-body">
                                    <?php
                                    require_once "../../model/student/hw_proj_list_stu.php";
                                    hw_proj_list_std_($conn, $stu_id); ?>
                                </div>
                            </div>
                        </div>
                    </div>-->




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
<!--<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>ปฏิทินงาน</h4>
                                    </div>
                                    <div class="card-body">
                                    <?php
                                    //require_once "../../model/student/calendar_list.php"; 
                                    //calendar_list($conn,$stu_id); 
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>!-->