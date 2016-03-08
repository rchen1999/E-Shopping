<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
</style>
</head>
<script>
window.onload=function()
{     
	var oTex=document.getElementById('clear');
	var oBton=document.getElementById('gocart');
	var oBtn=document.getElementsByTagName('input');
	var pkdItem="";
    oBton.onclick=function ()	{
			    	//		alert(this.id);
			window.open('shpcart.php?str='+p1.innerHTML );
         } 
	oTex.onclick=function ()	{
			 p1.innerHTML="";
         } 
	for (i=0;i<oBtn.length;i++){
		oBtn[i]._index=i;
			oBtn[i].onclick=function ()	{
			//alert(p1.innerHTML.indexOf(this.name));
			if (p1.innerHTML.indexOf(this.name) >=0){
					}
			else {
				if (p1.innerHTML.length==0)
				 p1.innerHTML=p1.innerHTML+this.name;
				else
				 p1.innerHTML=p1.innerHTML+", "+this.name;
			}
         } 
	}
} 


</script>
<body>
<div id="header" style="background-color:#FFA500;text-align:center;">
<h1 style="margin-bottom:0;">Welcome to Titanic</h1></div> 
<!-- div id="lamp" > Lamp             
</div-->

<h1>Check Our Stuff</h1>
You have picked: <p  id="p1"></p> <br>
<button id="clear" type="button" >Clear Cart</button> <br><br>
<?php  
	include 'conn.php';
	if (!empty($_GET["errno"]))
		if ($_GET["errno"]=1)
			echo '<h1>You need to login first </h1>';	
    else
        echo '<h1>You need pick at least one item </h1>';

	$sql = "SELECT item, instock, name,  price FROM Goodsis";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// 输出每行数据
		$i=0;
		while($row = $result->fetch_assoc()) {
			if ($row["instock"] > 0) {
				$aList[$i]=$row["item"];
				$aName[$i]=$row["name"];
				$aPrice[$i]=$row["price"];
				$i++;
			} 
		}
	}
	$nDisplay= $i;
	for($i=0;$i<$nDisplay;$i++){
		echo $aName[$i]. "  $" . $aPrice[$i]. "  ";
?>
<input type="button" name=<?php echo $aName[$i] ?> value="Add to Cart"/> </br>
<img  border="10" src="/images/<?php echo $aName[$i] ?>.gif" width="160" height="160"> </br>
<?php  
 } 
	$conn->close();

?>
</br></br>
<button id="gocart" >Go to Cart</button>
<!--button name="gocart" onclick="window.open('shpcart.php?str=')">Go to Cart</button--><br>
</body>
</html> 