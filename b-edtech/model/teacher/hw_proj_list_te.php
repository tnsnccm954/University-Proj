<?php
$te_id=$_SESSION['username'];
require_once "../../controllers/config.php";
function hw_proj_list_te($condb,$te_id)
{
    $te_id=$_SESSION['username'];
    $sql_hw_list = " SELECT 
    proj_id,hwproj_name,
    subj.subject_codename,subj.subject_name,te.name,
    class.classroom_name,
    hwproject.date_assign,type 
    FROM `hwproject`
    INNER JOIN `subject` AS subj ON subj.subject_id=hwproject.subject_id
    INNER JOIN `classroom` AS class ON class.classroom_id=hwproject.classroom_id
    INNER JOIN `teacher` AS te ON te.teacher_id=subj.teacher_id
    WHERE te.username='$te_id' 
    ";
    $resault_table = mysqli_query($condb, $sql_hw_list);
    ?>
    <div class="table-responsive">
    <table class="table table-sm">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>วิชา(รหัสวิชา)</th>
                <th>ห้องเรียน</th>
                <th>ชื่อการบ้าน</th>
                <th>ระยะที่กำหนด</th>
                <th>วันที่สั่ง</th>
                <th>เพิ่มเติม</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if (mysqli_num_rows($resault_table)>=1){
            $i = 1;
            while ($list_hw = mysqli_fetch_array($resault_table) ) {
            ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $list_hw['subject_codename']; ?></td>
                    <td><?php echo $list_hw['classroom_name']; ?></td>
                    <td><?php echo $list_hw['hwproj_name']; ?></td>
                    <td><?php echo $list_hw['type']; ?></td>
                    <td><?php echo displaydate($list_hw['date_assign']); ?></td>
                    <td class="col-md-3">
                        
                        <a type="submit" class="btn btn-info col-md-5 p-1" href="hwproject_detail-teach.php?proj_id=<?php echo $list_hw['proj_id']; ?>">รายละเอียด</a>
                        <a type="submit" class="btn btn-secondary col-md-5 p-1"  href="hwproject_grading_te.php?proj_id=<?php echo $list_hw['proj_id']; ?>">ตรวจงาน</ฟ>
                        
                    </td>
                </tr>
            <?php
                $i++;
            }
        }
        else {?> <tr> <td class="text-center" colspan="7">ไม่มีการบ้าน</td></tr> <?php }
            ?>
        </tbody>
    </table>
    </div>
    <?php
    }

?>