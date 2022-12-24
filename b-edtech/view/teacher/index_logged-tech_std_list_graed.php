<?php
require '../../routes/web.php';
include "../../controllers/config.php";
$_SESSION['class_id']=$_POST['class_id'];
$_SESSION['class_name']=$_POST['class_name'];
$te_username=$_SESSION['username'];
$classroom_id=$_SESSION['class_id'];
$classroom_name=$_SESSION['class_name'];
$subject_codename=$_SESSION['subj_codename'];

    $sql_subj_detail="SELECT * FROM `subject` subj
    LEFT JOIN teacher te ON te.teacher_id=subj.teacher_id
    WHERE subject_codename='$subject_codename'";
    $sql_subj_detail=mysqli_query($conn,$sql_subj_detail);
    $table_subj_detail=mysqli_fetch_array($sql_subj_detail);
    $_SESSION['subject_id']=$table_subj_detail['subject_id'];
    $subj_id=$_SESSION['subject_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hw_std_list</title>

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
            <div class="page-heading">
                <h3>ใบรายชื่อและใบคะแนน</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="text-center">รายวิชา: <?php echo $subject_codename ?> |ห้องเรียน:
                                            <?php echo $classroom_name ?> | ภาคเรียน:
                                            <?php echo $table_subj_detail['term']?></h4>
                                        <h4 class="text-center">ครูที่ปรึกษา:
                                            <?php echo $table_subj_detail['name']." ".$table_subj_detail['surname']; ?>
                                            | เบอร์โทรติดต่อ: <?php echo $table_subj_detail['teacher_tel']?> </h4>
                                    </div>
                                    <div class="card-body">
                                        <?php 
                                            require "../../model/teacher/mix_all_table_grade.php"; 
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
    <script src="../../assets/js/pages/dashboard.js"></script>
    <script src="../../assets/js/main.js"></script>
</body>

</html>