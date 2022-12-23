<?php
    include "Function.php";
    $username = $_POST['username']??null;
    $password = $_POST['pass']??null;
    $producttype = $_POST['producttype']??null;
    $shop_name = $_POST['shop_name']?? null;
    $shop_co_name=$_POST['shop_co_name'];
    $product_detail = $_POST['product_detail']?? null;
    $phone_num=$_POST['phonenumber']??null;
    $shop_option=["ค่าเช่า",$_POST['water']??null,
                    $_POST['electric']??null,
                    $_POST['foldingtable']??null,
                    $chair = $_POST['chair']?? null]??null;
    $count_table = $_POST['count_table']??null;
    $count_chair = $_POST['count_chair']??null;
    $price_table = 150;
    if(is_numeric($count_table)){
    $sumtable=$price_table*$count_table;}
    else{
        $sumtable=0;
    }
    $price_chair = 50;
    if(is_numeric($count_chair)){
    $sumchair=$price_chair*$count_chair;}
    else{
        $sumchair=0;
    }
    $rent = 3000;
    if(isset($_POST['water'])){
        $Water_option=1200;
    }
    elseif(!isset($_POST['water'])){
        $Water_option=0;
    }
    if(isset($_POST['electric'])){
        $elec_option=600;
    }
    elseif(!isset($_POST['electric'])){
        $elec_option=0;
    }
    $sumall=$rent+$elec_option+$Water_option+$sumchair+$sumtable;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="main_style.css" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
</head>
<body class="login">
    <div class="containerlogin">
        <form method="POST">
        <h1>Register</h1>
            <input type="hidden" name="username" value="<?php echo $username;?>" readonly>
            <input type="hidden" name="pass" value="<?php echo $password;?>" readonly>
            <label for='shop_name'>ชื่อร้าน :</label><input type='text' name='shop_name' value="<?php echo $shop_name;?>"readonly>
            <label for='shop_name'>ชื่อผู้ประกอบการ :</label><input type='text' name='shop_co_name' value="<?php echo $shop_co_name;?>"readonly><BR>
            <label for="productype"> ประเภทสินค้า : </label>
                <input type="text" ID="producttype" NAME="producttype" value="<?php echo $producttype;?>" readonly>
            <label for='product_detail'>รายละเอียดสินค้า : </label><input type='text' name='product_detail' value="<?php echo $product_detail;?>"><BR>
            <label for='option'>สิ่งอำนวยความสะดวก :</label><br>
            <table class="list_optiontable">
                <tr>
                    <th>ลำดับ</th>
                    <th>รายการ</th>
                    <th>จำนวน</th>
                    <th>ราคา(บาท)</th>
                </tr>
                <?php
                    $j=1;
                    for($i=0;$i<count($shop_option);$i++){
                        
                        if(isset($shop_option[$i])){
                        echo "<tr>";
                        echo "<td>".($j)."</td>";
                        echo "<td>".$shop_option[$i]."</td>";
                        }
                        if($shop_option[$i]=="ค่าเช่า"){
                            echo "<td>-</td>";
                            echo "<td>$rent</td>";
                            $j++;  
                             }
                        elseif($shop_option[$i]=="น้ำ"){
                        echo "<td>-</td>";
                        echo "<td>$Water_option</td>";
                        $j++;  
                         }
                        elseif($shop_option[$i]=="ไฟฟ้า"){
                            echo "<td>-</td>";
                            echo "<td>$elec_option</td>";
                            $j++;  
                             }
                        elseif($shop_option[$i]=="โต๊ะพับ"){
                            echo "<td>".$count_table."</td>";
                            echo "<td>".$sumtable."</td>";
                            $j++;  
                        }
                        elseif($shop_option[$i]=="เก้าอี้"){
                            echo "<td>".$count_chair."</td>";
                            echo "<td>".$sumchair."</td>";
                            $j++; 
                        }
                         
                        echo "</tr>";
                        
                    }
                ?>
                <tr>
                    <td colspan="3">รวมทั้งหมด</td>
                    <td><?php echo $sumall; ?></td>
                </tr>
            </table>
            <input type="hidden" name="shop_option" 
            value="
            <?php 
            for($i=0;$i<count($shop_option);$i++){
                
                echo $shop_option[$i];
                 if(!isset($shop_option[($i+1)])){
                    break;
                }
                echo ","; 
            } 
            ?>" >
            <input type="hidden" name="shop_cost" value="<?php echo $sumall ?>">
            <label>เบอร์โทรศัพท์ : </label><input type="text" maxlength="10" name="phonenumber"value="<?php echo $phone_num;?>"readonly><br>
            <div class="middle-btn">
                <input type="submit" name="kill_process" value="Cancel">
                <input type="submit" formmethod="POST" name="adduser_btn" value="Register">
            </div>
        </form>
    </div>
</body>
</html>