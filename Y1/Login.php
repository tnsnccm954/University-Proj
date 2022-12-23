<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="main_style.css" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body class="login">
    <div div class="containerlogin">
    <form method="POST">
    <h1>Login</h1><br>
        <label for="username">username :</label>
        <input type="text" name="username" required>
        <br>
        <label for="pass">Password :</label>
        <input type="password" name="pass" required>
        <br>
        <div class="middle-btn">
        <a href="guest_index.php"><div class="btn">Cancel</div></a>
        <input type="submit" name="login" value="Login">
        </div>
    </form></div>
</body>
</html>

<?php
    include 'Function.php';
    if(!$condb){
        die("Connection failed: " . mysqli_connect_error());
    }
?>