<?php 
require('checkout.php');
$string = file_get_contents("products.json");
$products =json_decode($string,true);
if ( isset( $_GET['card'] ) ) {
	if(strpos($_GET['card'],',')>=0){
		$card = explode(',', $_GET['card']);
	}else{
		$card=array($_GET['card']);
	}
}
// list of items have promotions
$pricingRules = array("atv","ipd","vga");
$co = new Checkout($pricingRules);
//scan items selected one by one
foreach($card as $c){
	foreach ($products as $p){
		if($p["SKU"]==$c){
			$price=$p["Price"];
		}
	}
	$item=array($c=>$price);
	$co->scan($item);
}
// call method total to display total amout need to pay 
$co->total();

?>