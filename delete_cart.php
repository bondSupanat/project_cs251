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
	
	
	$strSQL = "DELETE FROM Shopping_Cart WHERE num = '".$_GET[  'CusID']."' ";
	$conn->query($strSQL);
	$objQuery = mysql_query($strSQL);
	
	
		echo "Record Deleted.";
	?> <br> 
		<a href="cart.php">go back</a> 
	<?php
	
	

	?>
	
	
	
	
	
	
	
</body>
</html>