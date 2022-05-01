<?php
	if (isset($_POST['submit'])) {
		try {
			require "../common.php";
			require_once '../src/UserDBConnect.php';
			$sql  =  "SELECT *
			FROM users
			WHERE userid = :userid";
			$userid = $_POST['userid'];
			$statement = $connection -> prepare($sql);
			$statement -> bindParam(':userid', $userid, PDO::PARAM_STR);
			$statement -> execute();
			$result = $statement -> fetchAll();
			} catch(PDOException $error) {
			echo $sql . "<br>" . $error -> getMessage();
		}
	}
	require "templates/header.php";
	if (isset($_POST['submit'])) {
		if ($result && $statement -> rowCount() > 0) {
		?>
		<h2>Results</h2>
		<table>
			<thead>
				<tr>
					<th>User ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email Address</th>
					<th>Age</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($result as $row) { ?>
					<tr>
						<td><?php echo escape($row["userid"]); ?></td>
						<td><?php echo escape($row["firstname"]); ?></td>
						<td><?php echo escape($row["lastname"]); ?></td>
						<td><?php echo escape($row["email"]); ?></td>
						<td><?php echo escape($row["age"]); ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php } else { ?>
		> No results found for User ID: <?php echo escape($_POST['userid']); ?>.
		<?php }
	} ?>
	<h2>User Search</h2>
	<form method = "post">
		<label for = "userid">Insert User ID here:</label>
		<input type = "text" id = "userid" name = "userid">
		<input type = "submit" name = "submit" value = "Search">
	</form>
	<?php require "templates/footer.php"; ?>		