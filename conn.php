  <?php 
   $dbhost = 'localhost:3306';  //mysql服务器主机地址
   $dbuser = 'ray';      //mysql用户名
   $dbpass = 'idncas';//mysql用户名密码
   $dbname = "myDBPDO";
// 创建连接
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname );

// 检测连接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>