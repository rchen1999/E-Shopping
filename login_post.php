<?php 
	require_once 'common.php';
	require_once  'conn.php';
	$user1=$_GET["user"];
	$pass1=$_GET["pass"];
	$email1=$_GET["aemail"];

	if($_GET["act"]=='check'){
		$sql = "SELECT Uname, password FROM TracRec";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// 输出每行数据
			while($row = $result->fetch_assoc()) {
				if ( strtolower($user1)==strtolower($row["Uname"]) && $pass1==$row["password"] ) {
					echo $row["Uname"]. "  welcome back, click the button if you want to check out "  ;
					$_SESSION['loginuser']=$row["Uname"];
				return;
				} 
			}
		echo  " Wrong username or password "  ;
		}
	}
	else{
		$sql = "INSERT INTO TracRec ".
			"(Uname,email, Password, reg_date) ".
			"VALUES ".
			"('$user1','$email1','$pass1',NOW())";
		$retval = $conn->query($sql);
		if(! $retval ){
			die('Could not enter data: ' . mysqli_error());
		}
	echo "Register successfully\n".$user1. "  welcome " .  "click the button if you want to check out " ;
	$_SESSION['loginuser']=$user1;
	}
mysqli_close($conn);
?>
