<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>
<?php
	
	$category_id = $_POST['category_id'];
	$category_name = $_POST['category_name'];
	
	


$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "cs251_project";

$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
	
	
		$sql = "INSERT INTO Brand ( id_Brand,  name_Brand)
  			values ('$category_id','$category_name')";
		  	//echo "<script type = 'text/javascript'>window.open(\"sign_in.html\",\"_self\")</script>";;
			//$a = "in";
		    if ($conn->query($sql)){
	  			//echo "window.open(\"login.html\",\"_self\");";
	  			echo "Add Category";
				?><br><a href=javascript:history.back(1)>go back</a> <?php
			}else{
    			echo "Error: ". $sql ."
				". $conn->error;
  			}
	
	
	
	
	?>
	
	
	
	
<body>
</body>
</html>