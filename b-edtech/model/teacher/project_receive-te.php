<?php

    include "../../controllers/config.php";
    $classcode=$_POST['class_code'];
    $subj_code=$_POST['subj_code'];
    $proj_n=$_POST['proj_name'];
    $max_member=$_POST['max_member'];
    $proj_detail=$_POST['proj_detail'];
    $proj_date_assign=$_POST['real_dateassign'];
    add_hw_proj($conn,$classcode,$subj_code,$proj_n,$max_member,$proj_detail,$proj_date_assign);
    function add_hw_proj($conn,$classcode,$subj_code,$proj_n,$max_member,$proj_detail,$proj_date_assign){
        //type_proj
        $type_proj=$_POST['type_proj'];
        if(isset($type_proj)){
            //p1
            if(isset($_POST['p1_work_detail']) && isset($_POST['p2_work_detail'])){
            $p1_work_detail=$_POST['p1_work_detail'];
            $p1_max_point=$_POST['p1_max_point'];
            $proj_p1_date=$_POST['p1_dateassign'];
            
            //p2
            $p2_work_detail=$_POST['p2_work_detail'];
            $p2_max_point=$_POST['p2_max_point'];
            $proj_p2_date=$_POST['p2_dateassign'];
            
            //p3 if choose
            if($type_proj==3){
                $p3_work_detail=$_POST['p3_work_detail'];
                $p3_max_point=$_POST['p3_max_point'];
                $proj_p3_date=$_POST['p3_dateassign'];
                
                }
            }
            else{
                $_SESSION['msg'] ="คุณใส่ระยะงานไม่ครบ";
            }
        }
        else{
            $_SESSION['msg'] ="คุณยังไม่ได้เลือกระยะงาน";
        }
        $check_proj="SELECT `proj_id`,
        `hwproj_name`,
        `classroom_id`,
        `subject_id`,
        `date_assign`,
        count(proj_id) record 
        FROM `hwproject` 
        WHERE
        classroom_id='$classcode' AND 
        subject_id='$subj_code'";
        $check_proj_query=mysqli_query($conn,$check_proj);
        $check_proj_array=mysqli_fetch_array($check_proj_query);
        if($check_proj_array['record']>=1){
            $subj_name="SELECT subject_id,subject_codename,subject_name 
            FROM `subject`
            WHERE subject_id='$subj_code'
            ";
            $print_subj_n=mysqli_query($conn,$subj_name);
            $suj_n_array=mysqli_fetch_array($print_subj_n);
            $_SESSION['msg'] = "วิชา ".$suj_n_array['subject_name']." ทำการเพิ่มข้อมูลไปแล้ว/สั่งโปรเจคของเทอมนี้แล้ว";
        }
        else{
            $sql1="INSERT INTO `hwproject`(`hwproj_name`, `proj_detail`, `type`, `maximumg`, `classroom_id`, `subject_id`, `date_assign`) 
            VALUES ('$proj_n','$proj_detail','$type_proj','$max_member','$classcode','$subj_code','$proj_date_assign')";
            $insert_query = mysqli_query($conn, $sql1);
            if (!$insert_query) {
                $_SESSION['msg'] = "ทำการเพิ่มข้อมูล ผิดพลาด";
            } else {
                $_SESSION['msg'] = "ทำการเพิ่มข้อมูล เสร็จเรียบร้อย";
            }
            $sql2="SELECT `proj_id`,
            `hwproj_name`,
            `classroom_id`,
            `subject_id`,
            `date_assign` 
            FROM `hwproject` 
            WHERE hwproj_name='$proj_n' AND 
            classroom_id='$classcode' AND 
            subject_id='$subj_code' AND 
            date_assign='$proj_date_assign' ";
            
            $result=mysqli_query($conn,$sql2);
            $array_result=mysqli_fetch_assoc($result);
            $proj_id=$array_result['proj_id'];

            for ($i=0;$i<count($p1_work_detail);$i++){
                $insert_wl="INSERT INTO `worklist_proj`(`proj_id`, `phase`, `work_detail`, `max_score`, `date_deadline`) 
                VALUES ('$proj_id','1','$p1_work_detail[$i]','$p1_max_point[$i]','$proj_p1_date')";
                mysqli_query($conn,$insert_wl);
            }
            for ($i=0;$i<count($p2_work_detail);$i++){
                $insert_wl="INSERT INTO `worklist_proj`(`proj_id`, `phase`, `work_detail`, `max_score`, `date_deadline`) 
                VALUES ('$proj_id','2','$p2_work_detail[$i]','$p2_max_point[$i]','$proj_p2_date')";
                mysqli_query($conn,$insert_wl);
            }
            if($type_proj==3){
                for ($i=0;$i<count($p3_work_detail);$i++){
                    $insert_wl="INSERT INTO `worklist_proj`(`proj_id`, `phase`, `work_detail`, `max_score`, `date_deadline`) 
                    VALUES ('$proj_id','3','$p3_work_detail[$i]','$p3_max_point[$i]','$proj_p3_date')";
                    mysqli_query($conn,$insert_wl);
                }
            }
        }
        ?>
        
        <script type="text/javascript">
            alert("<?php echo $_SESSION['msg']; ?>");
            window.location = '../../view/teacher/index-te.php';
        </script>
    <?php
    }
    ?>