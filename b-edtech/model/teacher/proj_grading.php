<?php
    include "../../controllers/config.php";
    $proj_id=$_POST['proj_id'];
    $scored=$_POST['scored'];
    $worklist_id=$_POST['worklist_id'];
    $group_id=$_POST['group_id'];
    //echo "wl_id:".$worklist_id."_scored_".$scored;
    $sql="UPDATE `hwproj_grading`
    SET `scored` = '$scored' 
    WHERE worklist_id='$worklist_id' AND group_id='$group_id'
    ";
    $update_query = mysqli_query($conn, $sql);
    if (!$update_query) {
        $_SESSION['msg'] = "ทำการเพิ่ม/แก้ไข ผิดพลาด";
    } else {
        $_SESSION['msg'] = "ทำการเพิ่ม/แก้ไข เสร็จเรียบร้อย";
    }
    ?>
    <script type="text/javascript">
        alert("<?php echo $_SESSION['msg'] ?>");
        window.location = '../../view/teacher/hwproject_grading_check_score_te.php?proj_id=<?php echo $proj_id ?>&group_id=<?php echo $group_id?>'
    </script>