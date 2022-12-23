<?php
require '../../routes/web.php';
include "../../controllers/config.php";
$stu_username = $_SESSION['username'];
$std_id=$_SESSION['user_id'];
$hw_id = $_GET['hw_id'];
//$class_id=$_GET['class_id'];

//model hw_detail
$sql_hw_detail="SELECT * 
FROM `homework` 
WHERE hw_id=$hw_id
";
$hw_detail=mysqli_query($conn,$sql_hw_detail);
$hw_detail=mysqli_fetch_assoc($hw_detail);
$class_id=$hw_detail['classroom_id'];

//model classmember was grouped
$grouped_std_id=[];
$sql_class_grouped="SELECT std_id FROM `hw_group_member`
WHERE hw_id ='$hw_id'
";
$classmember_grouped=mysqli_query($conn,$sql_class_grouped);
while($std_grouped=mysqli_fetch_assoc($classmember_grouped)){
    array_push($grouped_std_id,$std_grouped['std_id']);
}
//print_r($grouped_std_id);
//model print classmember
$member_inclass = "SELECT * FROM `student`
WHERE classroom_id=$class_id";
$result_member_inclass = mysqli_query($conn, $member_inclass);
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
            <!--
            <div class="page-heading">

                <h3 class="text-center">จับกลุ่มการบ้าน</h3>

            </div>-->
            <div class="page-content">
                <section class="section">
                    <form method="POST" action="../../model/student/create_group_in_db.php" class="px-5 py-3 ">

                        <div class="row justify-content-center">
                            <h3 class="text-center py-2">จับกลุ่มการบ้าน</h3>
                            <div class="card col-10 px-5 py-5">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group ">
                                            <label for="helpInputTop">ชื่องาน: </label>
                                            <input type="hidden" name="hw_id"
                                                value="<?php echo $hw_detail['hw_id']; ?>">
                                            <input class="form-control text-right bg-white" type="text" name="hw_name"
                                                value="<?php echo $hw_detail['hw_name']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <div class="form-group ">
                                            <label for="helpInputTop">ประเภทงาน: </label>
                                            <input class="form-control text-right bg-white" type="text"
                                                name="group_name" value="<?php
                                                        if($hw_detail['maximumg']==1){
                                                            echo "เดี่ยว";
                                                        }
                                                        else{
                                                            echo "กลุ่ม";
                                                        }
                                                        ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <div class="form-group ">
                                            <label for="helpInputTop">จำนวนสมาชิกสูงสุด: </label>

                                            <input class="form-control text-right bg-white" type="text" name="maxg"
                                                value="<?php echo $hw_detail['maximumg']; ?>" readonly>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <h3 class="text-center my-3 ">-Build your Teams-</h3>
                            <div class="card col-10 px-5 py-3">

                                <div class="m-3">

                                    <div class="d-flex justify-content-center">

                                        <div class="col-10 my-3 ">
                                            <div class="form-group ">
                                                <label for="helpInputTop">ชื่อกลุ่ม: </label>
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
                                            <tr class="" >
                                                <td class="col-1"><?php echo $i; ?></td>
                                                <td class="col-lg-3">
                                                    <?php echo $table_member['name'] . "  " . $table_member['surname']; ?>
                                                </td>
                                                <td class="col-2">

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
                                            name="create_hwgroup"
                                            value="จับกลุ่ม">
                                        <a class="btn btn-success me-1 mb-1 btn-lg" href=" http://meet.google.com/new "
                                            target="_blank">Meet!</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
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