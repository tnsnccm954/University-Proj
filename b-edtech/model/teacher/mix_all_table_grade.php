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

        $grade_41=$_POST['grade_41'];
        $grade_42=$_POST['grade_42'];
        $grade_31_5=$_POST['grade_31_5'];
        $grade_32_5=$_POST['grade_32_5'];
        $grade_31=$_POST['grade_31'];
        $grade_32=$_POST['grade_32'];
        $grade_21_5=$_POST['grade_21_5'];
        $grade_22_5=$_POST['grade_22_5'];
        $grade_21=$_POST['grade_21'];
        $grade_22=$_POST['grade_22'];
        $grade_11_5=$_POST['grade_11_5'];
        $grade_12_5=$_POST['grade_12_5'];
        $grade_11=$_POST['grade_11'];
        $grade_12=$_POST['grade_12'];
        $grade_01=$_POST['grade_01'];
        $grade_02=$_POST['grade_02'];
        $grade='';
    
        
    
    
    
?>
    <table class="table table-sm">
        <thead>
        
            <tr>
                <th>ลำดับ</th>
                <th>รหัสนักเรียน</th>
                <th>ชื่อ-นามสกุล</th>
                <th>คะแนนรวม</th>
                <th>เกรด</th>
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
                            <?php 
                                $return_status=check_hw_list($conn,$hw_id_all[$j],$result_std_list['std_id']);
                                if($return_status[0]=="unsuccess"){}
                                    elseif($return_status[0]=="success" && isset($return_status[1])) {
                                        $k=$k+$return_status[1];
                                    
                                    }
                        }
                            ?>
                    <td><?php echo $k ?></td>
                    <td><?php 
                    if(($k>=$grade_42)&&($k<=$grade_41)) { 
                        $grade= '4' ; }
                    else if (($k>=$grade_32_5)&&($k<=$grade_31_5)) { 
                        $grade= '3.5' ; }
                    else if (($k>=$grade_32)&&($k<=$grade_31)) { 
                        $grade= '3' ; }
                    else if (($k>=$grade_22_5)&&($k<=$grade_21_5)) { 
                        $grade= '2.5' ; }
                    else if (($k>=$grade_22)&&($k<=$grade_21)) { 
                        $grade= '2' ; }
                    else if (($k>=$grade_12_5)&&($k<=$grade_11_5)) { 
                        $grade= '1.5' ; }
                    else if (($k>=$grade_12)&&($k<=$grade_11)) { 
                        $grade= '1' ; }
                    else if (($k>=$grade_02)&&($k<=$grade_01)) { 
                        $grade= '0' ; }
                    else {$grade= 'error' ; }
                        echo $grade;
                    
                    $status=0;
                    $std_id=$result_std_list['std_id'];
                    $sql_check="SELECT *,count(`statement_id`) record FROM `graded_per_class` WHERE `std_id`='$std_id' AND `subject_id`='$subj_id' AND `graded`='$grade'";
                    $check_graded=mysqli_query($conn,$sql_check);
                    $array_check_graded=mysqli_fetch_array($check_graded);
                    if($array_check_graded['record']>=1){
                        $status+=1;
                    }
                    if($status==0){
                    $sql_grade="INSERT INTO `graded_per_class`( `std_id`, `subject_id`, `graded`) 
                    VALUES ('$std_id','$subj_id','$grade')";
                    mysqli_query($conn,$sql_grade);
                    }
                    
                    ?>
                    
                    </td>
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
