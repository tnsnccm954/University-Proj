<?php

require_once "../../controllers/config.php";
session_start();

$worklist_id=$_POST['worklist_id'];
$stu_id=$_POST['stu_username'];
$group_id=$_POST['group_id'];
$pname="Proj-".$worklist_id."_g_".$group_id."_".$_FILES['files']['name'];

$tname=$_FILES['files']['tmp_name'];

$uploads_dir ='../../upload/hw_proj';

    move_uploaded_file($tname,$uploads_dir.'/'.$pname);
 //
    $sql ="INSERT INTO `hwproj_grading`( `worklist_id`, `group_id`, `proj_file`) VALUES ('$worklist_id','$group_id','$pname')";
    $upload=mysqli_query($conn,$sql);
    if (!isset($upload)) {
        $_SESSION['msg'] = "ทำการอัพโหลดข้อมูล ผิดพลาด";
    } else {
        $_SESSION['msg'] = "ทำการอัพโหลดข้อมูล เสร็จเรียบร้อย";
    }
    ?>
    <script type="text/javascript">
        alert("<?php echo $_SESSION['msg']; ?>");
        window.location = '../../view/student/index_logged-std.php';
    </script>
