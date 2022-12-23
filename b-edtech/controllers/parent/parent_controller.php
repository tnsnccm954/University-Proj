<?php

function student_list_card_std_detail(){
    require '../../routes/web.php';
    require $model.$role_route.'main-parent.php';
    $user_id = $_SESSION['user_id'];
    ?>
    <div class="row">

        <?php
        $result = std_list($conn, $user_id);
        while ($detailstd = mysqli_fetch_array($result)) {
        //print_r($detailstd);
        ?>
        <div class="col-12 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row align-items-center m-1">
                        <div class="col-md-4">
                            <div class=" m-3">
                                <div class="user-img d-flex align-items-center">
                                    <div class="avatar avatar-xl">
                                        <img src="../../assets/images/faces/1.jpg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 p-1">
                            <h6 class="text-muted font-semibold">นักเรียน: <div class="text-center py-2">
                                    <?php echo $detailstd[2] . " " . $detailstd[3]; ?></div>
                            </h6>
                            <h6 class="font-extrabold ">ห้องเรียน:
                                <?php echo $detailstd['classroom_name']; ?></h6>
                            <div class="pt-1 ">
                                <a class="btn btn-secondary p-1 " type="button">ข้อมูลผู้เรียน</a>
                                <a class="btn btn-warning p-1 text-secondary" type="button"
                                    href="hw_list_per_std-parent.php?std_id=<?php echo $detailstd['std_id']; ?>&class_id=<?php echo $detailstd['classroom_id']; ?>">เช็คการบ้าน</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
                                }
                                ?>

    </div>
    <?php
}
function student_list_card($form){
    require '../../routes/web.php';
    require $model.$role_route.'main-parent.php';
    $user_id = $_SESSION['user_id'];
    ?>
    <div class="row">

        <?php
        $result = std_list($conn, $user_id);
        while ($detailstd = mysqli_fetch_array($result)) {
        //print_r($detailstd);
        ?>
        <div class="col-12 col-lg-3 col-md-6">
            <a href="<?php echo $view.$role_route.$form."?std_id=".$detailstd['std_id']."&class_id=".$detailstd['classroom_id']; ?>">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row align-items-center m-1">
                            <div class="col-md-4">
                                <div class=" m-3">
                                    <div class="user-img d-flex align-items-center">
                                        <div class="avatar avatar-xl">
                                            <img src="../../assets/images/faces/1.jpg">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 p-1">
                                <h6 class="text-muted font-semibold">นักเรียน: <div class="text-center py-2">
                                        <?php echo $detailstd[2] . " " . $detailstd[3]; ?></div>
                                </h6>
                                <h6 class="font-extrabold ">ห้องเรียน:
                                    <?php echo $detailstd['classroom_name']; ?></h6>
                                <div class="pt-1 ">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php
                                }
                                ?>

    </div>
    <?php
}
?>