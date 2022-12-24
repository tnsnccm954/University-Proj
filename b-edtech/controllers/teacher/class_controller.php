<?php
require "../../routes/web.php";
require "../../controllers/config.php";
require "../../controllers/teacher/option-te.php";
/* เพิ่มห้องเรียนใหม่
function print_add_per_class($condb){
    
    $class_name=$_SESSION['classroom_name'];
    $subject_codename=$_SESSION['subj_codename'];
    $sql="SELECT * 
        FROM `subject` subj 
        WHERE subj.subject_codename='$subject_codename'
        ";
    $result_receive_subj=mysqli_query($condb,$sql);
    return $result_receive_subj;
    $data=mysqli_fetch_array($result_receive_subj);
    ?>
<div class="card">
    <div class="card-body">
        <h2 class="card-title ">รายละเอียดห้องเรียน</h2>
        <form class="form" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="first-name-column">รหัสห้องเรียน</label>
                        <input type="text" id="classroom_id" class="form-control" name="classroom_id">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="first-name-column">วิชา</label>
                        <input type="hidden" name="subj_id" id="subj_id"
                            value="<?php echo $data['subject_id'] ?>">
                        <input type="text" class="form-control" value="<?php echo $class_name?>" readonly>
                    </div>
                </div>

                <div class="mt-3 col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1" name="add_class">เพิ่มชั้นเรียน</button>
                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                </div>
            </div>
        </form>
    </div>

</div>
<?php
    }*/
function print_add_classroom($conn){
    require "../../routes/web.php";
    $te_id = $_SESSION['username'];
    ?>
<div class="card">
    <div class="card-body">
        <h2 class="card-title ">เพิ่มห้องเรียนใหม่ในรายวิชา</h2>
        <form class="form" method="POST" enctype="multipart/form-data" action="<?php echo $model.$role_route."add_classroom.php"; ?>">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="first-name-column">ห้องเรียน</label>
                        <input type="text" id="class_codename" class="form-control" name="class_codename" required>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="first-name-column">วิชา</label>
                        <select class="form-select" name="subj_id" id="select_subj_id" required>
                            <option >select</option>
                            <?php print_option_subject($conn, $te_id) ?>
                        </select>
                    </div>
                </div>
                <div class="mt-3 col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1" name="add_homework">เพิ่มชั้นเรียน</button>
                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                </div>
            </div>
        </form>
    </div>

</div>
<?php
}
?>