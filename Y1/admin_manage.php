<?php
    include 'Function.php';
    $ai_db=['ร้านข้าวมันไก่','ร้านยิ่งรวย','ร้านข้าวnamisalah','ร้านข้าวrealme'];
    $m_area=["A1","A2","A3","A4","B1","B2","B3","B4"];
    session_start();
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
        <form action="admin_manage_confirm.php" method="POST">
            <table>
                <caption>
                    <div class="toptable">
                        <label for='day'>จัดตลาดในวันที่ : </label><input name="day" type="date" required>
                    </div>
                </caption>
                <tr>
                    <?php
                    for($i=0;$i<8;$i++){
                        echo "<td>"."<br>"."Sample<br>".$m_area[$i]."<br>";
                        echo "<select name=".$m_area[$i]." id=''>";
                        $sql= "SELECT * FROM user_member";
                        $result=mysqli_query($condb,$sql);
                        while ($row=mysqli_fetch_assoc($result)){
                        echo  "<option value=".$row['user_id'].">".$row['shop_name']."</option>";
                        }
                        echo"</select><br></td>";
                        if($i==3){
                        echo "</tr><tr>";
                        }
                }
                    ?>
                </tr>
                <caption></caption>
            </table>
            <div class="middle-btn"><input type="submit" formmethod="POST" formaction="admin_manage_confirm.php" name="admin_manage" value="ยืนยัน"></div>
        </form>
    </div>
</div>
</body>
</html>