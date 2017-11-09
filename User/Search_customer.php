<?php
if(!isset($_SESSION)){
	session_start();
}
include 'header.php';
include 'men.php';
include '../function.php';
include '../dbconn.php';
isUser();
  $cname=NULL;
  $cime=NULL;
?>
<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            
            <div class="panel panel-primary">
                <div class="panel-heading">ค้าหาข้อมูล 
                    <ul class="nav navbar-nav navbar-right">
                      
                        <a class="btn btn-sm btn-primary" href="user_customer.php">
                            <span class="glyphicon glyphicon-user" title="เพิ่มข้อมูลลูกค้าใหม่">
                                เพิ่มลูกค้าใหม่
                            </span>
                        </a>
                      </ul>
                </div>
                <div class="panel-body">
                  <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-inline">
                     
                      <div class="col-md-6">
                           <div class="form-group">
                            <label class="sr-only" for="exampleInputAmount">ค้นจากชื่อหรือเบอร์โทรลูกค้า (in dollars)</label>
                            <div class="input-group">
                               <div class="input-group-addon" id="sizing-addon3"><span class="glyphicon glyphicon-user"  ></span></div>
                               <input type="text" class="form-control" name="customermane" placeholder="ค้นหาจากชื่อหรือเบอร์โทรลูกค้า..." >
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">Go!</button>
                                </span>
                            </div>
                          </div>
                      </div>
                  </form>
                  <form method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-inline">
                        <div class="col-md-6">
                              <div class="input-group">
                                <div class="input-group-addon" id="sizing-addon3"><span class="glyphicon glyphicon-phone"  ></span></div>
                                <input type="text" class="form-control" name="customerime" placeholder="ค้นหาจากหมายเลขสินค้า IME...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">Go!</button>
                                </span>
                              </div>
                        </div>
                  </form>
                </div>
            </div>
            
        </div>
        <div class="col-md-1"></div>
    </div>
    
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
         <?php
        if(isset($_POST['customermane']))
            {
            $cname=$_POST['customermane'];
            $sql = "SELECT * FROM customers WHERE name LIKE '$cname%' ORDER BY name ASC ";
            
            $result = $conn->query($sql);
            while($rs=mysqli_fetch_array($result)){
                
                $sqli2 = "SELECT * FROM product where customers_id='$rs[id]'";
                $resulti2 = $conn->query($sqli2) ;
                
        ?>
        <div class="panel panel-primary">
            <div class="panel-heading">ชื่อลูกค้า : คุณ<?php echo $rs['name'];?>
                <a href="user_product.php?pid=<?php echo $rs['id'];?>" class="btn btn btn-info"><span class="glyphicon glyphicon-plus" title="เพิ่มรายการสินค้า"> เพิ่มสินค้า</span></a>
                
            </div>
                <div class="panel-body">
                    <table class="table table-success table-hover">
                            <tr class="btn-success">
                                <th while="30%">ยี่ห้อ</th>
                                <th while="40%">รุ่น</th>
                                <th while="20%">หมายเลขเครื่อง</th>
                                <th while="10%"></th>
                            </tr>
                            <?php
                            while($rsi2=mysqli_fetch_array($resulti2)){
                          
                                $sqli03 = "SELECT * FROM brand where id='$rsi2[brand_id]'";
                                $resulti03 = $conn->query($sqli03) ;
                                $rsi03=mysqli_fetch_array($resulti03);
                            ?>

                            <tr>
                                <td><?php echo $rsi03['brand'];?></td>
                                <td><?php echo $rsi2['model'];?></td>
                                <td><?php echo $rsi2['ime'];?></td>
                                
                                <td>
                                  <center>

                                      <a href="user_from_job.php?pid=<?php echo $rs['id'];?>" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-file" title="ออกใบเคลมสินค้า"> ออกใบเคลม</span></a>

                                  </center>
                                </td>
                            </tr>
                    <?php
                            }
                    ?>
                        </table>
                </div>
        </div>
            <?php }}?>
            <?php
        if(isset($_GET['customerime']))
            {
            $cime=$_GET['customerime'];
            $sqli5 = "SELECT * FROM product WHERE ime LIKE '$cime%' ORDER BY ime ASC ";
            
            $resulti5 = $conn->query($sqli5);
            
        ?>
        <div class="panel panel-primary">
                <div class="panel-heading">รายการสินค้าที่ค้นหา</div>
                <div class="panel-body">
                    <table class="table table-success table-hover">
                            <tr class="btn-success">
                                <th while="20%">ชื่อลูกค้า</th>
                                <th while="20%">ยี่ห้อ</th>
                                <th while="30%">รุ่น</th>
                                <th while="20%">หมายเลขสินค้า</th>
                                
                                <th while="10%"></th>
                            </tr>

                            <?php while($rsi5=mysqli_fetch_array($resulti5)){

                                $sqli4 = "SELECT * FROM customers where id='$rsi5[customers_id]'";
                                $resulti4 = $conn->query($sqli4) ;
                                $rsi4=mysqli_fetch_array($resulti4);

                                $sqli3 = "SELECT * FROM brand where id='$rsi5[brand_id]'";
                                $resulti3 = $conn->query($sqli3) ;
                                $rsi3=mysqli_fetch_array($resulti3);
                            ?>

                            <tr>
                                <td><?php echo $rsi4['name'];?></td>
                                <td><?php echo $rsi3['brand'];?></td>
                                <td><?php echo $rsi5['model'];?></td>
                                <td><?php echo $rsi5['ime'];?></td>

                                <td>
                                  <center>

                                      <a href="user_from_job.php?pid=<?php echo $rsi5['id'];?>" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-file" title="ออกใบเคลมสินค้า"> ออกใบเคลม</span></a>

                                  </center>
                                </td>
                            </tr>
                    <?php }}?>
                        </table>
                </div>
                </div>
            
        </div>
        </div>
        <div class="col-md-1"></div>
    </div>
    
    
</div>







<?php
include '../footer.php'
 ?>
