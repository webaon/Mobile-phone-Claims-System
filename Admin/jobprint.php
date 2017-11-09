<html>
    <meta charset="utf-8">
<title>CenteriService บริการส่งศูนย์</title>

        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/cssbuton.css">


        <script type="text/javascript" src="assets/js/jquery.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
				<script src="assets/js/holder.js"></script>
				<script src="assets/js/respond.min.js"></script>
				<script src="http://code.jquery.com/jquery.min.js"></script>
</head>
    <body  onload="javascript:window.print()" >
        
<?php
if(!isset($_SESSION)){
	session_start();
}

include '../function.php';
include '../dbconn.php';
isAdmin();

if(isset($_GET['jid'])){
    
    $jidp=$_GET['jid'];
    
    $sqld = "SELECT * FROM job_service WHERE id='".$jidp."'";
	$resultd = $conn->query($sqld);
	$rsd = mysqli_fetch_array($resultd);
        
        
        ####รูปแบบวันที่###
        $date01 = date_create($rsd['sta_date']);
        $date2 = date_create($rsd['get_date']);
        $date3 = date_create($rsd['close_date']);
        $date4 = date_create($rsd['wait_date']);
        $date5 = date_create($rsd['end_date']);

        ########------####
        
        $sql5 = "SELECT * FROM repairs where job_service_id='$rsd[id]'";
                $result5 = $conn->query($sql5) ;
        
####เลือกสาขา####

$sqlj1 = "SELECT * FROM user WHERE id='".$rsd['user_id']."'";
$resultj1 = $conn->query($sqlj1);
$rsj1=mysqli_fetch_array($resultj1);
$bach1=$rsj1['username'];

###############
####เลือกพนักงาน####

$sqlj11 = "SELECT * FROM employees WHERE id='".$rsd['employees_id']."'";
$resultj11 = $conn->query($sqlj11);
$rsj11=mysqli_fetch_array($resultj11);
$emp1=$rsj11['f_name'];
$emp2=$rsj11['l_name'];

###############

######เลือกสินค้า#######
$sqlj2 = "SELECT * FROM product WHERE id='".$rsd['product_id']."'";
$resultj2 = $conn->query($sqlj2);
$rsj2=mysqli_fetch_array($resultj2);
$mode=$rsj2['model'];
$imee=$rsj2['ime'];
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
    $col=$rsj22['color'];
    $colo="(สี ".$col.")";
    
    $sqlj23 = "SELECT * FROM brand WHERE id='".$pidcb."'";
    $resultj23 = $conn->query($sqlj23);
    $rsj23=mysqli_fetch_array($resultj23);
    
    
    

#######################

######เลือกลูกค้า#######
$sqlj3 = "SELECT * FROM customers WHERE id='".$rsd['customers_id']."'";
$resultj3 = $conn->query($sqlj3);
$rsj3=mysqli_fetch_array($resultj3);

#######################
            
}
			
?>

<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="panel panel-warning">
                <div class="panel-heading">รายละเอียดการเคลม 
                    <span class="nav navbar-nav navbar-right">
                        บิลเลขที่ <?PHP echo $rsd['id'];?> <span class="glyphicon glyphicon-list-alt"></span><strong> ยอดที่ต้องชำระ : <?php echo $rsd['totlo_price'];?> บาท </strong>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <table class="table table-condensed">
                            <tr>
                                <td>สาขา : <span style="color: darkgray"><?php echo $bach1;?></span></td>
                                <td>พนักงาน : <span style="color: darkgray"><?php echo $emp1." ".$emp2;?></span></td>
                                <td></td>
                                <td></td>
                            </tr>
                            
                            <tr>
                                <td>สถานะการเคลม</td>
                                <td style="color: darkgray">: <?php echo $rsd['status'];?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>ชื่อลูกค้า</td>
                                <td style="color: darkgray">: <?php echo $rsj3['name'];?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>สินค้า</td>
                                <td style="color: darkgray">: <?php echo $mode." ".$colo;?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>    
                                <td>หมายเลขสินค้า</td>
                                <td style="color: darkgray">: <?php echo $imee;?></td>
                                <td></td>
                                <td></td>
                            </tr>
                           
                            <tr>
                                <td>อาการ</td>
                                <td style="color: darkgray">: <?php echo $rsd['job_manner'];?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>รายละเอียดเพิ่มเติม</td>
                                <td style="color: darkgray">: <?php echo $rsd['job_details'];?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>อุปกรณ์ที่นำมา</td>
                                <td style="color: darkgray">: <?php echo $rsd['attachment'];?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>หมายเหตุ</td>
                                <td style="color: darkgray">: <?php echo $rsd['job_note'];?></td>
                                <td></td>
                                <td></td>
                            </tr>
                    
                            <tr>
                                <td>ศูนย์บริการที่ส่งเคลม :</td>
                                <td style="color: darkgray"><?php echo $rsd['suppliers_id'];?></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>      
                                <td>หมายเหตุการเคลม :</td>
                                <td style="color: darkgray"><?php echo $rsd['note_end'];?></td>
                            </tr>
                            <tr>
                                <td>ค่าบริการ :</td>
                                <td style="color: darkgray"><?php echo $rsd['price_service'];?> บาท</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                        
                        <center> <h4>รายการซ่อม</h4></center>
                          
                              <table class="table table-striped">
                                  <tr class="a">
                                        <th>รายการ</th>
                                        <th><center>ราคา</center></th>
                                        <th>หมายเหตุ</th>
                                    </tr>

                                        <?php while($rs5=mysqli_fetch_array($result5)){

                                        ?>
                                     <tr >
                                        <td ><?php echo $rs5['repair'];?></td>
                                        <td ><center>  <?php echo $rs5['price'];?></center></td>
                                        <td ><?php echo $rs5['note'];?></td>
                                     </tr>
                                        <?php } ?>
                              </table>
                            </div>
                          </div>
                        
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>
        
        
        <div class="col-md-1"></div>
    </div> 
</div>

<?php
if(isset($_SESSION['flash'])){
    unset($_SESSION['flash']);
    session_write_close();
}
?>
    </body>
</html>
