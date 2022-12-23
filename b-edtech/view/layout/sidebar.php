<?php
//echo $_SESSION['role'];
if(isset($_SESSION['role'])){
    if($_SESSION['role']=="teacher"){
        ?>
        <div id="sidebar" class="">
            <div class="sidebar-wrapper ">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="../../view/teacher/index-te.php"><img  src="../../assets/images/logo/logo.png"
                                    alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item active ">
                            <a href="index-te.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>หน้าแรก</span>
                            </a>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>การทำงาน</span>
                            </a>
                            <ul class="submenu ">
                                <!--
                                <li class="submenu-item ">
                                    <a href="index_logged-tech_add-hw-chooseclass.php">สั่งงาน</a>
                                </li>-->
                                <li class="submenu-item ">
                                    <a href="index_logged-tech_add-class.php">เพิ่มห้องเรียน</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="index_logged-tech_add-subject.php">เพิ่มรายวิชา</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="index_logged-tech_add-hw-checkhomework.php">ตรวจสอบการบ้าน</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="hwproject_assign-teach.php">สั่งโปรเจค</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
<?php
    }
    else if($_SESSION['role']=="student"){
        ?>
        <div id="sidebar" class>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index_logged-std.php">
                                <img  src="../../assets/images/logo/logo.png" alt="Logo"
                                    srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>ระบบงาน</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="index_send_hw_std.php">ส่งการบ้าน</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="hw_list_per_std-std.php">เช็คงาน</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="proj_list_per_std-std.php">โครงงาน</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
<?php
    }
    else if($_SESSION['role']=="parent"){
        ?>
        <div id="sidebar" class>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <a href="index-parent.php"><img src="../../assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item active ">
                            <a href="index-parent.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>หน้าแรก</span>
                            </a>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>ส่วนงานผู้ปกครอง</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="std_list-parent.php">ข้อมูลผู้เรียน</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="std_list-parent_hw.php">เช็คการบ้าน</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="std_list-parent_proj.php">โครงงานนักเรียน</a>
                                </li>
                            </ul>
                        </li>
                        <!--
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>ส่วนงานโรงเรียน</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="component-alert.html">Alert</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="component-badge.html">Badge</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="component-tooltip.html">Tooltip</a>
                                </li>
                            </ul>
                        </li>-->
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
<?php
    }
}
else {
    echo "error" ;
}
?>