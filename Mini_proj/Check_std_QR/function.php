<?php

require_once "config.php";
date_default_timezone_set("Asia/Bangkok");

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['login'])) {
    $username = $_POST['username'];
    $pass = $_POST['password'];
    session_start();
    login($username, $pass, $conn);
}
if ($_SERVER['REQUEST_METHOD'] == "GET" and isset($_GET['logout'])) {
    logout($conn);
}
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['check_in'])) {
    $state_codename=$_POST['state_codename'];
    $std_id=$_POST['std_id'];
    $displayname=$_POST['displayname'];
    session_start();
    $recheck=recheck_check_in($state_codename,$std_id,$conn);
    if($recheck==1){
    check_in($state_codename,$std_id,$displayname,$conn);
    }
    else if($recheck==2){
        ?>
        <script type="text/javascript">
        alert("รหัสนักเรียนไม่ถูกต้อง");
        window.location = 'check_in_std.php?state_codename=<?php echo $state_codename; ?>';
    </script>
        <?php
    }
    else{
        ?>
        <script type="text/javascript">
        alert("เช็คชื่อเรียบร้อยแล้ว");
        window.location = 'check_in_std_success.php?state_codename=<?php echo $state_codename; ?>&displayname=<?php echo $displayname; ?>'
    </script>
        <?php
    }
}

//login&logout function
function login($user, $pass, $condb)
{
    $sql_login = "SELECT * FROM `teacher`
        WHERE te_username='$user' AND te_pass='$pass'";
    $result_Log = mysqli_query($condb, $sql_login);
    $data_login = mysqli_fetch_array($result_Log, MYSQLI_BOTH);
    
    if ($data_login) {
        $_SESSION['name'] = $data_login['te_name'];
        $_SESSION['username'] = $data_login['te_username'];

?>
        <script type="text/javascript">
            alert("<?php echo $_SESSION['name']; ?> ล็อคอิน สำเร็จ -w- b");
            window.location = 'index_logged-te.php';
        </script>
    <?php
    } else { ?>
        <script type="text/javascript">
            alert("<?php echo "ข้อมูลผิดพลาด"; ?>");
            window.location = 'index.php';
        </script>
<?php
    }
}
function logout($condb)
{
    session_start();
    session_unset();
    mysqli_close($condb);
}

//check-in
function check_in($state_codename,$std_id,$displayname,$condb){
    //timetofloat
    function hours_tofloat($val)
    {
        if (empty($val)) {
            return 0;
        }
        $parts = explode(':', $val);
        return $parts[0] + floor(($parts[1] / 60) * 100) / 100;
    }
    function float_tohours($val)
    {
        $newvalue = floor($val) . ':' . (($val * 60) % 60);
        return $newvalue;
    }
    $time= date('H:i');
    $date=date('Y-m-d');
    $timecollect=hours_tofloat($time);
    $timestart=hours_tofloat("07:29");
    $timelate=hours_tofloat("08:10");
    $timelimit=hours_tofloat("08:16");
    if($timelate>=$timecollect&&$timecollect>=$timestart){
        $result="/";
    }
    elseif($timelate<$timecollect){
        $result="สาย";
    }
    elseif($timecollect>=$timelimit){
        $result="สาย";
    }
    else{
        $result="ขาด";
    }
    $sql="INSERT INTO `check_in_statement`(`state_codename`, `std_id`, `display_name`,`time`,`date_access`,`result`) VALUES ('$state_codename','$std_id','$displayname','$time','$date','$result')";
    $check_in = mysqli_query($condb, $sql);
    if (!$check_in) {
        $_SESSION['msg'] = "เช็คชื่อ ผิดพลาด";
        ?>
    <script type="text/javascript">
        alert("<?php echo $_SESSION['msg'] ?>");
        window.location = 'check_in_std.php?state_codename=<?php echo $state_codename; ?>';
    </script>
    <?php
    } else {
        $_SESSION['msg'] = "นักเรียน:$displayname เช็คชื่อเข้าสู่ระบบ เสร็จเรียบร้อย";
    }
    ?>
    <script type="text/javascript">
        alert("<?php echo $_SESSION['msg'] ?>");
        window.location = 'check_in_std_success.php?state_codename=<?php echo $state_codename; ?>&displayname=<?php echo $displayname; ?>';
    </script>
    <?php
    
}
function recheck_check_in($state_codename,$std_id,$condb){
    $sql= "SELECT * FROM `check_in_statement` WHERE state_codename='$state_codename' AND std_id='$std_id'";
    $recheck_std=mysqli_query($condb,$sql);
    $recheck_std_array=mysqli_fetch_array($recheck_std);

    $sql2_checkstd_id="SELECT std_id FROM `student` WHERE  std_id='$std_id'";
    $check_std_id=mysqli_query($condb,$sql2_checkstd_id);
    $std_id_array=mysqli_fetch_array($check_std_id);
    $recheck=0;

    if(!$std_id_array){
        $recheck=2;
    }
    else if (isset($recheck_std_array) && isset($recheck_std)) {
        $recheck=0;
    } else {
        $recheck=1;
    }
    return $recheck;
}
?>