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
        <h1>Register</h1><br>
            <label for='username' >username :</label>
            <input type="text" name="username" required><br>
            <label for='password'>Password :</label>
            <input type="password" name="pass" required><br>
            <label for='shop_name'>ชื่อร้าน :</label><input type='text' name='shop_name' value=''required><BR>
            <label for='shop_name'>ชื่อผู้ประกอบการ :</label><input type='text' name='shop_co_name' value=''required><BR>
            <label for="productype"> ประเภทสินค้า : </label>
                <select ID="producttype" NAME="producttype" placeholder="กรุณาเลือกประเภทสินค้า" required>
                <option name="" value="NotSelected" style="display:none;">กรุณาเลือกประเภทสินค้า</option>
                <option id="food" value="อาหาร">อาหาร</option>
                <option id="fruit" value="ผลไม้">ผลไม้</option>
                <option id="appliance" value="ของใช้">ของใช้</option>
                <option id="clothes" value="เสื้อผ้า">เสื้อผ้า</option>
            </select><BR>
            <label for='product_detail'>รายละเอียดสินค้า : </label><input type='text' name='product_detail' value=''><BR>
            <label for='option'>สิ่งอำนวยความสะดวก :</label><br>
            <input type="checkbox" name="water" value="น้ำ"> <label for="water">น้ำ (300บาท)</label>
            <input type="checkbox" name="electric" value="ไฟฟ้า"> <label for="electric">ไฟฟ้า (300บาท)</label><br>
            <input type="checkbox" name="foldingtable" value="โต๊ะพับ"><label> โต๊ะพับ</label>
            <label>| กรุณาใส่จำนวน :</label>
            <input type="text" name="count_table" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}"/><br>
            <input type="checkbox" name="chair" value="เก้าอี้"><label> เก้าอี้</label>
            <label>| กรุณาใส่จำนวน : </label>
            <input type="text" name="count_chair" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}"/><br>
            <label>เบอร์โทรศัพท์ : </label><input type="text" name="phonenumber" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}"/><br>
            <div class="middle-btn">
                <a href="guest_index.php"><div class="btn">Cancel</div></a>
                <input type="submit" formmethod="POST" formaction="register_confirm.php"  value="Register">
            </div>
        </form>
    </div>
</body>
</html>

<?php
    include 'Function.php';
    if(!$condb){
        die("Connection failed: " . mysqli_connect_error());
    }
?>