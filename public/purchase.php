<?php
	if (isset($_POST['submit'])) {
		require "../common.php";
		try {
			require_once '../src/PurchasesDBConnect.php';
			$new_purchase = array(
			"movietitle" => $_POST['movietitle'],
			"price" => $_POST['price']
			);
			$sql = sprintf(
			"INSERT INTO %s (%s) values (%s)",
			"purchases",
			implode(", ", array_keys($new_purchase)),
			":" . implode(", :", array_keys($new_purchase))
			);
			$statement = $connection -> prepare($sql);
			$statement -> execute($new_purchase);
			} catch(PDOException $error) {
			echo $sql . "<br>" . $error -> getMessage();
		}
	}
?>
<?php require "templates/header.php"; ?>
<?php if (isset($_POST['submit']) && $statement) { ?>
	<?php echo "Thank you for your purchase."?>
<?php } ?>
<h2>Purchase a Movie</h2>
<form method = "post">
	<label for = "movietitle">Movie Title</label>
	<input type = "text" name = "movietitle" id = "movietitle">
	<label for = "price">Price</label>
	<input type = "text" name = "price" id = "price">
	<br>
	<br>
	<input type = "submit" name = "submit" value = "Buy Now">
</form>
<br>
<a href = "index.php">Back to Home</a>
<?php include "templates/footer.php"; ?> 