<?php
require '../../controllers/config.php';

//model hw_detail
$sql_hwdetail="SELECT * 
FROM `homework` hw
LEFT JOIN `subject` subj ON subj.subject_id=hw.subject_id 
WHERE hw_id=$hw_id";
$hw_detail=mysqli_query($conn,$sql_hwdetail);
if(mysqli_num_rows($hw_detail)>=1){
    //echo "success";
    $hw_detail_status=1;
    $hw_detail=mysqli_fetch_assoc($hw_detail);
    $class_id=$hw_detail['classroom_id'];
}
else {
    echo "none";
    $hw_detail_status=0;
}
//model std_ungroup_member_table
$sql_std_ungroup="SELECT std.std_id,std.name,std.surname FROM `student` std
LEFT JOIN hw_group_member hwg_member ON hwg_member.std_id= std.std_id
WHERE classroom_id=$class_id AND hwg_member.std_id IS NULL";
$std_ungroup=mysqli_query($conn,$sql_std_ungroup);

//model group_hwg
function hwg_group($condb,$hw_id){
    $sql_hwg_group="SELECT group_id,group_name FROM `hw_group_member` WHERE hw_id=$hw_id GROUP BY group_id;";
    $hwg_group=mysqli_query($condb,$sql_hwg_group);
    return $hwg_group;
}
//model std_member_grouped
function member_hwg($condb,$group_id){
    $sql_std_grouped="SELECT std.std_id,std.name,std.surname 
    FROM `hw_group_member` hwg_mem
    LEFT JOIN student std ON std.std_id=hwg_mem.std_id
    WHERE group_id=$group_id
    ";
    $std_member=mysqli_query($condb,$sql_std_grouped);
    return $std_member;
}
function hw_grading_detail($condb,$hw_id,$group_id){
    $sql_hw_grading_detail="SELECT * FROM `hwgrading` WHERE hw_id=$hw_id AND group_id=$group_id";
    $hw_grading_detail=mysqli_query($condb,$sql_hw_grading_detail);
    return $hw_grading_detail;
}
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['add_score'])){
    $hw_id=$_POST['hw_id'];
    $group_id=$_POST['group_id'];
    $score=$_POST['score'];
    edit_score($conn,$hw_id,$group_id,$score);
}
function edit_score($condb,$hw_id,$group_id,$score){
    $sql="UPDATE `hwgrading` SET `score`=$score WHERE hw_id=$hw_id AND group_id=$group_id";
    $result=mysqli_query($condb,$sql);
    if (!$result) {
        $_SESSION['msg'] = "มีข้อผิดพลาดในการให้คะแนน";
    } else {
        $_SESSION['msg'] = "ให้คะแนนเสร็จเรียบร้อย";
    }
    ?>
    <script type="text/javascript">
        alert("<?php echo $_SESSION['msg']; ?>");
        window.location = 'index-te.php';
    </script>
    <?php
}
?>
