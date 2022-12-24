<?php
require_once "config.php";
session_start();
$_SESSION['state_id'] = $_GET['state_codename'];
$state_id = $_SESSION['state_id'];
$sql = "SELECT * FROM `check_in_statement` WHERE state_codename='$state_id'";
$result_checked_std = mysqli_query($conn, $sql);

function checked_table_std($condb,$state_id){
    $sql="SELECT check_in_statement.std_id,check_in_statement.display_name,
    student.std_name
    FROM `check_in_statement` 
    LEFT JOIN `student`
    ON check_in_statement.std_id = student.std_id
    WHERE state_codename='$state_id'";
    $sql_fecth_name=mysqli_query($condb,$sql);
    $displayname_array=[];
    while($sql_fecth_name_array=mysqli_fetch_array($sql_fecth_name)){
        //print_r($sql_fecth_name_array);
        array_push($displayname_array,array($sql_fecth_name_array['display_name'],$sql_fecth_name_array['std_name']));
    }
?>
<div class="page-content p-5 mx-auto ">

    <div class="card ">
        <div class="table-responsive p-3">
            <table class="table table-bordered mb-5 ">
                <thead class="text-md-center ">
                    <h1 class="m-3 text-xl-center">ห้องเรียน 445</h1>
                    <th colspan="3">ปีกซ้าย </th>
                    <th colspan="5">กองกลางค้าบ </th>
                    <th colspan="3">ปีกขวานะ</th>
                </thead>
                <tbody style="text-align: center;">
                    <?php
                
                $i = 1;
                $l = 0;
                while ($i <= 5) { ?>
                    <tr>
                        <?php
                        
                        for ($j = 1; $j <= 10; $j++) {
                        ?>
                        <td>
                            <?php
                                    if(isset($displayname_array[$l])){
                                        echo $displayname_array[$l][0]."<br>";
                                        echo "( ".$displayname_array[$l][1]." )";
                                        $l++;
                                    }
                                    else  {
                                        echo "-";}
                                    ?>
                        </td>
                        <?php }
                        ?>
                    </tr>
                    <?php $i++;
                } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php
}
?>