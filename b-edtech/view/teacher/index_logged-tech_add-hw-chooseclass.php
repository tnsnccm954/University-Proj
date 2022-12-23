<?php
require '../../routes/web.php';

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
            <div class="page-heading px-lg-5 px-md-3">
                <h3>Homework</h3>
            </div>
            <div class="page-content">
                <div class="container">
                <div class="row">
                    <div class="row col-12">
                        <div class="col-12 col-md-6">
                            <?php require_once "../../model/teacher/add_homework.php";
                                 print_add_homework($conn);
                            ?>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>การบ้านทั้งหมด</h4>
                                </div>
                                
                                <div class="card-body">
                                    <?php require_once "../../model/teacher/to_do_list_te.php";
                                    hw_list_te($conn,$te_id)?>
                                    <a href="../../model/teacher/to_do_list_te.php?subj_id=<?php echo $subj_id; ?>"> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
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