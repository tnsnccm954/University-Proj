<?php

require_once "../../controllers/config.php";
$te_id=$_SESSION['username'];

function print_quick_hw_list($condb,$te_id){
    session_start();
    $sql_hw_list = "SELECT hw.hw_id,
        hw.hw_name,hw.hw_order,hw.level,hw.date_deadline,hw.dateassign,
        subj.subject_codename,subj.subject_name,
        teach.username,teach.name,teach.teacher_tel
        FROM `homework` hw
        INNER JOIN `subject` subj ON subj.subject_id=hw.subject_id
        LEFT JOIN `teacher` teach ON subj.teacher_id=teach.teacher_id
        WHERE teach.username='$te_id'
        ORDER BY date_deadline,`level` ASC
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
            if(isset($resault_table)){
                $i = 1;
                while ($list_hw = mysqli_fetch_array($resault_table) ) {
                ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php 
                    $_SESSION['subj_codename']=$list_hw['subject_codename'];
                    echo $list_hw['subject_codename']; ?></td>
                    <td><?php echo $list_hw['hw_name']; ?></td>
                    <td><?php echo $list_hw['level']; ?></td>
                    <td><?php echo displaydate($list_hw['dateassign']); ?></td>
                    <td><?php echo displaydate($list_hw['date_deadline']); ?></td>
                    <td>
                        <a href="../../view/teacher/index_logged-tech_hw_check_std_hw.php?hw_id=<?php echo $list_hw['hw_id'];?>&subj_codename=<?php echo $list_hw['subject_codename'];?>" class="btn btn-info col-md-12">Info</a>
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
function print_hw_per_class($condb,$subj_codename,$classcodename){
    $sql_hw_list = "SELECT hw.hw_id,
    hw.hw_name,hw.hw_order,hw.level,hw.date_deadline,hw.dateassign,
    subj.subject_codename,subj.subject_name,
    teach.username,teach.name,teach.teacher_tel
    FROM `homework` hw
    INNER JOIN `subject` subj ON subj.subject_id=hw.subject_id
    LEFT JOIN `teacher` teach ON subj.teacher_id=teach.teacher_id
    LEFT JOIN `classroom` class ON class.classroom_id=hw.classroom_id
    WHERE classroom_name='$classcodename'
    ORDER BY date_deadline,dateassign ASC  
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
                <th class="text-center" colspan="2">เพิ่มเติม</th>
            </tr>
        </thead>
        <tbody>
            <?php
        if(isset($resault_table)){
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
                    <a href="../../view/teacher/index_logged-tech_hw_check_std_hw.php?hw_id=<?php echo $list_hw['hw_id']?>&hw_name=<?php echo $list_hw['hw_name']?>" class="btn btn-info col-md-12">Info</a>
                </td>
            </tr>
            <?php
            $i++;
            }
        } else{?>
            <tfoot>
                <tr>
                    <td class="text-center" colspan="8">ไม่มีข้อมูล</td>
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