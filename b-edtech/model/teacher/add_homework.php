<?php
require "../../controllers/config.php";
require "../../controllers/hw_management.php";


function print_add_homework_per_class($condb){
    
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
<div class=" d-lg-flex justify-content-center">

    <div class="card col-lg-5 col-12 mx-3">
        <div class="m-3">
            <div class="card">
            <div class="text-center" ><h5>การบ้านของห้องเรียน : <?php echo $class_name; ?></h5></div>
            <?php
                $subj_header=subj_hw_this_class($condb,$class_id);
                $j=0;
                if(mysqli_num_rows($subj_header)>=1){
                    while ($subj_col_head=mysqli_fetch_assoc($subj_header)){
            ?>
            <div class="alert alert-primary mx-2">
                <div class="row">
                    <div class="col-12 d-lg-flex justify-content-end ">
                        
                        <a class="btn  disabled col-12 col-lg-6 m-1">
                            <?php echo $subj_col_head['subject_name']; ?>
                        </a>
                        <button class="btn btn-secondary col-12 col-lg-3 m-1" type="button" data-bs-toggle="collapse"
                            data-bs-target="#memberlist-<?php echo $subj_col_head['subject_id'];?>"
                            aria-expanded="false" aria-controls="memberlist-<?php echo $subj_col_head['subject_id'];?>">
                            การบ้านที่ถูกสั่ง
                        </button>
                        
                    </div>
                </div>
            </div>
            <div class="collapse mx-3 " id="memberlist-<?php echo $subj_col_head['subject_id'];?>">
                <div class="card card-body mb-0 ">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>ชื่อการบ้าน</th>
                                <th>รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $hw_per_subj=hw_per_subj($condb,$subj_col_head['subject_id']);
                            if(mysqli_num_rows($hw_per_subj)>=1){
                                $i=0;
                                while ($tb_hw_per_subj=mysqli_fetch_assoc($hw_per_subj)){
                                $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $tb_hw_per_subj['hw_name']; ?></td>
                                <td><a class="btn btn-info col-12 " href="only_view_tech_hw_info.php?hw_id=<?php echo $tb_hw_per_subj['hw_id']; ?>" >รายละเอียด</a></td>
                            </tr>
                            <?php
                               }
                            }
                            ?>
                        </tbody>
                        <caption class="text-end">จำนวนการบ้าน :
                            <?php echo $i;
                            $j+=$i;
                            ?> ชิ้น</caption>

                    </table>
                </div>
                
            </div>
            <?php
                }
            }
            else{
                ?>
            <h5 class="text-center">ยังไม่มีการสั่งการบ้าน</h5>
            <?php
            }  
            ?>
            <div class="text-center" > การบ้านทั้งหมด : <?php echo $j; ?> ชิ้น</div>
            
        </div>
        </div>
    </div>
    <div class="card col-lg-5 col-12 mx-3">
        <div class="card-body ">
            <h2 class="card-title text-center text-lg-start  ">รายละเอียดการบ้าน</h2>
            <form class="form" method="POST" enctype="multipart/form-data">
                <div class="row m-3">
                    <div class="col-md-6 col-12 ">
                        <div class="form-group">
                            <label for="first-name-column">ห้องเรียน</label>
                            <input type="hidden" name="select_class_id" id="select_class_id"
                                value="<?php echo $class_id?>">
                            <input type="text" class="form-control" value="<?php echo $class_name?>" readonly>

                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="first-name-column">วิชา</label>
                            <input type="hidden" name="select_subj_id" id="select_subj_id"
                                value="<?php echo $data['subject_id'] ?>">
                            <input type="text" class="form-control" value="<?php echo $subject_codename?>" readonly>

                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="first-name-column">ชื่อการบ้าน</label>
                            <input type="text" id="hw-name-column" class="form-control" name="hw-name-column">
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="first-name-column">ประเภท</label>
                            <select class="form-select" name="type" id="hw-category" onchange=" hw_category()">
                                <option value="1">เดี่ยว</option>
                                <option value="2">กลุ่ม</option>
                            </select>
                        </div>
                    </div>
                    <div id="max_m_form" class="form-group col-12 " style="display: none;">
                        <label for="max_member">จำนวนสมาชิก: </label>
                        <input required name="max_member" class="form-range row-cols-2" type="range"
                            oninput="realtime_mamber_range(this.value)" id="maxmember" min='2' max='50' step="1"
                            value="1"></label><span id="maxmember_text" class="text-center">2</span>
                    </div>


                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="last-name-column">คำสั่ง</label>
                            <textarea class="form-control" name="hw_detail" id="exampleFormControlTextarea1"
                                rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="files">ไฟล์แนบ</label>
                            <input type="file" id="files" class="form-control" name="files">
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="hw_level">ระดับการเรียนรู้</label>
                            <select class="form-control" id="hw_level" name='hw_level'>
                                <option selected>Choose...</option>
                                <option value="1">การจำ</option>
                                <option value="2">การเข้าใจ</option>
                                <option value="3">การประยุกต์ใช้</option>
                                <option value="4">การวิเคราะห์</option>
                                <option value="5">การประเมินผล</option>
                                <option value="6">การสร้างสรรค์</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <label for="country-floating">วันที่สั่ง</label>
                        <input type="date" id="assign_date" class="form-control" name="assign_date"
                            min="<?php echo date("Y-m-d");?>" onchange="limit_date()">
                    </div>
                    <div class=" col-md-6 col-12">
                        <label for="company-column">วันที่ส่ง</label>
                        <input type="date" id="deadline" class="form-control" name="deadline"
                            min="<?php echo date("Y-m-d");?>">
                    </div>


                    <div class="mt-3 col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1" name="add_homework">สั่งโลด</button>
                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                    </div>
                </div>
            </form>
        </div>

    </div>


</div>

<?php
    }
/* //การสั่งการบ้านแบบระบุห้องเรียนเอง
function print_add_homework($conn){
    $te_id = $_SESSION['username'];
    ?>
<div class="card ">
    <div class="card-body">
        <h2 class="card-title ">รายละเอียดการบ้าน</h2>
        <form class="form" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label for="first-name-column">ห้องเรียน</label>
                        <select class="form-select" name="select_class_id" id="select_class_id">
                            <option>select</option>
                            <?php print_option_classroom($conn, $te_id) ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="first-name-column">ชื่อการบ้าน</label>
                        <input type="text" id="hw-name-column" class="form-control" name="hw-name-column">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="first-name-column">วิชา</label>
                        <select class="form-select" name="select_subj_id" id="select_subj_id">
                            <option>select</option>
                            <?php print_option_subject($conn, $te_id) ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label for="last-name-column">คำสั่ง</label>
                        <textarea class="form-control" name="hw_detail" id="hw_detail" rows="3"></textarea>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="files">ไฟล์แนบ</label>
                        <input type="file" id="files" class="form-control" name="files">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="hw_level">ระดับการเรียนรู้</label>
                        <select class="form-control" id="hw_level" name='hw_level'>
                            <option selected>Choose...</option>
                            <option value="1">การจำ</option>
                            <option value="2">การเข้าใจ</option>
                            <option value="3">การประยุกต์ใช้</option>
                            <option value="4">การวิเคราะห์</option>
                            <option value="5">การประเมินผล</option>
                            <option value="6">การสร้างสรรค์</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="country-floating">วันที่สั่ง</label>
                        <input type="date" id="assign_date" class="form-control" name="assign_date"
                            min="<?php echo date("Y-m-d");?>">
                    </div>
                </div>
                <div class=" col-md-6 col-12">
                    <div class="form-group">
                        <label for="company-column">วันที่ส่ง</label>
                        <input type="date" id="deadline" class="form-control" name="deadline"
                            min="<?php echo date("Y-m-d");?>">
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-1 mb-1" name="add_homework">สั่งโลด</button>
                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                </div>
            </div>
        </form>
    </div>

</div><?php
}*/
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
function subj_hw_this_class($conn,$class_id){
    $sql="SELECT hw.subject_id,subj.subject_codename,subj.subject_name FROM `homework` hw
    LEFT JOIN subject subj ON subj.subject_id=hw.subject_id
    WHERE hw.classroom_id=$class_id
    GROUP BY hw.subject_id";
    $result=mysqli_query($conn,$sql);
    return $result;
}
function hw_per_subj($conn,$subj_id){
    $sql="SELECT * FROM `homework`
    WHERE subject_id = $subj_id";
    $result=mysqli_query($conn,$sql);
    return $result;
}
?>


<script>
//maxmember showing
document.getElementById("maxmember_text").innerHTML = document.getElementById("maxmember").value;

function realtime_mamber_range(maxmember) {
    document.getElementById("maxmember_text").innerHTML = maxmember;
}
//แสดงการแบ่งกลุ่มเมื่อมีงานกลุ่ม
function hw_category() {
    var type = document.getElementById("hw-category").value;
    var max_input = document.getElementById('max_m_form');
    if (type == 2) {
        max_input.style.display = 'block';
    }
    else{
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