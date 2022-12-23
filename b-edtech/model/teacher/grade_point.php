<?php
include "../../controllers/config.php";
$username = $_SESSION['username'];
$sql_subjectdetail = "SELECT  	subj.subject_codename,subj.subject_name,te.username,subj.subject_id,COUNT(classroom_id) AS count_room 
        FROM `subject` subj
        LEFT JOIN teacher te ON te.teacher_id=subj.teacher_id
        LEFT JOIN `classroom_subj_list` ON classroom_subj_list.subject_id=subj.subject_id
        WHERE username='$username'
        GROUP BY subject_id
            ";
$result = mysqli_query($conn, $sql_subjectdetail);
?>


<?php
if (isset($result)) {
    while ($list_subj = mysqli_fetch_array($result)) {
        if ($list_subj['count_room'] == 0) continue;
    ?>
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-3 py-4-5">
                <div class="row">

                    <div class="col-md-4">
                        <a href="../../view/teacher/index_logged-tech_grade_info.php?subject_codename=<?php echo $list_subj['subject_codename']; ?>">
                            <div class="stats-icon green">
                                <i class="iconly-boldAdd-User"></i>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-8">
                        <a href="../../view/teacher/index_logged-tech_grade_info.php?subject_codename=<?php echo $list_subj['subject_codename']; ?>">
                            <h6 class="text-muted font-semibold"><?php echo $list_subj['subject_codename'] ?></h6>
                            <h6 class="font-extrabold mb-0">จำนวนห้องเรียน:<?php echo $list_subj['count_room'] ?></h6>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php
        }
} else {
        ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-center col-md" >-ไม่มีวิชาที่รับผิดชอบสอน-</p>
                </div>
            </div>
        </div>
    </div>
    <?php
}

?>