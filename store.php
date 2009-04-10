<?php
	print("1 hour so far. <br />");
	require("product.php");
	$db = mysql_connect("localhost", "root", "root");
	if(!$db) {
		print("Error connecting to mysql.<br />");
		die();
	}
	if(!mysql_select_db("products", $db)) {
		print("Error selecting db.<br />");
		die();
	}

	$query = "select id from products";
	$result = mysql_query($query, $db);
	if(!$result) {
		print("Error processing query $query.<br />");
		die();
	}

	for($i=0; $i<mysql_num_rows($result); $i++) {
		$product_info = mysql_fetch_array($result);
		$products[] = new Product($product_info['id']);
	}

	foreach($products as $product) {
		print("
			<div id='product-box'>
				$product->name<br />
				\$$product->price<br />
				$product->stock<br /><br />
				$product->description<br />
				<form id='buy'>
					<input type='button' id='buy_button' value='Add to Cart' />
					<input type='hidden' id='product_id' value=$product->id />
				</form>
				<form id='wishlist'>
					<input type='button' id='wishlist_button' value='Add to Wishlist' />
					<input type='hidden' id='product_id' value=$product->id />
				</form>
			</div>
		");
	}
	mysql_close($db);
?>