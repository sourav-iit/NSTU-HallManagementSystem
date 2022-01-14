<?php
session_start();
require_once 'header.php';
include("config.php");
?>

<body>
	<?php require_once('navbar.php'); ?>
	<?php
	date_default_timezone_set('Asia/dhaka');
	$date = date('y-m-d');
	$date = strtotime($date);

	$statement = $db->prepare("select * from tbl_activeteachers");
	$statement->execute();
	$result = $statement->fetchAll();
	$count = $statement->rowCount();
	?>
	<div class="container m-top m-bottom">
		<h5 class="text-center my-3">Today Duty Teacher</h5>
		<div class="row">
			<div class="col-md-8 mx-auto">
			<table class="table  table-striped table-bordered">
			<thead class="thead-dark">
				<tr id="mang-tbl-header">
					<th width="5%" style="text-align: center; border-right: 1px solid #FFF;">No</th>
					<th width="50%" style="text-align: center; border-right: 1px solid #FFF;">Teacher Name</th>
					<th width="30%" style="text-align: center; border-right: 1px solid #FFF;">Phone</th>
				</tr>
			</thead>


			<?php
			$i = 0;
			if ($count > 0) {
				foreach ($result as $row) {

					if ((strtotime(substr($row['time'], 2, 8))) == $date) {
						$i++;
			?>
						<tr>
							<td><?= $i; ?></td>
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $row['phone']; ?></td>
						</tr>
				<?php

					}
				}
			} else {
				?>
				<tr>
					<td>No Teacher Available at this moment</td>
				</tr>
			<?php
			}

			?>
		</table>
		<hr>
		<h5 class="text-center">Here our all teacher</h5>
		<table class="table  table-striped table-bordered">
			<thead class="thead-dark">
				<tr>
					<th>No</th>
					<th>Teacher Name</th>
					<th>Working Dept</th>
					<th>phone</th>
					<th>E-mail</th>
				</tr>
			</thead>

			<?php
			$statement = $db->prepare("select * from tbl_teachers");
			$statement->execute();
			$result = $statement->fetchAll();
			$count = $statement->rowCount();
			if ($count > 0) {
				foreach ($result as $row) {
					$i++;
			?>
					<tr>
						<?php
						?>
						<td><?= $i; ?></td>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['work']; ?></td>
						<td><a href="tel:<?= $row['phone'] ?>" class="btn btn-info">Call Now</a></td>
						<td><a href="mailto:<?= $row['email'] ?>" class="btn btn-info">Email Now</a></td>

						<?php
						?>

						<?php
						?>

					</tr>
			<?php
				}
			}
			?>
		</table>
			</div>
		</div>
		
	</div>
	<br><br>
	<div class="container">
		
		
	</div>
</body>
<?php require_once('footer.php'); ?>