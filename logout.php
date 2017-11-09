<?php
if(!isset($_SESSION)){
	session_start();
}
include 'function.php';
unset($_SESSION['user']);
session_write_close();
redirect("index.php");
