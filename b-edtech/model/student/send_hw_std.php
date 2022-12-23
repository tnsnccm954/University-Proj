<?php

$stu_id=$_SESSION['username'];
require_once "../../controllers/config.php";
function send_hw_std_($condb,$stu_id)
{
    $stu_id=$_SESSION['username'];
    $sql_hw_list = "SELECT hw.`hw_id`,hw.`hw_name`,hw.`hw_order`,hw.`level`,hw.`date_deadline`,hw.`subject_id`,hw.`classroom_id`,hw.`dateassign`,
    stu.std_id,stu.classroom_id,
    class.classroom_id,
    subj.subject_id,subj.subject_codename
    FROM `homework` hw
    LEFT JOIN student stu ON stu.classroom_id =hw.`classroom_id`
    LEFT JOIN classroom class ON class.classroom_id = stu.classroom_id
    LEFT JOIN subject subj ON hw.`subject_id` = subj.subject_id
    WHERE stu.username='$stu_id'
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
                <th>ระดับความยาก</th>
                <th>วันที่สั่ง</th>
                <th>วันที่ส่ง</th>
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
                        <td><?php echo $list_hw['hw_name']; ?></td>
                        <td><?php echo $list_hw['level']; ?></td>
                        <td><?php echo displaydate($list_hw['dateassign']); ?></td>
                        <td><?php echo displaydate($list_hw['date_deadline']); ?></td>
                        <td>
                            <a href="index_send_hw_std_upload_hw.php?hw_id=<?php echo $list_hw['hw_id']; ?>&std_id=<?php echo $list_hw['std_id']; ?>" class="btn btn-info col-md-12">ส่งงาน</a>
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