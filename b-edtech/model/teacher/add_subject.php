<?php
require "../../controllers/config.php";
require "../../controllers/subj_management.php";
$te_id = $_SESSION['username'];
$teacher_id= $_SESSION['user_id'];
    ?>


<div class="card">
    <div class="card-body">
        <h2 class="card-title ">รายละเอียดรายวิชา</h2>
        <form class="form" method="POST" enctype="multipart/form-data">
            <div class="row">
            <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="first-name-column">รหัสรายวิชา</label>
                        <input type="text" id="subject_codename" class="form-control" name="subject_codename" required>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="first-name-column">ชื่อรายวิชา</label>
                        <input type="text" id="subject_name" class="form-control" name="subject_name" required>
                    </div>
                </div>
                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label for="last-name-column">คำอธิบายรายวิชา</label>
                        <textarea class="form-control" name="subject_detail" id="subject_detail" 
                            rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="hw_level">เทอม</label>
                            <select class="form-control" id="semester" name='semester' required>
                                <option selected>Choose...</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="first-name-column">ปีการศึกษา</label>
                        <input type="text" id="year" class="form-control" name="year" required>
                    </div>
                </div>
                <div class="mt-3 col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1" name="add_subject">เพิ่มรายวิชา</button>
                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                </div>
            </div>
        </form>
    </div>


</div><?php

function print_option_classroom($conn, $te_id)
    {
        $sql = "SELECT class.classroom_id,class.classroom_name,te.username 
                    FROM `classroom` class
                    LEFT JOIN teacher te ON te.teacher_id=class.teacher_id
                    WHERE te.username='$te_id'
                    ";
        $resault_table = mysqli_query($conn, $sql);
        while ($list = mysqli_fetch_array($resault_table)) {
    ?>
    <option value=" <?php echo $list['classroom_id']; ?>"><?php echo $list['classroom_name']; ?></option>
    <?php
        }
    }
function print_option_subject($conn, $te_id)
    {
        $sql = "SELECT subj.subject_id,subj.subject_codename,subj.teacher_id,subj.semester,subj.year 
                    FROM `subject`subj
                    LEFT JOIN teacher te ON te.teacher_id=subj.teacher_id
                    WHERE te.username='$te_id'
                    ";
        $resault_table = mysqli_query($conn, $sql);
        while ($list = mysqli_fetch_array($resault_table)) {
        ?>
    <option value=" <?php echo $list['subject_id']; ?>"><?php echo $list['subject_codename']; ?></option>
    <?php
        }
    }
?>

    
