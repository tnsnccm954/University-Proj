<?php
    include '../../controllers/config.php';
    $proj_id=$_GET['proj_id'];
    $sql="DELETE FROM `hwproject`
    WHERE `proj_id`='$proj_id'";
    $delete_proj_query=mysqli_query($conn,$sql);
    if (!$delete_proj_query) {
        $_SESSION['msg'] = "ลบข้อมูล ผิดพลาด";
    } else {
        $_SESSION['msg'] = "ลบข้อมูล เสร็จเรียบร้อย";
    }
    ?>
    <script type="text/javascript">
        alert("<?php echo $_SESSION['msg'] ?>");
        window.location = '../../view/teacher/index-te.php'
    </script>