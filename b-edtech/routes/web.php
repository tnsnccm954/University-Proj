<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if (!isset($_SESSION['user_id'])){
        ?>
        <script>
            alert("ยังไม่มีการเข้าสู่ระบบ/หมดเวลาการใช้งาน");
            window.location='https://b-edtech.herokuapp.com/';
        </script>
        <?php
    }
}
//model
$model="../../model/";

//controller
$controller="../../controllers/";

//view
$view="../../view/";

//layout
$layout="../layout/";

//route_by role 
if(isset($_SESSION['role'])){
    if($_SESSION['role']=="teacher"){
        $role_route="teacher/";
    }
    else if($_SESSION['role']=="student"){
        $role_route="student/";
    }
    else if($_SESSION['role']=="parent"){
        $role_route="parent/";
    }
}

?>