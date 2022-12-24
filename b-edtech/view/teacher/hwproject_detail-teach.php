<?php
require '../../routes/web.php';
include "../../controllers/config.php";
require $model."proj_management.php";
$te_id = $_SESSION['username'];

$proj_id = $_GET['proj_id'];
//model
$array_proj_detail=project_detail($conn,$proj_id);
$deadline_collect=deadline_array($conn,$proj_id);
//print_r($deadline_collect);
$table_p1_wl = phase_table($conn, $proj_id, 1);
$table_p2_wl = phase_table($conn, $proj_id, 2);

if (count($deadline_collect) == 3) {
    $table_p3_wl = phase_table($conn, $proj_id, 3);
}
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

<body onload="realtime_type_proj(<?php echo $array_proj_detail['type']; ?>) ">
    <div id="app">
    <?php include_once $layout."sidebar.php"; ?>
        <div id="main">
            <header class="mb-3">
                <?php include_once $layout."navbar.php"; ?>
            </header>

            <div class="page-heading">

                <h3>สั่งงานแบบโปรเจค</h3>

            </div>
            <div class="page-content">
                <section class="section">
                    <div class="card">
                        <form action="../../model/teacher/project_receive-te.php" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="class_code">ห้องเรียน: </label>
                                            <select class="form-select" name="select_class_id" id="select_class_id" disabled>
                                                <option value="<?php $array_proj_detail['classroom_id']; ?>"><?php echo $array_proj_detail['classroom_name']; ?></option>
                                                <?php print_option_classroom($conn, $te_id, $array_proj_detail['classroom_id']) ?>
                                            </select>
                                        </div>
                                        <div div class="form-group">
                                            <label for="proj_name">ชื่อการบ้าน: </label>
                                            <input id="proj_name" class="form-control text-right bg-white" type="text" value="<?php echo $array_proj_detail['hwproj_name']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="select_subj_id">วิชา: </label>
                                            <select class="form-select" name="select_subj_id" id="select_subj_id" disabled>
                                                <option value="<?php echo $array_proj_detail['subject_id']; ?>"><?php echo $array_proj_detail['subject_codename']; ?></option>
                                                <?php print_option_subject($conn, $te_id, $array_proj_detail['subject_id']) ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="max_member">จำนวนสมาชิก: </label>
                                            <input id="max_member" type="number" class="form-control col-md-12 bg-white text-right" value="<?php echo $array_proj_detail['maximumg']; ?>" id="maximumg" name="maximumg" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="proj_detail">รายละเอียด: </label>
                                            <textarea class="form-control bg-white" placeholder="กรุณากรอกรายละเอียดงาน" id="proj_detail" name="proj_detail" rows="4" cols="50" disabled><?php echo $array_proj_detail['proj_detail']; ?></textarea>
                                        </div>
                                    </div>
                                    <div div class="form-group col-md-6 p-3 px-5">
                                        <label>ประเภทของโครงงาน:</label><br>
                                        <select id="select_type" disabled class="form-control" name="type_proj" oninput="realtime_type_proj(this.value) ">
                                            <option value="<?php echo $array_proj_detail['type']; ?>"><?php echo $array_proj_detail['type']; ?></option>
                                            <option value="2">2</option>    
                                            <option value="3">3</option>
                                        </select>
                                        <!--<label><input type="radio" class="form-radio" oninput="realtime_type_proj(this.value)" id="type_proj-2" name="type_proj" value="2" required> 2 ครั้ง</label><br>
                                        <label><input type="radio" class="form-radio"  oninput="realtime_type_proj(this.value)" id="type_proj-3" name="type_proj" value="3" required> 3 ครั้ง</label>
                                        !-->
                                    </div>
                                    <div div class="form-group col-md-6 p-3 px-5">
                                        <label for="real_dateassign">วันที่สั่ง: </label>
                                        <input class="form-control bg-white" name="real_dateassign" type="text" value="<?php echo displaydatetextmonth($array_proj_detail['date_assign']); ?>" disabled>
                                    </div>

                                    <div class="col-md-12" id="proj_phase_wl" style="display:none;">
                                        <div id="phase_1">
                                            <div class="form-group col-md-6 py-1">
                                                <div class="input-group">
                                                    <span class="input-group-text btn bg-primary text-white">Phase 1 กำหนดส่ง: </span>
                                                    <input class="form-control bg-white" name="real_dateassign" type="text" value="<?php echo displaydatetextmonth($deadline_collect[0]); ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 px-5 py-2">
                                                <div class="input-group " id="phase_1_add_wl" style="display:none;">
                                                    <span class="input-group-text">เพิ่มงาน:</span> <input class="form-control" id='p1_newtask' type="text" placeholder="ชิ้นงาน">
                                                    <span class="input-group-text">คะแนนงาน: </span><input class="form-control" id='p1_point' type="number" value="1" min="1" max="50">
                                                    <a onclick="add_task(1)" id="add" class=" form-control btn-success text-center">Add</a>
                                                </div>
                                            </div>
                                            <div id="phase_1_worklist" class="form-group col-md-12 px-5 py-3">
                                                <?php
                                                while ($table_li_p1_wl = mysqli_fetch_array($table_p1_wl)) {
                                                ?>
                                                    <ul class="input-group"><span class="input-group-text">ระยะที่ 1 ชิ้นงาน: </span>
                                                        <input type="hidden" name="p1_work_id[]" value="<?php echo $table_li_p1_wl['worklist_id']; ?>">
                                                        <input class="col-md-3 form-control bg-white" name="p1_work_detail[]" type="text" value="<?php echo $table_li_p1_wl['work_detail']; ?>" readonly="">
                                                        <span class="input-group-text"> คะแนน: </span>
                                                        <input class="col-md-3 form-control bg-white" name="p1_max_point[]" type="number" value="<?php echo $table_li_p1_wl['max_score']; ?>" readonly="">
                                                        <button style="display: none;" class="btn btn-danger" value="delete_p2_work_detail[]"> - ลบออก</button>
                                                    </ul>

                                                <?php
                                                }

                                                ?>
                                            </div>
                                        </div>

                                        <div id="phase_2">


                                            <div class="form-group col-md-6 py-1">
                                                <div class="input-group">
                                                    <span class="input-group-text btn bg-primary text-white">Phase 2 กำหนดส่ง: </span>
                                                    <input class="form-control bg-white" name="real_dateassign" type="text" value="<?php echo displaydatetextmonth($deadline_collect[1]); ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 px-5 py-2">
                                                <div class="input-group" id="phase_2_add_wl" style="display:none;">
                                                    <span class="input-group-text">เพิ่มงาน:</span> <input class="form-control" id='p2_newtask' type="text" placeholder="ชิ้นงาน">
                                                    <span class="input-group-text">คะแนนงาน: </span><input class="form-control" id='p2_point' type="number" value="1" min="1" max="50">
                                                    <a onclick="add_task(2)" id="add" class=" form-control btn-success text-center">Add</a>
                                                </div>
                                            </div>
                                            <div id="phase_2_worklist" class="form-group col-md-12 px-5 py-3">
                                                <?php
                                                while ($table_li_p2_wl = mysqli_fetch_array($table_p2_wl)) {
                                                ?>
                                                    <ul class="input-group"><span class="input-group-text">ระยะที่ 2 ชิ้นงาน: </span>
                                                        <input type="hidden" name="p2_work_id[]" value="<?php echo $table_li_p2_wl['worklist_id']; ?>">
                                                        <input class="col-md-3 form-control bg-white" name="p2_work_detail[]" type="text" value="<?php echo $table_li_p2_wl['work_detail']; ?>" readonly="">
                                                        <span class="input-group-text"> คะแนน: </span>
                                                        <input class="col-md-3 form-control bg-white" name="p2_max_point[]" type="number" value="<?php echo $table_li_p2_wl['max_score']; ?>" readonly="">
                                                        <button style="display: none;" class="btn btn-danger" value="delete_p2_work_detail[]"> - ลบออก</button>
                                                    </ul>

                                                <?php
                                                }

                                                ?>
                                            </div>

                                        </div>
                                        <div id="phase_3">
                                            <div class="form-group col-md-6 py-1">
                                                <div class="input-group">
                                                    <span class="input-group-text btn bg-primary text-white">Phase 3 กำหนดส่ง: </span>
                                                    <input class="form-control bg-white" name="real_dateassign" type="text" value="<?php
                                                                                                                                    if (count($deadline_collect) == 3) {
                                                                                                                                        echo displaydatetextmonth($deadline_collect[2]);
                                                                                                                                    }
                                                                                                                                    ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12 px-5 py-2">
                                                <div class="input-group " id="phase_3_add_wl" style="display:none;">
                                                    <span class="input-group-text">เพิ่มงาน:</span> <input class="form-control" id='p3_newtask' type="text" placeholder="ชิ้นงาน">
                                                    <span class="input-group-text">คะแนนงาน: </span><input class="form-control" id='p3_point' type="number" value="1" min="1" max="50">
                                                    <a onclick="add_task(3)" id="add" class=" form-control btn-success text-center">Add</a>
                                                </div>
                                            </div>
                                            <div id="phase_3_worklist" class="form-group col-md-12 px-5 py-3">
                                                <?php
                                                if (count($deadline_collect) == 3) {
                                                    while ($table_li_p3_wl = mysqli_fetch_array($table_p3_wl)) {
                                                ?>
                                                        <ul class="input-group"><span class="input-group-text">ระยะที่ 3 ชิ้นงาน: </span>
                                                            <input type="hidden" name="p3_work_id[]" value="<?php echo $table_li_p3_wl['worklist_id']; ?>">
                                                            <input class="col-md-3 form-control bg-white" name="p3_work_detail[]" type="text" value="<?php echo $table_li_p3_wl['work_detail']; ?>" disabled>
                                                            <span class="input-group-text"> คะแนน: </span>
                                                            <input class="col-md-3 form-control bg-white" name="p3_max_point[]" type="number" value="<?php echo $table_li_p3_wl['max_score']; ?>" disabled>
                                                            <button style="display: none;" class="btn btn-danger" value="delete_p2_work_detail[]"> - ลบออก</button>
                                                        </ul>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <p id="sum_worklist"></p>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center ">
                                        <input type="button" class="btn btn-warning mt-3 me-3 mb-3" name="edit_request" id="edit_request" onclick="editfunc()" value="แก้ไขการบ้าน">
                                        <button type="submit" class="btn btn-success mt-3 me-3 mb-3" style="display: none;" name="confirm_edit" id="confirm_edit">ยืนยันการแก้ไข</button>
                                        <a href="../../model/teacher/delete_proj.php?proj_id=<?php echo $proj_id; ?>" type="button" name="delete" id="delete" class="btn btn-danger mt-3 me-3 mb-3">ยกเลิกการสั่ง</a>
                                        <button type="reset" class="btn btn-secondary mt-3 me-3 mb-3" style="display: none;" name="cancel_edit_request" id="cancel_edit_request" onclick="moveon()">ยกเลิกการแก้ไข</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
    <script>
        //maxmember showing
        document.getElementById("maxmember_text").innerHTML = document.getElementById("maxmember").value;
        var type_proj_db = document.getElementById("typy_proj_db").value;
        if (type_proj_db == 2) {
            document.getElementById('type_proj-2').checked = true;
            document.getElementById('type_proj-2').setAttribute('disabled', '');
        } else if (type_proj_db == 3) {
            document.getElementById('type_proj-3').checked = true;
            document.getElementById('type_proj-2').setAttribute('disabled', '');
        }

        function realtime_mamber_range(maxmember) {
            document.getElementById("maxmember_text").innerHTML = maxmember;
        }
        //phase_worklist_adding
        var count_task = 0;
        document.getElementById("sum_worklist").innerText = 'งานที่สั่งทั้งหมด: ' + count_task;

        function add_task(phase) {
            let task_text = document.getElementById("p" + phase + "_newtask");
            let task_point = document.getElementById("p" + phase + "_point");
            if (task_text.value.length == 0) {
                alert("please adding somethings");
            } else {
                let area_wl = document.getElementById("phase_" + phase + "_worklist");
                let field_wl = document.createElement('ul');
                field_wl.setAttribute('class', 'input-group ');
                field_wl.setAttribute('id', 'phase_' + phase + '_wl_ul');
                //name_newtask
                let new_name_task = document.createElement('span');
                new_name_task.setAttribute('class', 'input-group-text');
                new_name_task.innerText = 'ระยะที่ ' + phase + ' ชิ้นงาน: ';
                field_wl.appendChild(new_name_task);
                //newtask
                let new_task = document.createElement('input');
                new_task.setAttribute('class', 'col-md-3 form-control bg-white');
                new_task.name = 'p' + phase + '_work_detail[]';
                new_task.type = 'text';
                new_task.setAttribute('readOnly', '');
                new_task.value = task_text.value;
                field_wl.appendChild(new_task);
                task_text.value = '';
                //name_newtask_maxpoint
                let new_name_pointtask = document.createElement('span');
                new_name_pointtask.setAttribute('class', 'input-group-text');
                new_name_pointtask.innerText = ' คะแนน: ';
                field_wl.appendChild(new_name_pointtask);
                //newtask_maxpoint
                let new_task_point = document.createElement('input');
                new_task_point.setAttribute('class', 'col-md-3 form-control bg-white');
                new_task_point.name = 'p' + phase + '_max_point[]';
                new_task_point.type = 'number';
                new_task_point.setAttribute('readOnly', '');
                new_task_point.value = task_point.value;
                field_wl.appendChild(new_task_point);
                task_point.value = '1';
                //add_delete_button
                let delete_btn = document.createElement('button');
                delete_btn.setAttribute('class', 'btn btn-danger');
                delete_btn.innerText = ' - ลบออก';
                delete_btn.value = 'delete_' + new_task.name;
                delete_btn.addEventListener('click', function() {
                    area_wl.removeChild(field_wl);
                    count_task -= 1;
                    document.getElementById("sum_worklist").innerText = 'งานที่สั่งทั้งหมด: ' + count_task;
                })
                field_wl.appendChild(delete_btn);
                area_wl.appendChild(field_wl);
                count_task += 1;
                document.getElementById("sum_worklist").innerText = 'งานที่สั่งทั้งหมด: ' + count_task;

            }
        }
        //hidding_from_phase
        function realtime_type_proj(type) {
            if (type == 2) {
                document.getElementById("proj_phase_wl").style.display = 'block';
                document.getElementById("phase_3").style.display = 'none';
            } else if (type == 3) {
                document.getElementById("proj_phase_wl").style.display = 'block';
                document.getElementById("phase_3").style.display = 'block';
            } else if (type == null) {
                document.getElementById("proj_phase_wl").style.display = 'none';
            }
        }

        function editfunc() {
            document.getElementById("edit_request").style.display = "none";
            document.getElementById("delete").style.display = "none";
            document.getElementById("cancel_edit_request").style.display = "block";
            document.getElementById("confirm_edit").style.display = "block";
            document.getElementById('proj_name').removeAttribute('disabled');
            document.getElementById('max_member').removeAttribute('disabled');
            document.getElementById('proj_detail').removeAttribute('disabled');
            document.getElementById('select_type').removeAttribute('disabled');
            document.getElementsByName("real_dateassign").removeAttribute('disabled');
            document.getElementById('hw_detail').removeAttribute('readonly');
            document.getElementById('assign_date').removeAttribute('readonly');
            document.getElementById('deadline').removeAttribute('readonly');
            document.getElementById('fileupload').removeAttribute('readonly');
        }

        function moveon() {
            alert("ยกเลิกการแก้ไขแล้ว");
            window.location = 'index_tech.php';
        }
    </script>
    <?php
    function print_option_classroom($conn, $te_id, $hw_c_id)
    {
        $sql = "SELECT class.classroom_id,class.classroom_name,te.username 
                    FROM `classroom` class
                    LEFT JOIN teacher te ON te.teacher_id=class.teacher_id
                    WHERE te.username='$te_id'
                    ";
        $resault_table = mysqli_query($conn, $sql);
        while ($list = mysqli_fetch_array($resault_table)) {
            if ($list['classroom_id'] == $hw_c_id) continue;
    ?>
            <option value=" <?php echo $list['classroom_id']; ?>"><?php echo $list['classroom_name']; ?></option>
        <?php
        }
    }
    function print_option_subject($conn, $te_id, $hw_subj_id)
    {
        $sql = "SELECT subj.subject_id,subj.subject_codename,subj.teacher_id 
                    FROM `subject`subj
                    LEFT JOIN teacher te ON te.teacher_id=subj.teacher_id
                    WHERE te.username='$te_id'
                    ";
        $resault_table = mysqli_query($conn, $sql);
        while ($list = mysqli_fetch_array($resault_table)) {
            if ($list['subject_id'] == $hw_subj_id) continue;
        ?>
            <option value=" <?php echo $list['subject_id']; ?>"><?php echo $list['subject_codename']; ?></option>
    <?php
        }
    }
    ?>
</body>

</html>