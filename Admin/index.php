<?php
if(!isset($_SESSION)){
    session_start();
}
include 'header.php';
include 'nav.php';

include '../dbconn.php';
include '../function.php';
isAdmin();
$s1="ยังไม่รับเรื่อง";
$s2="รับเรื่องแล้ว";
$s3="ปิดงาน";
$s4="รอลูกค้ามารับ";

$sql="SELECT status FROM job_service WHERE status='$s1' ";
$result = $conn->query($sql) ;
$num_rows = mysqli_num_rows($result);

$sql1="SELECT status FROM job_service WHERE status='$s2' ";
$result1 = $conn->query($sql1) ;
$num_rows1 = mysqli_num_rows($result1);

$sql2="SELECT status FROM job_service WHERE status='$s3' ";
$result2 = $conn->query($sql2) ;
$num_rows2 = mysqli_num_rows($result2);

$sql3="SELECT status FROM job_service WHERE status='$s4' ";
$result3 = $conn->query($sql3) ;
$num_rows3 = mysqli_num_rows($result3);


?>

<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="panel panel-danger">
          <div class="panel-heading"><center><span class="glyphicon glyphicon-remove"> ::รายการที่ยังไม่รับเรื่อง::</span></center></div>
          <div class="panel-body">
              <h4>
                  <center>
                      จำนวน  <?php echo $num_rows;?> รายการ
                  </center>
              </h4>
          </div>
        </div>

    </div>


    <div class="col-md-3">
        <div class="panel panel-warning">
            <div class="panel-heading"><center><span class="glyphicon glyphicon-refresh"> ::รายการที่อยู่ระหว่าการเคลม::</span></center></div>
        <div class="panel-body">
            <h4>
                  <center>
                      จำนวน  <?php echo $num_rows1;?> รายการ
                  </center>
            </h4>
        </div>
</div>

    </div>

    <div class="col-md-3">
      <div class="panel panel-success">
          <div class="panel-heading"><center><span class="glyphicon glyphicon-ok"> ::รายการที่ดำเนินการเส็จ::</span></center></div>
        <div class="panel-body">
            <h4>
                  <center>
                      จำนวน  <?php echo $num_rows2;?> รายการ
                  </center>
            </h4>
        </div>
      </div>

    </div>


    <div class="col-md-3">
      <div class="panel panel-primary">
          <div class="panel-heading"><center><span class="glyphicon glyphicon-user"> ::รายการที่ลูกค้ายังไม่รับคืน::</span></center></div>
        <div class="panel-body">
            <h4>
                  <center>
                      จำนวน  <?php echo $num_rows3;?> รายการ
                  </center>
            </h4>
        </div>
      </div>

    </div>

  </div>

<hr />


</div>












<?php include '../footer.php';?>
