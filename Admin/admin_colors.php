<?php
if(!isset($_SESSION)){
    session_start();
}
include '../function.php';
isAdmin();
include 'header.php';
include 'nav.php';
include '../dbconn.php';


$color=null;

###################Insert Section###############
if(isset($_POST['c']['insert'])){//if define c['insert'] inset data
    $c = $_POST['c'];
    $sqli = "INSERT INTO colors(color)
                VALUE('".$c['color']."')";
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

    $sqle = "SELECT * FROM colors WHERE id='".$cid."'";
    $resulte = $conn->query($sqle);
    $rse = mysqli_fetch_array($resulte);

    $color = $rse['color'];

}

if(isset($_POST['c']['edit'])){// if post data to edit
    $c = $_POST['c'];
    $sqlu = "UPDATE colors SET
            color='".$c['color']."'

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
    $sqld = "DELETE FROM colors WHERE id='".$_GET['did']."'";
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
$sql = "SELECT * FROM colors ORDER BY id DESC";
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
          <h2 style="color:rgb(35, 172, 249)">เพิ่มกลุ่มสี</h2>
          <h4 style="color: rgba(211,211,211,1)">หากต้องการเพิ่มสี กรุณาระบุสีที่ต้องการได้เลย</h4><hr />

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-horizontal">
<?php if(isset($_GET['eid'])){?>
    <input type="hidden" name="c[edit]" value="1">
    <input type="hidden" name="c[id]" value="<?php echo $cid;?>">
<?php }else{?>
    <input type="hidden" name="c[insert]" value="1">
<?php }?>
    <div class="form-group">
                <label class="control-label col-md-2" for="c-color" style="color:rgb(203, 203, 203)"><h4>ชื่อสี</h4></label>
                <div class="col-md-10">
                <input id="c-color" class="button" placeholder="กรุณาระบุสี..." type="text" name="c[color]" value="<?php echo $color;?>" required="required">
                </div>

            </div>
        <input type="submit" value="บันทึกข้อมูล" class="btn btn-primary">
        <?php if(isset($_GET['eid'])){ //if select to Edit ?>
        <a href="admin_colors.php" class="btn btn-warning">ยกเลิก</a>
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
  <div class="panel-heading">รายการสี</div>
  <div class="panel-body">
  <table class="table table-condensed">
      <tr class="btn-primary">
          <th width="70%"></th>

          <th width="30%"></th>
      </tr>
      <?php while($rs=mysqli_fetch_array($result)){?>
      <tr class="active">
          <td><?php echo $rs['color'];?></td>

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
</div>
</div>
    

<div class="col-md-3">

</div>

</div>


</div>



<?php
include '../footer.php';
?>
