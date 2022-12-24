<?php
require '../../routes/web.php';
$te_id = $_SESSION['username'];

include "../../model/teacher/add_homework.php";
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
                <h3>สั่งงานแบบโปรเจค</h3>
            </div>
            <div class="page-content">
            <section class="section">
                    <div class="card">
                    <form action="../../model/teacher/project_receive-te.php" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="class_code">ห้องเรียน: </label>
                                        <select class="form-select" name="class_code" required>
                                            <option>select</option>
                                            <?php print_option_classroom($conn, $te_id) ?>
                                        </select>
                                    </div>
                                    <div   div class="form-group">
                                        <label for="proj_name">ชื่อการบ้าน: </label>
                                        <input type="text" name="proj_name" id="proj_name" class="form-control" placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="helpInputTop">วิชา: </label>
                                        <select class="form-select" name="subj_code" required>
                                            <option >select</option>
                                            <?php print_option_subject($conn, $te_id) ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="max_member">จำนวนสมาชิก: </label>
                                        <input required name="max_member" class="form-range row-cols-2" type="range" oninput="realtime_mamber_range(this.value)" id="maxmember" min='1' max='50' step="1" value="1"></label><span id="maxmember_text" class="text-center" >none</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="proj_detail">รายละเอียด: </label>
                                        <textarea class="form-control" placeholder="กรุณากรอกรายละเอียดงาน" id="proj_detail" name="proj_detail" rows="4" cols="50"></textarea>
                                    </div>
                                </div>
                                <div   div class="form-group col-md-6 p-3 px-5">
                                        <label>ประเภทของโครงงาน:</label><br>
                                        <label><input type="radio" class="form-radio" oninput="realtime_type_proj(this.value)" id="type_proj" name="type_proj" value="2" required> 2 ครั้ง</label><br>
                                        <label><input type="radio" class="form-radio"  oninput="realtime_type_proj(this.value)" id="type_proj" name="type_proj" value="3" required> 3 ครั้ง</label>
                                </div>
                                <div   div class="form-group col-md-6 p-3 px-5">
                                        <label for="real_dateassign">วันที่สั่ง: </label>
                                        <input class="form-control" name="real_dateassign" min="<?php echo date("Y-m-d");?>" type="date" required>
                                </div>
                                <div class="col-md-12" id="proj_phase_wl" style="display:none;">
                                    <div id="phase_1" >
                                        <div class="form-group col-md-6 py-1">
                                            <div class="input-group">
                                                    <span class="input-group-text btn bg-primary text-white">Phase 1 กำหนดส่ง: </span>
                                                    <input class="form-control" name="p1_dateassign" min="<?php echo date("Y-m-d");?>" type="date" >
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 px-5 py-2">
                                            <div class="input-group ">
                                                <span class="input-group-text">เพิ่มงาน:</span> <input class="form-control"  id='p1_newtask'  type="text" placeholder="ชิ้นงาน"> 
                                                <span class="input-group-text">คะแนนงาน: </span><input class="form-control"  id='p1_point'  type="number" value="1" min="1" max="50"> 
                                                <a onclick="add_task(1)" id="add" class=" form-control btn-success text-center" >Add</a>
                                            </div>
                                        </div>
                                        <div id="phase_1_worklist" class="form-group col-md-12 px-5 py-3" >    
                                        </div>
                                    </div>
                                    <div id="phase_2">
                                        <div class="form-group col-md-6 py-1">
                                            <div class="input-group">
                                                <span class="input-group-text btn bg-primary text-white">Phase 2 กำหนดส่ง: </span>
                                                <input class="form-control" name="p2_dateassign" min="<?php echo date("Y-m-d");?>" type="date" >
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 px-5 py-2">
                                            <div class="input-group">
                                                <span class="input-group-text">เพิ่มงาน:</span> <input class="form-control"  id='p2_newtask'  type="text" placeholder="ชิ้นงาน"> 
                                                <span class="input-group-text">คะแนนงาน: </span><input class="form-control"  id='p2_point'  type="number" value="1" min="1" max="50"> 
                                                <a onclick="add_task(2)" id="add" class=" form-control btn-success text-center" >Add</a>
                                            </div>
                                        </div>
                                        <div id="phase_2_worklist" class="form-group col-md-12 px-5 py-3" >    
                                        </div>
                                    </div>
                                    <div id="phase_3">
                                        <div class="form-group col-md-6 py-1">
                                            <div class="input-group">
                                                <span class="input-group-text btn bg-primary text-white">Phase 3 กำหนดส่ง: </span>
                                                <input class="form-control" name="p3_dateassign" min="<?php echo date("Y-m-d");?>" type="date" >
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 px-5 py-2">
                                            <div class="input-group " >
                                                <span class="input-group-text">เพิ่มงาน:</span> <input class="form-control"  id='p3_newtask'  type="text" placeholder="ชิ้นงาน"> 
                                                <span class="input-group-text">คะแนนงาน: </span><input class="form-control"  id='p3_point'  type="number" value="1" min="1" max="50"> 
                                                <a onclick="add_task(3)" id="add" class=" form-control btn-success text-center" >Add</a>
                                            </div>
                                        </div>
                                        <div id="phase_3_worklist" class="form-group col-md-12 px-5 py-3" >    
                                        </div>
                                        </div>
                                    <p id="sum_worklist"></p>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1" value="add_proj" >สั่งโลด</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>    
                            </div>
                        </div>
                    </form>
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
        //maxmember showing
        document.getElementById("maxmember_text").innerHTML = document.getElementById("maxmember").value;
        
        function realtime_mamber_range(maxmember){
        document.getElementById("maxmember_text").innerHTML = maxmember;
        }
        //phase_worklist_adding
        var count_task=0;
        document.getElementById("sum_worklist").innerText='งานที่สั่งทั้งหมด: '+count_task;
        function add_task(phase){
            let task_text=document.getElementById("p"+phase+"_newtask");
            let task_point=document.getElementById("p"+phase+"_point");
            if(task_text.value.length==0){
                alert("please adding somethings");
            }
            else{
                let area_wl=document.getElementById("phase_"+phase+"_worklist");
                let field_wl=document.createElement('ul');
                field_wl.setAttribute('class','input-group ');
                field_wl.setAttribute('id','phase_'+phase+'_wl_ul');
                //name_newtask
                let new_name_task=document.createElement('span');
                new_name_task.setAttribute('class','input-group-text');
                new_name_task.innerText='ระยะที่ '+phase+' ชิ้นงาน: ';
                field_wl.appendChild(new_name_task);
                //newtask
                let new_task=document.createElement('input');
                new_task.setAttribute('class','col-md-3 form-control bg-white');
                new_task.name='p'+phase+'_work_detail[]';
                new_task.type='text';
                new_task.setAttribute('readOnly','');
                new_task.value=task_text.value;
                field_wl.appendChild(new_task);
                task_text.value='';
                //name_newtask_maxpoint
                let new_name_pointtask=document.createElement('span');
                new_name_pointtask.setAttribute('class','input-group-text');
                new_name_pointtask.innerText=' คะแนน: ';
                field_wl.appendChild(new_name_pointtask);
                //newtask_maxpoint
                let new_task_point=document.createElement('input');
                new_task_point.setAttribute('class','col-md-3 form-control bg-white');
                new_task_point.name='p'+phase+'_max_point[]';
                new_task_point.type='number';
                new_task_point.setAttribute('readOnly','');
                new_task_point.value=task_point.value;
                field_wl.appendChild(new_task_point);
                task_point.value='1';
                //add_delete_button
                let delete_btn=document.createElement('button');
                delete_btn.setAttribute('class','btn btn-danger');
                delete_btn.innerText=' - ลบออก';
                delete_btn.value='delete_'+new_task.name;
                delete_btn.addEventListener('click',function(){
                    area_wl.removeChild(field_wl);
                    count_task-=1;
                    document.getElementById("sum_worklist").innerText='งานที่สั่งทั้งหมด: '+count_task;
                })
                field_wl.appendChild(delete_btn);
                area_wl.appendChild(field_wl);
                count_task+=1;
                document.getElementById("sum_worklist").innerText='งานที่สั่งทั้งหมด: '+count_task;    
            }
        }
        //hidding_from_phase
        function realtime_type_proj(type){
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
        }
    </script>
</body>
</html>
