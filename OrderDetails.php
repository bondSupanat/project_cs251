 
	
<!doctype html>
<?php

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "cs251_project";

// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
	
	
if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
$sql4 = "SELECT  * FROM NowUser";
	$qry4 = mysqli_query($conn,$sql4);
	$data4 = mysqli_fetch_array($qry4);
	
	$user = $data4['UserName'];

	$sql2 = "SELECT  * FROM Member WHERE username = '".$user."'";
	$qry2 = mysqli_query($conn,$sql2);
	$id2 = 0;
	
	$data2 = mysqli_fetch_array($qry2);
	$point = $data2['point'];


?>
<html>
<head>
<meta charset="UTF-8">
<title>Order Details</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="eCommerceAssets/styles/eCommerceStyle.css" rel="stylesheet" type="text/css">
<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->
<script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/montserrat:n4:default;source-sans-pro:n2:default.js" type="text/javascript"></script>
</head>

<body>
<div id="mainWrapper">
  <header> 
    
   <a href = "shopping.php"><div id="logo"> <!-- <img src="logoImage.png" alt="sample logo"> --> 
      <!-- Company Logo text --> HelloWorld</div></a>
       <div id="headerLinks">
		<a href="index.php" title="Login/Register">Log Out</a>
		<a href="history.php" title="History">History</a>
		<a href="favorite.php" title="Favorites">Favorites</a>
		<a href="cart.php" title="Cart">Cart</a>
	  <font size="2"><?php  echo "&nbsp&nbsp&nbsp&nbsp&nbsp".$user.",  &nbsp Point : ".$point ?></font>
	</div>
  </header>
 
  <section id="offer"> 
    <!-- The offer section displays a banner text for promotions -->
    <h2>New Shopping Online !!</h2>
    <p>REALLY AWESOME DISCOUNTS </p>
  </section>
  <div id="content">
    <section class="sidebar"> 
      <!-- This adds a sidebar with 1 searchbox,2 menusets, each with \4   links -->
	<form method="post" action="search.php">
      <input type="text"  id="search" name="search" placeholder="Search Name Product">
		
			<button >
					<font face="'Montserrat', sans-serif" color= #919191 size = 3 > Search </font>
			</button>
			
		</form>
		
			
		
      <div id="menubar">
        <nav class="menu">
          <h2><!-- Title for menuset 1 --> Brand</h2>
          <hr>
          <ul>
			  <?php
			  $sql3 = "SELECT * FROM Brand;";
	
		$qry2 = mysqli_query($conn,$sql3);
	  	//$data2 = mysqli_fetch_array($qry);
		
		while($data3 = mysqli_fetch_array($qry2)){
			  ?>
            <!-- List of links under menuset 1 -->
            <li><a href="category.php?nameC=<?php  echo $data3['id_Brand']; ?>" title="Link"><?php echo $data3['name_Brand'] ?></a></li>
            
			  <?php } ?>
          </ul>
        </nav>
       
      </div>
    </section>
    
	 <?php $orderId = $_GET['OrderID']; ?>
	  <section class="mainContent">
		  <font face="'Montserrat', sans-serif" color= #ea576b size = 3 >
			   <h1>Order Details</h1> 
			 <h4> <font face="'Montserrat', sans-serif" color= #FAB44A size = 2 >
			  		#Order - <?php echo  $orderId  ?> <br>
				 	Status : Processing </font> </h4>
			  <?php
			 
			 $dataa = mysqli_fetch_array(mysqli_query($conn,"SELECT  * FROM History WHERE id_Order = '".$orderId."'"))['discount'];
				 
				 ?>
			  
		  <table width="670" border="1">

<tr>

	<th width="91"> <div align="center">ID Product </div></th>
	<th width="30"> <div align="center">Image </div></th>
	<th width="50"> <div align="center">Name </div></th>
	<th width="80"> <div align="center">Price </div></th>
</tr>

	<?php
	

	//$sql2 = "SELECT  * FROM Shopping_Cart";
	//$qry2 = mysqli_query($conn,$sql2);
	$count = 0;
			  
	
	$sql3 = "SELECT * FROM History where id_Order = '$orderId';";
	$qry3 = mysqli_query($conn,$sql3);

	//$data3 = mysqli_fetch_array($qry3);
	
	while($data2 = mysqli_fetch_array($qry3)){
		$id = $data2['id_Product'];
		$sql = "SELECT  * FROM Product WHERE id_Product = '".$id."'";
		$qry = mysqli_query($conn,$sql);
		$data3 = mysqli_fetch_array($qry);
		
		?> <tr> 
				<td><div align="center"><?php echo $data3['id_Product'] ; ?> </div></td> 
				<td><img src="eCommerceAssets/images/<?php echo $data3['img_product'] ; ?> " width="100" height="101" alt=""/>	</td> 
				<td><?php echo $data3['nameProduct'] ; ?> </td> 
			  	<td align="center" ><?php echo $data3['price'] ; ?> </td> 
			  
		</tr>
		
		<?php
		
		$count += $data3['price'] ;
		
	}
	
	
	//$id = "1001";
	?> </table>
			 <br><br> <?php 
		echo "total Price : ";
		echo $count;
		echo " baht";
	?> <br> 
		
		<?php 
			echo "total Price + VAT 7 % : ";
			echo $count*1.07;
			echo " baht";
		?> <br> 

			  <?php  
			  echo "discount  : ";
			echo $dataa;
			echo " baht";
			  
			?><br>
			<?php  
			  echo "total  : ";
			echo ($count*1.07)-$dataa;
			echo " baht";
			  
			?><br>
			 <a href="ex.php?orderID=<?php echo $orderId ?> ">invoice</a> <br>
			<a href="shopping.php">go home</a> 	
			 
		</font>
	</section>
  </div>
  <footer> 
    <!-- This is the footer with default 3 divs -->
    
      <p>
		  <font face="'Montserrat', sans-serif" color= #ea576b size = 3 ><b><u>Exclusive Deals and Offers!</u></b>Subscribe and be the first to get great deals!</font> 
		
	  </p>
      <form method="post" action="subscribe.php">
        <input type="text"  id="search2" name="email" placeholder="E-mail">
        <button > <font face="'Montserrat', sans-serif" color= #919191 size = 1 > Sign Me up </font> </button>
		  
      </form>
    
    
		<br>
  </footer>
</div>
</body>
</html>
