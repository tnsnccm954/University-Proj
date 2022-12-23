<?php
require '../../routes/web.php';
$te_id=$_SESSION['user_id'];
$hw_id=$_GET['hw_id'];
require "../../model/teacher/hwg_grading.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTe-Tech</title>
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
                <h3>ตรวจงานกลุ่ม</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="row">
                        <div class="col-12 col-xl-8">
                            <div class="card">
                                <div class="card-body">
                                    <h4>ผู้เรียนที่จับกลุ่มแล้ว พร้อมตรวจ</h4>
                                    <?php 
                                        $hwg_group=hwg_group($conn,$hw_id);
                                        if(mysqli_num_rows($hwg_group)>=1){
                                            while($hwg_group_detail=mysqli_fetch_array($hwg_group)){
                                                $group_id=$hwg_group_detail['group_id'];
                                                //echo $group_id;
                                                ?>
                                    <div class="alert alert-dark mx-2">
                                        <div class="row">
                                            <div class="col-12 d-lg-flex justify-content-end ">
                                                <a class="btn  disabled col-12 col-lg-6 m-1">
                                                    <?php echo $hwg_group_detail['group_name']; ?>
                                                </a>
                                                <button class="btn btn-primary col-12 col-lg-3 m-1" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#memberlist-<?php echo $group_id;?>"
                                                    aria-expanded="false"
                                                    aria-controls="memberlist-<?php echo $group_id;?>">
                                                    รายชื่อ
                                                </button>
                                                <a class="btn btn-primary col-12 col-lg-3 m-1" data-bs-toggle="collapse"
                                                    href="#hwg-<?php echo $group_id;?>" role="button"
                                                    aria-expanded="false" aria-controls="hwg-<?php echo $group_id;?>">
                                                    ตรวจงาน
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="collapse mx-3 " id="memberlist-<?php echo $group_id;?>">
                                        <div class="card card-body mb-0 ">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>ลำดับ</th>
                                                        <th>ชื่อ-สกุล</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                                            $member_hwg=member_hwg($conn,$group_id);
                                                                            if(mysqli_num_rows($member_hwg)>=1){
                                                                                $j=1;
                                                                                while($member_tb=mysqli_fetch_assoc($member_hwg)){
                                                                                    ?>
                                                    <tr>
                                                        <td><?php echo $j; ?></td>
                                                        <td><?php echo $member_tb['name']." ".$member_tb['surname']; ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                                                $j++;
                                                                                }
                                                                            }
                                                                        ?>
                                                </tbody>
                                                <caption class="text-end">สมาชิกกลุ่ม :
                                                    <?php echo mysqli_num_rows($member_hwg) ?> คน</caption>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="collapse mx-3" id="hwg-<?php echo $group_id;?>">
                                        <div class="card card-body">
                                            <div class="row align-content-center ">
                                                <div class="col-md-6 ">
                                                    <div class="form-group ">
                                                        <label for="fileupload">ไฟล์แนบ: </label>
                                                        <?php 
                                                            $hw_grading=hw_grading_detail($conn,$hw_id,$group_id);
                                                            //print_r($hw_grading);
                                                        if(mysqli_num_rows($hw_grading)>=1) {
                                                            $hw_grading=mysqli_fetch_assoc($hw_grading);
                                                            //echo $hw_grading['hw_file'];
                                                            ?>
                                                        <div class="alert alert-primary">
                                                            <a class="btn d-flex align-content-center justify-content-center"
                                                                type="button"
                                                                href="../../upload/hwans/<?php echo $hw_grading['hw_file']; ?>"
                                                                target="_blank">
                                                                <div class="row  ">
                                                                    <div class="col-2">
                                                                        <i class="bi bi-file-earmark"
                                                                            style="font-size: 1.5rem;"></i>
                                                                    </div>
                                                                    <div class=" col-10  " style="font-size: 1.1rem;">
                                                                        <?php echo $hw_grading['hw_file']; 
                                                                        $score=$hw_grading['score'];
                                                                        $file_status=1;
                                                                        ?>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <?php
                                                        }
                                                        else {
                                                            ?>
                                                        <p id="nonefile" class="btn col-12">ไม่มีไฟล์แนบ</p>
                                                        <?php
                                                        $score=0;
                                                        $file_status=0;
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <?php if($file_status==1){ ?>        
                                                <div class="col-md-6 ">
                                                    <form method="POST">
                                                        <div class="input-group">
                                                        <input type="hidden" value="<?php echo $hw_id;?>"
                                                            name="hw_id">
                                                        <input type="hidden" value="<?php echo $group_id;?>"
                                                            name="group_id">
                                                        <span
                                                            class="input-group-text alert-start rounded bg-primary text-white">ให้คะแนน:
                                                        </span>
                                                        <input id="input_score_<?php echo $group_id;?>"
                                                            class="form-control col-3" type="number" 
                                                            value="<?php 
                                                            echo $score;
                                                            ?>"
                                                            name="score" readonly>
                                                        <a id="edit_btn_<?php echo $group_id;?>"
                                                            class="btn btn-warning rounded-end"
                                                            onclick="edit_score(<?php echo $group_id;?>)">แก้ไข</a>
                                                        <button id="confirm-edit_btn_<?php echo $group_id;?>"
                                                         type="submit" class="btn btn-success rounded-end" style="display: none;" 
                                                         name="add_score" value="add_score">ให้คะแนน</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <?php } 
                                                else{
                                                    ?>
                                                    <div class="col-md-6 ">
                                                        <h5 class="text-center">ยังไม่ได้ส่งงาน</h5>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                            }
                                        }
                                        else{
                                            ?>
                                            <h5 class="text-center" >ยังไม่มีการจับกลุ่ม</h5>
                                            <?php
                                        }                       
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4>ยังไม่ได้จับกลุ่ม</h4>
                                    <table class="table">
                                        <thead>
                                            <tr class="text-center">
                                                <th class="col-1">ลำดับ</th>
                                                <th>ชื่อ-นามสกุล</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php    
                                                if(mysqli_num_rows($std_ungroup)>=1){
                                                    $i=1;
                                                    while($std_ungroup_table=mysqli_fetch_assoc($std_ungroup)){
                                                        ?>
                                            <tr>
                                                <td class="text-end"><?php echo $i; ?></td>
                                                <td><?php echo $std_ungroup_table['name']." ".$std_ungroup_table['surname'] ?>
                                                </td>
                                            </tr>
                                            <?php
                                                        $i++;
                                                    }
                                                }
                                                else{
                                                    ?>
                                            <tr class="text-center">
                                                <td colspan="2">-จับกลุ่มครบแล้ว-</td>
                                            </tr>
                                            <?php
                                                }
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </section>
        </div>
    </div>
    </section>
    </div>
    <?php //require_once "../../controllers/footer.php"; ?>
    <script src="../../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/pages/dashboard.js"></script>
    <script src="../../assets/js/main.js"></script>
    <script>
    function edit_score(group_id) {
        //alert('input_score_'+phase+'_'+wl_id);
        document.getElementById('input_score_' + group_id).removeAttribute('readonly');
        document.getElementById('edit_btn_' + group_id).style.display = 'none';
        document.getElementById('confirm-edit_btn_' + group_id).style.display = 'block';
    }
    </script>
</body>

</html>