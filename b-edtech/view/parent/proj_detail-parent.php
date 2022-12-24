<?php
require '../../routes/web.php';
require $model.$role_route.'main-parent.php';
require $model."proj_management.php";
$std_id = $_GET['std_id'];
$proj_id = $_GET['proj_id'];
$std_detail=std_detail($conn,$std_id);
//project
$array_proj_detail=project_detail($conn,$proj_id);
$deadline_collect=deadline_array($conn,$proj_id);
//print_r($deadline_collect);
$table_p1_wl = phase_table($conn, $proj_id, 1);
$table_p2_wl = phase_table($conn, $proj_id, 2);
if (count($deadline_collect) == 3) {
    $table_p3_wl = phase_table($conn, $proj_id, 3);
}
$array_group_detail=search_group($conn,$std_id,$proj_id);
$group_id=$array_group_detail['group_id']??"none";
//error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proj_assign</title>

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

                <h3>รายละเอียดโปรเจค</h3>

            </div>
            <div class="page-content">
                <section class="section">
                <div class="d-flex justify-content-center d-lg-grid">
                        <div class="col-10 col-lg-12 px-lg-5 px-md-3 ">
                            <div class=" justify-content-center mx-3">
                                <div class="row ">
                                    <div class="card col-lg-12">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="class_code">ห้องเรียน: </label>
                                                        <input class="form-control text-right bg-white" type="text"
                                                            value="<?php echo $array_proj_detail['classroom_name']; ?>" disabled>
                                                    </div>
                                                    <div div class="form-group">
                                                        <label for="proj_name">ชื่องานวิจัย: </label>
                                                        <input class="form-control text-right bg-white" type="text"
                                                            value="<?php echo $array_proj_detail['hwproj_name']; ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="helpInputTop">วิชา: </label>
                                                        <input class="form-control text-right bg-white" type="text"
                                                            value="<?php echo $array_proj_detail['subject_codename']; ?>" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="max_member">จำนวนสมาชิก: </label>
                                                        <input type="text" class="form-control col-md-12 bg-white text-right"
                                                            value="<?php echo $array_proj_detail['maximumg']; ?>" id="maximumg"
                                                            name="maximumg" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="proj_detail">รายละเอียด: </label>
                                                        <textarea class="form-control bg-white" placeholder="กรุณากรอกรายละเอียดงาน"
                                                            id="proj_detail" name="proj_detail" rows="4" cols="50"
                                                            disabled><?php echo $array_proj_detail['proj_detail']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>ประเภทของโครงงาน: </label>
                                                        <input type="text" class="form-control col-md-12 bg-white"
                                                            value="<?php echo $array_proj_detail['type']; ?>" id="type_proj"
                                                            name="type_proj" value="2" disabled>
                                                    </div>
                                                </div>
                                                <div div class="form-group col-md-6">
                                                    <label for="real_dateassign">วันที่สั่ง: </label>
                                                    <input class="form-control bg-white" name="real_dateassign" type="text"
                                                        value="<?php echo displaydatetextmonth($array_proj_detail['date_assign']); ?>"
                                                        disabled>
                                                </div>

                                            </div>


                                        </div>


                                    </div>
                                    <div class="card col-lg-5 d-none mx-lg-5">
                                        <div class="card-header text-start">
                                            <h4>ชื่อผู้เรียน</h4>
                                        </div>
                                        <div class="card-body">
                                            <p>&nbsp;&nbsp;&nbsp;<?php echo $std_detail['name']." ".$std_detail['surname']; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="card py-2">
                                        <div class="card-body" >
                                        <div class="row ">
                                            <h3 class=" text-center p-3">
                                                กลุ่ม-<?php echo $array_group_detail['group_name']??"ยังไม่ได้จับกลุ่ม"; ?>
                                            </h3>
                                            <div class="col-md-12 p-3 text-center" id="proj_phase_wl">
                                                <div id="phase_1">
                                                    <div class="form-group col-md-6">
                                                        <div class="input-group">
                                                            <span class="input-group-text btn bg-primary text-white">Phase 1
                                                                กำหนดส่ง: </span>
                                                            <input class="form-control bg-white" name="real_dateassign" type="text"
                                                                value="<?php echo displaydatetextmonth($deadline_collect[0]); ?>"
                                                                disabled>
                                                        </div>
                                                    </div>

                                                    <div id="phase_1_worklist" class="form-group col-md-12 px-5 py-5">
                                                        <table class="table table-sm  ">
                                                            <thead>
                                                                <tr>
                                                                    <th>สถานะ</th>
                                                                    <th>ชิ้นงาน</th>
                                                                    <th>คะแนนเต็ม</th>
                                                                    <th>คะแนนที่ได้</th>
                                                                    <th>รายละเอียด</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php

                                                                        while ($table_li_p1_wl = mysqli_fetch_array($table_p1_wl)) {
                                                                            ?>
                                                                            <tr class="">
                                                                                <td class="col-md-2 ">
                                                                                    <?php
                                                                                                    if (isset($group_id)&&$group_id!="none") {
                                                                                                        $check_hw = check_hw_list($conn, $table_li_p1_wl['worklist_id'], $group_id);
                                                                                                    } else {
                                                                                                    ?>
                                                                                    <div class="alert alert-danger text-center">ยังไม่ได้ส่ง</div>
                                                                                    <?php
                                                                                                    }

                                                                                                    ?>
                                                                                </td>
                                                                                <td><?php echo $table_li_p1_wl['work_detail']; ?></td>
                                                                                <td><?php echo $table_li_p1_wl['max_score']; ?></td>
                                                                                <td id=scored_1>
                                                                                    <?php
                                                                                                    if ($group_id!="none" && $check_hw[0] == "success" ) {

                                                                                                        if ($check_hw[1] != 0) {
                                                                                                            echo $check_hw[1];
                                                                                                        } else {
                                                                                                            echo "ยังไม่ได้ให้คะแนน";
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo "-";
                                                                                                    }
                                                                                                    ?>
                                                                                </td>
                                                                                <td class="col-md-3 ">
                                                                                    <?php
                                                                                                    if ($group_id!="none" && $check_hw[0] == "success") {
                                                                                                        echo 'ไม่มีสิทธิ์เข้าถึง';  
                                                                                                    } else if ( $group_id!="none" && $check_hw[0] == "unsuccess") {
                                                                                                        echo 'ยังไม่ได้ส่งงาน';                                                                                      
                                                                                                    } else {
                                                                                                        echo 'ไม่สามารถส่งงานได้';
                                                                                                    }
                                                                                                    ?>
                                                                                </td>

                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div id="phase_2">


                                                    <div class="form-group col-md-6">
                                                        <div class="input-group">
                                                            <span class="input-group-text btn bg-primary text-white">Phase 2
                                                                กำหนดส่ง: </span>
                                                            <input class="form-control bg-white" name="real_dateassign" type="text"
                                                                value="<?php echo displaydatetextmonth($deadline_collect[1]); ?>"
                                                                disabled>
                                                        </div>
                                                    </div>

                                                    <div id="phase_2_worklist" class="form-group col-md-12 px-5 py-5">

                                                        <table class="table table-sm  ">
                                                            <thead>
                                                                <tr>
                                                                    <th>สถานะ</th>
                                                                    <th>ชิ้นงาน</th>
                                                                    <th>คะแนนเต็ม</th>
                                                                    <th>คะแนนที่ได้</th>
                                                                    <th>รายละเอียด</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php

                                                                        while ($table_li_p2_wl = mysqli_fetch_array($table_p2_wl)) {
                                                                            ?>
                                                                            <tr>
                                                                                <td class="col-md-2 ">

                                                                                    <?php
                                                                                                if (isset($group_id)) {
                                                                                                    $check_hw = check_hw_list($conn, $table_li_p2_wl['worklist_id'], $group_id);
                                                                                                } else {
                                                                                                ?>
                                                                                    <div class="alert  alert-danger text-center  ">ยังไม่ได้ส่ง</div>
                                                                                    <?php
                                                                                                }

                                                                                                ?>
                                                                                </td>
                                                                                <td><?php echo $table_li_p2_wl['work_detail']; ?></td>
                                                                                <td><?php echo $table_li_p2_wl['max_score']; ?></td>
                                                                                <td id=scored_1>
                                                                                    <?php
                                                                                                if ($group_id!="none" && $check_hw[0] == "success") {
                                                                                                    if ($check_hw[1] != 0) {
                                                                                                        echo $check_hw[1];
                                                                                                    } else {
                                                                                                        echo "ยังไม่ได้ให้คะแนน";
                                                                                                    }
                                                                                                } else {
                                                                                                    echo "-";
                                                                                                }
                                                                                                ?>
                                                                                </td>
                                                                                <td class="col-md-3 ">
                                                                                    <?php
                                                                                                if ($group_id!="none" && $check_hw[0] == "success") {
                                                                                                    echo 'ไม่มีสิทธิ์เข้าถึง';
                                                                                                } else if ($group_id!="none" && $check_hw[0] == "unsuccess") {
                                                                                                    echo "ยังไม่ได้ส่งงาน";
                                                                                                } else {
                                                                                                    echo 'ไม่สามารถส่งงานได้';
                                                                                                }
                                                                                                ?>
                                                                                </td>

                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                                <div id="phase_3">
                                                    <div class="form-group col-md-6">
                                                        <div class="input-group">
                                                            <span class="input-group-text btn bg-primary text-white">Phase 3
                                                                กำหนดส่ง: </span>
                                                            <input class="form-control bg-white" name="real_dateassign" type="text"
                                                                value="<?php
                                                                                if (count($deadline_collect) == 3) 
                                                                                {echo displaydatetextmonth($deadline_collect[2]);}?>"
                                                                disabled>
                                                        </div>
                                                    </div>
                                                    <div id="phase_3_worklist" class="form-group col-md-12 px-5 py-5">
                                                        <?php if (count($deadline_collect) == 3) { ?>
                                                        <table class="table table-sm  ">
                                                            <thead>
                                                                <tr>
                                                                    <th>สถานะ</th>
                                                                    <th>ชิ้นงาน</th>
                                                                    <th>คะแนนเต็ม</th>
                                                                    <th>คะแนนที่ได้</th>
                                                                    <th>รายละเอียด</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php

                                                                            while ($table_li_p3_wl = mysqli_fetch_array($table_p3_wl)) {
                                                                                ?>
                                                                                <tr class="">
                                                                                    <td class="col-md-2 ">
                                                                                        <?php

                                                                                                                if (isset($group_id) && $group_id!="none") {
                                                                                                                    $check_hw = check_hw_list($conn, $table_li_p3_wl['worklist_id'], $group_id);
                                                                                                                } else {
                                                                                                                ?>
                                                                                        <div class="alert alert-danger text-center">ยังไม่ได้ส่ง</div>
                                                                                        <?php
                                                                                                                }


                                                                                                                ?>
                                                                                    </td>
                                                                                    <td><?php echo $table_li_p3_wl['work_detail']; ?></td>
                                                                                    <td><?php echo $table_li_p3_wl['max_score']; ?></td>
                                                                                    <td id=scored_1>
                                                                                        <?php
                                                                                                                if ($group_id!="none" && $check_hw[0] == "success") {
                                                                                                                    if ($check_hw[1] != 0) {
                                                                                                                        echo $check_hw[1];
                                                                                                                    } else {
                                                                                                                        echo "ยังไม่ได้ให้คะแนน";
                                                                                                                    }
                                                                                                                } else {
                                                                                                                    echo "-";
                                                                                                                }
                                                                                                                ?>
                                                                                    </td>
                                                                                    <td class="col-md-3 ">
                                                                                        <?php
                                                                                                                if ($group_id!="none" && $check_hw[0] == "success") {
                                                                                                                    echo 'ไม่มีสิทธิ์เข้าถึง';
                                                                                                                } else if ($group_id!="none" && $check_hw[0] == "unsuccess") {
                                                                                                                    echo 'ยังไม่ได้ส่งงาน';
                                                                                                                } else {
                                                                                                                    echo 'ไม่สามารถส่งงานได้';
                                                                                                                }
                                                                                                                ?>
                                                                                    </td>

                                                                                </tr>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                            </tbody>
                                                        </table>
                                                        <?php } ?>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        </div>
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
    <script>
    //hidding_from_phase
    var type = document.getElementById("type_proj").value;
    if (type == 2) {
        document.getElementById("proj_phase_wl").style.display = 'block';
        document.getElementById("phase_3").style.display = 'none';
    } else if (type == 3) {
        document.getElementById("proj_phase_wl").style.display = 'block';
        document.getElementById("phase_3").style.display = 'block';
    } else if (type == null) {
        document.getElementById("proj_phase_wl").style.display = 'none';
    }

    function update_score(score, phase) {
        document.getElementById('scored_' + phase).innerText = score;
    }
    </script>

</body>

</html>