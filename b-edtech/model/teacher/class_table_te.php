<?php
    require_once "../../controllers/config.php";
    $subject_codename=$_SESSION['subj_codename']??null;
    $sql="SELECT * 
        FROM `subject` subj 
        WHERE subj.subject_codename='$subject_codename'
        ";
    $result_receive_subj=mysqli_query($conn,$sql);
    $data=mysqli_fetch_array($result_receive_subj);

    function print_class_tb($condb,$subject_codename){
        $sql_classtable="SELECT  class.classroom_id,class.classroom_name,subj.subject_codename,subj.subject_name,te.username 
        FROM `classroom_subj_list`
        LEFT JOIN `classroom` class ON class.classroom_id=classroom_subj_list.classroom_id
        LEFT JOIN `subject` subj ON subj.subject_id=classroom_subj_list.subject_id
        LEFT JOIN `teacher` te ON te.teacher_id=subj.teacher_id
        WHERE subject_codename='$subject_codename'
        ";
        $resault_table=mysqli_query($condb,$sql_classtable);
        ?>
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>รหัสห้องเรียน</th>
                        <th class="text-center" colspan="3" >การทำงาน</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                if(isset($resault_table)){
                    $i = 1;
                    while ($list_class = mysqli_fetch_array($resault_table) ) {
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $list_class['classroom_name']; ?></td>
                        
                        <td>
                            <a href="../../view/teacher/index_logged-tech_add-hw.php?classroom_id=<?php echo $list_class['classroom_id'] ?>&classroom_name=<?php echo $list_class['classroom_name'] ?>" class="btn btn-info col-md-12">สั่งการบ้าน</a>
                        </td>
                        <td>
                            <a href="../../view/teacher/index_logged-tech_hw_list_this_card.php?classroom_id=<?php echo $list_class['classroom_id'] ?>&classroom_name=<?php echo $list_class['classroom_name'] ?>" class="btn btn-secondary col-md-12">ตรวจการบ้าน</a>
                        </td>
                        <td>
                            <a href="../../view/teacher/view_tech_std_list_per_subj.php?classroom_id=<?php echo $list_class['classroom_id'] ?>&classroom_name=<?php echo $list_class['classroom_name'] ?>" class="btn btn-success col-md-12">ดูคะแนนรวม</a>
                        </td>
                        <td>
                        <a href="../../view/teacher/index_logged-tech_add-grade.php?classroom_id=<?php echo $list_class['classroom_id'] ?>&classroom_name=<?php echo $list_class['classroom_name'] ?>" class="btn btn-info col-md-12">ตัดเกรด</a>
                        </td>
                    </tr>
                    <?php
                    $i++;
                    }
                } else{?>
                    <tfoot>
                        <tr>
                            <td class="text-center" colspan="7">ไม่มีข้อมูล</td>
                        </tr>
                    </tfoot>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <?php
    }

?>