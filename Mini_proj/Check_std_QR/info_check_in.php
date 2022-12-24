<?php
    require_once 'config.php';
    $date_access=$_GET['date_access'];
    $sql_std_list="SELECT * FROM `student` std 
    ORDER BY std.std_id  ASC
    ";
    $sdt_list=mysqli_query($conn,$sql_std_list);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>info_check</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
</head>

<body>
    <div id="app">
        <?php require_once "sidebar-te.php"; ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h4>รายละเอียดประวัติการเช็คชื่อ</h4>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index_logged-te.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">รายละเอียดประวัติการเช็คชื่อ</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-center">รายการเช็คชื่อ วันที่:<?php print displaydate($date_access); ?> </h4>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <th>ลำดับ</th>
                                    <th>รหัสนักเรียน</th>
                                    <th>ชื่อ-นามสกุล</th>
                                    <th>ผลการเช็คชื่อ</th>
                                    <th>หมายเหตุ</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $i=1;
                                        while($stdtable=mysqli_fetch_array($sdt_list)){
                                            ?>
                                            <tr>
                                                <td><?php print $i; ?></td>
                                                <td><?php $std_id=$stdtable['std_id']; print $std_id; ?></td>
                                                <td><?php print $stdtable['std_name']." ".$stdtable['std_surname']; ?></td>
                                                <td><?php echo result_check_in($conn,$date_access,$std_id);
                                                ?></td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>

<?php
function result_check_in($condb,$date_access,$std_id){
    $sql_infodate="SELECT state_codename,date_access,std_id,result FROM `check_in_statement` WHERE date_access='$date_access' AND std_id='$std_id'";
    $infocheckdate_history=mysqli_query($condb,$sql_infodate);
    
    if($infocheckdate_history){
        $result=mysqli_fetch_row($infocheckdate_history);
        if(isset($result)){
        $result_check=$result[3];
        }
        else{
            $result_check='ขาด';
        }
    }
    else{
        $result_check='ผิดพลาด';
    }
    return $result_check;
}
?>