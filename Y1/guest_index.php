<?php
    include "Function.php";
    $m_area=["0","A1","A2","A3","A4","B1","B2","B3","B4"];
    session_start();
    $area_shop=[];
    $sql1= "SELECT * FROM `area_manage` ";
    $result1=mysqli_query($condb,$sql1);
    $row=mysqli_fetch_array($result1);
    if(isset($row)){
    for($i=0;$i<=8;$i++){
        array_push($area_shop,$row[$i]);
    }
    for($i=1;$i<=8;$i++){
    $sql2="SELECT * FROM `user_member` WHERE `user_id`='$area_shop[$i]'";
    $result2=mysqli_query($condb,$sql2);
    $row2=mysqli_fetch_assoc($result2);
        if($row2['user_id']==$area_shop[$i]){
            $area_shop[$i]=$row2['shop_name'];
            }
    }
    $_SESSION['day']=$_GET['daysent']??null;
    $m_day=$_SESSION['day']??$area_shop[0];
    }
    else{
        $area_shop=[];
        for($i=1;$i<=8;$i++){
            $area_shop[$i]="none";
            }
    }
    if(isset($m_day)){
        $area_shop=[];
        $sql1= "SELECT * FROM `area_manage` WHERE `time_market`='$m_day'";
        $result1=mysqli_query($condb,$sql1);
        $row=mysqli_fetch_array($result1);
        for($i=0;$i<=8;$i++){
            array_push($area_shop,$row[$i]);
        }
        for($i=1;$i<=8;$i++){
        $sql2="SELECT * FROM `user_member` WHERE `user_id`='$area_shop[$i]'";
        $result2=mysqli_query($condb,$sql2);
        $row2=mysqli_fetch_assoc($result2);
            if($row2['user_id']==$area_shop[$i]){
                $area_shop[$i]=$row2['shop_name'];
                }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="main_style.css" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>guest_index</title>
</head>
<body>
    <div class="container">
        <div class="nav">
                <h1>SWU-Marketplace</h1>
                <div class="weblogo"><img  src="https://upload-icon.s3.us-east-2.amazonaws.com/uploads/icons/png/8026814321579250998-512.png" ></div>
                <form method="GET">
                <select name="daysent" placeholder="เลือกวันที่" required>
                    <option value="" style="display: none;" >เลือกวันที่</option>
                    <?php
                        $sql3= "SELECT `time_market` FROM `area_manage`";
                        $result3=mysqli_query($condb,$sql3);
                        while($row3=mysqli_fetch_assoc($result3)){
                            echo '<option value="'.$row3['time_market'].'">'.$row3['time_market']."</option>";
                        }
                    ?>
                </select>
                <input type="submit" name="day_choose" value="ยืนยัน">
                </form>
                <ul>
                    <li><a href="guest_index.php">Home</a></li>
                    <li><a href="Login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                </ul>
        </div>
        <div class="market">
            <table class="nonform">
                <caption>
                    <div class="toptable">
                        <label for="today">การจัดตลาดของวันที่ : </label>
                        <input name="day" type="date" value="<?php echo $m_day;?>" readonly>
                    </div>
                </caption>
                <tr>
                    <?php
                        for($i=1;$i<=8;$i++){
                            echo "<td><br>".$area_shop[$i]."<br>".$m_area[$i]."</td>";
                            if($i==4){
                                echo "</tr><tr>";
                            }
                        }
                    ?>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
