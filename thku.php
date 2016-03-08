<html>
<head>
<meta charset="utf-8">
</head>
<body>
<script>

</script>
<?php
require_once 'common.php';
require_once  'conn.php';
CheckUserValidate();
$act=$_GET["act"];
if($act) {
        $cart = $_SESSION['cart'];  //get cart
		$k=0;
		$item="";
        foreach($cart as $i=>$c){    //iteration thru cart  
					//	   echo $_SESSION['cart'][$i].$_POST["$i"]. $i.$c."<br/>";
			$pkdName[$k]=$i;
			$pkdNo[$k]=$c;
			$item=$item.$i.", ";
			$k++;
        }  

		$total=0;
		$user1=$_SESSION["loginuser"];

		//Get order Number
		$sql =  "SELECT max(orderNO) FROM tracorder";
		$result = $conn->query($sql);
		if(!$result)
			$orderNO=100000;
		else {
				if ($result->num_rows > 0){
				$row = $result->fetch_assoc();
				$orderNO=$row["max(orderNO)"]+1;	
				}	
		}
				
		//Get user ID
		$sql = "SELECT id FROM TracRec WHERE Uname='$user1'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0){
			$row = $result->fetch_assoc();
			$id=$row["id"];
		}
		
		//print order histroy
		$i=0;
		$sql = "SELECT item, number, date, orderNO FROM tracorder WHERE id= '$id' ";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			echo  "Your order histroy. <br/> You have bought: <br/>";
			while($row = $result->fetch_assoc()) {	
				$hitem[$i]=$row["item"];
				$hno[$i]=$row["number"];
				$hdate[$i]=$row["date"];
				$horno[$i]=$row["orderNO"];				
				echo  $hno[$i].$hitem[$i]."on ". $hdate[$i]." order number ". $horno[$i]." <br/>";
				$i++;
			}	
		//update database, when $pkdNo[$k]>0 echo order info.		
		echo  "<br/>Hi,".$_SESSION["loginuser"].", this time You have bought: <br/>";
		for ($k=0;$k< count($pkdName)&& $pkdNo[$k]>0;$k++){
		$sql = "SELECT price FROM Goodsis WHERE name= '$pkdName[$k]' ";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$conn->query("UPDATE goodsis SET instock=instock-$pkdNo[$k] WHERE name='$pkdName[$k]'");
				$sql = "INSERT INTO Tracorder ".
				"(item,id, number, date, orderNO) ".
				"VALUES ".
				"('$pkdName[$k]','$id','$pkdNo[$k]',NOW(),'$orderNO')";
				$retval = $conn->query($sql);
				if(! $retval ){
					die('Could not enter data: ' . mysqli_error());
				}
      			$price=$row["price"]; 
			    echo $pkdNo[$k]."  " . $pkdName[$k].", unit price $". $price."<br/>" ;
				$total+=$price*$pkdNo[$k];
			}
		}	
	}
	
      echo  "You total is $ " . $total."<br/>your order number is".$orderNO.", Thank you for your order!<br/><br/>";

	// check stock  
	if ($total>0){
		//echo "<br>database updated successfully";
		echo "<br> now there are";
		$sq2 = "SELECT item, instock, name FROM Goodsis";
		$result1 = $conn->query($sq2);
		while($row = $result1->fetch_assoc()) {
		echo  "<br> ".$row["instock"]." ".$row["name"];	
		}
		echo"<br>instock";
	}
	else 
		echo "you made no purchase"; 
	
	mysqli_close($conn);
	}
}
?>
        <br/><br/>
        <input type="submit" value="logout" onclick="location='index.php';" />  

</body>
</html>
