<?php
if(!isset($_SESSION)){
    session_start();
}
include '../function.php';
isAdmin();
include 'header.php';
include 'nav.php';
include '../dbconn.php';

$idemployee=null;
$f_name=null;
$l_name=null;
$n_name=null;
$user_id=null;

###################Insert Section###############
if(isset($_POST['e']['insert'])){//if define e['insert'] inset data
    $e = $_POST['e'];
    $sqli = "INSERT INTO employees(idemployee,f_name,l_name,n_name,user_id)
                VALUE('".$e['idemployee']."','".$e['f_name']."','".$e['l_name']."','".$e['n_name']."','".$e['user_id']."')";
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
    $eid = $_GET['eid'];

    $sqle = "SELECT * FROM employees WHERE id='".$eid."'";
    $resulte = $conn->query($sqle);
    $rse = mysqli_fetch_array($resulte);

    $idemployee = $rse['idemployee'];
	$f_name = $rse['f_name'];
	$l_name = $rse['l_name'];
	$n_name = $rse['n_name'];
	$user_id = $rse['user_id'];
	
}

if(isset($_POST['e']['edit'])){// if post data to edit
    $e = $_POST['e'];
    $sqlu = "UPDATE employees SET
            idemployee='".$e['idemployee']."',
	f_name='".$e['f_name']."',
	l_name='".$e['l_name']."',
	n_name='".$e['n_name']."',
	user_id='".$e['user_id']."'
	
            WHERE id='".$e['id']."'";
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
    $sqld = "DELETE FROM employees WHERE id='".$_GET['did']."'";
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
$sql = "SELECT * FROM employees ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!-- ###############Flash Message############# -->
<?php if(isset($_SESSION['flash'])){ ?>
<div class="alert alert-<?php echo $_SESSION['flash']['type'];?>"  data-dismiss="alert">
    <?php echo ucfirst($_SESSION['flash']['type']).' '.$_SESSION['flash']['msg'];?>
</div>
<?php }?>



<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-11">
            
   
            <!--################ Show form############## -->
            <div class="panel panel-primary">
              <div class="panel-heading">ข้อมูลพนักงาน</div>
              <div class="panel-body">

            <!--################Insert form############## -->
            <h3>เพิ่มชื่อพนักงาน</h3>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-inline">
                <?php if(isset($_GET['eid'])){?>
                    <input type="hidden" name="e[edit]" value="1">
                    <input type="hidden" name="e[id]" value="<?php echo $eid;?>">
                <?php }else{?>
                    <input type="hidden" name="e[insert]" value="1">
                <?php }?>
                    <div class="form-group">
                      <label class="sr-only" for="e-idemployee">รหัสพนักงาน</label>
                      <input id="e-idemployee" class="form-control" placeholder="ระบุรหัสพนักงาน..." type="text" name="e[idemployee]" value="<?php echo $idemployee;?>" >
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="e-f_name">ชื่อ</label>
                        <input id="e-f_name" class="form-control" placeholder="ระบุชื่อพนักงาน..." type="text" name="e[f_name]" value="<?php echo $f_name;?>" required="required">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="e-l_name">นามสกุล</label>
                        <input id="e-l_name" class="form-control" placeholder="ระบุนามสกุล..." type="text" name="e[l_name]" value="<?php echo $l_name;?>" required="required">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="e-n_name">ชื่อเล่น</label>
                        <input id="e-n_name" class="form-control" placeholder="ระบุชื่อเล่น..." type="text" name="e[n_name]" value="<?php echo $n_name;?>" >
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="e-user_id">สาขา</label>
                        <select name="e[user_id]" class="form-control" id="e-user_id">
                            <option>---เลือกสาขา---</option>
                            <?php
                                $user=$conn->query("SELECT * FROM user");
                                  //print_r($user);
                                    while($us = mysqli_fetch_array($user, MYSQLI_BOTH)){?>
                                    <option value="<?php echo $us['id'];?>"><?php echo $us[1];?></option>
                            <?php }?>
                        </select>
                    </div>
                        <input type="submit" value="บันทึกข้อมูล พนักงาน" class="btn btn-primary">
                        <?php if(isset($_GET['eid'])){ //if select to Edit ?>
                        <a href="admin_employees.php" class="btn btn-warning">ยกเลิก</a>
                        <?php }?>

                </form>
            </div>

            <hr />
            <div class="col-md-12">
            <!-- ###############List of Data############# -->


            <h3>รายชื่อพนักงาน</h3>
                <table class="table table-success table-hover">
                    <tr class="btn-success">
                        <th while="10%">รหัส</th>
                        <th while="30%">ชื่อ</th>
                        <th while="20%">นามสกุล</th>
                        <th while="10%">ชื่อเล่น</th>
                        <th while="10%">สาขา</th>
                        <th while="20%"></th>
                    </tr>
                    <?php while($rs=mysqli_fetch_array($result)){
                                    $sql1 = "SELECT * FROM user WHERE id='".$rs['user_id']."'";
                                    $result1 = $conn->query($sql1);
                                    $rs1=mysqli_fetch_array($result1)
                        ?>
                    <tr>
                        <td><?php echo $rs['idemployee'];?></td>
                        <td><?php echo $rs['f_name'];?></td>
                        <td><?php echo $rs['l_name'];?></td>
                        <td><?php echo $rs['n_name'];?></td>
                        <td><?php echo $rs1['username'];?></td>
                        <td>
                          <center>

                            <a href="<?php echo $_SERVER['PHP_SELF'];?>?eid=<?php echo $rs['id'];?>" class="btn btn-sm btn-warning">แก้ไข</a>
                            <a href="<?php echo $_SERVER['PHP_SELF'];?>?did=<?php echo $rs['id'];?>" class="btn btn-sm btn-danger" onclick="return confirm('แน่ใจนะว่าต้องการลบ?');">ลบ</a>

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


<?php
include '../footer.php';
?>
