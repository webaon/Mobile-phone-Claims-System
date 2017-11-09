<body data-gr-c-s-loaded="true" ;>

<nav  class="navbar navbar-inverse">
          <div class="container">
            <div class="navbar-header">

             <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

           <a class="navbar-brand" href="index.php">CenterService</a>
            </div>


            <div id="navbar" class="navbar-collapse collapse">

                <!-- เมนูซ้าย -->
              <ul class="nav navbar-nav">
                <li><a href="user_job.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> ประวัติการเคลม</a></li>
                <li><a href="Search_customer.php"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> ออกใบเคลมสินค้า</a></li>
                <li><a href="Search_job.php"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> ตรวจสอบสถานะสินค้า/รายการเคลม</a></li>
              </ul>
              <!-- เมนูขวา -->
                  <ul class="nav navbar-nav navbar-right">
                <li style="color: rgb(255, 153, 0)">
                  <?php echo "คุณกำลังใช้ระบบในนาม ".$_SESSION['user']['username'] ?>
                </li>

              			  <?php if(isset($_SESSION['user'])){?>
              					<li><a href="../logout.php">ออกจากระบบ</a></li>
              				<?php }else{ ?>
              					<li><a href="../login.php">เข้าสู่ระบบ</a></li>
              				<?php }?>

              </ul>
            </div>
          </div>
        </nav>
<div>
