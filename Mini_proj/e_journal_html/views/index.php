<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/main-font.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <title>SMTAT-Home</title>
</head>

<body class="">
<?php
        include "header_nav.php";
    ?>
    <div class="container bg-white"> 
        <main>
            <div class="container col-xl-10 col-xxl-8 px-4 py-5">
                <div class="row align-items-center g-lg-5 py-5">
                    <div class="col-lg-7 text-center text-lg-start">
                        <h1 class="display-4 fw-bold lh-1 mb-3">ยินดีต้อนรับเข้าสู่ระบบ e-journal</h1>
                        <p class="col-lg-10 fs-4">Below is an example form built entirely with Bootstrap’s form
                            controls. Each required form group has a validation state that can be triggered by
                            attempting to submit the form without completing it.</p>
                    </div>
                    <div class="col-md-10 mx-auto col-lg-5 text-center">
                        <form class="p-4 p-md-5 border rounded-3 bg-light">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput"
                                    placeholder="ค้นหาข้อมูล">
                                <label for="floatingInput">ค้นหาวารสาร</label>
                            </div>
                            <button class="w-100 btn btn-lg btn-primary" type="submit">ค้นหา</button>
                            <hr class="my-4">
                            <small class="text-muted ">กรุณาพิมพ์คำค้นหาที่คุณต้องการ</small>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
<script src="../js/bootstrap.bundle.min.js"></script>