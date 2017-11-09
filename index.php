<?php
if(!isset($_SESSION)){
	session_start();

}

include 'header.php';
include 'function.php';





if($_SESSION['user']['user_type']=="Admin")
{
  redirect("admin/index.php");
}
else if($_SESSION['user']['user_type']=="User")
{
  redirect("user/index.php");
}
else
{
  redirect("login.php");
}
 ?>

<?php
include 'footer.php'
 ?>
