<?php
	if(isset($_GET['PHPSESSID'])){
		session_id($_GET['PHPSESSID']);
	}
    session_start();
function CheckUserValidate(){
		if(empty($_SESSION['loginuser']))
		header("Location: index.php?errno=1 ");
}
?>