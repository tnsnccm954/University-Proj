<nav class="navbar navbar-expand navbar-light ">
    <div class="container-fluid">
        <a href="#" class="burger-btn d-block">
            <i class="bi bi-justify fs-3"></i>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="dropdown ms-auto mb-2 mb-lg-0">
                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="user-menu d-flex">
                        <div class="user-name text-end me-3">
                            <h6 class="mb-0 text-gray-600"><?php echo $_SESSION['name']; ?></h6>
                            <p class="mb-0 text-sm text-gray-600"><?php echo $_SESSION['username']; ?></p>
                        </div>
                        <div class="user-img d-flex align-items-center">
                            <div class="avatar avatar-md">
                                <img src="../../assets/images/faces/1.jpg">
                            </div>
                        </div>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">

                    <li>
                        <h6><a class="dropdown-header" href="#"><i class="icon-mid bi bi-person me-2"></i> My
                                Profile</a></h6>
                    </li>
                    <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="../../index.php?logout"><i
                                class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- ส่วนการแจ้งเตือนที่เปลี่ยนจากแบบ Alert
<div class="d-flex justify-content-center">
    <div class="row col-10" >
        <div class="col" >
            <div class="alert alert-success alert-dismissible show fade col-12">
                การทำงานสำเร็จ
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="alert alert-danger alert-dismissible show fade col-12">
                การทำงานผิดพลาด
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>-->