<html>
	<head>
		<title>Checkout</title>
		<script>
			var card = new Array();
		</script>
	</head>
	<body>
		<center><h3>Products List </h3>
		<br><br>
		<?php
			$string = file_get_contents("products.json");
			$products =json_decode($string,true);
			echo '<table>';
			echo '<tr><td>SKU</td><td>Name</td><td>Price</td><td>Order</td></tr>';
			$i=0;
			foreach ($products as $p){
				echo '	<tr><td><b>'.$p["SKU"].'</b></td><td>'.$p["Name"].'</td><td>'.$p["Price"].'</td><td><button id="'.$p["SKU"].'" onClick="addToCard(this.id)" >Buy</button><td>';
			}
			echo '</table>';
		?>
		
		<br>
		<h2>Card</h2>
		<div id="card">No Items selected</div><br>
		<button id="submit" onClick="submit()" disabled >Checkout</button>
		<script>
		// add item selected to Card
			function addToCard(id) {
				card.push(id);
				chechoutButton();
				let details="";
	    		let i;
      			for (i = 0; i < card.length; i++) {
     				details=details+"<b>"+card[i]+"</b><a href='#' onClick='deleteItem(this.id)' id='"+i+"'> delete</a><br>";
    			} 
				document.getElementById("card").innerHTML = details; 
			}
			
			// remove item selected to Card
			function deleteItem(id){
				card.splice(id,1);
				chechoutButton();
				let details="";
	    		let i;
 				for (i = 0; i < card.length; i++) {
     				details=details+"<br><b>"+card[i]+"</b><a href='#' onClick='deleteItem(id)' id='"+i+"'> delete</a>";
    			} 
					document.getElementById("card").innerHTML = details; 
				}

			// checkout : display bill page with total amount
			function submit() {
  				window.location.replace("./payment.php?card="+card);
			}
			// disable button checkout if no item in Card
				function chechoutButton(){
                      if(card.length>0){
                          document.getElementById("submit").disabled = false;
					  }else{
                            document.getElementById("submit").disabled = true;
					  }
				}
		</script>
		</center>
	</body>
</html>