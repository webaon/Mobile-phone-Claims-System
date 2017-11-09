
<?php
if(!isset($_SESSION)){
    session_start();
}
include '../function.php';
isAdmin();
include 'header.php';
include 'nav.php';
include '../dbconn.php';

$brand=null;

###################Insert Section###############
if(isset($_POST['b']['insert'])){//ถ้ากำหนด b ['insert'] ให้เพิ่มข้อมูล
    $b = $_POST['b'];
    $sqli = "INSERT INTO brand(brand)
                VALUE('".$b['brand']."')";
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
    $bid = $_GET['eid'];

    $sqle = "SELECT * FROM brand WHERE id='".$bid."'";
    $resulte = $conn->query($sqle);
    $rse = mysqli_fetch_array($resulte);

    $brand = $rse['brand'];

}

if(isset($_POST['b']['edit'])){// if post data to edit
    $b = $_POST['b'];
    $sqlu = "UPDATE brand SET
            brand='".$b['brand']."'

            WHERE id='".$b['id']."'";
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
    $sqld = "DELETE FROM brand WHERE id='".$_GET['did']."'";
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
$sql = "SELECT * FROM brand ORDER BY id DESC";
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
        <div class="col-md-3"></div>
        <div class="col-md-6" >
          <h2 style="color:rgb(35, 172, 249)">เพิ่มยี่ห้อสินค้า</h2>
          <h4 style="color: rgba(211,211,211,1)">หากต้องการเพิ่มยี่ห้อสินค้า กรุณาระบุยี่ห้อสินค้าที่ต้องการได้เลย</h4><hr />


<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-horizontal">
<?php if(isset($_GET['eid'])){?>
    <input type="hidden" name="b[edit]" value="1">
    <input type="hidden" name="b[id]" value="<?php echo $bid;?>">
<?php }else{?>
    <input type="hidden" name="b[insert]" value="1">
<?php }?>
    <div class="form-group">
                <label class="control-label col-md-2" for="b-brand" style="color:rgb(203, 203, 203)"><h4>ชื่อยี่ห้อ</h4></label>
                <div class="col-md-10">
                <input id="b-brand" class="button" placeholder="กรุณาระบุยี่ห้อ..." type="text" name="b[brand]" value="<?php echo $brand;?>" required="required">
                </div>

            </div>
        <input type="submit" value="บันทึกข้อมูล" class="btn btn-primary">
        <?php if(isset($_GET['eid'])){ //if select to Edit ?>
        <a href="admin_brand.php" class="btn btn-warning">ยกเลิก</a>
        <?php }?>

</form>
</div>
</div>
</div>
</div>

<div class="row">
  <div class="col-md-3">

  </div>

  <div class="col-md-6">
  <!-- ############### ตารางข้อมูล ############# -->
<div class="panel panel-primary">
  <div class="panel-heading">รายการยี่ห้อสินค้า</div>
  <div class="panel-body">
  <table class="table table-condensed">
      <tr class="btn-primary">
          <th width="70%"></th>

          <th width="30%"></th>
      </tr>
      <?php while($rs=mysqli_fetch_array($result)){?>
      <tr class="active">
          <td><?php echo $rs['brand'];?></td>

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

<div class="col-md-3">

</div>

</div>



<?php
include '../footer.php';
?>
