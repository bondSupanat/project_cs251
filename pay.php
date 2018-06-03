<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Payment</title>
</head>
<body>
	
	
	
	<?php 
		$host = "localhost";
		$dbusername = "root";
		$dbpassword = "";
		$dbname = "cs251_project";

		// Create connection
		$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
	
	
	if (mysqli_connect_error()){
		die('Connect Error ('. mysqli_connect_errno() .') '
			. mysqli_connect_error());
	}
	
	
		
	
	date_default_timezone_set("Asia/Bangkok");
	$date = date("Y/m/d");
	$time = date("h:i:sa");
	echo $date . "<br>";
	echo  $time . "<br>";
	

	
	
	foreach($conn->query('SELECT MAX(id_Order)
	FROM History') as $max2) {
	
		 $max = $max2['MAX(id_Order)'];
		
}
	if(empty($max)) $max = 1000;
	 $max++;
	

	$sql2 = "SELECT  * FROM Shopping_Cart";
	$qry2 = mysqli_query($conn,$sql2);
	$count = 0;
	
	$sql4 = "SELECT  * FROM NowUser";
	$qry4 = mysqli_query($conn,$sql4);
	$data4 = mysqli_fetch_array($qry4);
	
	$user = $data4['UserName'];
	
	$status = "Processing";
	$data2 = mysqli_fetch_array($qry2);
	$id = $data2['ID_product'];
	$total = $_GET['total'];
	
		
			
		$sql5 = "SELECT  * FROM Promotion ORDER BY amount DESC";
		$qry5 = mysqli_query($conn,$sql5);
		echo "Total Price : ".$total . "   <br>";
	$discount = 0;
	/* while($data5 = mysqli_fetch_array($qry5)){
		$amount = $data5['amount'] ;
		if($amount < $total){
			
			$discount = $data5['discount'];
			
			$data_point = mysqli_fetch_array(mysqli_query($conn,"SELECT point,username FROM Member WHERE username = '$user';"))['point'] ."<br>";
			$a = $data5['point'] +  $data_point;
			
			mysqli_query($conn,"UPDATE Member
			SET point = $a
			WHERE username = '$user';");
			break;
			
		}
		
		
		
	} */
		
	echo "discount : ".$discount . "<br>";
	echo "Total :".($total-$discount ). "<br>";
	//echo "Reward Points : ".$a."<br>";
	
	
		echo "<br> Product ID :   <br>";
		$sql9 = "INSERT INTO History (id_Order, id_Product, status, date_Order, username_Member, time_Order,totalPrice,discount)
  			values ('$max','$id','$status','$date','$user','$time','$total','$discount')";
	//mysqli_query($conn, $sql9);
		//$sql9 .= "INSERT INTO History (id_Order, id_Product, status, date_Order, username_Member, time_Order)
  	echo $id . "   <br>";	
	
	while($data2 = mysqli_fetch_array($qry2)){
		
		$id = $data2['ID_product'];
		echo $id . "   <br>";
		$sql9 .=	",('$max','$id','$status','$date','$user','$time','$total','$discount')";
			
		
	}
	if (mysqli_multi_query($conn, $sql9)) {
    echo "New records created successfully";
} else {
    echo "Error: " . $sql9 . "<br>" . mysqli_error($conn);
}
	
	
	
	?> <br>
	
	Thank you ~ <br>
	 <a href=javascript:history.back(1)><font face="'Montserrat', sans-serif" color= #000000 size = 2 >go back</font> </a> 
	
	

</body>
</html>