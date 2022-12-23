<?php
require '../../routes/web.php';
include "../../controllers/config.php";
$proj_id=$_GET['proj_id'];
//model
$proj_detail_sql="SELECT 
wl_proj.proj_id,hwproject.hwproj_name,
hwproject.proj_detail,hwproject.type,hwproject.maximumg,
wl_proj.phase,wl_proj.work_detail,wl_proj.max_score,
classroom.classroom_name,te.name,subj.subject_codename,
hwproject.date_assign,wl_proj.date_deadline
FROM `worklist_proj` AS wl_proj
INNER JOIN hwproject ON hwproject.proj_id=wl_proj.proj_id
INNER JOIN classroom ON classroom.classroom_id=hwproject.classroom_id
INNER JOIN teacher AS te ON te.teacher_id=classroom.teacher_id 
INNER JOIN subject AS subj ON subj.subject_id=hwproject.subject_id
WHERE wl_proj.proj_id='$proj_id'  
ORDER BY `wl_proj`.`phase` ASC
";
$result=mysqli_query($conn,$proj_detail_sql);
    //controlls
    if(mysqli_num_rows($result)>=1){
        $array_proj_detail=mysqli_fetch_assoc($result);
    }
    else{
        $_SESSION['msg'] = "การค้นหา ผิดพลาด";
        ?>
        <script type="text/javascript">
            alert("<?php echo $_SESSION['msg']; ?>");
            //window.location = 'index_logged-std.php';
        </script>
        <?php
    }

    $search_group="SELECT * FROM `proj_member` WHERE proj_id='$proj_id' GROUP BY `group_name`";
    $result_group=mysqli_query($conn,$search_group);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proj_assign</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="../../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/app.css">
    <link rel="shortcut icon" href="../../assets/images/favicon.svg" type="image/x-icon">
</head>
<body>
    <div id="app">
        <?php include_once $layout."sidebar.php"; ?>
        <div id="main">
            <header class="mb-3">
                <?php include_once $layout."navbar.php"; ?>
            </header>
            <div class="page-heading">
                <h3>รายละเอียดโปรเจค</h3>
            </div>
            <div class="page-content">
            <section class="section">
                    <div class="card">
                    
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="class_code">ห้องเรียน: </label>
                                            <input class="form-control text-right bg-white" type="text" value="<?php echo $array_proj_detail['classroom_name']; ?>" disabled >
                                    </div>
                                    <div   div class="form-group">
                                        <label for="proj_name">ชื่อการบ้าน: </label>
                                        <input class="form-control text-right bg-white" type="text" value="<?php echo $array_proj_detail['hwproj_name']; ?>"disabled >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="helpInputTop">วิชา: </label>
                                        <input class="form-control text-right bg-white" type="text" value="<?php echo $array_proj_detail['subject_codename']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="max_member">จำนวนสมาชิก: </label>
                                        <input type="text" class="form-control col-md-12 bg-white text-right" value="<?php echo $array_proj_detail['maximumg']; ?>" id="maximumg" name="maximumg" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="proj_detail">รายละเอียด: </label>
                                        <textarea class="form-control bg-white" placeholder="กรุณากรอกรายละเอียดงาน" id="proj_detail" name="proj_detail" rows="4" cols="50" disabled><?php echo $array_proj_detail['proj_detail']; ?></textarea>
                                    </div>
                                </div>
                                <div   div class="col-md-6" >
                                        <div class="form-group">
                                            <label>ประเภทของโครงงาน: </label>
                                            <input type="text" class="form-control col-md-12 bg-white" value="<?php echo $array_proj_detail['type']; ?>" id="type_proj" name="type_proj" value="2" disabled>
                                        </div>
                                </div>
                                <div   div class="form-group col-md-6">
                                        <label for="real_dateassign">วันที่สั่ง: </label>
                                        <input class="form-control bg-white" name="real_dateassign" type="text" value="<?php echo displaydatetextmonth($array_proj_detail['date_assign']); ?>" disabled >
                                </div>
                                <div>
                                    <table class="col-12 table table-sm text-center">
                                        <thead>
                                            <th>ลำดับ</th>
                                            <th>ชื่อกลุ่ม</th>
                                            <th>การทำงาน</th>
                                            <th>หมายเหตุ</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=1;
                                            if(mysqli_num_rows($result_group)>=1){
                                                while($table_group_up=mysqli_fetch_array($result_group)){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $table_group_up['group_name']; ?></td>
                                                        <td class="d-flex justify-content-center" >
                                                        <a type="submit" class="btn btn-success me-1 mb-1 btn-lg" value="add_proj" href=" http://meet.google.com/new " target="_blank">Meet!</a>
                                                            <a href="hwproject_grading_check_score_te.php?proj_id=<?php echo $proj_id; ?>&group_id=<?php echo $table_group_up['group_id']; ?>" class="btn btn-secondary me-1 mb-1 btn-lg">ตรวจงาน</a>
                                                        </td>
                                                        <td>-</td>
                                                    </tr>


                                                    <?php
                                                $i++;
                                                }
                                            }
                                            else{
                                                ?>
                                                <td colspan="4" >ไม่พบการจับกลุ่ม / ยังไม่มีการจับกลุ่ม</td>
                                                <?php
                                            }

                                            ?>


                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                </div>    
                            </div>
                        </div>  
                    </div>
                </section>
            </div>
            <?php //require_once "../../controllers/footer.php"; ?>
        </div>
    </div>
    <script src="../../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/pages/dashboard.js"></script>
    <script src="../../assets/js/main.js"></script>
    <script>
     //hidding_from_phase
            var type=document.getElementById("type_proj").value;
            if(type==2){
                document.getElementById("proj_phase_wl").style.display='block';
                document.getElementById("phase_3").style.display='none';
            }
            else if(type==3){
                document.getElementById("proj_phase_wl").style.display='block';
                document.getElementById("phase_3").style.display='block';
            }
            else if(type==null){
                document.getElementById("proj_phase_wl").style.display='none';
            }
            function update_score(score,phase){
                document.getElementById('scored_'+phase).innerText=score;
            }
            function check_max(value,phase,maxvalue,lastorder){
                document.getElementById('score_p'+phase+'_'+lastorder).setAttribute('max',maxvalue);
            }
    </script>
    
</body>
    
</html>
