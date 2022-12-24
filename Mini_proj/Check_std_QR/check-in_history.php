<?php
    require_once "config.php";
    $sql="SELECT state_codename,date_access,COUNT(date_access) AS state_count FROM `check_in_statement` GROUP BY date_access";
    $checkdate_history=mysqli_query($conn,$sql);
    
?>
<div class="table-responsive">
    <table class="table table-lg">
        <thead>
            <tr>
                <th>วันที่</th>
                <th>ตรงเวลา</th>
                <th>สาย</th>
                <th>ขาด</th>
                <th>รวม</th>
                <th>รายละเอียด</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($result_check_date_his=mysqli_fetch_array($checkdate_history)){
                    $date_access=$result_check_date_his['date_access'];
                    $sql2="SELECT result,COUNT(result) AS state_count FROM `check_in_statement` WHERE date_access=' $date_access' AND result='/' GROUP BY result";
                    $sql3="SELECT result,COUNT(result) AS state_count FROM `check_in_statement` WHERE date_access=' $date_access' AND result='สาย' GROUP BY result";
                    //$sql4="SELECT result,COUNT(result) AS state_count FROM `check_in_statement` WHERE date_access=' $date_access' AND result='ขาด' GROUP BY result";
                    $count_result_check_in=mysqli_query($conn,$sql2);
                    $count_result_check_late=mysqli_query($conn,$sql3);
                    //$count_result_uncheck=mysqli_query($conn,$sql4);
                    if($count_result_check_in&&$count_result_check_late){
                    $array_count_result_check_in=mysqli_fetch_array($count_result_check_in);
                    $count_check_in=$array_count_result_check_in['state_count']??0;
                    $array_count_result_check_late=mysqli_fetch_array($count_result_check_late);}
                    $count_check_late=$array_count_result_check_late['state_count']??0;
                    //$array_count_result_uncheck=mysqli_fetch_array($count_result_uncheck);
                    ?>
                <tr>
                    <td><?php print displaydate($date_access); ?></td>
                    <td><?php print $count_check_in;?></td>
                    <td><?php print   $count_check_late;?></td>
                    <td><?php $abs_all=abs($count_check_in+$count_check_late-50); 
                              print $abs_all;
                    ?></td>
                    <td><?php print $count_check_in+$count_check_late+$abs_all?></td>
                    <td>
                        <a href="info_check_in.php?date_access=<?php print $result_check_date_his['date_access']; ?>" class="btn btn-info" >รายละเอียด</a>
                        <a href="viewroom_page.php?state_codename=<?php print $result_check_date_his['state_codename']; ?>" class="btn btn-secondary" >จัดห้องเรียน</a>
                    </td>
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</div>