<?php
include "../../controllers/config.php";
$teacher_id = $_SESSION['user_id'];
$sql_subjectdetail = "SELECT  	subj.subject_codename,subj.subject_name,subj.teacher_id,subj.subject_id,COUNT(classroom_id) AS count_room 
    FROM `subject` subj
    LEFT JOIN `classroom_subj_list` ON classroom_subj_list.subject_id=subj.subject_id
    WHERE subj.teacher_id='$teacher_id'
    GROUP BY subject_id
            ";
$result = mysqli_query($conn, $sql_subjectdetail);
?>


<?php
if (mysqli_num_rows($result)>=1) {
    while ($list_subj = mysqli_fetch_array($result)) {
        if ($list_subj['count_room'] == 0 && $list_subj['subject_codename']==null) continue;
    ?>
<div class="col-12 col-lg-3 col-md-6 col-sm-12 px-3 ">
    <a href="../../view/teacher/view_tech_subject_info.php?subject_codename=<?php echo $list_subj['subject_codename']; ?>">
        <div class="card">
            <div class="card-body px-3 py-4-5">
                <div class="row">

                    <div class="col-md-4">

                        <div class="stats-icon green">
                            <i class="iconly-boldAdd-User"></i>
                        </div>

                    </div>
                    <div class="col-md-8">

                        <h6 class="text-muted font-semibold"><?php echo $list_subj['subject_name'] ?></h6>
                        <h6 class="font-extrabold mb-0">จำนวนห้องเรียน: <?php echo $list_subj['count_room'] ?></h6>

                    </div>

                </div>
            </div>
        </div>
    </a>
</div>
<?php
        }
} else {
        ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="text-center col-md">-ไม่มีวิชาที่รับผิดชอบสอน-</p>
            </div>
        </div>
    </div>
</div>
<?php
}

?>