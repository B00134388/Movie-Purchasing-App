<?php
	if (isset($_POST['submit'])) {
		try {
			require "../common.php";
			require_once '../src/UserDBConnect.php';
			$sql = "SELECT *
			FROM users
			WHERE id = :id";
			$id = $_POST['id'];
			$statement = $connection->prepare($sql);
			$statement->bindParam(':id', $id, PDO::PARAM_STR);
			$statement->execute();
			$result = $statement->fetchAll();
			} catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
		}
	}
	require "templates/header.php";
	if (isset($_POST['submit'])) {
		if ($result && $statement->rowCount() > 0) {
		?>
		<h2>Results</h2>
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email Address</th>
					<th>Age</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($result as $row) { ?>
					<tr>
						<td><?php echo escape($row["id"]); ?></td>
						<td><?php echo escape($row["firstname"]); ?></td>
						<td><?php echo escape($row["lastname"]); ?></td>
						<td><?php echo escape($row["email"]); ?></td>
						<td><?php echo escape($row["age"]); ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php } else { ?>
		> No results found for <?php echo escape($_POST['id']); ?>.
		<?php }
	} ?>
	<h2>User Search</h2>
	<form method="post">
		<label for="id">Insert ID here:</label>
		<input type="text" id="id" name="id">
		<input type="submit" name="submit" value="Search">
	</form>
	<a href="index.php">Back to home</a>
	<?php require "templates/footer.php"; ?>		