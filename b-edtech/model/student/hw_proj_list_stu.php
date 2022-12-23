<?php
$stu_username=$_SESSION['username'];
require_once "../../controllers/config.php";
function hw_proj_list_std_($condb,$stu_username)
{
    $stu_username=$_SESSION['username'];
    $sql_hw_list = " SELECT proj_id,hwproj_name,subj.subject_codename,subj.subject_name,te.name,hwproject.date_assign,type FROM `hwproject`
    INNER JOIN student AS stu ON stu.classroom_id=hwproject.classroom_id
    INNER JOIN `subject` AS subj ON subj.subject_id=hwproject.subject_id
    INNER JOIN `teacher` AS te ON te.teacher_id=subj.teacher_id
    WHERE stu.username='$stu_username' 
    ";
    $resault_table = mysqli_query($condb, $sql_hw_list);
    ?>
    <div class="table-responsive">
    <table class="table table-sm">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>วิชา(รหัสวิชา)</th>
                <th>ชื่อการบ้าน</th>
                <th>ระยะที่กำหนด</th>
                <th>วันที่สั่ง</th>
                <th>เพิ่มเติม</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if (!isset($result)){
            $i = 1;
            while ($list_hw = mysqli_fetch_array($resault_table) ) {
            ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $list_hw['subject_codename']; ?></td>
                    <td><?php echo $list_hw['hwproj_name']; ?></td>
                    <td><?php echo $list_hw['type']; ?></td>
                    <td><?php echo displaydate($list_hw['date_assign']); ?></td>
                    <td>
                        <form action="hwproject_detail_stu.php" method="POST">
                            <input name="proj_id" type="hidden" value="<?php echo $list_hw['proj_id']; ?>">
                        
                        <button type="submit" class="btn btn-info col-md-12">รายละเอียด</button>
                        </form>
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