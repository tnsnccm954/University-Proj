<?php date_default_timezone_set("Asia/Bangkok");
    require_once 'function.php';
    $date_create=date('Y-m-d');
?>
    <div class="card-header">
        <h4 class="card-title" >สร้างการเช็คชื่อวันที่: <?php echo displaydate($date_create); ?></h4>
    </div>
    <div class="card-body">
        <form class="form-control-lg" action="view_check_page.php" method="GET">
            <label for="statment_id" >รหัสการเช็คชื่อ: </label>
            <input type="text" id="statment_id" name="statment_id" value="<?php
            print date('dmy')."-".rand(0,100); ?>" readonly>
            <input class="btn btn-primary"  type="submit" value="ยืนยันการสร้าง" >
        </form>
    </div>
    