
<?php
if(!isset($_SESSION)){
	session_start();
}
include 'header.php';
include 'nav.php';
include '../function.php';
include '../dbconn.php';
isAdmin();


if(isset($_GET['end2job'])){ //if select to Edit
	 $b3 = $_GET['end2job'];
	 $d3=date("Y-m-d H:i:s");
	 $ss3="ปิดงาน";
	 $sqlu3 = "UPDATE job_service SET

					close_date='".$d3."',
					status='".$ss3."'

				WHERE id='".$b3."'";
$rsu3 = $conn->query($sqlu3);

if($rsu3){
		$_SESSION['flash']['type']='success';
		$_SESSION['flash']['msg']='งานเคลมเสร็จเรียบร้อย';
}else{
		$_SESSION['flash']['type']='danger';
		$_SESSION['flash']['msg']='เกิดข้อผิดพลาด!!ไม่สามารถปิดงานได้ กรุณาทำรายการใหม่';
}

}


###################Delete Section###############
if(isset($_GET['did'])){
    $sqld5 = "DELETE FROM job_service WHERE id='".$_GET['did']."'";
    $rsd5 = $conn->query($sqld5);
    if($rsd5){
        $_SESSION['flash']['type']='success';
        $_SESSION['flash']['msg']='ลบข้อมูลเรียบร้อยแล้ว';
    }else{
        $_SESSION['flash']['type']='danger';
        $_SESSION['flash']['msg']='ไม่สามารถลบข้อมูลได้';
    }
}

?>


<div class="container">
	<div class="row">

		<div class="col-md-12">

<div class="panel panel-primary">
  <div class="panel-heading">บิลแจ้งฝากส่งศูนย์ทั้งหมด</div>
  <div class="panel-body">



    <table class="table table-hover">
      <tr class="btn-success">



          <th width="10%"><center>ใบแจ้ง</center></th>
          <th width="20%">ชื่อรุ่น</th>
          <th width="20%">อาการ</th>
          <th width="10%">วันที่แจ้ง</th>
          <th width="20%">ชื่อลูกค้า</th>
          <th width="10%">สาขา</th>
          <th width="10%"></th>

      </tr>
			<?php
			$sql = "SELECT * FROM job_service ORDER BY id DESC";
			$result = $conn->query($sql);


		   while($rs=mysqli_fetch_array($result)){

			$sql1 = "SELECT * FROM product where id='$rs[product_id]'";
			$result1 = $conn->query($sql1) ;
			$rs1=mysqli_fetch_array($result1);

			$sql2 = "SELECT * FROM customers where id='$rs[customers_id]'";
			$result2 = $conn->query($sql2) ;
			$rs2=mysqli_fetch_array($result2);

			$sql3 = "SELECT * FROM user where id='$rs[user_id]'";
			$result3 = $conn->query($sql3) ;
			$rs3=mysqli_fetch_array($result3);

		?>
      <tr >

          <td><center><a href="admin_jobdtail.php?jid=<?php echo $rs['id'];?>"><?php echo $rs['id'];?></a></center></td>

          <td><?php echo $rs1['model'];?></td>
          <td>
						<?php
							echo $rs['job_manner'];
							echo "<br>";
							echo $rs['status'];
						?>
					</td>
          <td><?php echo $rs['sta_date'];?></td>
          <td><?php echo $rs2['name'];?></td>
          <td><?php echo $rs3['username'];?></td>
          <td>
						<div class="btn-group">
						  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    จัดการ <span class="caret"></span>
						  </button>
						  <ul class="dropdown-menu ">
                                                      <li><a href="jobprint.php?jid=<?PHP echo $rs['id'];?>"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> พิมพ์ใบรายการซ่อม</a></li>
						    <li role="separator" class="divider"></li>
						    <li><a href="admin_jobdtail.php?jid=<?php echo $rs['id'];?>"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> รายละเอียดการเคลม</a></li>
						    <li role="separator" class="divider"></li>
						    <li>
							<a href="admin_conjob.php?eid=<?php echo $rs['id'];?>"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> รับเรื่อง</a>
                                                    </li>
						    <li><a href="admin_endjob.php?jid=<?php echo $rs['id'];?>"><span class="glyphicon glyphicon-flash" aria-hidden="true"></span> ปิดงาน</a></li>
  							<li role="separator" class="divider"></li>
						    <!-- <li><a href="#"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> แก้ไข</a></li> 
						    <li role="separator" class="divider"></li> -->
						    <li><a href="<?php echo $_SERVER['PHP_SELF'];?>?did=<?php echo $rs['id'];?>"  onclick="return confirm('แน่ใจนะว่าต้องการลบ?');"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ลบรายการนี้</a>

						  </ul>
						</div>
      </tr>
  <?php }?>
    </table>

  </div>
</div>

</div>
</div>
</div>
</div>




<?php
include '../footer.php'
 ?>
