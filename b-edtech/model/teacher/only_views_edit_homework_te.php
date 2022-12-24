<?php
include "../../controllers/config.php";
include "../../controllers/hw_management.php";
$te_id = $_SESSION['username'];
$hw_id = $_GET['hw_id'];
$sql_hw = "SELECT  
    hw.hw_id,hw.hw_name,hw.hw_order,hw.level,hw.date_deadline,hw.dateassign,hw.classroom_id,hw.hw_assign_file,hw.maximumg,
    subj.subject_id,subj.subject_codename,subj.subject_name,
    teach.username,teach.name,teach.teacher_tel,
    class.classroom_name
    FROM `homework` hw
    INNER JOIN `subject` subj ON subj.subject_id=hw.subject_id
    LEFT JOIN `teacher` teach ON subj.teacher_id=teach.teacher_id 
    LEFT JOIN `classroom` class ON class.classroom_id=hw.classroom_id
    WHERE hw_id='$hw_id'";
$result_hw = mysqli_query($conn, $sql_hw);
$hw_data = mysqli_fetch_array($result_hw);
?>
<div class="card  col-lg-5 col-12 mx-3">
    <div class="card-body">
        <h2 class="card-title d-flex justify-content-center justify-content-md-start ">รายละเอียดการบ้าน</h2>
        <form class="form px-3" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <input type="hidden" name="hw_id" id="hw_id" value="<?php echo $hw_data['hw_id']; ?>">
                        <label for="first-name-column">ห้องเรียน</label>
                        <select class="form-select" name="select_class_id" id="select_class_id" disabled>
                            <option value="<?php echo $hw_data['classroom_id']; ?>">
                                <?php echo $hw_data['classroom_name']; ?></option>
                            
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="first-name-column">วิชา</label>
                        <select class="form-select" name="select_subj_id" id="select_subj_id" disabled>
                            <option value="<?php echo $hw_data['subject_id']; ?>">
                                <?php echo $hw_data['subject_codename']; ?></option>
                            
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="first-name-column">ชื่อการบ้าน</label>
                        <input type="text" id="hw-name-column" class="form-control" name="hw-name-column"
                            value="<?php echo $hw_data['hw_name']; ?>" readonly>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="first-name-column">ประเภท</label>
                        <select class="form-select" name="type" id="hw-category" onchange=" hw_category()" disabled>
                            <option value="<?php 
                                if($hw_data['maximumg']==1){
                                    echo "1";
                                }
                                else{
                                    echo "2";
                                }
                                
                                ?>">
                                <?php
                                    if($hw_data['maximumg']==1){
                                        echo "เดี่ยว";
                                    }
                                    else{
                                        echo "กลุ่ม";
                                    }
                                ?>
                            </option>
                            <option value="1">เดี่ยว</option>
                            <option value="2">กลุ่ม</option>
                        </select>
                    </div>
                </div>
                <div id="max_m_form" class="form-group col-12 " <?php
                        if($hw_data['maximumg']>=2){
                            echo'style="Display:block;"';
                        }
                        else if($hw_data['maximumg']==1){
                            echo'style="Display:none;"';
                        }
                    ?>>
                    <label for="max_member">จำนวนสมาชิก: </label>
                    <input id="maxmemg" required name="max_member" class="form-range row-cols-2" type="range"
                        oninput="realtime_mamber_range(this.value)" id="maxmember" min='1' max='50' step="1"
                        value="<?php echo $hw_data['maximumg']; ?>" disabled></label>
                    <span id="maxmember_text" class="text-center"><?php echo $hw_data['maximumg'] ?></span>
                </div>

                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label for="last-name-column">คำสั่ง</label>
                        <textarea class="form-control" name="hw_detail" id="hw_detail" rows="3"
                            readonly><?php echo $hw_data['hw_order']; ?></textarea>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="country-floating">วันที่สั่ง</label>
                        <input type="date" id="assign_date" class="form-control" name="assign_date"
                            value="<?php echo $hw_data['dateassign']; ?>" readonly>
                    </div>
                </div>
                <div class=" col-md-6 col-12">
                    <div class="form-group">
                        <label for="company-column">วันที่ส่ง</label>
                        <input type="date" id="deadline" class="form-control" name="deadline"
                            value="<?php echo $hw_data['date_deadline']; ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <input type="hidden" name="deletefile" value="<?php echo $hw_data['hw_assign_file']; ?>">
                        <label for="fileupload">ไฟล์แนบ: </label>
                        <?php 
                        if($hw_data['hw_assign_file']!=null) {?>
                        <a class="btn d-flex align-content-center justify-content-center" type="button"
                            href="../../upload/hwassign/<?php echo $hw_data['hw_assign_file']; ?>" target="_blank">
                            <div class="row  ">
                                <div class="col-2">
                                    <i class="bi bi-file-earmark" style="font-size: 1.5rem;"></i>
                                </div>
                                <div class=" col-10  " style="font-size: 1.1rem;">
                                    <?php echo $hw_data['hw_assign_file']; ?>
                                </div>
                            </div>
                        </a>
                        <?php
                        }
                        else {
                        ?>
                            <p id="nonefile" class="btn col-12" >ไม่มีไฟล์แนบ</p>
                        <?php
                        }
                        ?>
                        <input type="file" id="files" class="form-control" name="files" style="display: none;" disabled>

                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="hw_level">ระดับการเรียนรู้</label>
                        <input type="text" id="hw_level" class="form-control" name="hw_level"
                            value="<?php echo $hw_data['level']; ?>" readonly>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center ">
                    <a class="btn btn-secondary" onclick="history.back()" > กลับไปสั่งการบ้าน </a>
                </div>
            </div>
        </form>
    </div>

</div>

<?php
function print_option_classroom($conn, $te_id,$hw_c_id)
{
    $sql = "SELECT class.classroom_id,class.classroom_name,te.username 
                FROM `classroom` class
                LEFT JOIN teacher te ON te.teacher_id=class.teacher_id
                WHERE te.username='$te_id'
                ";
    $resault_table = mysqli_query($conn, $sql);
    while ($list = mysqli_fetch_array($resault_table)) {
        if($list['classroom_id']==$hw_c_id) continue;
?>
<option value=" <?php echo $list['classroom_id']; ?>"><?php echo $list['classroom_name']; ?></option>
<?php
    }
}
function print_option_subject($conn, $te_id,$hw_subj_id)
{
    $sql = "SELECT subj.subject_id,subj.subject_codename,subj.teacher_id 
                FROM `subject`subj
                LEFT JOIN teacher te ON te.teacher_id=subj.teacher_id
                WHERE te.username='$te_id'
                ";
    $resault_table = mysqli_query($conn, $sql);
    while ($list = mysqli_fetch_array($resault_table)) {
        if($list['subject_id']==$hw_subj_id) continue;
    ?>
<option value=" <?php echo $list['subject_id']; ?>"><?php echo $list['subject_codename']; ?></option>
<?php
    }
}
?>

<script>
function editfunc() {
    document.getElementById("edit_request").style.display = "none";
    document.getElementById("delete").style.display = "none";
    document.getElementById("cancel_edit_request").style.display = "block";
    document.getElementById("confirm_edit").style.display = "block";
    document.getElementById("files").style.display = "block";
    document.getElementById('select_class_id').removeAttribute('disabled');
    document.getElementById('files').removeAttribute('disabled');
    document.getElementById('select_subj_id').removeAttribute('disabled');
    document.getElementById('hw-category').removeAttribute('disabled');
    document.getElementById('maxmemg').removeAttribute('disabled');
    document.getElementById('hw_level').removeAttribute('readonly');
    document.getElementById('hw_detail').removeAttribute('readonly');
    document.getElementById('hw-name-column').removeAttribute('readonly');
    document.getElementById('hw_detail').removeAttribute('readonly');
    document.getElementById('assign_date').removeAttribute('readonly');
    document.getElementById('deadline').removeAttribute('readonly');
    let nonefile=document.getElementById("nonefile");
    if (nonefile!=null){
        nonefile.style.display = "none";
    }
    
}

function moveon() {
    alert("ยกเลิกการแก้ไขแล้ว");
    window.location = 'index-te.php';
}

//maxmember showing
document.getElementById("maxmember_text").innerHTML = document.getElementById("maxmember").value;

function realtime_mamber_range(maxmember) {
    document.getElementById("maxmember_text").innerHTML = maxmember;
}


//แสดงการแบ่งกลุ่มเมื่อมีงานกลุ่ม

function hw_category() {
    var type = document.getElementById("hw-category").value;
    var max_input = document.getElementById('max_m_form');
    if (type >= 2) {
        max_input.style.display = 'block';
    } else if (type == 1) {
        max_input.style.display = 'none';
    }
}
//เปลี่ยนเวลาของ Deadline ให้ไม่เกิน Aissgn_date
function limit_date() {
    var assign_date = document.getElementById("assign_date").value;
    var input_deadline = document.getElementById("deadline");
    input_deadline.setAttribute('min', assign_date);
}
</script>