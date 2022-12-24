<?php
require "../../routes/web.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTe-EDTech</title>

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
            <header class="mb-3">
                <?php include_once $layout."navbar.php"; ?>
            </header>
            <div class="page-heading mx-lg-4 d-flex justify-content-center justify-content-lg-start  ">
                <h3 >ส่วนงานครู</h3>
            </div>
            <div class="page-content ">
                <section class="row">
                    <div class="col-12 ">
                        <div class="row">
                            <div class=" mx-5 px-lg-5 mx-sm-3 mb-3" >
                                <h5 class="  px-lg-3">วิชาที่สอน</h5>
                            </div>
                            <div class="d-flex justify-content-center" >
                            
                                <div class="row col-10">
                                    <?php require_once "../../model/teacher/subject_card_te.php";?>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="col-10">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>โปรเจคที่สั่ง</h4>
                                        </div>
                                        <div class="card-body">
                                            <?php 
                                            require_once "../../model/teacher/hw_proj_list_te.php"; 
                                            hw_proj_list_te($conn,$te_id);
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div></div>
                        </div>
                        <div class="d-flex aligns-items-center justify-content-center">
                            <div class="col-10">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>การบ้านที่สั่งทั้งหมด</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php 
                                            require_once "../../model/teacher/hw_list_te-table.php"; 
                                            print_quick_hw_list($conn,$te_id);
                                        ?>
                                    </div>
                                </div>
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