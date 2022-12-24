<?php
    require_once "../../controllers/config.php";
    $sql_hw_std_list="SELECT * FROM `homework` hw 
    LEFT JOIN `subject` subj ON hw.subject_id = subj.subject_id 
    LEFT JOIN `student` std ON hw.classroom_id=std.classroom_id
    WHERE std_id='$std_id' 
    ";
    $std_hw_list=mysqli_query($conn, $sql_hw_std_list);
    
    function check_hw_list($condb,$hw_id,$std_id){
        $sql_check_hwstd = "SELECT * 
            FROM `hwgrading`
            WHERE hw_id='$hw_id' && std_id='$std_id'
        ";
        $resault_table = mysqli_query($condb, $sql_check_hwstd);
        $check_hw = mysqli_fetch_array($resault_table);

        if(isset($check_hw)){
            ?>
            <?php
            $status="success";
            $score=$check_hw['score'];
            $hw_file='<a href="upload/hwans/'.$check_hw['hw_file'].'">'.$check_hw['hw_file'].'</a>';
            
        }else{
            ?>
            
            <?php
            $status="unsuccess";
            $score=null;
            $hw_file=null;
        }
        return array($status,$score,$hw_file);
        }

    
?>
    <table class="table table-sm">
        <thead>
        
            <tr>
                <th>ลำดับ</th>
                <th>วิชา(รหัสวิชา)</th>
                <th>ชื่อการบ้าน</th>
                <th>กำหนดส่ง</th>
                <th>สถานะ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!isset($subj_list)){
            $i = 1;
                while ($subj_list = mysqli_fetch_array($std_hw_list)) {
                ?>
                    <tr><?php $return_status=check_hw_list($conn,$subj_list['hw_id'],$std_id);
                        if ($return_status[0]=="unsuccess") {
                            
                    ?>
                        <td><?php echo $i;?></td>
                        <td><?php echo $subj_list['subject_codename']; ?></td>
                        <td><?php echo $subj_list['hw_name']; ?></td>
                        <td><?php echo $subj_list['date_deadline']; ?></td>
                        
                        <td class="text-center">
                            <div class="alert alert-danger">ยังไม่ส่ง</div>
                        </td>
                        <?php
                        }
                        else{}
                        ?>
                    </tr>
                <?php
                    $i++;
                }
            }
            else {?> <tr> <td class="text-center" colspan="7">ไม่มีการบ้าน</td></tr> <?php 
            }
            ?>
        </tbody>
    </table>