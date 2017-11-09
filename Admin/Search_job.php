<?php
if(!isset($_SESSION)){
	session_start();
}
include 'header.php';
include 'nav.php';
include '../function.php';
include '../dbconn.php';
isAdmin();
  $cname=NULL;
  $cime=NULL;
  
  
?>
<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            
            <div class="panel panel-primary">
                <div class="panel-heading">ตรวจสอบสถานะ 
                    
                </div>
                <div class="panel-body">
                  <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-inline">
                     
                      <div class="col-md-4">
                           <div class="form-group">
                            <label class="sr-only" for="exampleInputAmount">ค้นจากชื่อหรือเบอร์โทรลูกค้า (in dollars)</label>
                            <div class="input-group">
                               <div class="input-group-addon" id="sizing-addon3"><span class="glyphicon glyphicon-user"  ></span></div>
                               <input type="text" class="form-control" name="customermane" placeholder="ใสชื่อหรือเบอร์โทรลูกค้า...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">Go!</button>
                                </span>
                            </div>
                          </div>
                      </div>
                  </form>
                  <form method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-inline">
                        <div class="col-md-4">
                              <div class="input-group">
                                <div class="input-group-addon" id="sizing-addon3"><span class="glyphicon glyphicon-credit-card"  ></span></div>
                                <input type="text" class="form-control" name="jobid" placeholder="ใส่หมายเลขใบเคลม...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">Go!</button>
                                </span>
                              </div>
                        </div>
                  </form>
                  <form method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-inline">
                        <div class="col-md-4">
                              <div class="input-group">
                                <div class="input-group-addon" id="sizing-addon3"><span class="glyphicon glyphicon-phone"  ></span></div>
                                <input type="text" class="form-control" name="customerime" placeholder="ใส่หมายเลขสินค้า IME...">
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
                
                $sqli22 = "SELECT * FROM job_service where customers_id='$rs[id]'";
                $resulti22 = $conn->query($sqli22) ;
                
        ?>
        <div class="panel panel-primary">
            <div class="panel-heading">ชื่อลูกค้า : คุณ<?php echo $rs['name'];?>
            </div>
                <div class="panel-body">
                    <table class="table table-success table-hover">
                            <tr class="btn-success">
                                <th while="5%"><center>เลขที่</center></th>
                                <th while="25%">สินค้ารุ่น</th>
                                <th while="20%">หมายเลขเครื่อง</th>
                                <th while="20%">อาการ</th>
                                <th while="10%">วันที่ส่งเคลม</th>
                                <th while="10%">สถานะ</th>
                                <th while="10%"></th>
                                   
                                
                            </tr>
                            <?php
                            while($rsi22=mysqli_fetch_array($resulti22)){
                          
                                $sqli03 = "SELECT * FROM product where id='$rsi22[product_id]'";
                                $resulti03 = $conn->query($sqli03) ;
                                $rsi03=mysqli_fetch_array($resulti03);
                                   
                                    $date = date_create($rsi22['sta_date']);
                            ?>

                            <tr>
                                <td><center><?php echo $rsi22['id'];?></center></td>
                                <td><?php echo $rsi03['model'];?></td>
                                <td><?php echo $rsi03['ime'];?></td>
                                <td><?php echo $rsi22['job_manner'];?></td>
                                <td><?php echo date_format($date,'d/m/y');?></td>
                                <td><?php echo $rsi22['status'];?></td>
                                
                                <td>
                                    <div class="btn-group">
						  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
						    จัดการ <span class="caret"></span>
						  </button>
						  <ul class="dropdown-menu ">
						    <li><a href="#"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> พิมพ์ใบฝากเคลม</a></li>
						    <li role="separator" class="divider"></li>
						    <li><a href="admin_jobdtail.php?jid=<?php echo $rsi22['id'];?>"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> รายละเอียดการเคลม</a></li>
						    <li role="separator" class="divider"></li>
						    <li>
							<a href="admin_conjob.php?eid=<?php echo $rsi22['id'];?>"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> รับเรื่อง</a>
                                                    </li>
						    <li><a href="admin_endjob.php?jid=<?php echo $rsi22['id'];?>"><span class="glyphicon glyphicon-flash" aria-hidden="true"></span> ปิดงาน</a></li>
  							<li role="separator" class="divider"></li>
                                                  </ul>
                                    </div>
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
            $rsi5=mysqli_fetch_array($resulti5);
                
             $sqli23 = "SELECT * FROM job_service where product_id='$rsi5[id]'";
             $resulti23 = $conn->query($sqli23) ;
            
        ?>
        <div class="panel panel-primary">
                <div class="panel-heading">รายการสินค้าที่ค้นหา</div>
                <div class="panel-body">
                    <table class="table table-success table-hover">
                            <tr class="btn-success">
                                <th while="5%"><center>เลขที่</center></th>
                                <th while="25%">สินค้ารุ่น</th>
                                <th while="20%">หมายเลขเครื่อง</th>
                                <th while="20%">อาการ</th>
                                <th while="10%">วันที่ส่งเคลม</th>
                                <th while="10%">สถานะ</th>
                                <th while="10%"></th>
                            </tr>

                            <?php while($rsi23=mysqli_fetch_array($resulti23)){
                                
                                $date1 = date_create($rsi23['sta_date']);
                            ?>

                            <tr>
                                <td><center><?php echo $rsi23['id'];?></center></td>
                                <td><?php echo $rsi5['model'];?></td>
                                <td><?php echo $rsi5['ime'];?></td>
                                <td><?php echo $rsi23['job_manner'];?></td>
                                <td><?php echo date_format($date1,'d/m/y');?></td>
                                <td><?php echo $rsi23['status'];?></td>
                                <td>
                                    <div class="btn-group">
						  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
						    จัดการ <span class="caret"></span>
						  </button>
						  <ul class="dropdown-menu ">
						    <li><a href="#"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> พิมพ์ใบฝากเคลม</a></li>
						    <li role="separator" class="divider"></li>
						    <li><a href="admin_jobdtail.php?jid=<?php echo $rsi23['id'];?>"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> รายละเอียดการเคลม</a></li>
						    <li role="separator" class="divider"></li>
						    <li>
							<a href="admin_conjob.php?eid=<?php echo $rsi23['id'];?>"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> รับเรื่อง</a>
                                                    </li>
						    <li><a href="admin_endjob.php?jid=<?php echo $rsi23['id'];?>"><span class="glyphicon glyphicon-flash" aria-hidden="true"></span> ปิดงาน</a></li>
  							<li role="separator" class="divider"></li>
                                                  </ul>
                                    </div>
                                  </td>
                                
                            </tr>
                    <?php
            }}
                    ?>
                        </table>
                </div>
            </div>
            <?php
            
            if(isset($_GET['jobid']))
            {
            $cime=$_GET['jobid'];
            $sqli56 = "SELECT * FROM job_service WHERE id = '$cime' ORDER BY id ASC ";
            
            $resulti56 = $conn->query($sqli56);
            
              
        ?>
        <div class="panel panel-primary">
                <div class="panel-heading">รายการสินค้าที่ค้นหา</div>
                <div class="panel-body">
                    <table class="table table-success table-hover">
                            <tr class="btn-success">
                                <th while="5%"><center>เลขที่</center></th>
                                <th while="25%">สินค้ารุ่น</th>
                                <th while="20%">หมายเลขเครื่อง</th>
                                <th while="20%">อาการ</th>
                                <th while="10%">วันที่ส่งเคลม</th>
                                <th while="10%">สถานะ</th>
                                <th while="10%"></th>
                            </tr>

                            <?php while($rsi56=mysqli_fetch_array($resulti56)){
                                $date1 = date_create($rsi56['sta_date']);
                                
                                $sqli003 = "SELECT * FROM product where id='$rsi56[product_id]'";
                                $resulti003 = $conn->query($sqli003) ;
                                $rsi003=mysqli_fetch_array($resulti003);
                                
                                
                            ?>

                            <tr>
                                <td><center><?php echo $rsi56['id'];?></center></td>
                                <td><?php echo $rsi003['model'];?></td>
                                <td><?php echo $rsi003['ime'];?></td>
                                <td><?php echo $rsi56['job_manner'];?></td>
                                <td><?php echo date_format($date1,'d/m/y');?></td>
                                <td><?php echo $rsi56['status'];?></td>
                                <td>
                                    <div class="btn-group">
						  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
						    จัดการ <span class="caret"></span>
						  </button>
						  <ul class="dropdown-menu ">
						    <li><a href="#"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> พิมพ์ใบฝากเคลม</a></li>
						    <li role="separator" class="divider"></li>
						    <li><a href="admin_jobdtail.php?jid=<?php echo $rsi56['id'];?>"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> รายละเอียดการเคลม</a></li>
						    <li role="separator" class="divider"></li>
						    <li>
							<a href="admin_conjob.php?eid=<?php echo $rsi56['id'];?>"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> รับเรื่อง</a>
                                                    </li>
						    <li><a href="admin_endjob.php?jid=<?php echo $rsi56['id'];?>"><span class="glyphicon glyphicon-flash" aria-hidden="true"></span> ปิดงาน</a></li>
  							<li role="separator" class="divider"></li>
                                                  </ul>
                                    </div>
                                  </td>
                                
                            </tr>
                    <?php
            }}
                    ?>
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