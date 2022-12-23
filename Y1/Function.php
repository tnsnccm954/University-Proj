<?php
    //connectDB phase
    $condb=mysqli_connect('localhost','root','','swu_market');
?>
<?php
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['login']))
    {
        login_func();
    }
    elseif($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['adduser_btn']))
    {   
        pre_register();
    }
    elseif($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['kill_process']))
    {   
        session_destroy();
        header("Location:guest_index.php");
    }
function pre_register(){
    $condb=mysqli_connect('localhost','root','','swu_market');
    $username=$_POST['username'];
    $password=$_POST['pass'];
    $producttype = $_POST['producttype'];
    $shop_name = $_POST['shop_name'];
    $shop_co_name=$_POST['shop_co_name'];
    $product_detail = $_POST['product_detail'];
    $phone_num=$_POST['phonenumber'];
    $sumall=$_POST['shop_cost'];
    mysqli_query($condb,"INSERT INTO `user_member` (`username`, `pass`, `shop_name`, `shop_co_name`, `shop_product`, `shop_type` , `tel_num`, `shop_cost`)
                            VALUES ('$username', '$password', '$shop_name', '$shop_co_name', '$product_detail','$producttype', '$phone_num', '$sumall')");
    header("Location:guest_index.php");
}
function login_func(){
    $condb=mysqli_connect('localhost','root','','swu_market');
    $username=$_POST['username'];
    $password=$_POST['pass'];
    //mysqli_query($condb,"DELETE FROM member WHERE id=0");
    $sql= "SELECT * FROM admin_member WHERE username='$username' AND pass='$password'";
    $result=mysqli_query($condb,$sql);
    if(mysqli_num_rows($result)==1){
        $row = mysqli_fetch_assoc($result);
        echo "hello";
        if ($row['username']==$username && $row['pass']==$password){
            header("Location:admin_index.php");
        }
        else
        {
            $message = "Login Error";
            echo "<script type='text/javascript'>alert('$message');</script>";
            
        }
    }
    else{
        $sql= "SELECT * FROM user_member WHERE username='$username' AND pass='$password'";
        $result=mysqli_query($condb,$sql);
        $row = mysqli_fetch_assoc($result);
        echo " Welcome to";
        if ($row['username']==$username && $row['pass']==$password){
            header("Location:guest_index.php");
        }
        else{
            $message = "Login Error";
            echo "<script type='text/javascript'>alert('$message');</script>";
            
        }
    }
}
function deleteregister(){

}
?>
