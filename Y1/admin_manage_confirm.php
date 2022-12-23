<?php
    include 'Function.php';
    $day_recept=$_POST['day'];
    session_start();
    $A1_recept=$_POST['A1'];
    $A2_recept=$_POST['A2'];
    $A3_recept=$_POST['A3'];
    $A4_recept=$_POST['A4'];
    $B1_recept=$_POST['B1'];
    $B2_recept=$_POST['B2'];
    $B3_recept=$_POST['B3'];
    $B4_recept=$_POST['B4'];
    $m_area=["A1","A2","A3","A4","B1","B2","B3","B4"];
    
    $m_area_managed=[$A1_recept,$A2_recept,$A3_recept,$A4_recept,$B1_recept,$B2_recept,$B3_recept,$B4_recept];
    
    for($i=0;$i<8;$i++){
    $sql="SELECT * FROM `user_member` WHERE `user_id`='$m_area_managed[$i]'";
    $result=mysqli_query($condb,$sql);
    $row=mysqli_fetch_assoc($result);
        if($row['user_id']==$m_area_managed[$i]){
            $m_area_managed[$i]=$row['shop_name'];
            }
    }
    $areamanaged=mysqli_query($condb,"INSERT INTO `area_manage` (`time_market`, `A1`, `A2`, `A3`, `A4`, `B1`, `B2`, `B3`, `B4`)
                         VALUES ('$day_recept','$A1_recept','$A2_recept','$A3_recept','$A4_recept','$B1_recept','$B2_recept','$B3_recept','$B4_recept')");
    if(isset($_POST['delete'])){
        mysqli_query($condb,"DELETE FROM `area_manage` WHERE time_market='$day_recept'");
        header("Location:admin_index.php");
        }
    if(isset($_POST['add_area_managed'])){
        header("Location:admin_index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="main_style.css" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
        <div class="nav">
                <h1>SWU-Marketplace</h1>
                <div class="weblogo"><img  src="https://upload-icon.s3.us-east-2.amazonaws.com/uploads/icons/png/8026814321579250998-512.png" ></div>
                <ul>
                    <li><a href="admin_index.php">Home</a></li>
                    <li><a href="admin_manage.php">Manage Market</a></li>
                    <li><a href="guest_index.php">Logout</a></li>
                </ul>
        </div>
<div class="market">
    <form method="POST">
        <table>
            <caption>
                    <div class="toptable">
                        <label for='day'>จัดตลาดในวันที่ : </label><input name="day" type="date" value="<?php echo $day_recept;?>" readonly>
                    </div>
                </caption>
            <tr>
                <?php
                for($i=0;$i<8;$i++){
                    echo "<td>";
                    echo $m_area_managed[$i].'<br>';
                    echo $m_area[$i]."<br></td>";
                    if($i==3){
                    echo "</tr><tr>";
                    }
                }
                ?>
            </tr>
        </table>
        <div class="middle-btn">
        <input type="submit" name="delete" value="ยกเลิก">
        <input type="submit" name="add_area_managed" value="ยืนยัน">
        </div>
    </form>
</div>
</body>
</html>