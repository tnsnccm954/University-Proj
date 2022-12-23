<?php
function project_detail($condb, $proj_id)
{
    $sql = "SELECT * FROM `hwproject`
    LEFT JOIN subject subj ON subj.subject_id=hwproject.subject_id
    LEFT JOIN classroom class ON class.classroom_id=hwproject.classroom_id
    WHERE hwproject.proj_id=$proj_id
    ";
    $result=mysqli_query($condb,$sql);
    if(mysqli_num_rows($result)>=1){
        $result=mysqli_fetch_assoc($result);
        return $result;
    }
    else
    {
        $_SESSION['msg'] = "ไม่พบข้อมูลโครงงาน";
        ?>
        <script type="text/javascript">
            alert("<?php echo $_SESSION['msg'] ?>");
            window.location = 'index-Parent.php'
        </script>
        <?php
    }
    return $result;
}
function phase_table($conn, $proj_id, $i)
{
        $table_phase_wl = "SELECT
            wl_proj.worklist_id,wl_proj.proj_id,
            wl_proj.phase,wl_proj.work_detail,wl_proj.max_score
            FROM `worklist_proj` AS wl_proj
            INNER JOIN hwproject ON hwproject.proj_id=wl_proj.proj_id
            WHERE wl_proj.proj_id='$proj_id' AND wl_proj.phase='$i'
            ORDER BY `wl_proj`.`phase` ASC";
        return mysqli_query($conn, $table_phase_wl);
}
function search_group($condb,$std_id,$proj_id){
    $search_group = " SELECT * FROM `proj_member`
    WHERE std_id='$std_id' AND proj_id='$proj_id'
    ";
    $check_search_group = mysqli_query($condb, $search_group);
    if (mysqli_num_rows($check_search_group)>=1) {
        $result=mysqli_fetch_assoc($check_search_group);
        return $result;
    } else {
    $_SESSION['msg'] = "ค้นหากลุ่มไม่พบ";
    ?>
    <script type="text/javascript">
        alert("<?php echo $_SESSION['msg']; ?>");
        //window.location = 'index_logged-std.php';
    </script>
    <?php
    }
}
function check_hw_list($condb, $hw_wl_id, $group_id)
{
    $sql_check_hw_proj_std_list = "SELECT * 
                FROM `hwproj_grading`
                WHERE 	worklist_id='$hw_wl_id' AND group_id='$group_id'
            ";
    $resault_table = mysqli_query($condb, $sql_check_hw_proj_std_list);
    $check_hw = mysqli_fetch_array($resault_table);
    if (mysqli_num_rows($resault_table)>=1) {
    ?>
        <div class="alert alert-success">ส่งแล้ว</div>
    <?php
        $status = "success";
        $score = $check_hw['scored'];
        $hw_proj_file = '<a href="upload/hw_proj/' . $check_hw['proj_file'] . '">' . $check_hw['proj_file'] . '</a>';
    } else {
    ?>
        <div class="alert alert-danger">ยังไม่ส่ง</div>
    <?php
            $status = "unsuccess";
            $score = null;
            $hw_proj_file = null;
        }
        return array($status, $score, $hw_proj_file);
}
function deadline_array($condb,$proj_id){
    $deadline_phase_wl = "SELECT 
    date_deadline
    FROM `worklist_proj` AS wl_proj
    WHERE wl_proj.proj_id='$proj_id' 
    GROUP BY wl_proj.phase
    ";
    $li_dl_phase_wl = mysqli_query($condb, $deadline_phase_wl);
    $deadline_collect=[];
    while ($result= mysqli_fetch_array($li_dl_phase_wl)){
        array_push($deadline_collect,$result['date_deadline']);
    }
    return $deadline_collect;
}
?>