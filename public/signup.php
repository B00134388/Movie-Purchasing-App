<?php
	if (isset($_POST['submit'])) {
		require "../common.php";
		try {
			require_once '../src/UserDBConnect.php';
			$new_user = array(
			"firstname" => $_POST['firstname'],
			"lastname" => $_POST['lastname'],
			"email" => $_POST['email'],
			"age" => $_POST['age']
			);
			$sql = sprintf(
			"INSERT INTO %s (%s) values (%s)",
			"users",
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
	<?php echo escape($_POST['firstname']); ?> successfully added.
<?php } ?>
<h2>Create an Account</h2>
<form method="post">
	<label for="firstname">First Name</label>
	<input type="text" name="firstname" id="firstname">
	<label for="lastname">Last Name</label>
	<input type="text" name="lastname" id="lastname">
	<label for="email">Email Address</label>
	<input type="text" name="email" id="email">
	<label for="age">Age</label>
	<input type="text" name="age" id="age">
	<br>
	<br>
	<input type="submit" name="submit" value="Sign Up">
</form>
<br>
<a href="index.php">Back to home</a>
<?php include "templates/footer.php"; ?> 