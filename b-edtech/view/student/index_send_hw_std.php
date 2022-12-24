<?php
require '../../routes/web.php';
require $model.$role_route.'main-student.php';
$std_id=$_SESSION['user_id'];
$subj_id=$_GET['subj_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B-EDTech</title>

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

                <h3>การบ้านที่ต้องส่ง</h3>

            </div>

            <div class="page-content">
                <section class="row">
                    <div class="row">
                        <div class="row">



                            <div class="col-12">
                                <d class="card p-4">

                                    <?php
                                        $re_subj_head = subj_detail($conn,$subj_id);
                                        //print_r($re_subj_head);
                                        if (mysqli_num_rows($re_subj_head) >= 1) {
                                            while ($subj_head = mysqli_fetch_assoc($re_subj_head)) {
                                                $subj_id = $subj_head['subject_id'];
                                                    ?>
                                                <h5>
                                                    <?php
                                                    echo "วิชา: " . $subj_head['subject_codename'] . " | " . $subj_head['subject_name'];
                                                    ?>
                                                </h5>
                                                <div class="table-responsive">
                                                    <table class="table table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>ลำดับ</th>
                                                                <th>ชื่อการบ้าน</th>
                                                                <th>รายละเอียด</th>
                                                                <th>วันที่ส่ง</th>
                                                                <th>สถานะ</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $result = std_per_subj_hw($conn, $std_id, $subj_id);
                                                                if (mysqli_num_rows($result)>=1) {
                                                                    $i = 1;
                                                                    $j = 0;
                                                                    while ($list_hw = mysqli_fetch_assoc($result)) {
                                                                        //print_r($list_hw);
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $i; ?></td>
                                                                            <td class="col-3"><?php echo $list_hw['hw_name']; ?></td>
                                                                            <td>-</td>
                                                                            <td><?php echo displaydate($list_hw['date_deadline']); ?></td>
                                                                            <td>
                                                                                <?php
                                                                                    if($list_hw['maximumg']>1){
                                                                                        $hw_status = hwg_status($conn, $list_hw['hw_id'], $std_id);
                                                                                    }
                                                                                    else{
                                                                                        $hw_status = hw_status($conn, $list_hw['hw_id'], $std_id);
                                                                                    }
                                                                                    

                                                                                    if ($hw_status == "sended") {
                                                                                    ?>                                                                                                                                         
                                                                                                    <a class="btn btn-success col-md-5 m-1 disabled">ส่งแล้ว</a>
                                                                                                    <a class="btn btn-info col-md-5 m-1 ">ตรวจสอบ</a>
                                                                                                <?php
                                                                                    } elseif ($hw_status == "unsent") {
                                                                                    ?>
                                                                                                <a class="btn btn-danger col-md-5 px-1 disabled">ยังไม่ได้ส่ง</a>
                                                                                                <a href="index_send_hw_std_upload_hw.php?hw_id=<?php echo $list_hw['hw_id']; ?>&std_id=<?php echo $list_hw['std_id']; ?>" class="btn btn-secondary col-md-5 mx-1 ">ส่งงาน</a>
                                                                                                <?php
                                                                                        $j++;
                                                                                    } else {
                                                                                    ?>
                                                                                                <a class="btn btn-info col-md-12">ไม่มีข้อมูล</a>
                                                                                                <?php
                                                                                    }
                                                                                    ?>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                        $i++;
                                                                    }
                                                                }
                                                    else { ?> <tr>
                                                    <td class="text-center" colspan="7">ไม่มีการบ้าน</td>
                                                </tr> <?php }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <td class="text-end px-4" colspan="5">
                                                    งานค้างวิชานี้ทั้งหมด : <?php echo $j; ?>
                                                </td>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <?php
            }
        } else {
            ?>
                                    <div class=" py-5 align-content-center justify-content-center">
                                        <h5 class=" text-center">ยังไม่มีการบ้าน</h5>
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

    <script src="../../assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="../../assets/js/pages/dashboard.js"></script>

    <script src="../../assets/js/main.js"></script>
</body>

</html>