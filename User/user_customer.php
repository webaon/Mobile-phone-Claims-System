<?php
if(!isset($_SESSION)){
    session_start();
}
include '../function.php';
isUser();
include 'header.php';
include 'men.php';
include '../dbconn.php';

$name=null;
$address=null;
$phone=null;

###################Insert Section###############
if(isset($_POST['c']['insert'])){//if define c['insert'] inset data
    $c = $_POST['c'];
    $sqli = "INSERT INTO customers(name,address,phone)
                VALUE('".$c['name']."','".$c['address']."','".$c['phone']."')";
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
    $cid = $_GET['eid'];

    $sqle = "SELECT * FROM customers WHERE id='".$cid."'";
    $resulte = $conn->query($sqle);
    $rse = mysqli_fetch_array($resulte);

    $name = $rse['name'];
	$address = $rse['address'];
	$phone = $rse['phone'];
	
}

if(isset($_POST['c']['edit'])){// if post data to edit
    $c = $_POST['c'];
    $sqlu = "UPDATE customers SET
            name='".$c['name']."',
	address='".$c['address']."',
	phone='".$c['phone']."'
	
            WHERE id='".$c['id']."'";
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
    $sqld = "DELETE FROM customers WHERE id='".$_GET['did']."'";
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
$sql = "SELECT * FROM customers ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!-- ###############Flash Message############# -->
<?php if(isset($_SESSION['flash'])){ ?>
<div class="alert alert-<?php echo $_SESSION['flash']['type'];?>" data-dismiss="alert">
    <?php echo ucfirst($_SESSION['flash']['type']).' '.$_SESSION['flash']['msg'];?>
</div>
<?php }?>


<h2 style="color:rgb(230, 183, 16)"><center>ข้อมูลลูกค้า</center></h2><hr  style="width: 350px"/>
<h4 style="color:rgb(255, 255, 255)"><center>รายละเอียดข้อมูลการติอต่อลูกค้า</center></h4>


<div class="col-md-1"></div>
<div class="col-md-10">
<div class="panel panel-primary">
    <div class="panel-heading">ข้อมูลลูกค้า</div>
	<div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <!--################Insert form############## -->
                    <div class="row">
                        <div class="col-md-12">
                        <h4>เพิ่มข้อมูลลูกค้าใหม่</h4>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"">
                        <?php if(isset($_GET['eid'])){?>
                            <input type="hidden" name="c[edit]" value="1">
                            <input type="hidden" name="c[id]" value="<?php echo $cid;?>">
                        <?php }else{?>
                            <input type="hidden" name="c[insert]" value="1">
                        <?php }?>
                            <div class="form-group">
                                        <label for="c-name">ชื่อลูกค้า :</label>
                                        <input id="c-name" class="form-control" placeholder="กรุณาระบุชื่อลูกค้า..." type="text" name="c[name]" value="<?php echo $name;?>" >
                                       
                                    </div><div class="form-group">
                                        <label  for="c-address">ที่อยู่ :</label>
                                        <input id="c-address" class="form-control" placeholder="กรุณาระบุที่อยู่ลูกค้า..." type="text" name="c[address]" value="<?php echo $address;?>" >
                                        
                                    </div><div class="form-group">
                                        <label  for="c-phone">เบอร์โทร :</label>
                                        <input id="c-phone" class="form-control" placeholder="กรุณาระบุเบอร์โทรติดต่อลูกค้า..." type="text" name="c[phone]" value="<?php echo $phone;?>" >
                                       
                                    </div>
                            <center>
                                <input type="submit" value="บันทึก" class="btn btn-primary">
                                <?php if(isset($_GET['eid'])){ //if select to Edit ?>
                                <a href="user_customer.php" class="btn btn-warning">ยกเลิก</a>
                                <?php }?>
                            </center>
                        </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="col-md-12">
                        <!-- ###############List of Data############# -->
                        <h4>รายชื่อลูกค้า</h4>
                        <table class="table table-hover">
                            <tr class="btn-success">
                                <th while="30%">ชื่อลูกค้า</th>
                                <th while="40%">ที่อยู่</th>
                                <th while="20%">เบอร์โทร</th>

                                <th while="10%"></th>
                            </tr>
                            <?php while($rs=mysqli_fetch_array($result)){?>
                            <tr>
                                <td><?php echo $rs['name'];?></td>
                                <td><?php echo $rs['address'];?></td>
                                <td><?php echo $rs['phone'];?></td>

                                <td>
                            <center>
                                <a href="<?php echo $_SERVER['PHP_SELF'];?>?eid=<?php echo $rs['id'];?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="แก้ไข">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <a href="user_product.php?pid=<?php echo $rs['id'];?>"  class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="จัดการสินค้า">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                </a>
                                
                            </center>
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
<div class="col-md-1"></div>
<?php
include '../footer.php';
?>
