<?php
    
    $sql_hw_header="SELECT hm.hw_id,hm.hw_name,hm.subject_id,hm.classroom_id,
    subj.subject_codename,subj.subject_name
    FROM `homework` hm
    LEFT JOIN `subject` subj ON subj.subject_id=hm.subject_id
    WHERE subject_codename='$subject_codename' && classroom_id='$classroom_id'
    ORDER BY `hm`.`classroom_id` ASC
    "; 
    $hw_header=mysqli_query($conn,$sql_hw_header);
    $sql_hw_body="SELECT hm.hw_id,hm.hw_name,hm.subject_id,hm.classroom_id,
    subj.subject_codename,subj.subject_name
    FROM `homework` hm
    LEFT JOIN `subject` subj ON subj.subject_id=hm.subject_id
    WHERE subject_codename='$subject_codename' && classroom_id='$classroom_id'
    ORDER BY `hm`.`classroom_id` ASC
    "; 
     $hw_tbody=mysqli_query($conn,$sql_hw_body);
     $hw_id_all=array();
     while ($hw_body_list = mysqli_fetch_array($hw_tbody)){
        array_push($hw_id_all,$hw_body_list['hw_id']);
     }
     
     //print_r($hw_body_list);
     //foreach($hw_body_list)

    $sql_std_table_list="SELECT * FROM `student` WHERE classroom_id='$classroom_id' ORDER BY `student`.`std_id` ASC ";
    $std_table_list=mysqli_query($conn,$sql_std_table_list);

?>
    <table class="table table-sm">
        <thead>
        
            <tr>
                <th>ลำดับ</th>
                <th>รหัสนักเรียน</th>
                <th>ชื่อ-นามสกุล</th>
                <?php
                    while ($hw_header_list = mysqli_fetch_array($hw_header)){
                        ?>
                        <th><?php echo $hw_header_list['hw_name']; ?></th>
                        <?php
                    }
                ?>
                <th>คะแนนรวม</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!isset($result_std_list)){
            $i = 1;
            while ($result_std_list = mysqli_fetch_array($std_table_list)) {
            ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $result_std_list['std_id']; ?></td>
                    <td><?php echo $result_std_list['name']." ".$result_std_list['surname']; ?></td>
                    <?php
                    $k=0;
                        for($j=0;$j<=(count($hw_id_all)-1);$j++){
                            ?>
                            <td><?php 
                                $return_status=check_hw_list($conn,$hw_id_all[$j],$result_std_list['std_id']);
                                if($return_status[0]=="unsuccess") echo "0";
                                    elseif($return_status[0]=="success" && isset($return_status[1])) {
                                        $k=$k+$return_status[1];
                                        echo $return_status[1];
                                    }
                        }
                            ?></td>
                    <td><?php echo $k ?></td>
                </tr>
            <?php
                $i++;
            }
        }
        else {?> <tr> <td class="text-center" colspan="7">ไม่มีการบ้าน</td></tr> <?php }
            ?>
        </tbody>
    </table>
<?php
function check_hw_list($condb,$hw_id,$std_id){
    $sql_check_hwstd_list = "SELECT * 
        FROM `hwgrading`
        WHERE hw_id='$hw_id' && std_id='$std_id'
    ";
    $resault_table = mysqli_query($condb, $sql_check_hwstd_list);
    $check_hw = mysqli_fetch_array($resault_table);
    if(isset($check_hw)){
        $status="success";
        $score=$check_hw['score'];
        
    }else{
        $status="unsuccess";
        $score=null;
        
    }
    return array($status,$score);
    }
?>
