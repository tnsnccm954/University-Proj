<?php
require '../../controllers/config.php';
function count_std_f_par($condb, $user_id)
{
    $sql = "
            SELECT COUNT(statment_id) AS count_std 
            FROM `parental_list`
            WHERE parent_id='$user_id'
        ";
    $result = mysqli_query($condb, $sql);
    if ($result) {
        $result = mysqli_fetch_row($result);
        $result = $result[0];
    } else if (!$result) {
        $result = 'ไม่พบข้อมูล';
    }

    return $result;
}
function std_list($condb, $user_id)
{
    $sql = "
            SELECT 
            par_l.parent_id,std.std_id,std.name,std.surname,class.classroom_id,class.classroom_name,te.name,te.surname,te.teacher_tel FROM `parental_list` par_l 
            LEFT JOIN `student` std ON std.std_id=par_l.std_id
            LEFT JOIN `classroom` class ON class.classroom_id=std.classroom_id
            LEFT JOIN `teacher` te ON te.teacher_id=class.teacher_id
            WHERE par_l.parent_id='$user_id';   
        ";
    $result = mysqli_query($condb, $sql);
    return $result;
}
function std_detail($condb,$std_id){
    $sql="SELECT std.std_id,std.name,std.surname,class.classroom_name
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
//hw state
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
    $sql = "SELECT hw.`hw_id`,hw.`hw_name`,hw.`hw_order`,hw.`level`,hw.`date_deadline`,hw.`subject_id`,hw.`classroom_id`,hw.`dateassign`,
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
function sum_hw_std($condb,$std_id){
    
    $sql="SELECT hw.hw_id FROM `homework` hw
    LEFT JOIN student std ON std.classroom_id=hw.classroom_id
    WHERE std.std_id='$std_id';
    ";
    $result_hw=mysqli_query($condb,$sql);
    $result_hw=mysqli_fetch_all($result_hw);
    $sql2="SELECT hw_id FROM `hwgrading`
    WHERE std_id='$std_id'
    ";
    $result_sended=mysqli_query($condb,$sql2);
    $result_sended=mysqli_fetch_all($result_sended);

    $result=array_udiff($result_hw,$result_sended,"udiff");
    $result=count($result);
    return $result;
}
function udiff($result_hw,$result_sended){
    {
    if ($result_hw===$result_sended)
    {
    return 0;
    }
    return ($result_hw>$result_sended)?1:-1;
    }
}
//project state
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