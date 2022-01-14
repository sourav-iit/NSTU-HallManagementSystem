<?php
session_start();
require_once 'header.php';
include("config.php");
?>

<body>
	<?php require_once('navbar.php'); ?>
	<div class="container m-top m-bottom">
		<?php
		$statement = $db->prepare("select * from tbl_notices ORDER BY id DESC");
		$statement->execute();
		$result = $statement->fetchAll();
		$count = 0;
		foreach ($result as $row) {
			$count++;
		}
		?>
		<div class="row mt-5">
			<div class="col-md-10 mx-auto">
				<h4 class="text-center">Notices</h4>
				<div class="border-line mb-5"></div>
				<?php
				foreach ($result as $row) {
				?>

					<div class="card">
						<div class="card-header">
							<?php echo $row['title']; ?>
						</div>
						<div class="card-body">
							<?php echo $row['description']; ?>
						</div>
						<div class="card-footer">
							<?php echo "Published: " . $row['time']; ?>
						</div>
					</div>
					<br><br>
				<?php
				}
				?>
			</div>

		</div>

	</div>


	</div>

</body>

<footer>
	<?php require_once('footer.php'); ?>
</footer>