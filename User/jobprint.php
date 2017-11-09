<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
         
        
    </head>
    <body onload="javascript:window.print()" >
<?PHP 
if(!isset($_SESSION)){
	session_start();
}

include '../function.php';
include '../dbconn.php';
isUser();
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

    <div>
        <center>
            <div><img src="../pic/logo.png" width="300" height="96" alt=""/></div>
            <b>ใบนำฝาเครื่องส่งศูนย์/ส่งเคลม/ส่งซ่อม</b><br/>
            โทร. 086-3008338, 083-771111 #2006
        </center>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" align='center'>
      <tbody>
        <tr>
            <td width="40%"></td>
            <td width="40%"></td>
            <td width="20%"></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
        </tr>
         <tr>
            <td></td>
            <td><br/></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><b>เลขที่บิล :</b> <?PHP echo $rsd['id'];?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><b>สาขา : </b><?php echo $bach1;?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><b>วันที่ : </b><?php echo date_format($date01,'d/m/y');?></td>
        </tr>
        <tr>
            <td><br></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><b>ชื่อลูกค้า :</b> <?php echo $rsj3['name'];?></td>
            <td><b>เบอร์ติดต่อ : </b><?php echo $rsj3['phone'];?></td>
            <td></td>
        </tr>
        <tr>
            <td><b>ที่อยู่ : </b><?php echo $rsj3['address'];?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><b>สินค้า :</b> <?php echo $mode." ".$colo;?></td>
            <td><b>หมายเลขสินค้า :</b> <?php echo $imee;?></td>
            <td></td>
            
        </tr>
        <tr>
            <td><b>อาการ :</b> <?php echo $rsd['job_manner'];?></td>
            <td></td>
            <td></td>
        </tr>
          <tr>
            <td><b>รายละเอียดเพิ่มเติม :</b><br/> <?php echo $rsd['job_details'];?></td>
        </tr>
        <tr>
            <td><b>อุปกรณ์ที่รับไว้ :</b> <?php echo $rsd['attachment'];?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><b>หมายเหตุ :</b> <?php echo $rsd['job_note'];?></td>
    
            
        </tr>
        <tr>
            <td></td>
            <td align='center'><b>ค่าบริการ :</b> <?php echo $rsd['price_service'];?> บาท </td>
            <td></td>
        </tr>
        <tr>
            <td><br /><br /></td>
        </tr>
        <tr>
            <td></td>
            <td align='center'><b>ลงชื่อ</b>.................................<b>ผู้รับแจ้ง</b></td>
            <td></td>
        </tr>
         <tr>
            <td></td>
            <td align='center'>(<?php echo $emp1." ".$emp2;?>)</td>
            <td></td>
        </tr>
  </tbody>
</table>
    </div>
<br/>
<center>-----------------------------------------------------------------------------------------------</center>
<?php
if(isset($_SESSION['flash'])){
    unset($_SESSION['flash']);
    session_write_close();
}
?>
    </body>
</html>

