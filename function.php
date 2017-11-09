<?php
if(!isset($_SESSION)){
	session_start();
}

function redirect($url=null){
	@header("Location:".$url);
}


function isAdmin(){
            if(!isset($_SESSION['user']) || $_SESSION['user']['user_type'] != 'Admin'){
		$_SESSION['flash']['type']='danger';
		$_SESSION['flash']['msg']='คุณไม่มีสิทธิ์เข้าถึงไฟล์นี้';
		redirect("index.php");
	}
}
function isUser(){
	if($_SESSION['user']['user_type']!="User"){
		$_SESSION['flash']['type']='danger';
		$_SESSION['flash']['msg']='คุณไม่มีสิทธิ์เข้าถึงไฟล์นี้';
		redirect("index.php");
	}
}
