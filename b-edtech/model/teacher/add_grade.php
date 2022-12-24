<?php
require "../../controllers/config.php";
require "../../controllers/hw_management.php";
require_once "class_table_te.php";
function print_add_grade_class($condb){
    
    $class_id= $_SESSION['classroom_id'];
    $class_name=$_SESSION['classroom_name'];
    $subject_codename=$_SESSION['subj_codename'];
    $sql="SELECT * 
        FROM `subject` subj 
        WHERE subj.subject_codename='$subject_codename'
        ";
    $result_receive_subj=mysqli_query($condb,$sql);
    $data=mysqli_fetch_array($result_receive_subj);
    ?>
<div class="card">
    <div class="card-body">
        <h2 class="card-title ">คำนวณเกรด</h2>
        <form class="form" action="index_logged-tech_std_list_graed.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="first-name-column">ห้องเรียน</label>
                        <input type="hidden" name="class_id" id="class_id" value="<?php echo $class_id?>">
                        <input type="text" class="form-control" name="class_name" value="<?php echo $class_name?>" readonly>

                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="first-name-column">วิชา</label>
                        <input type="hidden" name="subj_id" id="subj_id"
                            value="<?php echo $data['subject_id'] ?>">
                        <input type="text" class="form-control" value="<?php echo $subject_codename?>" readonly>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                    <h2 class="card-title ">เกณฑ์การตัดเกรด</h2>
                    <form class="form" method="POST" enctype="multipart/form-data">
                    <div class="row">
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="hw_level">เกรด 4</label>
                        <input type="text" id="grade_41" class="form-control" name="grade_41">
                        <label for="hw_level">ถึง</label>
                        <input type="text" id="grade_42" class="form-control" name="grade_42">
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="hw_level">เกรด 3.5</label>
                        <input type="text" id="grade_31_5" class="form-control" name="grade_31_5">
                        <label for="hw_level">ถึง</label>
                        <input type="text" id="grade_32_5" class="form-control" name="grade_32_5">
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="hw_level">เกรด 3</label>
                        <input type="text" id="grade_31" class="form-control" name="grade_31">
                        <label for="hw_level">ถึง</label>
                        <input type="text" id="grade_32" class="form-control" name="grade_32">
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="hw_level">เกรด 2.5</label>
                        <input type="text" id="grade_21_5" class="form-control" name="grade_21_5">
                        <label for="hw_level">ถึง</label>
                        <input type="text" id="grade_22_5" class="form-control" name="grade_22_5">
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="hw_level">เกรด 2</label>
                        <input type="text" id="grade_21" class="form-control" name="grade_21">
                        <label for="hw_level">ถึง</label>
                        <input type="text" id="grade_22" class="form-control" name="grade_22">
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="hw_level">เกรด 1.5</label>
                        <input type="text" id="grade_11_5" class="form-control" name="grade_11_5">
                        <label for="hw_level">ถึง</label>
                        <input type="text" id="grade_12_5" class="form-control" name="grade_12_5">
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="hw_level">เกรด 1</label>
                        <input type="text" id="grade_11" class="form-control" name="grade_11">
                        <label for="hw_level">ถึง</label>
                        <input type="text" id="grade_12" class="form-control" name="grade_12">
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="hw_level">เกรด 0</label>
                        <input type="text" id="grade_01" class="form-control" name="grade_01">
                        <label for="hw_level">ถึง</label>
                        <input type="text" id="grade_02" class="form-control" name="grade_02">
                    </div>
                </div>
                
                <div class="mt-3 col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1" name="add_grade">ตัดเกรดโลด</button>
                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                </div>
            </div>
        </form>
    </div>

</div>
<?php
    }
function print_add_grade($conn){
    $te_id = $_SESSION['username'];
    ?>
<div class="card">
    <div class="card-body">
        <h2 class="card-title ">คำนวณเกรด</h2>
        <form class="form" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="first-name-column">ห้องเรียน</label>
                        <select class="form-select" name="select_class_id" id="select_class_id" >
                            <option>select</option>
                            <?php print_option_classroom($conn, $te_id) ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="first-name-column">วิชา</label>
                        <select class="form-select" name="select_subj_id" id="select_subj_id" >
                            <option >select</option>
                            <?php print_option_subject($conn, $te_id) ?>
                        </select>
                        </div>
                </div>
                <div class="card">
                    <div class="card-body">
                    <h2 class="card-title ">เกณฑ์การตัดเกรด</h2>
                    <form class="form" method="POST" enctype="multipart/form-data">
                    <div class="row">
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="hw_level">เกรด 4</label>
                        <input type="text" id="grade_41" class="form-control" name="grade_41">
                        <label for="hw_level">ถึง</label>
                        <input type="text" id="grade_42" class="form-control" name="grade_42">
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="hw_level">เกรด 3.5</label>
                        <input type="text" id="grade_31_5" class="form-control" name="grade_31_5">
                        <label for="hw_level">ถึง</label>
                        <input type="text" id="grade_32_5" class="form-control" name="grade_32_5">
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="hw_level">เกรด 3</label>
                        <input type="text" id="grade_31" class="form-control" name="grade_31">
                        <label for="hw_level">ถึง</label>
                        <input type="text" id="grade_32" class="form-control" name="grade_32">
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="hw_level">เกรด 2.5</label>
                        <input type="text" id="grade_21_5" class="form-control" name="grade_21_5">
                        <label for="hw_level">ถึง</label>
                        <input type="text" id="grade_22_5" class="form-control" name="grade_22_5">
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="hw_level">เกรด 2</label>
                        <input type="text" id="grade_21" class="form-control" name="grade_21">
                        <label for="hw_level">ถึง</label>
                        <input type="text" id="grade_22" class="form-control" name="grade_22">
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="hw_level">เกรด 1.5</label>
                        <input type="text" id="grade_11_5" class="form-control" name="grade_11_5">
                        <label for="hw_level">ถึง</label>
                        <input type="text" id="grade_12_5" class="form-control" name="grade_12_5">
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="hw_level">เกรด 1</label>
                        <input type="text" id="grade_11" class="form-control" name="grade_11">
                        <label for="hw_level">ถึง</label>
                        <input type="text" id="grade_12" class="form-control" name="grade_12">
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="hw_level">เกรด 0</label>
                        <input type="text" id="grade_01" class="form-control" name="grade_01">
                        <label for="hw_level">ถึง</label>
                        <input type="text" id="grade_02" class="form-control" name="grade_02">
                    </div>
                </div>
                
                <div class="mt-3 col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1" name="add_grade">ตัดเกรดโลด</button>
                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                </div>
            </div>
        </form>
    </div>

</div>

</div><?php
}
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
        $sql = "SELECT subj.subject_id,subj.subject_codename,subj.teacher_id 
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