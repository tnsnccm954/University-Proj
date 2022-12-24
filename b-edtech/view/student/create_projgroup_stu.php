<?php
require '../../routes/web.php';
include "../../controllers/config.php";
require $model."proj_management.php";
$std_id=$_SESSION['user_id'];
$proj_id = $_GET['proj_id'];
//model
$array_proj_detail=project_detail($conn,$proj_id);
$class_id = $array_proj_detail['classroom_id'];
$member_inclass = "SELECT * FROM `student`
WHERE classroom_id='$class_id'";
$result_member_inclass = mysqli_query($conn, $member_inclass);

//model grouped
$grouped_std_id=[];
$sql_class_grouped="SELECT std_id FROM `proj_member`
WHERE proj_id ='$proj_id'
";
$classmember_grouped=mysqli_query($conn,$sql_class_grouped);
while($std_grouped=mysqli_fetch_assoc($classmember_grouped)){
    array_push($grouped_std_id,$std_grouped['std_id']);
}
//controlls
if (mysqli_num_rows($result_member_inclass)<1) {
    $_SESSION['msg'] = "หาห้องเรียนไม่ครบ ผิดพลาด";
?>
<script type="text/javascript">
alert("<?php echo $_SESSION['msg']; ?>");
//window.location = 'index_logged-std.php';
</script>
<?php
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create-group</title>

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

                <h3>จับกลุ่มงานโปรเจค</h3>

            </div>
            <div class="page-content">
                <section class="section">
                    <div class="card">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="class_code">ห้องเรียน: </label>
                                        <input class="form-control text-right bg-white" type="text"
                                            value="<?php echo $array_proj_detail['classroom_name']; ?>" disabled>
                                    </div>
                                    <div div class="form-group">
                                        <label for="proj_name">ชื่องานวิจัย: </label>
                                        <input class="form-control text-right bg-white" type="text"
                                            value="<?php echo $array_proj_detail['hwproj_name']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="helpInputTop">วิชา: </label>
                                        <input class="form-control text-right bg-white" type="text"
                                            value="<?php echo $array_proj_detail['subject_codename']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="max_member">จำนวนสมาชิก: </label>
                                        <input type="text" class="form-control col-md-12 bg-white text-right"
                                            value="<?php echo $array_proj_detail['maximumg']; ?>" id="maxg" name="maxg"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="proj_detail">รายละเอียด: </label>
                                        <textarea class="form-control bg-white" placeholder="กรุณากรอกรายละเอียดงาน"
                                            id="proj_detail" name="proj_detail" rows="4" cols="50"
                                            disabled><?php echo $array_proj_detail['proj_detail']; ?></textarea>
                                    </div>
                                </div>


                            </div>

                        </div>

                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <form method="POST" action="../../model/student/create_group_proj_in_db.php"
                                    class="px-5 py-3 ">
                                    
                                        <h3 class="text-center">-Build your Teams-</h3>
                                        <div class="d-flex justify-content-center">
                                           
                                                <div class="col-10 my-3 ">
                                                    <div class="form-group ">
                                                        <label for="helpInputTop">ชื่อกลุ่ม: </label>
                                                        <input type="hidden" value="<?php echo $proj_id;  ?>" id="proj_id"
                                                            name="proj_id" readonly>
                                                        <input type="hidden"
                                                            value="<?php echo $array_proj_detail['maximumg']; ?>" id="maxg"
                                                            name="maxg" readonly>
                                                            <div class=" m-2">
                                                                <input class="form-control text-right bg-white " type="text"
                                                                    name="group_name" placeholder="กรุณากรอกชื่อกลุ่ม" required>
                                                            </div>
                                                    </div>
                                                </div>
                                            
                                        </div>
                                    
                                    <table class="col-12 table table-sm text-center">
                                        <thead> 
                                            <th>ลำดับ</th>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>เลือกสมาชิก</th>
                                            <th>หมายเหตุ</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while ($table_member = mysqli_fetch_assoc($result_member_inclass)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $table_member['name'] . "  " . $table_member['surname']; ?>
                                                </td>
                                                <td>

                                                    <input name="stu_id[]" value="<?php echo $table_member['std_id'] ?>"
                                                        class="form-checkbox" type="checkbox" <?php
                                                            foreach($grouped_std_id as $value){
                                                                if($table_member['std_id']==$value)echo " disabled";
                                                            }
                                                            if($table_member['std_id']==$std_id){
                                                                echo "checked disabled";
                                                                
                                                        ?>>
                                                    <input type="hidden" name="stu_id[]"
                                                        value="<?php echo $table_member['std_id'] ?>">
                                                    <?php
                                                            }?>
                                                </td>
                                                <td>
                                                    <?php
                                                        $groupstatus=0;
                                                        foreach($grouped_std_id as $value){
                                                            if($table_member['std_id']==$value){
                                                                $groupstatus+=1;
                                                                break;
                                                            }
                                                        }
                                                        //echo $groupstatus;
                                                        if($groupstatus>=1)echo 'มีกลุ่มแล้ว';
                                                        else echo '-';
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <div class="col-12 d-flex justify-content-end">
                                        <input type="submit" class="btn btn-light-primary me-1 mb-1 btn-lg"
                                            value="จับกลุ่ม">
                                        <a class="btn btn-success me-1 mb-1 btn-lg" href=" http://meet.google.com/new "
                                            target="_blank">Meet!</a>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </section>
            </div>

            <?php require_once "../../controllers/footer.php"; ?>
        </div>
    </div>
    <script src="../../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>

    <script src="../../assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="../../assets/js/pages/dashboard.js"></script>

    <script src="../../assets/js/main.js"></script>

</body>

</html>