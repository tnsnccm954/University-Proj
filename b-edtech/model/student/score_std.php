<?php
require_once "../../controllers/config.php";
$stu_id=$_SESSION['username'];
function print_quick_hw_list_($condb,$stu_id)
{
    $stu_id=$_SESSION['username'];
    $sql_hw_list = "SELECT hg.`statement_id`,hg.`hw_id`,hg.`std_id`,hg.`score`,
    hw.hw_id,hw.hw_name,hw.hw_order,hw.classroom_id,hw.subject_id, stu.std_id,stu.username, 
    subj.subject_id,subj.subject_codename,subj.subject_name 
    FROM `hwgrading` hg 
    INNER JOIN homework hw ON hg.`hw_id` = hw.hw_id 
    LEFT JOIN subject subj ON subj.subject_id = hw.subject_id 
    LEFT JOIN student stu ON stu.std_id = hg.`std_id`
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
                <th>รายละเอียดการบ้าน</th>
                <th>คะแนน</th>
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
                    <td><?php echo $list_hw['subject_name']; ?></td>
                    <td><?php echo $list_hw['hw_name']; ?></td>
                    <td><?php echo $list_hw['hw_order']; ?></td>
                    <td><?php echo $list_hw['score']??'ยังไม่ถูกให้คะแนน'; ?></td>
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
