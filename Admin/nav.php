<body data-gr-c-s-loaded="true" style="background-image: url(pic/bg.png);">

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
                <li><a href="admin_job.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> รายการเคลม</a></li>
                <li><a href="Search_job.php"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> ตรวจสอบสถานะสินค้า/รายการเคลม</a></li>
              
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> กำหนดค่า<span class="caret"></span></a>
                  <ul class="dropdown-menu">

                    <li class="dropdown-header"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> สาขา&พนักงน</li>
                    <li role="separator" class="divider"></li>
                    <li><a href="admin_user.php"> - สาขา</a></li>

                    <li><a href="admin_employees.php"> - รายชื่อพนักงาน</a></li>

                    <li role="separator" class="divider"></li>
                    <li class="dropdown-header"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> สินค้า</li>
                    <li role="separator" class="divider"></li>
                    <li><a href="admin_product_category.php"> - ประเภทสินค้า</a></li>
                    <li><a href="admin_brand.php"> - ยี่ห้อสินค้า</a></li>
                    <li><a href="admin_colors.php"> - สี</a></li>


                    <li role="separator" class="divider"></li>
                    <li class="dropdown-header"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> ศูนย์บริการ</li>
                    <li role="separator" class="divider"></li>
                    <li><a href="admin_suppliers.php"> - ข้อมูลศูนย์บริการ</a></li>

                  </ul>
                </li>
                    
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
