<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/main-font.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <title>SMTAT-Search</title>
</head>

<body>
    <?php
        include "header_nav.php";
    ?>
    <div class="container bg-white">
        <main>

            <div class="container-fluid col-xl-12 px-2 py-2">
                <div class="d-flex justify-content-center col-12">
                    <label for="Search" class="my-auto">ค้นหาวารสาร: </label>
                    <form class="d-flex col-8 form-inline">
                        <input class="form-control mr-sm-2 mx-3" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-primary my-2 my-sm-0 " type="submit">Search</button>
                    </form>
                </div>
                <div class="d-flex justify-content-center py-2 col text-center ">
                    <div class="card w-100 border border-primary p-3 m-2 mb-auto" style="max-width: 300px !important;">
                        <h5>Category</h5>
                        <hr>
                        <ul class="list-group align-items-start">
                            <li class="list-group-item">
                                <a href="#" >ปีที่เผยแพร่</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#">ปีที่เผยแพร่</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card w-100 border border-primary p-3 m-2" style="max-width: 760px;">
                        <h5>List</h5>
                        <div class="container">
                            <div class="card border border-dark" style="max-width: 225px;">
                                <img src="https://online.anyflip.com/yepzd/frdc/files/shot.jpg" class="card-img-top mx-auto" style="max-width: 200px; max-height:283.4px;"  alt="...">
                                <div class="card-body ">
                                    <h5 class="text-left card-title ">Card title</h5>
                                    <p class="card-text">Some quick example text ...</p>
                                    <hr>
                                    <div class="col-12 d-inline-flex justify-content-center ">
                                    <a href="#" class="btn btn-primary mx-1">
                                        <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                    </a>
                                    <a href="readon_web.php" class="btn btn-primary col-8 mx-1">อ่านบนเว็บ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <nav aria-label="Pagination" class="mt-auto">
                            <ul class="pagination justify-content-end m-0 ">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>

<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/journalsys_script.js" ></script>