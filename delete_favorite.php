<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
	<?
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
	
	
	$strSQL = "DELETE FROM favorite WHERE ID_product = '".$_GET['CusID']."' ";
	$conn->query($strSQL);
	$objQuery = mysql_query($strSQL);
	
	
		echo "Record Deleted.";
	?> <br> 
		<a href="favorite.php">go back</a> 
	<?
	
	

	?>
	
	
	
	
	
	
	
</body>
</html>