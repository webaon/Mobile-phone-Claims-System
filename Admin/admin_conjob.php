<?php
if(!isset($_SESSION)){
	session_start();
}
include 'header.php';
include 'nav.php';
include '../function.php';
include '../dbconn.php';
isAdmin();

	$cid = $_GET['eid'];
	$e=$cid;

	$get_date=null;
	$status=null;
	$suppliers_id=null;
	$d=date("Y-m-d H:i:s");

	###################Edit Section#################
	if(isset($_GET['eid'])){ //if select to Edit
	    $jid = $_GET['eid'];

	    $sqle = "SELECT * FROM job_service WHERE id='".$jid."'";
	    $resulte = $conn->query($sqle);
	    $rse = mysqli_fetch_array($resulte);


		$get_date = $rse['get_date'];
		$status = $rse['status'];
		$suppliers_id = $rse['suppliers_id'];


	}

	if(isset($_POST['j']['edit'])){// if post data to edit
	    $j = $_POST['j'];
	    $sqlu = "UPDATE job_service SET

	      	get_date='".$j['get_date']."',
	      	status='".$j['status']."',
	      	suppliers_id='".$j['suppliers_id']."'
	        WHERE id='".$j['id']."'";

	    $rsu = $conn->query($sqlu);

	    if($rsu){
				$_SESSION['flash']['type']='success';
				$_SESSION['flash']['msg']='รับเรื่องเคลมเรียบร้อย';
                                echo"<head><meta http-equiv='Refresh'content = '; URL = admin_job.php'></head>";


	    }else{
				$_SESSION['flash']['type']='danger';
				$_SESSION['flash']['msg']='ไม่สามารถแก้ไขข้อมูลได้ กรุณาเลือกศูนย์บริการ';;
	    }




	}?>

<!-- ###############Flash Message############# -->
<?php if(isset($_SESSION['flash'])){ ?>
<div class="alert alert-<?php echo $_SESSION['flash']['type'];?>" data-dismiss="alert">
    <?php echo ucfirst($_SESSION['flash']['type']).' '.$_SESSION['flash']['msg'];?>
</div>
<?php }?>


<div class="container">
	<div class="row">
<div class="col-md-3">

</div>
		<div class="col-md-6">

<div class="panel panel-primary">
  <div class="panel-heading">ฟอร์มรับเรื่องส่งเคลม >>ใบแจ้งเลขที่ <?php echo $e ;?></div>
	<div class="panel-body">

		<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?eid=<?=$cid?>&" class="form-horizontal">
			<?php if(isset($_GET['eid'])){?>
					<input type="hidden" name="j[edit]" value="1">
					<input type="hidden" name="j[id]" value="<?php echo $jid;?>">
			<?php }else{?>
					<input type="hidden" name="j[insert]" value="1">
			<?php }?>

				<div class="form-group">
				<label  class="col-md-4" for="j-suppliers" ><center>
					ส่งศูนย์บริการ:
				</center></label>
				<div class="col-md-8">


				<select name="j[suppliers_id]" class="form-control" id="j-suppliers_id">
								<option>---เลือกศูนย์บริการ---</option>
								<?php
								$suppliers=$conn->query("SELECT * FROM suppliers");

								//print_r($suppliers);
								while($su = mysqli_fetch_array($suppliers, MYSQLI_BOTH)){?>
										<option value="<?php echo $su['id'];?>"><?php echo $su[1];?></option>
								<?php }?>
				</select>


						 <input id="j-get_date" class="form-control"  name="j[get_date]" value="<?php echo $d ;?>" type="hidden">
	 				 	 <input name="j[status]" id="j-status" value="รับเรื่องแล้ว" type="hidden"/>


				</div>

	</div>
				<hr />
				<center>
					<input type="submit" value="รับเรื่องเคลม" class="btn btn-primary">
				</center>

		</form>

  </div>
	<div class="col-md-3">

	</div>
</div>
</div>
</div>
</div>

<?php
include '../footer.php';
?>
