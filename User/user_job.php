<?php
if(!isset($_SESSION)){
	session_start();
}
include 'header.php';
include 'men.php';
include '../function.php';
include '../dbconn.php';
isUser();



 if(isset($_GET['eid1'])){ //if select to Edit
    $bid = $_GET['eid1'];

    $sqle = "SELECT * FROM job_service WHERE id='".$bid."'";
    $resulte = $conn->query($sqle);
    $rse = mysqli_fetch_array($resulte);


}

	if(isset($_GET['eid'])){ //if select to Edit
	    $b = $_GET['eid'];
            $d=date("Y-m-d H:i:s");
            $ss="รอลูกค้ามารับ";
                $sqlu = "UPDATE job_service SET
                wait_date='".$d."',
		status='".$ss."'
                WHERE id='".$b."'";
    $rsu = $conn->query($sqlu);

    if($rsu){
        $_SESSION['flash']['type']='success';
        $_SESSION['flash']['msg']='รับเครื่องกลับสาขาเรียบร้อย';
    }else{
        $_SESSION['flash']['type']='danger';
        $_SESSION['flash']['msg']='ไม่สามารถทำรายการได้้';
    }

}
		if(isset($_GET['eid2'])){ //if select to Edit
	     $b2 = $_GET['eid2'];
             $d2=date("Y-m-d H:i:s");
             $ss2="ลูกค้ารับคืนแล้ว";
                    $sqlu2 = "UPDATE job_service SET
                    end_date='".$d2."',
                    status='".$ss2."'
                    WHERE id='".$b2."'";
    $rsu2 = $conn->query($sqlu2);

    if($rsu2){
        $_SESSION['flash']['type']='success';
        $_SESSION['flash']['msg']='ลูกค้ารับเครื่องกลับคืนแล้ว';
    }else{
        $_SESSION['flash']['type']='danger';
        $_SESSION['flash']['msg']='ไม่สามารถทำรายการได้้';
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
<body data-gr-c-s-loaded="true" style="background-image: url(pic/bg.png);">



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

			$us=$_SESSION['user']['id'];
			####################################################

			$sql = "SELECT * FROM job_service where user_id='$us' ORDER BY id DESC";
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

                        
                        
                         $date = date_create($rs['sta_date']);
		?>
      <tr >

          <td><center><a href="user_jobdtail.php?jid=<?php echo $rs['id'];?>"><?php echo $rs['id'];?></a></center></td>

          <td>
              <?php 
                echo $rs1['model'];
                echo "<br>";
                echo "IME: ".$rs1['ime'];
              ?>
          </td>
          <td>
            <?php
		echo $rs['job_manner'];
		echo "<br>";
		echo "สถานะ: ".$rs['status'];
            ?>
           </td>
          <td><?php echo date_format($date,'d/m/y');?></td>
          <td><?php echo $rs2['name'];?></td>
          <td><?php echo $rs3['username'];?></td>

          <td>
						<div class="btn-group">
						  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    จัดการ <span class="caret"></span>
						  </button>
						  <ul class="dropdown-menu ">
                                                      <li><a href="jobprint.php?jid=<?php echo $rs['id'];?>"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> พิมพ์ใบฝากเคลม</a></li>
						    <li role="separator" class="divider"></li>
                                                    <li><a href="user_jobdtail.php?jid=<?php echo $rs['id'];?>"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> รายละเอียดการเคลม</a></li>
						    <li role="separator" class="divider"></li>
                                                    <li><a href="<?php echo $_SERVER['PHP_SELF'];?>?eid=<?php echo $rs['id'];?>"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> รับคืนสาขา</a></li>
                                                    <li><a href="<?php echo $_SERVER['PHP_SELF'];?>?eid2=<?php echo $rs['id'];?>"><span class="glyphicon glyphicon-saved" aria-hidden="true"></span> ลูกค้ารับแล้ว</a></li>
						    <li role="separator" class="divider"></li>
						    
						    <li role="separator" class="divider"></li>
						  </ul>
						</div>

					</td>

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
