<?php
//homeworkfunction
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['add_homework'])) {
        $hw_name_r = $_POST['hw-name-column']??null;
        $hw_order_r = $_POST['hw_detail'];
        $hw_level_r = $_POST['hw_level']; 
        $hw_deadline_r = $_POST['deadline'];
        $hw_subject_id = $_POST['select_subj_id'];
        $hw_classroom_id = $_POST['select_class_id'];
        $hw_dateassign_r = $_POST['assign_date'];
        if($_POST['type']>=2) $hwg_max_member =$_POST['max_member'];
        else $hwg_max_member=1;
        $check_file=$_FILES['files'];
        if($check_file['name']!=null){
            
            $pname="Hw-".$_FILES['files']['name'];
            $tname=$_FILES['files']['tmp_name'];
            $uploads_dir ='../../upload/hwassign';
            move_uploaded_file($tname,$uploads_dir.'/'.$pname);
        }
        else{
            $pname=null;
        }
        //echo $hw_name_r. $hw_order_r. $hw_deadline_r. $hw_subject_id. $hw_classroom_id. $hw_dateassign_r;
        add_hw($conn, $hw_name_r, $hw_order_r, $hw_deadline_r, $hw_subject_id, $hw_classroom_id, $hw_dateassign_r,$pname,$hw_level_r,$hwg_max_member);
    }
function add_hw($condb, $hw_name_r, $hw_order_r, $hw_deadline_r, $hw_subject_id, $hw_classroom_id, $hw_dateassign_r,$pname_r,$hw_level_r,$hwg_max_member)
    {
        $sql = "INSERT INTO `homework`( `hw_name`, `hw_order`, `date_deadline`, `subject_id`, `classroom_id`, `dateassign`,`hw_assign_file`,`level`,`maximumg`) 
        VALUES ('$hw_name_r','$hw_order_r','$hw_deadline_r','$hw_subject_id','$hw_classroom_id','$hw_dateassign_r','$pname_r',$hw_level_r,$hwg_max_member)";
        $insert_query = mysqli_query($condb, $sql);
        if (!$insert_query) {
            $_SESSION['msg'] = "ทำการเพิ่มข้อมูล ผิดพลาด";
        } else {
            $_SESSION['msg'] = "ทำการเพิ่มข้อมูล เสร็จเรียบร้อย";
        }
        ?>
        <script type="text/javascript">
            alert("<?php echo $_SESSION['msg']; ?>");
            window.location = 'index-te.php';
        </script>
    <?php
    }
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['confirm_edit'])) {
        $hw_id = $_POST['hw_id'];
        $hw_name_r = $_POST['hw-name-column'];
        $hw_order_r = $_POST['hw_detail'];
        $hw_level_r = $_POST['hw_level']??1; 
        $hw_deadline_r = $_POST['deadline'];
        $hw_subject_id = $_POST['select_subj_id'];
        $hw_classroom_id = $_POST['select_class_id'];
        $hw_dateassign_r = $_POST['assign_date'];
        $uploads_dir ='../../upload/hwassign/';
        $delete_file=$_POST['deletefile'];
        
        $check_del=file_exists($uploads_dir.$delete_file);
        if($check_del==1&&$delete_file!=null){
            $sql_delete_file_dir="UPDATE `homework` SET `hw_assign_file`=null WHERE hw_id='$hw_id'";
            mysqli_query($conn,$sql_delete_file_dir);
            unlink($uploads_dir.$delete_file);
        }
        else{
            $pname=null;
        }
        if(!empty($_FILES['files']['name'])){
            
            $pname="Hw-".$_FILES['files']['name'];
            $tname=$_FILES['files']['tmp_name'];
            $uploads_dir ='../../upload/hwassign';
            move_uploaded_file($tname,$uploads_dir.'/'.$pname);
            //echo "uploaded";
        }
        else{
            $pname=null;
        }
        edit_hw($conn,$hw_id, $hw_name_r, $hw_order_r, $hw_deadline_r, $hw_subject_id, $hw_classroom_id, $hw_dateassign_r,$pname,$hw_level_r);
    }
function edit_hw($condb,$hw_id, $hw_name_r, $hw_order_r, $hw_deadline_r, $hw_subject_id, $hw_classroom_id, $hw_dateassign_r,$pname_r,$hw_level_r)
    {   
        $sql = "UPDATE `homework`
        SET `hw_name`='$hw_name_r',
        `hw_order`='$hw_order_r',
        `date_deadline`='$hw_deadline_r',
        `subject_id`='$hw_subject_id',
        `classroom_id`='$hw_classroom_id',
        `dateassign`='$hw_dateassign_r',
        `hw_assign_file`='$pname_r',
        `level`='$hw_level_r'
        WHERE hw_id='$hw_id'
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
            //window.location = 'index-te.php'
        </script>
    <?php
    }
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['delete'])) {
        $hw_id = $_POST['hw_id'];
        delete($conn,$hw_id);
    }
function delete($condb,$hw_id){
        $sql_find_d_file="SELECT hw_assign_file FROM `homework` WHERE hw_id='$hw_id' ";
        $result=mysqli_query($condb,$sql_find_d_file);
        print_r($result);
        $result=mysqli_fetch_array($result);
        print_r($result);
        $uploads_dir ='../../upload/hwassign/';
        $del_file=$result['hw_assign_file'];
        $check_del=file_exists($uploads_dir.$del_file);
        if($check_del==1&&$del_file!=null){
            unlink($uploads_dir.$del_file);
        }
        $sql_delete="DELETE
        FROM `homework` 
        WHERE hw_id='$hw_id'";
        $delete_query = mysqli_query($condb, $sql_delete);
        $sql_after_delete="ALTER TABLE `homework`  AUTO_INCREMENT = 1";
        $after_delete_query=mysqli_query($condb, $sql_after_delete);
        if (!$delete_query&&!$after_delete_query) {
            $_SESSION['msg'] = "ทำการลบข้อมูล ผิดพลาด";
        } else {
            $_SESSION['msg'] = "ทำการลบข้อมูล เสร็จเรียบร้อย";
        }
        ?>
        <script type="text/javascript">
            alert("<?php echo $_SESSION['msg'] ?>");
            window.location = 'index-te.php'
        </script>
    <?php
    }
    ?>
    