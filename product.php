<?php
	class Product {
		var $id;
		var $name;
		var $description;
		var $price;
		var $stock;
		var $picture_id;

		function Product($id) {
			$this->$id = $id;
			$query = "select name, description, price, stock, picture_id from products where id=$id";
			get_sql($query);
		}

		function get_sql($query) {
			$db = mysql_connect("localhost", "root", "root");
			if(!$db) {
				print("Error connecting to mysql.<br />");
				die();
			}
			if(!mysql_select_db("products", $db)) {
				print("Error selecting db.<br />");
				die();
			}

			$result = mysql_query($query);
			$product_info = mysql_fetch_array($result);
			$this->name = $product_info['name'];
			$this->description = $product_info['description'];
			$this->price = $product_info['price'];
			$this->stock = $product_info['stock'];
			$this->picture_id = $product_info['picture_id'];
			mysql_close($db);
		}
	}
?>