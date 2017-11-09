<?php
if(!isset($_SESSION)){
	session_start();
}
include 'header.php';
include 'men.php';
include '../function.php';
include '../dbconn.php';
isUser();

if(isset($_GET['pid'])){
    $pidj=$_GET['pid'];
}

####เลือกสาขา####
$bach= $_SESSION['user']['username'];
$sqlj1 = "SELECT * FROM user WHERE username='".$bach."'";
$resultj1 = $conn->query($sqlj1);
$rsj1=mysqli_fetch_array($resultj1);
$bach1=$rsj1['username'];
$bach2=$rsj1['id'];
###############

######เลือกสินค้า#######
$sqlj2 = "SELECT * FROM product WHERE id='".$pidj."'";
$resultj2 = $conn->query($sqlj2);
$rsj2=mysqli_fetch_array($resultj2);

$pidc=$rsj2['customers_id'];
$pidct=$rsj2['product_category_id'];
$pidcc=$rsj2['color_id'];
$pidcb=$rsj2['brand_id'];

    $sqlj21 = "SELECT * FROM product_category WHERE id='".$pidct."'";
    $resultj21 = $conn->query($sqlj21);
    $rsj21=mysqli_fetch_array($resultj21);
    
    $sqlj22 = "SELECT * FROM colors WHERE id='".$pidcc."'";
    $resultj22 = $conn->query($sqlj22);
    $rsj22=mysqli_fetch_array($resultj22);
    
    $sqlj23 = "SELECT * FROM brand WHERE id='".$pidcb."'";
    $resultj23 = $conn->query($sqlj23);
    $rsj23=mysqli_fetch_array($resultj23);
    
    

#######################

######เลือกลูกค้า#######
$sqlj3 = "SELECT * FROM customers WHERE id='".$pidc."'";
$resultj3 = $conn->query($sqlj3);
$rsj3=mysqli_fetch_array($resultj3);

#######################

######เพิ่มข้อมูล#######
if(isset($_POST['p']['branchs_id'])){
    $p=$_POST['p'];
    $psta=date("Y-m-d H:i:s");
    
    $sqli = "INSERT INTO job_service(user_id, employees_id, customers_id, product_id, job_manner, job_details, attachment, price_service, job_note, sta_date)
             VALUE('".$p['branchs_id']."','".$p['employees_id']."','".$p['customers_id']."','".$p['product_id']."','".$p['manner']."','".$p['details']."','".$p['attachment']."','".$p['service']."','".$p['note']."','".$psta."')";
    $rsi = $conn->query($sqli);
    if($rsi){
        $_SESSION['flash']['type']='success';
        $_SESSION['flash']['msg']='เพิ่มข้อมูลเรียบร้อย';
        echo"<head><meta http-equiv='Refresh'content = '1; URL = user_job.php'></head>";
    }else{
        $_SESSION['flash']['type']='danger';
        $_SESSION['flash']['msg']='ไม่สามารถเพิ่มข้อมูลได้!! กรุณาใส่ข้อมูลให้ครบ';
        echo"<head><meta http-equiv='Refresh'content = '2;'></head>";
    }
    
}
#######################


?>

<?php if(isset($_SESSION['flash'])){ ?>
<div class="alert alert-<?php echo $_SESSION['flash']['type'];?>" data-dismiss="alert">
    <?php echo ucfirst($_SESSION['flash']['type']).' '.$_SESSION['flash']['msg'];?>
</div>
<?php }?>

<div class="container">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">

			<div class="panel panel-primary">
			  <div class="panel-heading">ฟร์อมแจ้งฝากส่งศูนย์</div>
			  <div class="panel-body">

					<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?pid=<?=$pidj?>&" class="form-inline">
                                            <div class="row">
                                                <div class="col-md-5">
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                        <label for="p-branchs_id">สาขา :</label>
                                                        <input type="hidden" name="p[branchs_id]" id="p-branchs_id" value="<?php echo $bach2;?>">
                                                        <input name="p[branchs_id1]" id="p-branchs_id1" type="text" class="form-control" style="width: 150px" value=" <?php echo $bach1;?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                        <label  for="p-employees_id">ผู้ดำเนินการ :</label>
                                                        <select name="p[employees_id]" class="form-control" id="p-employees_id" style="width: 150px" required="required">
                                                        <option>---เลือกพนักงาน---</option>
                                                            <?php
                                                                $employees=$conn->query("SELECT * FROM employees WHERE user_id ='$bach2'");
                                                                //print_r($employees);
                                                                while($em = mysqli_fetch_array($employees, MYSQLI_BOTH)){?>
                                                                <option value="<?php echo $em['id'];?>"><?php echo $em[2]."  ".$em[3];?></option>
                                                            <?php }?>
                                                        </select>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="form-group">
                                            <label  for="p-name"> ชื่อลูกค้า : </label>
                                            <input type="hidden" name="p[customers_id]" id="p-customers_id" value="<?php echo $rsj3['id'];?>">
                                            <input readonly value="<?php echo $rsj3['name'];?>" id="p-customers" class="form-control" placeholder="ชื่อลูกค้า..." type="text" name="p[customers]" required="required" style="width: 150px">
                                            </div>
                                            <div class="form-group">
                                            <label  for="p-phone" > เบอร์โทร : </label>
                                            <input readonly value="<?php echo $rsj3['phone'];?>" id="p-customerphone" class="form-control" placeholder="เบอร์โทรติดต่อกลับ..." type="text" name="p[customerphone]" required="required" style="width: 150px">
                                            </div>
                                            <div class="form-group">
                                            <label  for="p-address" > ที่อยู่ : </label>
                                            <input readonly value="<?php echo $rsj3['address'];?>" id="p-customeradd" class="form-control" placeholder="ที่อยู่ลูกค้า..." type="text" name="p[customeradd]" required="required" style="width: 350px">
                                            </div>
                                          
                                            <hr />
                                            <div class="form-group">
                                            <input type="hidden" name="p[product_id]" id="p-product_id" value="<?php echo $rsj2['id'];?>">
                                            <label class="control-label col-md-3" for="p-brand" >ยี่ห้อ : </label>
                                            <div class="col-md-9">
                                            <input readonly value="<?php echo $rsj23['brand'];?>" id="p-brand" class="form-control" placeholder="ยี่ห้อสินค้า..." type="text" name="p[brand]" required="required">
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <label class="control-label col-md-3" for="p-model" >รุ่น : </label>
                                            <div class="col-md-9">
                                            <input readonly value="<?php echo $rsj2['model'];?>" id="p-model" class="form-control" placeholder="เช่น iPhone4s 16GB ศูนย์..." type="text" name="p[model]" required="required">
                                            </div>
                                            </div>	
                                            <div class="form-group">
                                            <label class="control-label col-md-3" for="p-color" >สี : </label>
                                            <div class="col-md-9">
                                            <input readonly value="<?php echo $rsj22['color'];?>" id="p-color" class="form-control" placeholder="ระบุสี..." type="text" name="p[color]" required="required">
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <label class="control-label col-md-3" for="p-ime" >IME : </label>
                                            <div class="col-md-9">
                                            <input readonly value="<?php echo $rsj2['ime'];?>" id="p-ime" class="form-control" placeholder="หมายเลขสินค้า..." type="text" name="p[ime]" required="required">
                                            </div>
                                            </div>
                                            <!--
                                            <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-info" onclick="browseDevice()">
                                            <i class="glyphicon glyphicon-search"></i>
                                            </a>
                                            -->
                                            <hr />
                                            <div class="form-group">
                                            <label class="control-label col-md-2" for="p-manner" >อาการ : </label>
                                            <div class="col-md-10">
                                            <input id="p-manner" class="form-control" placeholder="ระบุอาการ เช่น เครื่องร้อน ฯลฯ..." type="text" name="p[manner]" required="required" style="width: 560px">
                                            </div>
                                            </div>
                                            <br /><br />
                                            <div class="form-group">
                                            <label class="control-label col-md-2" for="p-details" >รายละเอียด : </label>
                                            <div class="col-md-10">
                                            <textarea cols="80" rows="5" id="p-details" class="form-control" placeholder="ระบุรายละเอียดของอาการ..." type="text" name="p[details]" required="required"></textarea>
                                            </div>
                                            </div>
                                            <br /><br />
                                            <div class="form-group">
                                            <label class="control-label col-md-3" for="p-attachment" >อุปกรณ์ที่นำมา : </label>
                                            <div class="col-md-9">
                                            <input id="p-attachment" class="form-control" placeholder="อุปกรณืที่นำมาด้วย เช่น USB+ฺแบตเตอร์รี่+กล่อง..." type="text" name="p[attachment]" required="required">
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <label class="control-label col-md-3" for="p-note" >หมายเหตุ : </label>
                                            <div class="col-md-9">
                                            <input id="p-note" class="form-control" placeholder="หมายเหตุ : เช่น เครื่องตกน้ำมา..." type="text" name="p[note]" >
                                            </div>
                                            </div>
                                            <Right>
                                            <div class="form-group">
                                            <label class="control-label col-md-3" for="p-service" >ค่าบริการ/บาท </label>
                                            <div class="col-md-9">
                                            <input id="p-service" class="form-control" placeholder="ค่าบริการ/บาท..." type="text" name="p[service]" required="required" >
                                            </div>
                                            </div>
                                            </Right>
                                            <hr />
                                            <center>
                                            <input type="submit" value="บันทึกข้อมูล" class="btn btn-primary">
                                            <input type="reset" value="ยกเลิก" class="btn btn-warning">
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
