
<?php
if(!isset($_SESSION)){
	session_start();
}

include 'header.php';

if(isset($_POST['username'])){//มีการส่งข้อมูลมาไหม
	include 'dbconn.php';//ติดต่อฐานข้อมูล
	include 'function.php';

	$user = @$_POST['username'];//รับข้อมูล username เก็บไว้ใน $user
	$pass = @$_POST['password'];//รับข้อมูล password เก็บไว้ใน $pass

	$sql = "SELECT * FROM user
			WHERE username='".$user."'
			AND password='".$pass."'";//สร้างคำสั่ง SQL
	$result = $conn->query($sql);//สั่งให้ SQL ทำงาน
	$rs = mysqli_fetch_array($result);//เรียกข้อมูลเก็บไว้ใน $rs

	if(empty($rs)){//ตรวจสอบว่า $rs มีข้อมูลไหม
		$_SESSION['flash']['type']='กรุณาตรวจสอบ';
		$_SESSION['flash']['msg']='Username หรือ Password ไม่ถูกต้อง';
	}else{
		$conn->query("UPDATE user SET last_login='".date("Y-m-d H:i:s")."' WHERE id='".$rs['id']."'");

		$_SESSION['user']=$rs;//กำหนด Session user

		//print_r($_SESSION['user']);
		if($_SESSION['user']['user_type']=="Admin"){
			redirect("admin/index.php");
		}
		if($_SESSION['user']['user_type']=="User"){
			redirect("user/index.php");
		}

          	$_SESSION['user']['username'];


	}
}
?>





<body data-gr-c-s-loaded="true" style="background-image: url(pic/bg.png);">

    <div class="container" style="margin-top:100px">
        <div class="row">
            <div class="col-sm-4">

            </div>

            <div class="col-sm-4">

								<!-- โชว์ข้อความ -->
								<?php if(isset($_SESSION['flash'])){ ?>

								<div class="alert alert-<?php echo $_SESSION['flash']['type'];?>">
								<h4 style="color:rgb(238, 118, 97)"	>
									<?php echo ucfirst($_SESSION['flash']['type']).' '.$_SESSION['flash']['msg'];?>
								</h4>
								</div>

								<?php }?>

            	<!-- Login -->

                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-singnin">

                    <center>
                    <h3 class="form-singnin-heading" style="color: rgba(220,220,220,1)"> -- Login --  </h3>
                    <h5 style="color: rgba(211,211,211,1)">กรุณา Login เข้าสู่ระบบ เพื่อทำรายการที่ต้องการ</h5><br>


                        <label for="username" class="sr-only">Username</label>
                            <input id="username" name="username" type="text" class="button" placeholder="Username..." autofocus="" required="">
                  <br>
                        <label for="password" class="sr-only">Password</label>
                            <input id="password" name="password" type="password" class="button" placeholder="Password..." required="">

                   <br>
                   <br>

                    <button type="submit" class="btn btn-lg btn-primary btn-success">ตกลง</button>
                    <button type="reset" class="btn btn-lg btn-primary btn-success">ยกเลิก</button>

                </center>

                </form>
            </div>

            <div class="col-sm-4">

            </div>
        </div>
</body>

		<?php
		include 'footer.php';
		?>
