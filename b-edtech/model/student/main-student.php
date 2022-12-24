<?php
require '../../routes/web.php';
include $controller."config.php";
function std_detail($condb,$std_id){
    $sql="SELECT std.std_id,std.name,std.surname,class.classroom_id,class.classroom_name
    FROM `student` std
    LEFT JOIN classroom class ON class.classroom_id=std.classroom_id
    WHERE std.std_id=$std_id";
    $result=mysqli_query($condb,$sql);
    if(mysqli_num_rows($result)>=1){
        $result=mysqli_fetch_assoc($result);
        return $result;
    }
    else
    {
        $_SESSION['msg'] = "ไม่พบข้อมูลผู้เรียน";
        ?>
        <script type="text/javascript">
            alert("<?php echo $_SESSION['msg'] ?>");
            window.location = 'index-Parent.php'
        </script>
        <?php
    }
}
function card_subj_hw($condb,$class_id){
    $sql="SELECT *,COUNT(hw.subject_id) sum_hw
    FROM `homework` hw
    LEFT JOIN subject subj ON subj.subject_id=hw.subject_id
    WHERE classroom_id=$class_id
    GROUP BY subj.subject_id
    ";
    $result=mysqli_query($condb,$sql);
    return $result;
}
function card_subj_proj($condb, $class_id)
{
    $sql = "SELECT * FROM `hwproject`
    LEFT JOIN subject subj ON subj.subject_id=hwproject.subject_id
    WHERE hwproject.classroom_id=$class_id
    ";
    $result=mysqli_query($condb,$sql);
    return $result;
}
function sum_hw_per_proj($condb,$proj_id)
{
    $sql="SELECT *,COUNT(worklist_id) sum_wl FROM `worklist_proj`
    WHERE proj_id=$proj_id;";
    $result=mysqli_query($condb,$sql);
    $result=mysqli_fetch_array($result);
    $result=$result['sum_wl'];
    return $result;
}
function table_subj_hw($condb, $std_id)
{
    $sql = "
        SELECT hw.`hw_id`,hw.`hw_name`,hw.`hw_order`,hw.`level`,hw.`date_deadline`,hw.`subject_id`,hw.`classroom_id`,hw.`dateassign`,
    stu.std_id,stu.classroom_id,
    class.classroom_id,
    subj.subject_id,subj.subject_codename,subj.subject_name
    FROM `homework` hw
    LEFT JOIN student stu ON stu.classroom_id =hw.`classroom_id`
    LEFT JOIN classroom class ON class.classroom_id = stu.classroom_id
    LEFT JOIN subject subj ON hw.`subject_id` = subj.subject_id
    WHERE stu.std_id='$std_id' 
    GROUP BY hw.subject_id
    ORDER BY `subj`.`subject_id`
    ";
    $result=mysqli_query($condb,$sql);
    return $result;
}
function std_per_subj_hw($condb, $std_id, $subj_id)
{
    $sql = "SELECT hw.hw_id,hw.hw_name,hw.hw_order,hw.level,hw.date_deadline,hw.subject_id,hw.classroom_id,hw.dateassign,hw.maximumg,
        stu.std_id,stu.classroom_id,
        class.classroom_id,
        subj.subject_id,subj.subject_codename
        FROM `homework` hw
        LEFT JOIN student stu ON stu.classroom_id =hw.`classroom_id`
        LEFT JOIN classroom class ON class.classroom_id = stu.classroom_id
        LEFT JOIN subject subj ON hw.`subject_id` = subj.subject_id
        WHERE stu.std_id='$std_id' AND hw.subject_id='$subj_id'  
        ORDER BY `subj`.`subject_id` ASC,hw.date_deadline";
    $result = mysqli_query($condb, $sql);
    return $result;
}
function hw_status($condb, $hw_id, $std_id)
{
    $sql = "
        SELECT * 
        FROM `hwgrading`
        WHERE std_id='$std_id' AND hw_id='$hw_id'
        ";
    $result= mysqli_query($condb,$sql);
    $result= mysqli_fetch_row($result);
    if(isset($result)){
        $hw_status="sended";
    }
    else{
        $hw_status="unsent";
    }
    return $hw_status;
}
function hwg_status($condb,$hw_id,$std_id)
{
    $sql="SELECT hwg.group_id,hwg.group_name,hwg.hw_id,hwg.std_id
    ,hwgrading.score,hwgrading.hw_file
    FROM `hw_group_member` hwg
    INNER JOIN hwgrading ON hwg.group_id=hwgrading.group_id
    WHERE hwg.std_id='$std_id' AND hwgrading.hw_id='$hw_id'
    ";
    $result= mysqli_query($condb,$sql);
    $result= mysqli_fetch_row($result);
    if(isset($result)){
        $hw_status="sended";
    }
    else{
        $hw_status="unsent";
    }
    return $hw_status;
}
function table_hw_per_subj($condb,$subj_id){
    $sql="SELECT *
    FROM `homework` hw
    LEFT JOIN subject subj ON subj.subject_id=hw.subject_id
    WHERE hw.subject_id=$subj_id
    ";
    $result=mysqli_query($condb,$sql);
    return $result;
}
function subj_detail($condb,$subj_id){
    $sql="SELECT * 
    FROM `subject`
    WHERE subject_id=$subj_id
    ";
    $result=mysqli_query($condb,$sql);
    return $result;
}
?>