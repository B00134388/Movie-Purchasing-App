<?php
	if (isset($_POST['submit'])) {
		try {
			require "../common.php";
			require_once '../src/PurchasesDBConnect.php';
			$sql = "SELECT *
			FROM purchases
			WHERE purchaseid = :purchaseid";
			$purchaseid = $_POST['purchaseid'];
			$statement = $connection -> prepare($sql);
			$statement -> bindParam(':purchaseid', $purchaseid, PDO::PARAM_STR);
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
					<th>Purchase ID</th>
					<th>Movie Title</th>
					<th>Price</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($result as $row) { ?>
					<tr>
						<td><?php echo escape($row["purchaseid"]); ?></td>
						<td><?php echo escape($row["movietitle"]); ?></td>
						<td><?php echo escape($row["price"]); ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php } else { ?>
		> No results found for Purchase ID: <?php echo escape($_POST['purchaseid']); ?>.
		<?php }
	} ?>
	<h2>View Purchase History</h2>
	<form method = "post">
		<label for = "purchaseid">Insert Purchase ID here:</label>
		<input type = "text" id = "purchaseid" name = "purchaseid">
		<input type = "submit" name = "submit" value = "Search">
	</form>
	<?php require "templates/footer.php"; ?>		