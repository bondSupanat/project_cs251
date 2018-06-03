

<!doctype html>
<?php
$idC = $_GET['nameC'];
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
<title>Brand</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="eCommerceAssets/styles/eCommerceStyle.css" rel="stylesheet" type="text/css">

<script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/montserrat:n4:default;source-sans-pro:n2:default.js" type="text/javascript"></script>
</head>

<body>
<div id="mainWrapper">
  <header> 
    <!-- This is the header content. It contains Logo and links -->
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
      <!-- This adds a sidebar with 1 searchbox,2 menusets, each with 4 links -->
	<?php 
			$classS = new Search;
			$classS->showSearch();
		
		?>
		
      <div id="menubar">
        <nav class="menu">
          <h2> Category</h2>
          <hr>
          <ul>
			  <?php
			  	$classC = new Category;
			  	$classC->showCategory($conn);
			  ?>
          </ul>
        </nav>
       
      </div>
    </section>
    <section class="mainContent">
		<?php   
		
			$sql2 = "SELECT * FROM Product where type = '$idC';";
			$qry = mysqli_query($conn,$sql2);
		
		$class = new Product;
		
		while($data2 = mysqli_fetch_array($qry)){	
		?>
      	<div class="productRow">
        
			<?php
				$class->set($data2);
				$class->showProduct();
			
				$data2 = mysqli_fetch_array($qry); 
				$class->set($data2);
				if(empty($data2)) break;
				$class->showProduct();
		
				$data2 = mysqli_fetch_array($qry); 
				$class->set($data2);
				if(empty($data2)) break;
				$class->showProduct();
			?>
       
      	</div>
     	<?php } ?>
    </section>
  </div>
  <footer> 
   <p>
		  <font face="'Montserrat', sans-serif" color= #ea576b size = 3 ><b><u>Exclusive Deals and Offers!</u></b>Subscribe and be the first to get great deals!</font> 
		
	  </p>
      <form method="post" action="subscribe.php">
        <input type="text"  id="search2" name="email" placeholder="E-mail">
        <button > <font face="'Montserrat', sans-serif" color= #919191 size = 1 > Sign Me up </font> </button>
		  
      </form>
  </footer>
</div>
</body>
</html>


<!---  OO   -->
<?php
	class Product {
		private $img;
		private $price;
		private $name;
		private $id;
	
		public function set($data){
			$this->img = $data['img_product'];
			$this->price = $data['price'];
			$this->name = $data['nameProduct'];
			$this->id = $data['id_Product'];
			
		}
		
		public function getImg(){
			return $this->img;
		}
		
		public function getPrice(){
			return $this->price;
		}
		
		public function getName(){
			return $this->name;
		}
		
		public function showProduct(){
			?> 
 				<article class="productInfo">
		    		 <div><img alt="sample" src="eCommerceAssets/images/<?php echo $this->img; ?>"></div> 
          			 <p class="price"><?php echo $this->price;?> Baht</p> 
          			 <p class="productContent"><?php echo $this->name;?> </p> 
					 <a href="productpage.php?proId=<?php echo $this->id;?>"><input type="button" name="button" value="Buy" class="buyButton"></a>	
				</article>
			<?php
			
		}
	
	}

	class Category {
		
		public function showCategory($conn){
			$sql3 = "SELECT * FROM Brand;";
			$qry2 = mysqli_query($conn,$sql3);
	  	
			while($data3 = mysqli_fetch_array($qry2)){
			  ?>
            	<li><a href="category.php?nameC=<?php echo $data3['id_Brand']  ?>" title="Link"><?php echo $data3['name_Brand'] ?></a></li>
            
			<?php } 
		}
		
	}

	class Search {
		
		public function showSearch(){
			?>
				<form method="post" action="search.php">
     				<input type="text"  id="search" name="search" placeholder="Search Name Product">
						<button >
							<font face="'Montserrat', sans-serif" color= #919191 size = 3 > Search </font>
						</button>
				</form>

			<?php
		}
	}

	class Subscribe {
		
		public function showSubscribe(){
			 ?> <p>
		  <font face="'Montserrat', sans-serif" color= #ea576b size = 3 ><b><u>Exclusive Deals and Offers!</u></b> Subscribe and be the first to get great deals!</font> 
		
	  </p>
      <form method="post" action="subscribe.php">
        <input type="text"  id="search2" name="email" placeholder="E-mail">
        <button > <font face="'Montserrat', sans-serif" color= #919191 size = 1 > Sign Me up </font> </button>
		  
      </form> <?php
		}
	}

?>