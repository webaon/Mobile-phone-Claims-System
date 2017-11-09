<?php
if(!isset($_SESSION)){
	session_start();
}

include 'header.php';
include 'nav.php';
include '../function.php';
include '../dbconn.php';
isAdmin();
$cid = $_GET['jid'];

#### แสดงรายการซ่อม ####
	$sql = "SELECT * FROM job_service WHERE id='".$cid."'";
	$result = $conn->query($sql);
	$rsj = mysqli_fetch_array($result);

        
        $sql5 = "SELECT * FROM repairs where job_service_id='$rsj[id]'";
                $result5 = $conn->query($sql5) ;
                
###### อัพเดท #####
    if (isset($_POST ['j']['soff'])){ //if select to Edit
	 $b3 = $_POST['j'];
	 $d3=date("Y-m-d H:i:s");
	 $sqlu3 = "UPDATE job_service SET
            close_date='".$d3."',
            status='".$b3['soff']."',
            note_end='".$b3['note_end']."',   
            totlo_price ='".$b3['tprice']."'
            WHERE id='".$cid."'";
        $rsu3 = $conn->query($sqlu3);

if($rsu3){
		$_SESSION['flash']['type']='success';
		$_SESSION['flash']['msg']='งานเคลมเสร็จเรียบร้อย';
                echo"<head><meta http-equiv='Refresh'content = '1; URL = admin_job.php'></head>";
                
}else{
		$_SESSION['flash']['type']='danger';
		$_SESSION['flash']['msg']='เกิดข้อผิดพลาด!!ไม่สามารถปิดงานได้ กรุณาทำรายการใหม่';
}

}

####คำนวน###


###########

if(isset($_SESSION['flash'])){
    
?>
<div class="alert alert-<?php echo $_SESSION['flash']['type'];?>" data-dismiss="alert">
    <?php echo ucfirst($_SESSION['flash']['type']).' '.$_SESSION['flash']['msg'];?>
</div>
<?php }?>
                


<div class="container">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="panel panel-primary">
			  <div class="panel-heading">ปิดงาน :: รายละเอียดการเคลม	
                              
                          </div>
                             <div class="panel-body">

				
                                <!--- แสดงรายการซ่อม --->
                                
                                <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                     <a href="admin_endaddjob.php?jid=<?php echo $rsj['id'];?>" class="btn btn-info">เพิ่มรายการซ่อม</a>
                                        <table class="table table-bordered">

                                                <tr class="btn-success">
                                                        <td>รายการ</td>
                                                        <td><center>ราคา</center></td>
                                                        <td>หมายเหตุ</td>
                                                </tr>
                                                    
                                        <?php 
                                        $SU=null;
                                        $sum=NULL;
                                        while($rs5=mysqli_fetch_array($result5)){
                                           
                                                    
                                        ?>

                                                <tr >
                                                  <td ><?php echo $rs5['repair'];?></td>
                                                        <td ><center><?php echo $rs5['price'];?></center></td>
                                                        <td ><?php echo $rs5['note'];?></td>
                                                </tr>
                                                
                                                        <?php  
                                                             $SU=$SU+$rs5['price'];   
                                                             $sum=$SU+$rsj['price_service'];
                                                        }  
                                                        ?>
                                                <tr>
                                                    <td>รวม</td>
                                                    <td><center> <?PHP echo $SU; ?></center></td>
                                                    <td>บาท</td>
                                                </tr>
                                               
                                       
                                        </table>

                                <!--- ปิดแสดงรายการซ่อม --->
                                <hr />
                                </div>
                                </div>
                                
                                <form method="post" action="#" class="form-horizontal">
                                    <input type="hidden" name="j[soff]" value="ปิดงาน">
                                    <input type="hidden" name="j[tprice]" value="<?PHP echo $sum; ?>">
                                <div class="form-group">
                                        <label class="control-label col-md-2" for="j-note_end" >หมายเหตุการเคลม: </label>
                                        <div class="col-md-8">
                                          <textarea name="j[note_end]" cols="60" rows="4" class="form-control" placeholder="ระบุหมายเหตุหรือข้อแนะนำ..." ><?php echo $rsj['note_end'];?></textarea>
                                        </div>
                                        
                                </div> 
                                <hr />
                                
                                <center>
                                <input type="submit" value="ปิดงานเคลม" class="btn btn-primary">
                                </center>
                                </form>
                           
			  </div>
			</div>
		</div>
	</div>
</div>


<?php
include '../footer.php'
 ?>
