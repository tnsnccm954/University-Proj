<?php

require_once "../../controllers/config.php";
session_start();

$hw_id=$_POST['hw_id'];
$stu_id=$_SESSION['user_id'];
$hw_type=$_POST['hw_type'];
if($hw_type!=2){
    $pname="HW_ID".$hw_id."-".$_FILES['files']['name'];

    $tname=$_FILES['files']['tmp_name'];

    $uploads_dir ='../../upload/hwans';

        move_uploaded_file($tname,$uploads_dir.'/'.$pname);
        
        $sql ="INSERT INTO `hwgrading`(`hw_id`,`std_id`,`hw_file`) VALUES ('$hw_id','$stu_id','$pname')";
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
<?php
}
elseif ($hw_type==2){
    $group_id=$_POST['group_id'];
    $pname="HW_ID".$hw_id."-".$_FILES['files']['name'];

    $tname=$_FILES['files']['tmp_name'];

    $uploads_dir ='../../upload/hwans';

        move_uploaded_file($tname,$uploads_dir.'/'.$pname);
        
        $sql ="INSERT INTO `hwgrading`(`hw_id`,`std_id`,`hw_file`,`group_id`) VALUES ('$hw_id','$stu_id','$pname','$group_id')";
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
        <?php
}
?>