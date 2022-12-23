<?php
require '../../routes/web.php';
include "../../controllers/config.php";
$te_id = $_SESSION['username'];
$proj_id=$_GET['proj_id'];
$group_id=$_GET['group_id'];
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
    if($result){
        $array_proj_detail=mysqli_fetch_assoc($result);
    }
    else{
        $_SESSION['msg'] = "การค้นหา ผิดพลาด";
        ?>
        <script type="text/javascript">
            alert("<?php echo $_SESSION['msg']; ?>");
            window.location = 'index_logged-std.php';
        </script>
        <?php
    }
$deadline_phase_wl="SELECT
wl_proj.proj_id,
wl_proj.phase,wl_proj.work_detail,wl_proj.max_score,
wl_proj.date_deadline
FROM `worklist_proj` AS wl_proj
INNER JOIN hwproject ON hwproject.proj_id=wl_proj.proj_id
WHERE wl_proj.proj_id='$proj_id'  
GROUP BY wl_proj.phase
ORDER BY `wl_proj`.`phase` ASC";
    $li_dl_phase_wl=mysqli_query($conn,$deadline_phase_wl);
    //collect only deadline
    $deadline_collect=[];
        while($li_ta_phase_wl=mysqli_fetch_array($li_dl_phase_wl)){
            array_push($deadline_collect,$li_ta_phase_wl['date_deadline']);
        }
    function phase_table($conn,$proj_id,$i){
        $table_phase_wl="SELECT
        wl_proj.worklist_id,wl_proj.proj_id,
        wl_proj.phase,wl_proj.work_detail,wl_proj.max_score
        FROM `worklist_proj` AS wl_proj
        INNER JOIN hwproject ON hwproject.proj_id=wl_proj.proj_id
        WHERE wl_proj.proj_id='$proj_id' AND wl_proj.phase='$i'
        ORDER BY `wl_proj`.`phase` ASC";
        return mysqli_query($conn,$table_phase_wl);
    }   
        $table_p1_wl=phase_table($conn,$proj_id,1);
        $table_p2_wl=phase_table($conn,$proj_id,2);
        if(count($deadline_collect)==3){
            $table_p3_wl=phase_table($conn,$proj_id,3);
        }
        

        function check_hw_list($condb,$hw_wl_id,$group_id){
            $sql_check_hw_proj_std_list = "SELECT * 
                FROM `hwproj_grading`
                WHERE 	worklist_id='$hw_wl_id' AND group_id='$group_id'
            ";
            $resault_table = mysqli_query($condb, $sql_check_hw_proj_std_list);
            $check_hw = mysqli_fetch_array($resault_table);
            if(isset($check_hw)){
                ?>
                <div class="alert alert-success">ส่งแล้ว</div>
                <?php
                $status="success";
                $score=$check_hw['scored'];
                $hw_proj_file='<a href="upload/hw_proj/'.$check_hw['proj_file'].'">'.$check_hw['proj_file'].'</a>';
            }else{
                ?>
                <div class="alert alert-danger">ยังไม่ส่ง</div>
                <?php
                $status="unsuccess";
                $score=null;
                $hw_proj_file=null;
            }
            return array($status,$score,$hw_proj_file);
            }
        
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
                                        <input type="text" class="form-control col-md-12 bg-white text-right" value="<?php echo $array_proj_detail['type']; ?>" id="type_proj" name="type_proj" value="2" disabled>
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
                  
                                <div class="col-md-12 p-3 text-center" id="proj_phase_wl">
                                    <div id="phase_1" >
                                        <div class="form-group col-md-6">
                                            <div class="input-group">
                                                    <span class="input-group-text btn bg-primary text-white">Phase 1 กำหนดส่ง: </span>
                                                    <input class="form-control bg-white" name="real_dateassign" type="text" value="<?php echo displaydatetextmonth($deadline_collect[0]); ?>" disabled >
                                            </div>
                                        </div>
                                        
                                        <div id="phase_1_worklist" class="form-group col-md-12 px-5 py-5" >
                                            <table class="table table-sm  ">
                                                    <thead>
                                                        <tr>
                                                            <th>สถานะ</th>
                                                            <th>ชิ้นงาน</th>
                                                            <th>คะแนนเต็ม</th>
                                                            <th>คะแนนที่ได้</th>
                                                            <th>รายละเอียด</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        
                                                        while($table_li_p1_wl=mysqli_fetch_array($table_p1_wl)){
                                                            ?>
                                                            <tr class="" >
                                                                <td class="col-md-2 " >
                                                                    <?php $check_hw=check_hw_list($conn,$table_li_p1_wl['worklist_id'],$group_id);
                                                                    ?>
                                                                </td>
                                                                <td><?php echo $table_li_p1_wl['work_detail']; ?></td>
                                                                <td ><?php echo $table_li_p1_wl['max_score']; ?></td>
                                                                <td id=scored_1 class="col-md-3 ">
                                                                    <?php
                                                                        if($check_hw[0]=="success") {
                                                                            ?>
                                                                            <form action="../../model/teacher/proj_grading.php" method="POST">
                                                                        
                                                                                <input type="hidden" name="worklist_id" value="<?php echo $table_li_p1_wl['worklist_id'];
                                                                                    $wl_id=$table_li_p1_wl['worklist_id']; ?>
                                                                                    ?>">
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-text btn bg-primary text-white">ให้คะแนน: </span>
                                                                                        <input type="hidden" name="proj_id" value="<?php echo $proj_id; ?>" >
                                                                                        <input type="hidden" name="group_id" value="<?php echo $group_id; ?>" >
                                                                                        <input
                                                                                            id="input_score_1_<?php echo $wl_id; ?>"
                                                                                            min="0"
                                                                                            max="<?php echo $table_li_p1_wl['max_score']; ?>"value=<?php 
                                                                                            $score=$check_hw[1]??0;
                                                                                            echo $score;
                                                                                        ?> class="form-control bg-white" name="scored" type="number" readonly >
                                                                                        
                                                                                       <a id="edit_btn_1_<?php echo $wl_id; ?>" class="btn btn-warning rounded-end" onclick="edit_score(1,<?php echo $wl_id; ?>)" >แก้ไข</a>
                                                                                       <input id="confirm-edit_btn_1_<?php echo $wl_id; ?>" class="btn btn-success rounded-end " style="display: none;" type="submit" value="ยืนยัน" >
                                                                                       <!--  href="hwproject_grading_score_te.php?proj_id=<?php echo $proj_id; ?>&group_id=<?php echo $group_id; ?>" -->
                                                                                    </div>
                                                                            </form>
                                                                            <?php
                                                                        }
                                                                        else if($check_hw[0]=="unsuccess"){
                                                                            echo "ไม่สามารถให้คะแนนได้";
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td class="col-md-3 ">
                                                                <?php
                                                                    if($check_hw[0]=="success") {
                                                                        echo $check_hw[2];
                                                                    }
                                                                    else if($check_hw[0]=="unsuccess"){
                                                                        echo "ยังไม่ได้ส่งการบ้าน";
                                                                    }
                                                                ?>
                                                                </td>
                                                                
                                                            </tr>
                                                        <?php
                                                        
                                                        }
                                                    ?> 
                                                    </tbody>
                                            </table>    
                                        </div>
                                    </div>
                                    
                                    <div id="phase_2">
                                    
                                        
                                        <div class="form-group col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-text btn bg-primary text-white">Phase 2 กำหนดส่ง: </span>
                                                <input class="form-control bg-white" name="real_dateassign" type="text" value="<?php echo displaydatetextmonth($deadline_collect[1]); ?>" disabled >
                                            </div>
                                        </div>
                                        
                                        <div id="phase_2_worklist" class="form-group col-md-12 px-5 py-5" >
                                        <table class="table table-sm  ">
                                                    <thead>
                                                        <tr>
                                                            <th >สถานะ</th>
                                                            <th>ชิ้นงาน</th>
                                                            <th>คะแนนเต็ม</th>
                                                            <th>คะแนนที่ได้</th>
                                                            <th>รายละเอียด</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        $i=1;
                                                        while($table_li_p2_wl=mysqli_fetch_array($table_p2_wl)){
                                                            ?>
                                                            <tr class="" >
                                                                <td class="col-md-2 " >
                                                                    <?php $check_hw=check_hw_list($conn,$table_li_p2_wl['worklist_id'],$group_id);
                                                                    ?>
                                                                </td>
                                                                <td><?php echo $table_li_p2_wl['work_detail']; ?></td>
                                                                <td ><?php echo $table_li_p2_wl['max_score']; ?></td>
                                                                <td id=scored_2 class="col-md-3 ">
                                                                    <?php
                                                                        if($check_hw[0]=="success") {
                                                                            ?>
                                                                            <form action="../../model/teacher/proj_grading.php" method="POST">
                                                                                <input type="hidden" name="proj_id" value="<?php echo $proj_id; ?>" >
                                                                                <input type="hidden" name="group_id" value="<?php echo $group_id; ?>" >
                                                                                <input type="hidden" name="worklist_id" value="<?php echo $table_li_p2_wl['worklist_id'];?>">
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-text btn bg-primary text-white">ให้คะแนน: </span>
                                                                                        <input 
                                                                                            id="input_score_2_<?php echo $table_li_p2_wl['worklist_id']; ?>"
                                                                                            min="0"
                                                                                            max="<?php echo $table_li_p2_wl['max_score']; ?>"value=<?php 
                                                                                            $score=$check_hw[1]??0;
                                                                                            echo $score;
                                                                                        ?> class="form-control bg-white" name="scored" type="number" readonly >
                                                                                    
                                                                                        <a id="edit_btn_2_<?php echo $table_li_p2_wl['worklist_id']; ?>" class="btn btn-warning rounded-end" onclick="edit_score(2,<?php echo $table_li_p2_wl['worklist_id']; ?>)" >แก้ไข</a>
                                                                                       <input id="confirm-edit_btn_2_<?php echo $table_li_p2_wl['worklist_id']; ?>" class="btn btn-success rounded-end " style="display: none;" type="submit" value="ยืนยัน" >
                                                                                    </div>
                                                                            </form>
                                                                            <?php
                                                                        }
                                                                        else if($check_hw[0]=="unsuccess"){
                                                                            echo "ไม่สามารถให้คะแนนได้";
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td class="col-md-3 ">
                                                                <?php
                                                                    if($check_hw[0]=="success") {
                                                                        echo $check_hw[2];
                                                                    }
                                                                    else if($check_hw[0]=="unsuccess"){
                                                                        echo "ยังไม่ได้ส่งการบ้าน";
                                                                    }
                                                                ?>
                                                                </td>
                                                                
                                                            </tr>
                                                        <?php
                                                        $i++;
                                                        }
                                                    ?> 
                                                    </tbody>
                                            </table>  
                                        </div>
                                        
                                    </div>
                                    <div id="phase_3">
                                        <div class="form-group col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-text btn bg-primary text-white">Phase 3 กำหนดส่ง: </span>
                                                <input class="form-control bg-white" name="real_dateassign" type="text" value="<?php 
                                                if(count($deadline_collect)==3){
                                                echo displaydatetextmonth($deadline_collect[2]); 
                                                }
                                                ?>" disabled >
                                            </div>
                                        </div>
                                        <div id="phase_3_worklist" class="form-group col-md-12 px-5 py-5" >
                                            <?php if(count($deadline_collect)==3){ ?>
                                                <table class="table table-sm  ">
                                                            <thead>
                                                                <tr>
                                                                    <th>สถานะ</th>
                                                                    <th>ชิ้นงาน</th>
                                                                    <th>คะแนนเต็ม</th>
                                                                    <th>คะแนนที่ได้</th>
                                                                    <th>รายละเอียด</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                $i=1;
                                                                while($table_li_p3_wl=mysqli_fetch_array($table_p3_wl)){
                                                                    ?>
                                                                    <tr class="" >
                                                                        <td class="col-md-2 " >
                                                                            <?php $check_hw=check_hw_list($conn,$table_li_p3_wl['worklist_id'],$group_id);
                                                                            ?>
                                                                        </td>
                                                                        <td><?php echo $table_li_p3_wl['work_detail']; ?></td>
                                                                        <td ><?php echo $table_li_p3_wl['max_score']; ?></td>
                                                                        <td id=scored_3 class="col-md-3 ">
                                                                            <?php
                                                                                if($check_hw[0]=="success") {
                                                                                    ?>
                                                                                    <form action="../../model/teacher/proj_grading.php" method="POST">
                                                                                        <input type="hidden" name="proj_id" value="<?php echo $proj_id; ?>" >
                                                                                        <input type="hidden" name="group_id" value="<?php echo $group_id; ?>" >
                                                                                        <input type="hidden" name="worklist_id" value="<?php echo $table_li_p3_wl['worklist_id'];
                                                                                            ?>">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-text btn bg-primary text-white">ให้คะแนน: </span>
                                                                                                <input 
                                                                                                id="input_score_3_<?php echo $table_li_p3_wl['worklist_id']; ?>"
                                                                                                min="0"
                                                                                                max="<?php echo $table_li_p3_wl['max_score']; ?>"value=<?php 
                                                                                            $score=$check_hw[1]??0;
                                                                                            echo $score;
                                                                                        ?> class="form-control bg-white" name="scored" type="number" readonly>                            
                                                                                                <a id="edit_btn_3_<?php echo $table_li_p3_wl['worklist_id']; ?>" class="btn btn-warning rounded-end" onclick="edit_score(3,<?php echo $table_li_p3_wl['worklist_id'];?>)" >แก้ไข</a>
                                                                                                <input id="confirm-edit_btn_3_<?php echo $table_li_p3_wl['worklist_id']; ?>" class="btn btn-success rounded-end " style="display: none;" type="submit" value="ยืนยัน" >
                                                                                            </div>
                                                                                    </form>
                                                                                    <?php
                                                                                }
                                                                                else if($check_hw[0]=="unsuccess"){
                                                                                    echo "ไม่สามารถให้คะแนนได้";
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                        <td class="col-md-3 ">
                                                                        <?php
                                                                            if($check_hw[0]=="success") {
                                                                                echo $check_hw[2];
                                                                            }
                                                                            else if($check_hw[0]=="unsuccess"){
                                                                                echo "ยังไม่ได้ส่งการบ้าน";
                                                                            }
                                                                        ?>
                                                                        </td>
                                                                        
                                                                    </tr>
                                                                <?php
                                                                $i++;
                                                                }
                                                            ?> 
                                                            </tbody>
                                                    </table>
                                                <?php } ?>
                                        </div>
                                                
                                        </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <a type="submit" class="btn btn-success me-1 mb-1 btn-lg" value="add_proj" href=" http://meet.google.com/new " target="_blank">Meet!</a>
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
            function edit_score(phase,wl_id){
                //alert('input_score_'+phase+'_'+wl_id);
                document.getElementById('input_score_'+phase+'_'+wl_id).removeAttribute('readonly');
                document.getElementById('edit_btn_'+phase+'_'+wl_id).style.display='none';
                document.getElementById('confirm-edit_btn_'+phase+'_'+wl_id).style.display='block';
            }
    </script>
    
</body>
    
</html>
