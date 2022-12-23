<?php
$stu_id=$_SESSION['username'];
require_once "../../controllers/config.php";
function check_hw_list_std_($condb,$stu_id)
{
    $stu_id=$_SESSION['username'];
    $sql_hw_list = "SELECT 
    hg.`hw_id`,hg.`std_id`,hg.`hw_file`,
    hw.hw_id,hw.hw_name,hw.hw_order,hw.subject_id,hw.classroom_id,
    subj.subject_id,subj.subject_codename,
    stu.username,stu.std_id
    FROM `hwgrading` hg
    LEFT JOIN homework hw ON hw.hw_id = hg.`hw_id`
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
                <th>วิชา(รหัสวิชา)</th>
                <th>ชื่อการบ้าน</th>
                <th>รายละเอียดการบ้าน</th>
                <th>สถานะ</th> 
            </tr>
        </thead>
        <tbody>
        <?php
            if (isset($resault_table)){
            $i = 1;
            while ($list_hw = mysqli_fetch_array($resault_table) ) {
            ?>
                <tr>
                    <td><?php echo $list_hw['subject_codename']; ?></td>
                    <td><?php echo $list_hw['hw_name']; ?></td>
                    <td><?php echo $list_hw['hw_order']; ?></td>
                    <td><?php if ($list_hw['hw_file']) 
                                {echo "ส่งแล้ว";}
                              else{ echo "ยังไม่ส่ง";}
                     ?></td> 
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