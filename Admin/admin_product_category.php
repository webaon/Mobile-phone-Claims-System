<body data-gr-c-s-loaded="true";>
<?php
if(!isset($_SESSION)){
    session_start();
}
include '../function.php';
isAdmin();
include 'header.php';
include 'nav.php';
include '../dbconn.php';

$pd_category=null;

###################Insert Section###############
if(isset($_POST['p']['insert'])){//if define p['insert'] inset data
    $p = $_POST['p'];
    $sqli = "INSERT INTO product_category(pd_category)
                VALUE('".$p['pd_category']."')";
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
    $pid = $_GET['eid'];

    $sqle = "SELECT * FROM product_category WHERE id='".$pid."'";
    $resulte = $conn->query($sqle);
    $rse = mysqli_fetch_array($resulte);

    $pd_category = $rse['pd_category'];

}

if(isset($_POST['p']['edit'])){// if post data to edit
    $p = $_POST['p'];
    $sqlu = "UPDATE product_category SET
            pd_category='".$p['pd_category']."'

            WHERE id='".$p['id']."'";
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
    $sqld = "DELETE FROM product_category WHERE id='".$_GET['did']."'";
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
$sql = "SELECT * FROM product_category ORDER BY id DESC";
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
          <h2 style="color:rgb(35, 172, 249)">เพิ่มประเภทสินค้า</h2>
          <h4 style="color: rgba(211,211,211,1)">หากต้องการเพิ่มประเภทสินค้า กรุณาระบุประเทภสินค้าที่ต้องการได้เลย</h4><hr />

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-horizontal">
<?php if(isset($_GET['eid'])){?>
    <input type="hidden" name="p[edit]" value="1">
    <input type="hidden" name="p[id]" value="<?php echo $pid;?>">
<?php }else{?>
    <input type="hidden" name="p[insert]" value="1">
<?php }?>
    <div class="form-group">
                <label class="control-label col-md-3" for="p-pd_category" style="color:rgb(217, 217, 217)"><h4>ประเภทสินค้า</h4></label>
                <div class="col-md-9">
                <input id="p-pd_category" class="button" placeholder="ระบุประเภท..." type="text" name="p[pd_category]" value="<?php echo $pd_category;?>" required="required">
                </div>

    </div>
        <input type="submit" value="บันทึกข้อมูล" class="btn btn-primary">
        <?php if(isset($_GET['eid'])){ //if select to Edit ?>
        <a href="admin_product_category.php" class="btn btn-warning">ยกเลิก</a>
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
<!-- ###############List of Data############# -->
<div class="panel panel-primary">
  <div class="panel-heading">รายการประเภทสินค้า</div>
  <div class="panel-body">
        <table class="table table-condensed">
             <tr class="btn-primary">
               <th width="70%"></th>

               <th width="30%"></th>
           </tr>
           <?php while($rs=mysqli_fetch_array($result)){?>
          <tr class="active">
               <td><?php echo $rs['pd_category'];?></td>

               <td>
               <a href="<?php echo $_SERVER['PHP_SELF'];?>?eid=<?php echo $rs['id'];?>" class="btn btn-sm btn-warning">แก้ไข</a>
               <a href="<?php echo $_SERVER['PHP_SELF'];?>?did=<?php echo $rs['id'];?>" class="btn btn-sm btn-danger" onclick="return confirm('แน่ใจนะว่าต้องการลบ?');">ลบ</a>
               </td>
           </tr>
           <?php }?>
       </table>
    </div>
</div>

<div class="col-md-3">

</div>
</div>


<?php
include '../footer.php';
?>
