<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/main-font.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <title>SMTAT-Read</title>
</head>

<body>
    <?php
        include "header_nav.php";
        ?>
    <div class="container bg-white">
        
        <main>
            <div class="container-fluid col-xl-12 px-2 py-2 ">
                <div class="d-flex justify-content-center col-12">
                    <label for="Search" class="my-auto">ค้นหาวารสาร: </label>
                    <form class="d-flex col-8 form-inline">
                        <input class="form-control mr-sm-2 mx-3" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-primary my-2 my-sm-0 " type="submit">Search</button>
                    </form>
                </div>
                <div class="d-flex justify-content-center py-2 col text-center ">
                    <div class="card w-100 border border-primary p-3 m-2" style="max-width: 720px;">
                        <iframe class="h-100" style="width: auto;  height: auto;" src="https://online.anyflip.com/yepzd/frdc/index.html"  seamless="seamless" scrolling="no" frameborder="0" allowtransparency="true" allowfullscreen="true" ></iframe>
                    </div>
                    <div class="d-inline" >
                        <div class="card w-100 border border-primary p-3 m-2 mb-auto" style="max-width: 360px !important; min-width:300px;">
                            <div class="d-flex">
                                <img src="https://online.anyflip.com/yepzd/frdc/files/shot.jpg"  style="max-width: 127px !important;  width: auto;  height: auto;" >
                                <div class="d-inline text-start col p-1" >
                                    <h5 class="m-1">Hela</h5>
                                    <p class="mx-2" style="font-size: 0.8rem;">เดือนกรกฎาคม - ธันวาคม 2564</p>
                                    <h6 class="m-1">ผู้เขียน</h6>
                                    <p class="mx-2" style="font-size: 0.8rem;">เดือนกรกฎาคม - ธันวาคม 2564</p>
                                    <a href="#" class="btn btn-primary col-12 mx-1">Download</a>
                                    <a href="#" class="btn btn-primary col-12 m-1 mt-2">Copy APA</a>
                                </div>
                            </div>
                        </div>
                        <div class="card w-100 border border-primary p-3 m-2 mb-auto" style="max-width: 360px !important; min-width:300px;">
                            <h5><b>บทความที่เกี่ยวข้อง</b></h5>
                            <hr class="m-1" >
                            <div class="d-flex card p-3 m-2 ">
                                <div class="d-flex col" >
                                    <img src="https://online.anyflip.com/yepzd/frdc/files/shot.jpg"  style="max-width: 82px !important;  width: auto;  height: auto;" >
                                    <div class="d-inline text-start col-8 px-1" >
                                        <h6 class="m-1">Hela</h6>
                                        <p class="mx-2" style="font-size: 0.5rem;">เดือนกรกฎาคม - ธันวาคม 2564</p>
                                        <h6 class="m-1" style="font-size: 1rem;">ผู้เขียน</h6>
                                        <p class="mx-2" style="font-size: 0.5rem;">เดือนกรกฎาคม - ธันวาคม 2564</p>
                                        <a href="#" class="btn btn-primary col-12 m-1 mt-2">อ่านบนเว็บ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center  col " >
                    <div class="card w-100 border border-primary p-3 m-2" style="max-width: 1100px;">
                        <h5 class="text-center" >บทคัดย่อ/Abstract</h5>
                        <hr class="my-1">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque consequuntur aliquam a. Beatae quisquam, rerum itaque dolores, tempora molestias sed omnis est sunt dolorum nobis consequuntur error dolore repellendus nisi.</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/journalsys_script.js"></script>