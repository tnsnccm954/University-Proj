<?php
function print_option_classroom($conn, $te_id)
{
    $sql = "SELECT class.classroom_id,class.classroom_name,te.username 
                FROM `classroom` class
                LEFT JOIN teacher te ON te.teacher_id=class.teacher_id
                WHERE te.username='$te_id'
                ";
    $resault_table = mysqli_query($conn, $sql);
    while ($list = mysqli_fetch_array($resault_table)) {
?>
<option value=" <?php echo $list['classroom_id']; ?>"><?php echo $list['classroom_name']; ?></option>
<?php
    }
}
function print_option_subject($conn, $te_id)
{
    $sql = "SELECT subj.subject_id,subj.subject_codename,subj.teacher_id 
                FROM `subject`subj
                LEFT JOIN teacher te ON te.teacher_id=subj.teacher_id
                WHERE te.username='$te_id'
                ";
    $resault_table = mysqli_query($conn, $sql);
    while ($list = mysqli_fetch_array($resault_table)) {
    ?>
<option value=" <?php echo $list['subject_id']; ?>"><?php echo $list['subject_codename']; ?></option>
<?php
    }
}