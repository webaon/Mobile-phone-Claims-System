<?php
if(!isset($_SESSION)){
    session_start();
}
include '../function.php';
isAdmin();
include 'header.php';
include 'nav.php';
include '../dbconn.php';

$supplier=null;
$se_phone=null;

###################Insert Section###############
if(isset($_POST['s']['insert'])){//if define s['insert'] inset data
    $s = $_POST['s'];
    $sqli = "INSERT INTO suppliers(supplier,se_phone)
                VALUE('".$s['supplier']."','".$s['se_phone']."')";
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
    $sid = $_GET['eid'];

    $sqle = "SELECT * FROM suppliers WHERE id='".$sid."'";
    $resulte = $conn->query($sqle);
    $rse = mysqli_fetch_array($resulte);

    $supplier = $rse['supplier'];
	$se_phone = $rse['se_phone'];

}

if(isset($_POST['s']['edit'])){// if post data to edit
    $s = $_POST['s'];
    $sqlu = "UPDATE suppliers SET
            supplier='".$s['supplier']."',
	se_phone='".$s['se_phone']."'

            WHERE id='".$s['id']."'";
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
    $sqld = "DELETE FROM suppliers WHERE id='".$_GET['did']."'";
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
$sql = "SELECT * FROM suppliers ORDER BY id DESC";
$result = $conn->query($sql);
?>


<div class="jumbotron" style="background-image: url(./pic/bg.png); margin-top: -30px ">

<!-- ###############Flash Message############# -->
<?php if(isset($_SESSION['flash'])){ ?>
<div class="alert alert-<?php echo $_SESSION['flash']['type'];?>" data-dismiss="alert">
    <?php echo ucfirst($_SESSION['flash']['type']).' '.$_SESSION['flash']['msg'];?>
</div>
<?php }?>



<!--################Insert form############## -->
<div class="container">
    <div class="row">

        <div class="col-md-12" >
          <h2 style="color:rgb(241, 217, 89)">ข้อมูล Suppliers</h2>
          <h4 style="color: rgba(211,211,211,1)">หากต้องการเพิ่มศูนย์จำหน่าย กรุณาระบุข้อมูลศูนย์จำหน่ายที่ต้องการได้เลย</h4>

<hr />

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-inline">
<?php if(isset($_GET['eid'])){?>
    <input type="hidden" name="s[edit]" value="1">
    <input type="hidden" name="s[id]" value="<?php echo $sid;?>">
<?php }else{?>
    <input type="hidden" name="s[insert]" value="1">
<?php }?>

<center>
    <div class="form-group">
                <label for="s-supplier" style="color:rgb(250, 250, 232)"><h4>ชื่อศูนย์บริการ</h4></label>
                <input id="s-supplier" class="button" placeholder="กรุณาระบุศูนย์บริการ..." type="text" name="s[supplier]" value="<?php echo $supplier;?>" required="required">

            </div><div class="form-group">
                <label  for="s-se_phone" style="color:rgb(250, 250, 232)"><h4>เบอร์โทรศัพท์</h4></label>
                <input id="s-se_phone" class="button" placeholder="กรุณาระบุเบอร์โทร..." type="text" name="s[se_phone]" value="<?php echo $se_phone;?>" >
            </div>

        <input type="submit" value="บันทึกข้อมูล" class="btn btn-primary">
        <?php if(isset($_GET['eid'])){ //if select to Edit ?>
        <a href="admin_suppliers.php" class="btn btn-warning">ยกเลิก</a>
        <?php }?>
</center>

</form>
</div>
</div>
</div>
</div>

<div class="col-md-2">

</div>

<div class="col-md-8">
<!-- ###############List of Data############# -->
<div class="panel panel-primary">
  <div class="panel-heading">ศูนย์บริการทั้งหมด</div>
  <div class="panel-body">
<table class="table table-warning table-hover">
    <tr class="btn-warning ">

      <th  width="50%">ชื่อศูนย์บริการ</th>
      <th  width="30%">เบอร์โทรศัพท์</th>

      <th  width="20%"></th>


    </tr>
    <?php while($rs=mysqli_fetch_array($result)){?>
    <tr>
        <td><?php echo $rs['supplier'];?></td>
	      <td><?php echo $rs['se_phone'];?></td>

        <td>
          <center>
            <a href="<?php echo $_SERVER['PHP_SELF'];?>?eid=<?php echo $rs['id'];?>" class="btn btn-sm btn-warning">แก้ไข</a>
            <a href="<?php echo $_SERVER['PHP_SELF'];?>?did=<?php echo $rs['id'];?>" class="btn btn-sm btn-danger" onclick="return confirm('แน่ใจนะว่าต้องการลบ?');">ลบ</a>
         </center>
       </td>

    </tr>
    <?php }?>
</table>
</div>




<?php
include '../footer.php';
?>
