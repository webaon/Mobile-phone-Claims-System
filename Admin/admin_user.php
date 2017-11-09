<?php
if(!isset($_SESSION)){
    session_start();
}
include '../function.php';
isAdmin();
include '../header.php';
include '../dbconn.php';
include 'nav.php';

$username=null;
$password=null;
$user_type=null;
$last_login=null;

###################Insert Section###############
if(isset($_POST['u']['insert'])){//if define u['insert'] inset data
    $u = $_POST['u'];
    $sqli = "INSERT INTO user(username,password,user_type,last_login)
                VALUE('".$u['username']."','".$u['password']."','".$u['user_type']."','".$u['last_login']."')";
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
    $uid = $_GET['eid'];

    $sqle = "SELECT * FROM user WHERE id='".$uid."'";
    $resulte = $conn->query($sqle);
    $rse = mysqli_fetch_array($resulte);

    $username = $rse['username'];
	$password = $rse['password'];
	$user_type = $rse['user_type'];
	$last_login = $rse['last_login'];
	
}

if(isset($_POST['u']['edit'])){// if post data to edit
    $u = $_POST['u'];
    $sqlu = "UPDATE user SET
            username='".$u['username']."',
	password='".$u['password']."',
	user_type='".$u['user_type']."',
	last_login='".$u['last_login']."'
	
            WHERE id='".$u['id']."'";
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
    $sqld = "DELETE FROM user WHERE id='".$_GET['did']."'";
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
$sql = "SELECT * FROM user ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!-- ###############Flash Message############# -->
<?php if(isset($_SESSION['flash'])){ ?>
<div class="alert alert-<?php echo $_SESSION['flash']['type'];?>">
    <?php echo ucfirst($_SESSION['flash']['type']).' '.$_SESSION['flash']['msg'];?>
</div>
<?php }?>


<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-11">
<!--################Insert form############## -->

<div class="panel panel-primary">
  <div class="panel-heading">ข้อมูลสาขา</div>
  <div class="panel-body">
      
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-inline">
      <?php if(isset($_GET['eid'])){?>
          <input type="hidden" name="u[edit]" value="1">
          <input type="hidden" name="u[id]" value="<?php echo $uid;?>">
      <?php }else{?>
          <input type="hidden" name="u[insert]" value="1">
      <?php }?>
            <div class="form-group"> 
                <label  for="u-username"><h4>เพิ่มสาขา : </h4></label>
            </div>
            <div class="form-group">
                <label class="sr-only" for="u-username">สาขา</label>
                <input id="u-username" class="form-control" placeholder="ระบุสาขา..." type="text" name="u[username]" value="<?php echo $username;?>" required="required">
            </div>
            <div class="form-group">
                <label class="sr-only" for="u-password">Password</label>
                <input id="u-password" class="form-control" placeholder="Password..." type="text" name="u[password]" value="<?php echo $password;?>" required="required">
            </div>
            <div class="form-group">
                <label class="sr-only" for="u-user_type">---กลุ่มสถานะ---</label>
                <select name="u[user_type]" class="form-control" id="u-user_type">
                                      <option value="User" <?php if($user_type=='User'){?> selected="selected"<?php }?>>User</option>
                                      <option value="UserPro" <?php if($user_type=='UserPro'){?> selected="selected"<?php }?>>UserPro</option>
                                      <option value="Admin" <?php if($user_type=='Admin'){?> selected="selected"<?php }?>>Admin</option>
                </select>
            </div>
            <div class="form-group">
                <label class="sr-only" for="u-last_login">เข้าระบบล่าสุด</label>
                <input id="u-last_login" class="form-control" type="hidden" name="u[last_login]" value="date("Y-m-d H:i:s")" >
            </div>

              <input type="submit" value="บันทึกข้อมูล" class="btn btn-primary">
              <?php if(isset($_GET['eid'])){ //if select to Edit ?>
              <a href="admin_user.php" class="btn btn-warning">ยกเลิก</a>
              <?php }?>
              
      </form>
<hr />

<!-- ###############List of Data############# -->
  <h3>รายการสาขา</h3>
        <table class="table table-success table-hover">
            <tr class="btn-success">
                <th while="20%">สาขา</th>
                <th while="30%">Password</th>
                <th while="20%">กลุ่มสถานะ</th>
                <th while="30%">เข้าระบบล่าสุด</th>

                <th></th>
            </tr>
            <?php while($rs=mysqli_fetch_array($result)){?>
            <tr>
                <td><?php echo $rs['username'];?></td>
                <td><?php echo $rs['password'];?></td>
                <td><?php echo $rs['user_type'];?></td>
                <td><?php echo $rs['last_login'];?></td>

                <td>
                <a href="<?php echo $_SERVER['PHP_SELF'];?>?eid=<?php echo $rs['id'];?>" class="btn btn-sm btn-warning">แก้ไข</a>
                <a href="<?php echo $_SERVER['PHP_SELF'];?>?did=<?php echo $rs['id'];?>" class="btn btn-sm btn-danger" onclick="return confirm('แน่ใจนะว่าต้องการลบ?');">ลบ</a>
                </td>
            </tr>
            <?php }?>
        </table>
</div>
</div>
        </div>
    </div>
</div>



<?php
include '../footer.php';
?>
