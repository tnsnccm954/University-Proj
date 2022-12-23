<?php

require_once "../../controllers/config.php";
function to_do_list($condb,$std_id)
{   
    
    $sql_hw_list = "SELECT hw.hw_id,hw.hw_name,hw.date_deadline,hw.level,hw.maximumg
	,subj.subject_id,subj.subject_codename,subj.subject_name
    ,class.classroom_id,class.classroom_name
    FROM `homework` AS hw
    INNER JOIN subject subj ON hw.subject_id=subj.subject_id
    INNER JOIN classroom class ON hw.classroom_id=class.classroom_id
    ORDER BY hw.date_deadline ASC,hw.level ASC;
    ";
    $result_table = mysqli_query($condb, $sql_hw_list);
    
    $sql_check_hw_sended_list="SELECT hw_id
    FROM hwgrading
    WHERE std_id='$std_id'
    ";
    $result_check_hw_list=mysqli_query($condb,$sql_check_hw_sended_list);
    if(mysqli_num_rows($result_check_hw_list)>=1){
        $array_hw_sended_list=[];
        while ($check_hwlist=mysqli_fetch_assoc($result_check_hw_list)){
            array_push($array_hw_sended_list,$check_hwlist['hw_id']);
        }
    }
    function check_hw_list($hw_id,$array_hw_list){
            if(isset($array_hw_list)){
                foreach ($array_hw_list as $value){
                    if($hw_id==$value){
                        return 1;
                    }
                }
            }
    }
    ?>
    <div class="table-responsive">
    <table class="table table-sm">
        <thead class="text-center" >
            <tr>
                
                <th >วิชา<br>(รหัสวิชา)</th>
                <th>ชื่อการบ้าน</th>
                <th>ประเภท</th>
                <th>วันที่ส่ง</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if (mysqli_num_rows($result_table)>=1){
            $i = 1;
            while ($list_hw = mysqli_fetch_array($result_table) ) {
                    if(check_hw_list($list_hw['hw_id'],$array_hw_sended_list??NULL)==1)continue;
            ?>
                <tr>
                    
                    <td><?php echo $list_hw['subject_codename']; ?></td>
                    <td><?php echo $list_hw['hw_id']; ?></td>
                    <td><?php if($list_hw['maximumg']>1) echo 'งานกลุ่ม';else echo 'งานเดี่ยว'; ?></td>
                    <td><?php echo displaydate($list_hw['date_deadline']); ?></td>
                    
                </tr>
            <?php
                $i++;
            }
        }
        else {?> <tr> <td class="text-center" colspan="7">ไม่มีการบ้าน</td></tr> <?php }
            ?>
        </tbody>
    </table>
    </div>
    <?php
    }

?>