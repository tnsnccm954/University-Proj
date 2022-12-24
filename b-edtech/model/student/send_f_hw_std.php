<?php
$hw_id=$_GET['hw_id'];
$hw_type=$_SESSION['hw_type'];
$std_id=$_SESSION['user_id'];
$class_id=$_SESSION['classroom_id'];
?>

<div class="row">
    <?php
        if($hw_type==2){
            $sql="
            SELECT group_id,group_name
            FROM `hw_group_member` 
            WHERE std_id='$std_id'
            ";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>=1){
                ?>
    <script>
    //window.alert("มีกลุ่มแล้ว")
    </script>
    <?php
                $group_info=mysqli_fetch_assoc($result);
            }
            else{
                ?>
    <script>
    //window.alert("ยังไม่มีกลุ่ม/ยังไม่ได้จับกลุ่ม")
    </script>
    <?php
                $group_info=0;
            }
        ?>
    <div class="card p-3 col-12">
        <div class="card-body">
            <div class="row">
                <h3 class="text-center  fs-4">กลุ่มงาน : 
                    <?php 
                    if($group_info!=0)echo $group_info['group_name'];
                    else echo 'ยังไม่ได้จับกลุ่ม';
                    ?>
                </h3>
                <table class="table">

                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อ-สกุล</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                if($group_info!=0){
                                    $group_id=$group_info['group_id'];
                                    $sql_member="SELECT hwg_mem.group_id,hwg_mem.group_name,
                                    std.std_id,std.name,std.surname
                                    FROM `hw_group_member` hwg_mem
                                    LEFT JOIN student std ON std.std_id=hwg_mem.std_id
                                    WHERE hwg_mem.group_id='$group_id'
                                    ";
                                    $result_group_mem=mysqli_query($conn,$sql_member);
                                    if(mysqli_num_rows($result_group_mem)>=1){
                                        $i=1;
                                        while($group_member=mysqli_fetch_assoc($result_group_mem)){
                                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $group_member['name']." ".$group_member['surname']; ?></td>
                        </tr>
                        <?php
                                        $i++;
                                        }
                                    }
                                    else{
                                    ?>
                                    <tr>
                                        <td class="text-center" colspan="2">-ไม่พบข้อมูลสมาชิก-</td>
                                    </tr>
                                    <?php
                                    }
                                    
                                }
                                else{
                                ?>
                                <tr>
                                    <td class="text-center" colspan="2" >ไม่มีสมาชิก</td>
                                </tr>
                                <?php
                                }
                                ?>
                    </tbody>
                    <caption>
                        <h6 class="text-end">สมาชิกกลุ่ม : <?php 
                                if($group_info!=0 && mysqli_num_rows($result_group_mem)>=1){
                                echo mysqli_num_rows($result_group_mem);
                                }
                                else{
                                    echo "-";
                                }
                                
                                ?> คน</h6>
                    </caption>
                </table>
                <div class="col-12 d-xl-flex justify-content-xl-center">
                    <a type="button" class="btn btn-light-primary m-2 btn-md col-12 col-xl-6"
                        href="../../view/student/create_hwgroup_stu.php?hw_id=<?php echo $hw_id; ?>&class_id=<?php echo $class_id; ?>"
                        <?php
                            if($group_info!=0)echo 'style="display:none;"';
                        ?>>จับกลุ่ม
                    </a>
                    <a class="btn btn-success col-12 col-xl-6 m-2 btn-md" href=" http://meet.google.com/new "
                        target="_blank">Meet!</a>
                </div>
            </div>
        </div>
    </div>

    
    
    <div class="card p-3 col-12">
        
        <div class="card-body">
            <h3 class="fs-4" >ส่งงาน</h3>
            <div class="row">
                <form method="POST" action="../../model/student/send_db_hw_std.php " enctype="multipart/form-data">
                    <input class="form-control" type="hidden" name="hw_id" value="<?php echo $hw_id; ?>">
                    <input class="form-control" type="hidden" name="stu_id" value="<?php echo $stu_id; ?>">
                    <input class="form-control" type="hidden" name="group_id" value="<?php echo $group_id; ?>">
                    <input class="form-control" type="hidden" name="hw_type" value="<?php echo $hw_type; ?>">
                    <input class="form-control" type="file" name="files" id="file"><br>
                    <input class="form-control" type="submit" name="button" id="button" value="ส่งงาน" />
                </form>
            </div>
        </div>
    </div>
    <?php
        }
    else{    
        ?>
    <div class="card p-3 col-12">
        
        <div class="card-body">
            <h3 class="fs-4" >ส่งงาน</h3>
            <div class="row">
                <form method="POST" action="../../model/student/send_db_hw_std.php " enctype="multipart/form-data">
                    <input class="form-control" type="hidden" name="hw_id" value="<?php echo $hw_id; ?>">
                    <input class="form-control" type="hidden" name="stu_id" value="<?php echo $stu_id; ?>">
                    <input class="form-control" type="file" name="files" id="file"><br>
                    <input class="form-control" type="submit" name="button" id="button" value="ส่งงาน" />
                </form>
            </div>
        </div>
    </div>
    <?php
        }
       
        ?>    
</div>