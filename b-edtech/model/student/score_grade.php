<?php
require_once "../../controllers/config.php";
$stu_id=$_SESSION['username'];
function print_grade_list_($condb,$stu_id)
{
    $stu_id=$_SESSION['username'];
    $sql_hw_list = "SELECT * FROM `graded_per_class`
    INNER JOIN student stu ON stu.std_id=graded_per_class.std_id
    INNER JOIN subject ON subject.subject_id=graded_per_class.subject_id
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
                <th>เกรด</th>
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
                    <td><?php echo $list_hw['graded']; ?></td>
                </tr>
            <?php
                $i++;
            }
        }
        else {?> <tr> <td class="text-center" colspan="7">ไม่มีเกรด</td></tr> <?php }
            ?>
        </tbody>
    </table>
    </div>
    <?php
    }

?>
