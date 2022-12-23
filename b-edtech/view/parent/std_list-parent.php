<?php
require '../../routes/web.php';
require $controller.$role_route.'parent_controller.php';
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent_index</title>
    <link rel="shortcut icon" type="image/x-icon"
        href="https://cdn.sstatic.net/Sites/stackoverflow/Img/favicon.ico?v=ec617d715196" />
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

            <div class="page-heading">

                <h3>ข้อมูลผู้เรียน</h3>

            </div>
            <div class="page-content ">
                <section class="row">
                    <div class=" col-12 col-lg-12 ">
                        <!-- 
                        <div class="row p-1">
                            <h4 >การทำงาน</h4>

                        </div>-->

                        <?php
                            student_list_card_std_detail();
                        ?>
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