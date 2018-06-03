<?php
// (c) Xavier Nicolay
// Exemple de génération de devis/facture PDF

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

	$orderID = $_GET['orderID'];

 $user = mysqli_fetch_array(mysqli_query($conn,"SELECT  * FROM History WHERE id_Order = '".$orderID."'"))['username_Member'];
 $address = mysqli_fetch_array(mysqli_query($conn,"SELECT  * FROM Member WHERE username = '".$user."'"))['address'];
 $name = mysqli_fetch_array(mysqli_query($conn,"SELECT  * FROM Member WHERE username = '".$user."'"))['fullName'];
 $date = mysqli_fetch_array(mysqli_query($conn,"SELECT  * FROM History WHERE id_Order = '".$orderID."'"))['date_Order'];
$time = mysqli_fetch_array(mysqli_query($conn,"SELECT  * FROM History WHERE id_Order = '".$orderID."'"))['time_Order'];
$total = mysqli_fetch_array(mysqli_query($conn,"SELECT  * FROM History WHERE id_Order = '".$orderID."'"))['totalPrice'];
$discount = mysqli_fetch_array(mysqli_query($conn,"SELECT  * FROM History WHERE id_Order = '".$orderID."'"))['discount'];


require('invoice.php');

$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();
$pdf->addSociete( "HelloWord shoes.",
                  "HelloWorldAdresse\n" .
                  "thammasat rangsit university\n" .
                  "Klong Luang, Rangsit, Prathumthani 12121 " . EURO );
$pdf->fact_dev("hello", "EiEi" );
$pdf->temporaire( " ~ Shopping EiEi ~ " );
$pdf->addDate( $date);
$pdf->addClient($orderID);
$pdf->addPageNumber($time);
$pdf->addClientAdresse($name ."\n".$address);
//$pdf->addReglement("Chèque à réception de facture");
//$pdf->addEcheance("03/12/2003");
//$pdf->addNumTVA("FR888777666");
//$pdf->addReference("Devis ... du ....");
$cols=array( "PRODUCT ID"    => 30,
             "DESIGNATION"  => 88,
             " "     => 0,
             " "      => 0,
             "PRICE" => 30,
             "NOTE"          => 49 );
$pdf->addCols( $cols);
$cols=array( "PRODUCT ID"    => "L",
             "DESIGNATION"  => "L",
             " "     => "C",
             " "      => "R",
             "PRICE" => "R",
             "NOTE"          => "C" );
$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);
$y    = 85;
//=====================================================================================================

	$sql3 = "SELECT * FROM History where id_Order = '$orderID';";
	$qry3 = mysqli_query($conn,$sql3);

	//$data3 = mysqli_fetch_array($qry3);
	
	while($data2 = mysqli_fetch_array($qry3)){
		$id = $data2['id_Product'];
		$sql = "SELECT  * FROM Product WHERE id_Product = '".$id."'";
		$qry = mysqli_query($conn,$sql);
		$data3 = mysqli_fetch_array($qry);
		
	
				//echo $data3['id_Product'] ."  "; 
	
 				//echo $data3['nameProduct'] ."  ";  
			  // 	echo $data3['price'] ."  <br>"; 
		
			  
		$line = array( "PRODUCT ID"    => $data3['id_Product'],
               "DESIGNATION"  =>  $data3['nameProduct'] ,
               " "     => "1",
               " "      => " ",
               "PRICE" => $data3['price'] ,
               "NOTE"          => " " );
$size = $pdf->addLine( $y, $line );
$y   += $size + 4;
	
		
	}


//=====================================================================================================




$tot_prods = array( array ( "px_unit" => 10, "qte" => 0, "tva" => 1 ) );
$tab_tva = array( "1"       => 0);
$params  = array( "RemiseGlobale" => 1,
                      "remise_tva"     => 1,       // {la remise s'applique sur ce code TVA}
                      "remise"         => 0,       // {montant de la remise}
                      "remise_percent" => 10,      // {pourcentage de remise sur ce montant de TVA}
                  "FraisPort"     => 1,
                      "portTTC"        => 10,      // montant des frais de ports TTC
                                                   // par defaut la TVA = 19.6 %
                      "portHT"         => 0,       // montant des frais de ports HT
                      "portTVA"        => 19.6,    // valeur de la TVA a appliquer sur le montant HT
                  "AccompteExige" => 1,
                      "accompte"         => 0,     // montant de l'acompte (TTC)
                      "accompte_percent" => 15,    // pourcentage d'acompte (TTC)
                  "Remarque" => " " );

$pdf->addTVAs( $params, $tab_tva, $tot_prods , $total , $discount , 1.07);
$pdf->addCadreEurosFrancs();
$pdf->Output();
?>
