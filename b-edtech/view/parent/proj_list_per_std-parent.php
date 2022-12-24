<?php
require '../../routes/web.php';
require $model.$role_route.'main-parent.php';
$user_id = $_SESSION['user_id'];
$std_id = $_GET['std_id'];
$class_id = $_GET['class_id'];
$std_detail=std_detail($conn,$std_id);
$class_name = $std_detail['classroom_name']??null;
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

                <!--<h3>การบ้านของผู้เรียน</h3>-->

            </div>
            <div class="page-content ">
                <section class="row">
                    <div class="py-3 d-flex justify-content-xl-start justify-content-center">
                        <h3 class="px-lg-3">Project |
                            โครงงาน </h3>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="col-10 col-lg-12 px-lg-5 px-md-3 ">
                            <div class="d-flex justify-content-center mx-3">
                                <div class="col-12">
                                    <div class="row text-center text-lg-start">
                                        <div class="col-12 col-lg-6">
                                            <div class="card">
                                                <div class="card-header text-start">
                                                    <h4>ชื่อผู้เรียน</h4>
                                                </div>
                                                <div class="card-body">
                                                    <p>&nbsp;&nbsp;&nbsp;<?php echo $std_detail['name']." ".$std_detail['surname']; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>ห้องเรียน</h4>
                                                </div>
                                                <div class="card-body">
                                                    <p>&nbsp;&nbsp;&nbsp;<?php echo $class_name; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-12 col-lg-12 ">
                                <!-- 
                        <div class="row p-1">
                            <h4 >การทำงาน</h4>

                        </div>-->

                                <div class="row">
                                    <h4 class="my-3">
                                        วิชาที่สั่งโปรเจค
                                    </h4>
                                    <div class="row mx-2">

                                        <?php
                                        $result = card_subj_proj($conn, $class_id);
                                        if(mysqli_num_rows($result)>=1){
                                            while ($card_subj_proj = mysqli_fetch_array($result)) {
                                            //print_r($detailstd);
                                            ?>
                                                <div class="col-12 col-lg-3 col-md-6 col-sm-12 px-3 ">
                                                    <a href="<?php echo $view.$role_route."proj_detail-parent.php"."?proj_id=".$card_subj_proj['proj_id']."&std_id=".$std_id; ?>">
                                                        <div class="card d-lg-grid">
                                                            <div class="card-body px-3 py-4-5">
                                                                <div class="row">
                                                                <div class="d-flex justify-content-center ">

                                                                    <div class="col-md-4 mx-2">

                                                                        <div class="stats-icon green">
                                                                            <i class="iconly-boldAdd-User"></i>
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-md-8 mx-2">

                                                                        <h6 class="text-muted font-semibold">
                                                                            <?php echo $card_subj_proj['subject_codename'] ?>
                                                                        </h6>
                                                                        <h6 class="font-extrabold mb-0">
                                                                            จำนวนงานย่อย: <?php echo sum_hw_per_proj($conn,$card_subj_proj['proj_id']) ?>
                                                                        </h6>

                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php
                                            }
                                        }
                                        else{
                                            ?>
                                            <div class="col-12" >
                                                <div class="card p-5" >
                                                    <h5 class="text-center m-3" >ยังไม่มีการสั่งงาน</h5>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
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