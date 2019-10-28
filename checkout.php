<?php
class Checkout{
  public $pricingRules;
  public $items=array();
  public $total;

  public function __construct($pricingRules) {
       $this->pricingRules = $pricingRules;
	   $total=0;
	   $items=array();
    }
// function scan will scan item by item and push each item to an array that will be used in total method
  function scan($item) {
	  array_push($this->items,$item);
  }

// function total to calculate  total amount need to pay
  function total(){
	  $atv=0;
	  $ipd=0;
	  $vga=0;
	  $mbp=0;
	  $atvPrice=0;
	  $ipdPrice=0;
	  $vgaPrice=0;
	  $mbpPrice=0;
	  echo "<center><h2>Bill Details </h2><br><br><br>";
	  echo "<table><tr><td><b>Item</b>  </td><td><b>Price</b>  </td></tr>";
	  foreach($this->items as $i){
	  
		if(in_array(array_keys($i)[0], $this->pricingRules)){
				echo "<tr><td>".array_keys($i)[0]."</td><td>".array_values($i)[0]."</td></tr>";
			if(array_keys($i)[0]=="atv"){
				$atv++;
				$atvPrice=(float)( str_replace("$","",array_values($i)[0]));
			}
			else if(array_keys($i)[0]=="ipd"){
				$ipd++;
				$ipdPrice=(float)( str_replace("$","",array_values($i)[0]));
			}
			else if(array_keys($i)[0]=="vga"){
				$vga++;
				$vgaPrice=(float)( str_replace("$","",array_values($i)[0]));
			}
		
	   }else{
		    echo "<tr><td>".array_keys($i)[0]."</td><td>".array_values($i)[0]."</td></tr>";
	   		$this->total =$this->total + (float)( str_replace("$","",array_values($i)[0]));
	   		if(array_keys($i)[0]=="mbp"){
				$mbp++;
				$mbpPrice=(float)( str_replace("$","",array_values($i)[0]));
			}
   		}
	 
  }       // add amout fter discout of first promotion
  		 	$this->total = $this->total + ($atv-(int)($atv/3))*$atvPrice ;
        // add amout fter discout of second promotion
   			if($ipd>4){
        		$this->total = $this->total + $ipd*499.99;
   			}else{
        		$this->total = $this->total + $ipd*549.99;
   			}

      // add amout fter discout of second promotion
   	if($vga-$mbp>0){
       $this->total = $this->total +  ($vga-$mbp)*$vgaPrice;	   
   }
	echo "<table><tr><td><b>Total Expected:</b></td><td><b>". number_format($this->total,2)."</b></td></tr>";
	echo "</table><button>Payment</button></center>";

	  }
  
}
?> 