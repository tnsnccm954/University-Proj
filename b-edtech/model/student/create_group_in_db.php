<?php
include '../../controllers/config.php';
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['create_hwgroup'])){

}
$hw_id=$_POST['hw_id'];
$maxg = $_POST['maxg'];
$array_stu_id = $_POST['stu_id'];
//echo $hw_id,$maxg;
//print_r($array_stu_id);
if (count($array_stu_id) > $maxg) {
    $_SESSION['msg'] = "จำนวนเกินกว่าที่กำหนด ผิดพลาด";
    ?>
    <script type="text/javascript">
        alert("<?php echo $_SESSION['msg']; ?>");
        window.location = '../../view/student/create_hwgroup_stu.php?hw_id=<?php echo $hw_id; ?>';
    </script>
    <?php
}
else
{
    $status=0;
    for($i=0;$i<count($array_stu_id);$i++){
        $search_group_up="SELECT * ,
        count(`statment_id`) record 
        FROM `hw_group_member`
        WHERE hw_id='$hw_id' AND std_id='$array_stu_id[$i]'
        ";
        $check_group_up=mysqli_query($conn,$search_group_up);
        $array_group_up=mysqli_fetch_array($check_group_up);
        if($array_group_up['record']>=1){
            $status-=1;
        }
        
    
    }
    //echo $status;
    if($status==0)
    {
    $group_name = $_POST['group_name'];
    echo $group_name;

        for($i=0;$i<count($array_stu_id);$i++){
            $sql_add_group="INSERT INTO `hw_group_member`(`group_name`, `hw_id`, `std_id`) 
            VALUES ('$group_name','$hw_id','$array_stu_id[$i]')";
            mysqli_query($conn,$sql_add_group);

        }
        $check_statement_id="SELECT * FROM `hw_group_member` WHERE group_name='$group_name' GROUP BY hw_id";
        $recieve_statement_id=mysqli_fetch_array(mysqli_query($conn,$check_statement_id));
        $statement_of_g=$recieve_statement_id['statment_id'];
        $add_group_id="UPDATE `hw_group_member` SET `group_id`='$statement_of_g' WHERE group_name='$group_name'
        ";
        mysqli_query($conn,$add_group_id);
        //$_SESSION['group_id']=$first_statement_of_g."_".$group_name;
        $_SESSION['msg'] = "เพิ่มข้อมูลเสร็จสิ้น";
        ?>
    <script type="text/javascript">
        alert("<?php echo $_SESSION['msg']; ?>");
        window.location = '../../view/student/index_logged-std.php';
    </script>
    <?php
    }
    elseif($status<0){
        $_SESSION['msg'] = "เพื่อนมีกลุ่มแล้วจับใหม่นะ";
        ?>
    <script type="text/javascript">
        alert("<?php echo $_SESSION['msg']; ?>");
        window.location = '../../view/student/create_hwgroup_stu.php?hw_id=<?php echo $hw_id; ?>';
    </script>
    <?php
    }
}
?>