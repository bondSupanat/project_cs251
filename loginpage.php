<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<?php
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "cs251_project";

// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
if($conn->error)
{
	echo "Fail to connect";
}


	$username = $_POST['username'];
	$pass = $_POST['password'];
	
	$sql2 = "SELECT  * FROM employee WHERE Username = '".$username."' AND Password = '".$pass."'";
	$instruct2 = $conn->query($sql2) or die($conn->error);
	$check2 = $instruct2->fetch_array();
	if($check2)
	{
		echo "Success Login"; ?> <br> 
		<a href="insertProduct.php">Admin page</a>  <?php
		
	}
	else
	{
		
		
	
	
	$sql = "SELECT  * FROM Member WHERE username = '".$username."' AND password = '".$pass."'";
	$instruct = $conn->query($sql) or die($conn->error);
	$check = $instruct->fetch_array();
	if($check)
	{
		echo "Success Login"; ?> <br> 
		<a href="shopping.php">go Shopping Online</a>  <?php
		$sql2 = "DELETE  FROM Shopping_Cart";
		$conn->query($sql2);
		$sql3 = "DELETE  FROM Like_Product";
		$conn->query($sql3);
		$sql5 = "DELETE  FROM NowUser";
		$conn->query($sql5);
		$sql4 = "INSERT INTO NowUser (UserName)
  			values ('$username')";
		$conn->query($sql4);
	}
	else
	{
		echo "Wrong User name & password !!"; ?> <br> 
		<a href=javascript:history.back(1)>go back</a> <?php
	
		
	}
	}

?>
	
</body>
</html>