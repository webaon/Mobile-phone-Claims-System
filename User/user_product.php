<?php
if(!isset($_SESSION)){
    session_start();
}
include '../function.php';
isUser();
include 'header.php';
include 'men.php';
include '../dbconn.php';


$product_category_id=null;
$brand_id=null;
$model=null;
$color_id=null;
$ime=null;

  if(isset($_GET['pid'])){
      $cidp=$_GET['pid'];
    $cp=$cidp; 
    $sqlc1 = "SELECT * FROM customers WHERE id='".$cp."'";
    $resultc1 = $conn->query($sqlc1);
    $rsc1=mysqli_fetch_array($resultc1);
    $cnn=$rsc1['name'];
  }
    
    
###################Insert Section###############
if(isset($_POST['p']['insert'])){//if define p['insert'] inset data
    $p = $_POST['p'];
    $sqli = "INSERT INTO product(product_category_id,brand_id,model,color_id,ime,customers_id)
                VALUE('".$p['product_category_id']."','".$p['brand_id']."','".$p['model']."','".$p['color_id']."','".$p['ime']."','".$p['customers_id']."')";
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

    $sqle = "SELECT * FROM product WHERE id='".$pid."'";
    $resulte = $conn->query($sqle);
    $rse = mysqli_fetch_array($resulte);

    $product_category_id = $rse['product_category_id'];
	$brand_id = $rse['brand_id'];
	$model = $rse['model'];
	$color_id = $rse['color_id'];
	$ime = $rse['ime'];

}

if(isset($_POST['p']['edit'])){// if post data to edit
    $p = $_POST['p'];
    $sqlu = "UPDATE product SET
        product_category_id='".$p['product_category_id']."',
	brand_id='".$p['brand_id']."',
	model='".$p['model']."',
	color_id='".$p['color_id']."',
	ime='".$p['ime']."'

            WHERE id='".$p['id']."'";
    $rsu = $conn->query($sqlu);
    if($rsu){
        $_SESSION['flash']['type']='success';
        $_SESSION['flash']['msg']='แก้ไขข้อมูลเรียบร้อย';
    }else{
        $_SESSION['flash']['type']='danger';
        $_SESSION['flash']['msg']='ไม่สามารถแก้ไขข้อมูลได้!! ใส่ข้อมูลไม่ถูกต้อง';
    }
}

###################Select Data Section###############
$sql = "SELECT * FROM product WHERE customers_id='".$cidp."' ORDER BY id DESC";
$result = $conn->query($sql);
?>


<!-- ###############Flash Message############# -->
<?php if(isset($_SESSION['flash'])){ ?>
<div class="alert alert-<?php echo $_SESSION['flash']['type'];?>" data-dismiss="alert">
    <?php echo ucfirst($_SESSION['flash']['type']).' '.$_SESSION['flash']['msg'];?>
</div>
<?php }?>


<h2 style="color:rgb(230, 183, 16)"><center>ข้อมูลสินค้า</center></h2><hr  style="width: 350px"/>
<h4 style="color:rgb(255, 255, 255)"><center>รายละเอียดทะเบียนสินค้า</center></h4>


<div class="col-md-1"></div>
<div class="col-md-10">
<div class="panel panel-primary">
    <div class="panel-heading">ข้อมูลสินค้า : คุณ <?php echo $cnn; ?></div>
	<div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <!--################Insert form############## -->
                    <div class="row">
                    <div class="col-md-12">
                        <h4><center>เพิ่มสินค้าใหม่</center></h4>
                      <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?pid=<?=$cidp?>&" class="form-horizontal">
                        <?php if(isset($_GET['eid'])){?>
                            <input type="hidden" name="p[edit]" value="1">
                            <input type="hidden" name="p[id]" value="<?php echo $pid;?>">
                        <?php }else{?>
                            <input type="hidden" name="p[insert]" value="1">
                        <?php }?>
                            <div class="form-group">
                                        <label class="control-label col-md-2" for="p-product_category_id">ประเภทสินค้า</label>
                                        <div class="col-md-10">
                                        <select name="p[product_category_id]" class="form-control" id="p-product_category_id">
                                                <option>เลือกประเภทสินค้า</option>
                                                <?php
                                                $product_category=$conn->query("SELECT * FROM product_category");

                                                //print_r($product_category);
                                                while($pr = mysqli_fetch_array($product_category, MYSQLI_BOTH)){?>
                                                    <option value="<?php echo $pr['id'];?>"><?php echo $pr[1];?></option>
                                                <?php }?>
                                            </select>
                                        </div>

                                    </div><div class="form-group">
                                        <label class="control-label col-md-2" for="p-brand_id">ยี่ห้อ</label>
                                        <div class="col-md-10">
                                        <select name="p[brand_id]" class="form-control" id="p-brand_id">
                                                <option>เลือกยี่ห้อ</option>
                                                <?php
                                                $brand=$conn->query("SELECT * FROM brand");

                                                //print_r($brand);
                                                while($br = mysqli_fetch_array($brand, MYSQLI_BOTH)){?>
                                                    <option value="<?php echo $br['id'];?>"><?php echo $br[1];?></option>
                                                <?php }?>
                                            </select>
                                        </div>

                                    </div><div class="form-group">
                                        <label class="control-label col-md-2" for="p-model">รุ่น</label>
                                        <div class="col-md-10">
                                        <input id="p-model" class="form-control" type="text" name="p[model]" value="<?php echo $model;?>" required="required">
                                        </div>

                                    </div><div class="form-group">
                                        <label class="control-label col-md-2" for="p-color_id">สี</label>
                                        <div class="col-md-10">
                                        <select name="p[color_id]" class="form-control" id="p-color_id">
                                                <option>เลือกสี</option>
                                                <?php
                                                $color=$conn->query("SELECT * FROM colors");

                                                //print_r($color);
                                                while($co = mysqli_fetch_array($color, MYSQLI_BOTH)){?>
                                                    <option value="<?php echo $co['id'];?>"><?php echo $co[1];?></option>
                                                <?php }?>
                                            </select>
                                        </div>

                                    </div><div class="form-group">
                                        <label class="control-label col-md-2" for="p-ime">หมายเลขสินค้า</label>
                                        <div class="col-md-10">
                                        <input id="p-ime" class="form-control" type="text" name="p[ime]" value="<?php echo $ime;?>" required="required">
                                        </div>

                                    </div><div class="form-group">

                                        <div class="col-md-10">
                                            <input type="hidden" name="p[customers_id]" class="form-control" id="p-customers_id" value=" <?php echo $cp; ?>">
                                                
                                        </div>

                                    </div>
                            <center>
                                <input type="submit" value="บันทึก" class="btn btn-primary">
                                <?php if(isset($_GET['eid'])){ //if select to Edit ?>
                                <a href="user_product.php?pid=<?=$cidp?>&" class="btn btn-warning">ยกเลิก</a>
                                <?php }?>
                            </center>
                        </form>
                    </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="col-md-12">
                        <!-- ###############List of Data############# -->
                        <h4>รายการสินค้า</h4>


                        <table class="table table-hover">
                            <tr class="btn-success">
                                <th while="15%">ประเภทสินค้า</th>
                                <th while="15%">ยี่ห้อ</th>
                                <th while="30%">รุ่น</th>
                                <th while="10%">สี</th>
                                <th while="20%">หมายเลขสินค้า</th>

                                <th while="10%"></th>
                            </tr>
                          <?php


                           while($rs=mysqli_fetch_array($result))
                           {
                             $sql1 = "SELECT * FROM colors where id='$rs[color_id]'";
                             $result1 = $conn->query($sql1) ;
                             $rs1=mysqli_fetch_array($result1);

                             $sql2 = "SELECT * FROM brand where id='$rs[color_id]'";
                             $result2 = $conn->query($sql2) ;
                             $rs2=mysqli_fetch_array($result2);

                             $sql3 = "SELECT * FROM product_category where id='$rs[color_id]'";
                             $result3 = $conn->query($sql3) ;
                             $rs3=mysqli_fetch_array($result3);

                             ?>
                            <tr>
                                <td><?php echo $rs3['pd_category'];?></td>
                                <td><?php echo $rs2['brand'];?></td>
                                <td><?php echo $rs['model'];?></td>


                                <td><?php echo $rs1['color'];?></td>

                                <td><?php echo $rs['ime'];?></td>

                                <td>
                                  <center>

                                    <a href="<?php echo $_SERVER['PHP_SELF'];?>?pid=<?=$cidp?>&eid=<?php echo $rs['id'];?>"  class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="แก้ไข">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>
                                     <a href="user_from_job.php?pid=<?php echo $rs['id'];?>"  class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="ออกบิลเคลม">
                                        <span class="glyphicon glyphicon-list-alt"></span>
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
