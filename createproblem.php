<?php
session_start();
require_once 'header.php';
include("config.php");

if (isset($_SESSION['login'])) {
} else {
	header("location:login.php");
}
?>
<?php
$email = $_SESSION['login'];
if (isset($_POST['problem'])) {
	echo $_SESSION['login'];
	echo $_SESSION['id'];
	try {
		if (empty($_POST['name'])) {
			throw new Exception('Name can not be empty');
		} else if (empty($_POST['description'])) {
			throw new Exception('Description can not be empty');
		}

		$stId = $_SESSION['id'];
		$stage = 0;
		/* --------------- insert into problem ----------------------- */
		$statement = $db->prepare("insert into tbl_problems (name,description,st_id,is_solved) values(?,?,?,?)");
		$statement->execute(array($_POST['name'], $_POST['description'], $stId, $stage));

		$success_message = 'you submited a problem to hall admin has added successfully.';
	} catch (Exception $e) {
		$error_message = $e->getMessage();
	}
}
?>

<body>
	<?php require_once('navbar.php'); ?>

	<?php
	if (isset($error_message)) {
		echo "<div class='error'>" . $error_message . '</div>';
	}
	?>
	<?php
	if (isset($success_message)) {
		echo "<div class='success'>" . $success_message . '</div>';
	}
	?>

	<div class="container  m-top">
		<div class="row mt-5">
			<div class="col-md-6 mx-auto p-2">
				<div class="card shadow rounded p-1">
					<div class="card-body">
						<h4 class="card-title text-center">Enter Detailed Information</h4>
						<form class="" action="" method="post">
							<div class="form-group">
								<label for="usr" class="text-white">Name:</label>
								<input type="text" class="form-control" id="usr" name="name" placeholder="Enter your Name">
							</div>
							<div>
								<label for="usr" class="text-white">Descriptive Problem:</label>
								<textarea class="form-control" rows="10" id="comment" name="description" placeholder="describe about problem"></textarea>
							</div>
							<div class="text-center my-3">
								<button class="btn btn-primary" type="submit" name="problem" value="Submit">Submit</button>
							</div>
						</form>
					</div>
				</div>

			</div>
		</div>

	</div>
	<br><br>
	<div class="container  m-bottom" style="width: 800px">
		<table class="table  table-striped table-bordered">
			<tr style="background-color: #0D7B7B;color: #FFF;height: 40px;">
				<th width="5%" style="text-align: center; border-right: 1px solid #FFF;">No.</th>
				<th width="60%" style="text-align: center; border-right: 1px solid #FFF;">Dsscription</th>
				<th width="40%" style="text-align: center; border-right: 1px solid #FFF;">E-mail</th>
				<th width="15%" style="text-align: center; ">Stage</th>
			</tr>

			<?php
			$i = 0;
			$stId = $_SESSION['id'];
			/*
		$statement = $db->prepare("SELECT * FROM tbl_problems where st_id='$stId'");
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row) {
				$i++;
				?>
				<tr>
					<td><?php echo $i ;?></td>
					<td><?php echo $row['description']; ?></td>

					<td></td>

				</tr>
				<?php
}
*/

			$connection = mysqli_connect("localhost", "root", "", "hall");
			$query = "SELECT * FROM tbl_problems where st_id='$stId'";
			$result = mysqli_query($connection, $query);
			$booked = 0;
			if ($result) {
				$row = mysqli_num_rows($result);

				if ($row) {
					//printf("Number of row in the table : " . $row);
					while ($row = $result->fetch_row()) {
						$i++;


			?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $row[1]; ?></td>
							<td><?php echo $email; ?></td>
							<?php
							if ($row[4] == 0) {
							?>
								<td> <input class="btn btn-danger" type="button" name="" value="pending"></td>

							<?php
							} else {
							?>
								<td> <input class="btn btn-success" type="button" name="" value="solved"></td>
							<?php
							}
							?>
						</tr>

					<?php
					}
					?>
				<?php
				} else {
				?>
					<tr>
						<td></td>
						<td>you have no problem</td>
					</tr>

			<?php
				}
				// mysqli_free_result($result);
			}
			?>

		</table>
	</div>	
</body>
<?php require_once('footer.php'); ?>
