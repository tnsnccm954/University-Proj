<?php
    require_once "../../controllers/config.php";
    

    function print_class_tb($condb,$username){
        $sql_classtable="SELECT * FROM `subject` subj
        INNER JOIN `teacher` te ON te.teacher_id=subj.teacher_id
        INNER JOIN classroom_subj_list ON classroom_subj_list.subject_id=subj.subject_id
        INNER JOIN classroom class ON class.classroom_id=classroom_subj_list.classroom_id
        WHERE te.username = '$username'  
ORDER BY `subj`.`subject_codename` ASC
        ";
        $resault_table=mysqli_query($condb,$sql_classtable);
        ?>
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>รหัสห้องเรียน</th>
                        <th>สอนในวิชา</th>
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
                        <td><?php echo $list_class['subject_codename']; ?></td>
                        
                        
                        <td>
                            <a href="../../view/teacher/index_logged-tech_hw_all_card.php?classroom_id=<?php echo $list_class['classroom_id'] ?>&classroom_name=<?php echo $list_class['classroom_name'] ?>&subj_codename=<?php echo $list_class['subject_codename']; ?>" class="btn btn-secondary col-md-12">ตรวจสอบการบ้าน</a>
                        </td>
                        <td>
                            <a href="../../view/teacher/index_logged-tech_std_list_all_subj.php?classroom_id=<?php echo $list_class['classroom_id'] ?>&classroom_name=<?php echo $list_class['classroom_name'] ?>&subj_codename=<?php echo $list_class['subject_codename']; ?>" class="btn btn-success col-md-12">ตรวจสอบรายบุคคล</a>
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