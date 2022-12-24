<?php
require_once "../../controllers/config.php";
$stu_id=$_SESSION['username'];

$sql_sub_list = "SELECT sublist.classroom_id,sublist.subject_id, class.classroom_id , class.teacher_id,teacher.teacher_id,teacher.name,subj.subject_id ,subj.subject_codename,subj.subject_name,subj.semester,subj.year,stu.classroom_id,stu.username
FROM `classroom_subj_list`  sublist
INNER JOIN classroom class ON sublist.classroom_id =  class.classroom_id
LEFT JOIN subject subj ON subj.subject_id = sublist.subject_id
LEFT JOIN teacher ON teacher.teacher_id=class.teacher_id 
LEFT JOIN student stu ON stu.classroom_id = sublist.classroom_id
WHERE stu.username='$stu_id'" ;
$resault_table = mysqli_query($conn, $sql_sub_list);
?>
<div class="table-responsive">
<table class="table table-sm">
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>รหัสวิชา</th>
            <th>ชื่อรหัสวิชา</th>
            <th>ผู้สอน</th>
            <th>เทอม</th>
            </tr>
    </thead>
    <tbody>
    <?php
        $i = 1;
        while ($list_sub = mysqli_fetch_array($resault_table) ) {
        ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $list_sub['subject_codename']; ?></td>
                <td><?php echo $list_sub['subject_name']; ?></td>
                <td><?php echo $list_sub['name']; ?></td>
                <td><?php echo $list_sub['semester']."/".($list_sub['year']+43-2000); ?></td>
                <td>
                </td>
            </tr>
        <?php
            $i++;
        }
        ?>
    </tbody>
</table>
</div>