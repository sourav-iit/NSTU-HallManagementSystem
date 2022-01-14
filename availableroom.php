<?php
session_start();
require_once 'header.php';
include("config.php");
?>

<body>
	<?php require_once('navbar.php'); ?>
	<div class="container m-top m-bottom">

		<div class="text-center my-5">
			<h3>How To apply The Hall</h3>
			<p>When our hall seat available here you can apply for seat to allocation a seat into out hall</p>

		</div>
		<table class="table  table-striped table-bordered table-dark">
			<thead class="thead-dark">
				<tr id="mang-tbl-header">
					<th>Room No/Name</th>
					<th>Block</th>
					<th>Available seat</th>
					<th>Allocation</th>
				</tr>
			</thead>

			<?php

			$statement = $db->prepare("select * from tbl_rooms");
			$statement->execute();
			$result = $statement->fetchAll();
			foreach ($result as $row) {
				$id = $row['id'];
				$name = $row['name'];
				$block = $row['block'];
				$size = $row['size'];

				$connection = mysqli_connect("localhost", "root", "", "hall");
				if (mysqli_connect_errno()) {
					echo "Database connection failed.";
				}
				$query = "select count(*) from tbl_student where room_id='$id' group by room_id";
				$result = mysqli_query($connection, $query);
				$booked = 0;
				if ($result) {
					$row = mysqli_num_rows($result);

					if ($row) {
						//printf("Number of row in the table : " . $row);
						$row = $result->fetch_row();

						if ($row[0] < $size) {
			?>
							<tr>
								<td><?php echo  $name; ?></td>
								<td><?php echo $block; ?></td>
								<td><?php echo ($size - $row[0]); ?></td>
								<td><a class="btn btn-info" href="application.php?id=<?= $id; ?>">Apply Now</a></td>

							</tr>

						<?php
						}
						?>

					<?php
					} else {
					?>
						<tr>
							<td><?php echo  $name; ?></td>
							<td><?php echo $block; ?></td>
							<td><?php echo $size; ?></td>
							<td><a class="btn btn-info" href="application.php?id=<?= $id; ?>">Apply Now</a></td>

						</tr>
			<?php
					}
					// mysqli_free_result($result);
				}
				mysqli_close($connection);
			}
			?>

			<?php

			//}
			?>

		</table>
		<br><br>

	</div>
</body>
<?php require_once('footer.php'); ?>