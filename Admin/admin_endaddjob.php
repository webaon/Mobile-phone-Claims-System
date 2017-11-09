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
$e=$cid;

$repair=null;
$price=null;
$note=null;
$job_service_id=null;

###################Insert Section###############
if(isset($_POST['r']['insert'])){//if define r['insert'] inset data
    $r = $_POST['r'];
    $sqli = "INSERT INTO repairs(repair,price,note,job_service_id)
                VALUE('".$r['repair']."','".$r['price']."','".$r['note']."','".$r['job_service_id']."')";

    $rsi = $conn->query($sqli);
    if($rsi){
        $_SESSION['flash']['type']='success';
        $_SESSION['flash']['msg']='เพิ่มข้อมูลเรียบร้อย';
    }else{
        $_SESSION['flash']['type']='danger';
        $_SESSION['flash']['msg']='ไม่สามารถเพิ่มข้อมูลได้';
    }

}

###################Edit Section#################
if(isset($_GET['eid'])){ //if select to Edit
    $rid = $_GET['eid'];

    $sqle = "SELECT * FROM repairs WHERE id='".$rid."'";
    $resulte = $conn->query($sqle);
    $rse = mysqli_fetch_array($resulte);

    $repair = $rse['repair'];
	$price = $rse['price'];
	$note = $rse['note'];
	$job_service_id = $rse['job_service_id'];

}

if(isset($_POST['r']['edit'])){// if post data to edit
    $r = $_POST['r'];
    $sqlu = "UPDATE repairs SET
            repair='".$r['repair']."',
						price='".$r['price']."',
						note='".$r['note']."',
						job_service_id='".$r['job_service_id']."'

            WHERE id='".$r['id']."'";
    $rsu = $conn->query($sqlu);
    if($rsu){
        $_SESSION['flash']['type']='success';
        $_SESSION['flash']['msg']='แก้ไขข้อมูลเรียบร้อย';
    }else{
        $_SESSION['flash']['type']='danger';
        $_SESSION['flash']['msg']='ไม่สามารถแก้ไขข้อมูลได้';
    }
}

###################Delete Section###############
if(isset($_GET['did'])){
    $sqld = "DELETE FROM repairs WHERE id='".$_GET['did']."'";
    $rsd = $conn->query($sqld);
    if($rsd){
        $_SESSION['flash']['type']='success';
        $_SESSION['flash']['msg']='ลบข้อมูลเรียบร้อยแล้ว';
    }else{
        $_SESSION['flash']['type']='danger';
        $_SESSION['flash']['msg']='ไม่สามารถลบข้อมูลได้';
    }
}


###################Select Data Section###############
$sql = "SELECT * FROM repairs WHERE job_service_id='$e'";
$result = $conn->query($sql);
?>

<!-- ###############Flash Message############# -->
<?php if(isset($_SESSION['flash'])){ ?>
<div class="alert alert-<?php echo $_SESSION['flash']['type'];?>" data-dismiss="alert">
    <?php echo ucfirst($_SESSION['flash']['type']).' '.$_SESSION['flash']['msg'];?>
</div>
<?php }?>
?>

<div class="container">
	<div class="row">
<div class="col-md-2">

</div>
		<div class="col-md-8">

<div class="panel panel-primary">
  <div class="panel-heading">รายการซ่อม >>ใบแจ้งเลขที่ <?php echo $e ;?> <a href="admin_endjob.php?jid=<?php echo $e;?>" class="btn btn-success">ย้อนกลับ</a></div>
	<div class="panel-body">
		<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?jid=<?=$cid?>&" class="form-horizontal">
		<?php if(isset($_GET['eid'])){?>
		    <input type="hidden" name="r[edit]" value="1">
		    <input type="hidden" name="r[id]" value="<?php echo $rid;?>">
		<?php }else{?>
		    <input type="hidden" name="r[insert]" value="1">
		<?php }?>
		    <div class="form-group">
		                <label class="control-label col-md-2" for="r-repair">รายการ</label>
		                <div class="col-md-10">
		                <input id="r-repair" class="form-control" type="text" name="r[repair]" value="<?php echo $repair;?>" >
		                </div>

		            </div><div class="form-group">
		                <label class="control-label col-md-2" for="r-price">ราคา</label>
		                <div class="col-md-10">
		                <input id="r-price" class="form-control" type="text" name="r[price]" value="<?php echo $price;?>" >
		                </div>

		            </div><div class="form-group">
		                <label class="control-label col-md-2" for="r-note">หมายเหตุ</label>
		                <div class="col-md-10">
		                <input id="r-note" class="form-control" type="text" name="r[note]" value="<?php echo $note;?>" >
		                </div>
										<input name="r[job_service_id]" type="hidden" class="form-control" id="r-job_service_id" value="<?php echo $e;?>">

		            </div>
		        <input type="submit" value="บันทึกข้อมูล" class="btn btn-primary">
		        <?php if(isset($_GET['eid'])){ //if select to Edit ?>
		        <a href="admin_repairs.php" class="btn btn-warning">ยกเลิก</a>
		        <?php }?>

		</form>
		</div>

		<hr />
		<div class="col-md-12">
		<!-- ###############List of Data############# -->
		<h3>รายการรายการซ่อม</h3>
		<table class="table table-bordered table-hover">
		    <tr>
		        <th>รายการ</th>
			<td><center>ราคา</center></td>
			<th>หมายเหตุ</th>


		        <th></th>
		    </tr>
		    <?php while($rsre=mysqli_fetch_array($result)){

					?>


		    <tr>
		        <td><?php echo $rsre['repair'];?></td>
						<td ><center>  <?php echo $rsre['price'];?></center></td>
						<td><?php echo $rsre['note'];?></td>


		        <td>
		          <center>

		            <a href="<?php echo $_SERVER['PHP_SELF'];?>?jid=<?=$cid?>&eid=<?php echo $rsre['id'];?>" class="btn btn-sm btn-warning">แก้ไข</a>
		            <a href="<?php echo $_SERVER['PHP_SELF'];?>?jid=<?=$cid?>&did=<?php echo $rsre['id'];?>" class="btn btn-sm btn-danger" onclick="return confirm('แน่ใจนะว่าต้องการลบ?');">ลบ</a>

		          </center>
		          </td>
		    </tr>
		    <?php }?>
		</table>
		</div>


  </div>
	<div class="col-md-2">

	</div>
</div>
</div>
</div>
</div>

<?php
include '../footer.php'
 ?>