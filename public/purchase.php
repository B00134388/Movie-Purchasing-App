<?php
	if (isset($_POST['submit'])) {
		require "../common.php";
		try {
			require_once '../src/PurchasesDBConnect.php';
			$new_user = array(
			"purchaseid" => $_POST['purchaseid'],
			"movietitle" => $_POST['movietitle'],
			"price" => $_POST['price']
			);
			$sql = sprintf(
			"INSERT INTO %s (%s) values (%s)",
			"purchases",
			implode(", ", array_keys($new_user)),
			":" . implode(", :", array_keys($new_user))
			);
			$statement = $connection->prepare($sql);
			$statement->execute($new_user);
			} catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
		}
	}
?>
<?php require "templates/header.php"; ?>
<?php if (isset($_POST['submit']) && $statement) { ?>
	Thank you for purchasing: <?php echo escape($_POST['movietitle']); ?>
<?php } ?>
<h2>Purchase</h2>
<form method="post">
	<label for="purchaseid">Purchase ID</label>
	<input type="text" name="purchaseid" purchaseid="purchaseid">
	<label for="movietitle">Movie Title</label>
	<input type="text" name="movietitle" purchaseid="movietitle">
	<label for="price">Price</label>
	<input type="text" name="price" purchaseid="price">
	<br>
	<br>
	<input type="submit" name="submit" value="Buy Now">
</form>
<br>
<a href="index.php">Back to home</a>
<?php include "templates/footer.php"; ?> 