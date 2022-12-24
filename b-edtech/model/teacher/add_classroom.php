<?php
require "../../routes/web.php";
require "../../controllers/config.php";
$te_id=$_SESSION['user_id'];
$class_codename=$_POST['class_codename'];
$subj_id=$_POST['subj_id'];

$sql_add_class="INSERT INTO `classroom`( `classroom_name`, `teacher_id`) VALUES ('$class_codename','$te_id')";
$add_class=mysqli_query($conn,$sql_add_class);

if($add_class){
    $sql_fetch_id="SELECT `classroom_id`, `classroom_name` FROM `classroom` WHERE classroom_name='$class_codename'";
    $fetch_id=mysqli_query($conn,$sql_fetch_id);
    $fetch_id=mysqli_fetch_assoc($fetch_id);
    $class_id=$fetch_id['classroom_id'];
    $sql_add_class_in_subj="INSERT INTO `classroom_subj_list`(`classroom_id`, `subject_id`) VALUES ('$class_id','$subj_id')";
    $pair_newclass=mysqli_query($conn,$sql_add_class_in_subj);
    if (!$pair_newclass) {
        $_SESSION['msg'] = "ทำการเพิ่มข้อมูล ผิดพลาด";
    } else {
        $_SESSION['msg'] = "ทำการเพิ่มข้อมูล เสร็จเรียบร้อย";
    }
    ?>
    <script type="text/javascript">
        alert("<?php echo $_SESSION['msg']; ?>");
        window.location = '../../view/teacher/index-te.php';
    </script>
<?php
}
else {
    $_SESSION['msg'] = "ทำการเพิ่มข้อมูล ผิดพลาด";
    ?>
    <script type="text/javascript">
        alert("<?php echo $_SESSION['msg']; ?>");
        window.location = '../../view/teacher/index-te.php';
    </script>
<?php
}

