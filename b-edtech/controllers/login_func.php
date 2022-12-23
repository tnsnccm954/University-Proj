<?php

require "config.php";
 
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['login'])) {
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $role = $_POST['role'];
    if ($role == 1) {
        $role = "student";
    } elseif ($role == 2) {
        $role = "teacher";
    }
    elseif ($role == 3) {
        $role = "parent";
    }
    session_start();
    login($username, $pass, $conn, $role);
}
if ($_SERVER['REQUEST_METHOD'] == "GET" and isset($_GET['logout'])) {
    logout($conn);
}

//login&logout function
function login($user, $pass, $condb, $role)
{
    $sql_login = "SELECT * FROM $role
        WHERE username='$user' AND pass='$pass'";
    $result_Log = mysqli_query($condb, $sql_login);
    $data_login = mysqli_fetch_array($result_Log, MYSQLI_BOTH);
    mysqli_close($condb);
    if ($data_login) {
        $_SESSION['name'] = $data_login['name'];
        $_SESSION['username'] = $data_login['username'];
       
?>
        <script type="text/javascript">
            alert("<?php echo $role . " " . $_SESSION['name']; ?> ล็อคอิน สำเร็จ -w- b");
            window.location = '<?php
                                if ($role == "teacher") {
                                    $_SESSION['user_id']=$data_login['teacher_id'];
                                    $_SESSION['role']='teacher';
                                    echo 'view/teacher/index-te.php';
                                }
                                elseif ($role == "student") {
                                    $_SESSION['user_id']=$data_login['std_id'];
                                    $_SESSION['role']='student';
                                    echo 'view/student/index_logged-std.php';
                                }
                                elseif($role="parent"){
                                    $_SESSION['user_id']=$data_login['parent_id'];
                                    $_SESSION['role']='parent';
                                    echo'view/parent/index-Parent.php';
                                } 
                                ?>';
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

