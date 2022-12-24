<?php
require '../../routes/web.php';
$_SESSION['classroom_id']=$_GET['classroom_id'];
$_SESSION['classroom_name']=$_GET['classroom_name'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard_Te</title>

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
            <div class="page-heading ">
                <div class=" d-flex justify-content-center justify-content-lg-start"> 
                        <h3 class="fs-2 mx-lg-5 my-1">การสั่งการบ้าน</h3>   
                </div>
            </div>
            <div id='test'></div>
            <div class="page-content">
                <?php require_once "../../model/teacher/add_homework.php";
                    print_add_homework_per_class($conn);
                ?>
            </div>
            </section>
        </div>
        <?php //require_once "../../controllers/footer.php"; ?>
    </div>
    </div>
    <script src="../../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/pages/dashboard.js"></script>
    <script src="../../assets/js/main.js"></script>
</body>

</html>