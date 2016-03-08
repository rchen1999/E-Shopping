<html>
<head>
</head>
<body>
<script src="my_ajax.js"></script>
<script>
function chkemail(a)    
{ 
	var i=a.length;    
	var tempa= a.indexOf("@");
	var tempd = a.indexOf(".");
	if (tempa > 1) 
	  if ((i-tempa) > 3) 
	    if ((i-tempd)>0)  
				return 1;    
	else	   
       return 0;    
} 
window.onload=function()
{  
	var oTex1=document.getElementById('user1');
	var oTex2=document.getElementById('pass1');
	var oTex3=document.getElementById('aemail1');	
	var oBtn=document.getElementById('btn1');
	var oBtn2=document.getElementById('btn2');

	
	oBtn.onclick=function ()
	{
	//	alert (oTex2.value);
		var url='login_post.php?act=check&user='+oTex1.value+'&pass='+oTex2.value+'&aemail='+oTex3.value; 
		ajax(url, function (str){
		alert(str);
		})
	}

	
		oBtn2 .onclick=function ()
	{
	//alert (oTex1.value);
	if (oTex1.value=="" || oTex2.value=="")
		alert("No username or Password");
	else{
	  if (chkemail(oTex3.value)>0){
			var url='login_post.php?act=add&user='+oTex1.value+'&pass='+oTex2.value+'&aemail='+oTex3.value; 
			ajax(url, function (str){
				alert(str);
			})
	   }
		else
		alert("Please Check your Email");	
	}
	}
}
</script>
<b>Check the stuffs and select the amount you want to buy: </b>
<br><br>
 <form action="checkout.php?SID" method="POST"> 
<?php 
   //start session 
	require_once 'common.php';
	require_once 'conn.php';	
        if(!isset($_SESSION['cart'])){  
        		$_SESSION['cart'] = array();    
        } 
  
       	if (!empty($_GET["str"])){
			$item=", ".$_GET["str"];
			     $pkdItem=explode(", ",$item);
				 $_SESSION['cart'] = array();
				//define array，key is name, value is amount 
               for($i = 1; $i <count($pkdItem); $i++ ){  
                $c = $pkdItem[$i];  
                    $_SESSION['cart'][$c] = 1;                
                }           		
			}
 		else{
			header("Location: index.php?errno=2 ");
			}    
				//echo $_POST->length; echo $pkdItem['0']; 


	$sql = "SELECT item,price, name FROM Goodsis";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
    // 输出每行数据
		$i=0;
		while($row = $result->fetch_assoc()) {
			if (strpos($item,$row["name"])>0 ) {
				$aList[$i]=$row["item"];
				$aName[$i]=$row["name"];
				$aPrice[$i]=$row["price"];
				$i++;
			} 
		}
	}
	$nDisplay= $i;
	for($i=0;$i<$nDisplay;$i++){
		echo $aName[$i]." $" . $aPrice[$i];
?>
<br>
  <select name=<?php echo $aName[$i] ?>>
   <option style="width:10px" selected = "selected" value=1>1</option>
   <option style="width:10px" value=2>2</option>
   <option style="width:10px" value=3>3</option>
   <option style="width:10px" value=4>4</option>
   <option style="width:10px" value=0>0</option>
  </select>
<!--input type="button" name= value="Add to Cart"/--> <br><br>
<img  border="10" src="/images/<?php echo $aName[$i] ?>.gif" width="160" height="160"> <br><br>
 <?php  
 } 
$conn->close();
?>
 
Please log in your account or register a new user before check out:
<br><br>

UserName:  <input id="user1" type="text" /> <br><br>
Password : <input id="pass1" type="password" /> <br><br>
<input id="btn1" type="button" value="Log in"/><br><br>
Email: <input id="aemail1" type="text" /> <br><br>
<input id="btn2" type="button" value="Register New User"/><br><br>
<input name="submit" type="submit"  value="Check out"/> 
</form > 
</body>
</html>