<?php
    //homeworkfunction
    if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['add_subject'])) {
        $subject_id = $_POST['subject_id']??null;
        $subject_codename = $_POST['subject_codename'];
        $subject_name = $_POST['subject_name'];
        $subject_detail = $_POST['subject_detail']; 
        $teacher_id= $_SESSION['user_id'];
        $semester= $_POST['semester'];
        $year = $_POST['year'];
        //echo $subject_id, $subject_codename, $subject_name, $subject_detail, $teacher_id, $semester, $year;
        add_subj($conn, $subject_id, $subject_codename, $subject_name, $subject_detail, $teacher_id, $semester, $year);
    }
    function add_subj($condb, $subject_id, $subject_codename, $subject_name, $subject_detail, $teacher_id, $semester, $year)
    {
        $sql = "INSERT INTO `subject`(`subject_id`, `subject_codename`, `subject_name`, `subject_detail`, `teacher_id`, `semester`, `year`) 
        VALUES ('$subject_id','$subject_codename','$subject_name','$subject_detail','$teacher_id','$semester','$year')";
        $insert_query = mysqli_query($condb, $sql);
        if (!$insert_query) {
            $_SESSION['msg'] = "ทำการเพิ่มข้อมูล ผิดพลาด";
        } else {
            $_SESSION['msg'] = "ทำการเพิ่มข้อมูล เสร็จเรียบร้อย";
        }
        ?>
        <script type="text/javascript">
            alert("<?php echo $_SESSION['msg']; ?>");
            //window.location = 'index_logged-tech.php';
        </script>
    <?php
    }
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['confirm_edit'])) {
        $subject_codename = $_POST['subject_codename']??null;
        $subject_name = $_POST['subject_name'];
        $subject_detail = $_POST['subject_detail']; 
        $subject_id = $_POST['subject_id'];
        $teacher_id = $_POST['teacher_id'];
        $semester= $_POST['semester'];
        $year = $_POST['year'];
        

        edit_subj($conn, $subject_id, $subject_codename, $subject_name, $subject_detail, $teacher_id, $semester, $year);
    }
    function edit_subj($condb, $subject_id, $subject_codename, $subject_name, $subject_detail, $teacher_id, $semester, $year)
    {   
        $sql = "UPDATE `subject` 
        SET `subject_id`='[$subject_id]',
        `subject_codename`='[$subject_codename]',
        `subject_name`='[$subject_name]',
        `subject_detail`='[$subject_detail]',
        `teacher_id`='[$teacher_id]',
        `semester`='[$semester]',
        `year`='[$year]'
        WHERE subject_id='$subject_id'
        ";
        $update_query = mysqli_query($condb, $sql);
        if (!$update_query) {
            $_SESSION['msg'] = "ทำการแก้ไขข้อมูล ผิดพลาด";
        } else {
            $_SESSION['msg'] = "ทำการแก้ไขข้อมูล เสร็จเรียบร้อย";
        }
        ?>
        <script type="text/javascript">
            alert("<?php echo $_SESSION['msg'] ?>");
            window.location = 'index_logged-tech.php'
        </script>
    <?php
    }
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['delete'])) {
        $hw_id = $_POST['subject_id'];
        delete($conn,$subject_id);
    }
    function delete($condb,$subject_id){
        $sql_delete="DELETE
        FROM `subject` 
        WHERE subject_id='$subject_id'";
        $delete_query = mysqli_query($condb, $sql_delete);
        $sql_after_delete="ALTER TABLE `subject`  AUTO_INCREMENT = 1";
        $after_delete_query=mysqli_query($condb, $sql_after_delete);
        if (!$delete_query&&!$after_delete_query) {
            $_SESSION['msg'] = "ทำการลบข้อมูล ผิดพลาด";
        } else {
            $_SESSION['msg'] = "ทำการลบข้อมูล เสร็จเรียบร้อย";
        }
        ?>
        <script type="text/javascript">
            alert("<?php echo $_SESSION['msg'] ?>");
            window.location = 'index_logged-tech.php'
        </script>
    <?php
    }
    ?>
    