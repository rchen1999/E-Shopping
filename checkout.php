<html>
<head>
<meta charset="utf-8">
</head>
<body>
<script>

</script>
<?php
require_once 'common.php';
require_once 'conn.php';
CheckUserValidate();
       $cart = $_SESSION['cart'];  //得到购物车  
		$k=0;
		// echo count($_POST);
		$item="";
		//echo $_SESSION['cart'][$i]. $i.$c."<br/>";
        foreach($cart as $i=>$c){    //对购物车里的商品进行遍历  
        $_SESSION['cart'][$i]=$_POST["$i"];     
			//	  
		$pkdName[$k]=$i;
		$pkdNo[$k]=$_POST["$i"];
		if ($item=="")
			$item=$i;
		else
			$item=$item.", ".$i;
		//echo  $pkdName[$k].$pkdNo[$k]."<br/>";
		$k++;
        }  
		//echo  $item;
		echo  "You have chosen: <br/>";
		$total=0;
		//session_destroy(); 
	for ($k=0;$k< count($pkdName);$k++){
		$sql = "SELECT price FROM Goodsis WHERE name= '$pkdName[$k]' ";
		$result = $conn->query($sql);
		if ($result->num_rows > 0 && $pkdNo[$k]>0) {
			while($row = $result->fetch_assoc()) {
				$price=$row["price"];
			    echo $pkdNo[$k]."  " . $pkdName[$k].", unit price $". $price."<br/>" ;
				$total+=$price*$pkdNo[$k];
			}
		}	
	}
      echo  "You total is $ " . $total." <br/>";
	
mysqli_close($conn);

?>
        <br/><br/>
        <input type="submit" value="Place order" onclick="location='thku.php?SID;'" />  
        <input type="button" value="Go back to cart" onclick="location='shpcart.php?SID&str=<?php echo $item?>  ';"/>  
 </body>
</html>