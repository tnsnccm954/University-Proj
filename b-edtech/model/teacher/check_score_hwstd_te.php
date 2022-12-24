<?php
    require_once "../../controllers/config.php";
function check_hw_table($conn,$hw_id,$classroom_codename){
    $sql_std_list="SELECT std.std_id,std.name,std.surname,class.classroom_name FROM `student`std
    LEFT JOIN classroom class ON class.classroom_id=std.classroom_id
    WHERE classroom_name='$classroom_codename'
    ";
    $resault_std_table_list = mysqli_query($conn, $sql_std_list);
    
    function check_hw_list($condb,$hw_id,$std_id){
        $sql_check_hwstd_list = "SELECT * 
            FROM `hwgrading`
            WHERE hw_id='$hw_id' && std_id='$std_id'
        ";
        $resault_table = mysqli_query($condb, $sql_check_hwstd_list);
        $check_hw = mysqli_fetch_array($resault_table);
        if(isset($check_hw)){
            ?>
            <div class="alert alert-success">ส่งแล้ว</div>
            <?php
            $status="success";
            $score=$check_hw['score'];
            $hw_file='<a href="upload/hwans/'.$check_hw['hw_file'].'">'.$check_hw['hw_file'].'</a>';
        }else{
            ?>
            <div class="alert alert-danger">ยังไม่ส่ง</div>
            <?php
            $status="unsuccess";
            $score=null;
            $hw_file=null;
        }
        return array($status,$score,$hw_file);
        }
?>
    <div class="table-responsive">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>รหัสนักเรียน</th>
                    <th>ชื่อนามสกุล</th>
                    <th>สถานะ</th>
                    <th>คะแนน</th>
                </tr>
            </thead>
            <tbody>
                <?php
            if(isset($resault_std_table_list)){
                $i = 1;
                while ($list_std = mysqli_fetch_array($resault_std_table_list) ) {
                ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $list_std['std_id']; ?></td>
                    <td><?php echo $list_std['name']." ".$list_std['surname']; ?></td>
                    <td class="text-center">
                        <?php $return_status=check_hw_list($conn,$hw_id,$list_std['std_id']);
                    ?></td>

                    <td>
                            <?php
                                if($return_status[0]=="unsuccess") echo "disabled";
                                elseif($return_status[0]=="success" && isset($return_status[1])) {
                                    ?>
                                    <?php echo $return_status[1];?>
                                    <?php
                                    ;
                                }
                            ?>
                    </td>
                    </form>
                </tr>
                <?php
                $i++;
                }
            } else{?>
                <tfoot>
                    <tr>
                        <td class="text-center" colspan="8">ไม่มีข้อมูล</td>
                    </tr>
                </tfoot>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <?php
        
        
        
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['confirm_grading'])){
        $hw_id_r=$_POST['hw_id'];
        $std_id_r=$_POST['std_id'];
        $score_r=$_POST['scoregrading'];
        add_score($conn,$score_r,$hw_id_r, $std_id_r);
    }
    function add_score($condb,$score_r,$hw_id_r, $std_id_r){
        $sql_up_score="UPDATE `hwgrading` SET `score` ='$score_r' WHERE `hw_id`='$hw_id_r'  && `std_id` ='$std_id_r'";
        $ีup_score_query=mysqli_query($condb, $sql_up_score);
        if (!$ีup_score_query) {
            $_SESSION['msg'] = "ทำการให้คะแนน ผิดพลาด";
        } else {
            $_SESSION['msg'] = "ทำการให้คะแนน เสร็จเรียบร้อย";
        }
        ?>
        <script type="text/javascript">
            alert("<?php echo $_SESSION['msg'] ?>");
        </script>
    <?php
    }
        ?>