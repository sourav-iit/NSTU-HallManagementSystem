<?php
session_start();
require_once 'header.php';
require_once('config.php');
?>

<body id="page-top" data-spy="scroll" data-target=".fixed-top">
	<?php require_once('navbar.php'); ?>

	<div id="carousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="6000">
		<ol class="carousel-indicators">
			<li data-target="#carousel" data-slide-to="0" class="active"></li>
			<li data-target="#carousel" data-slide-to="1"></li>
			<li data-target="#carousel" data-slide-to="2"></li>
			<li data-target="#carousel" data-slide-to="3"></li>
		</ol>
		<div class="carousel-inner" role="listbox">
			<div class="carousel-item active">
				<a href="index.php">
					<picture>
						<img srcset="images/slider/hall1.jpg" alt="responsive image" class="d-block img-fluid">
					</picture>
					<div class="carousel-caption d-none d-md-block text-dark">
						<h2>Welcome To Noakhali Science and <br> Technology University hall System</h2>
					</div>

				</a>
			</div>
			<!-- /.carousel-item -->
			<div class="carousel-item">
				<a href="index.php/">
					<picture>
						<img srcset="images/slider/hall2.jpg" alt="responsive image" class="d-block img-fluid">
					</picture>
				</a>
			</div>
			<!-- /.carousel-item -->
			<div class="carousel-item">
				<a href="index.php">
					<picture>
						<img srcset="images/slider/hall3.jpg" alt="responsive image" class="d-block img-fluid">
					</picture>
				</a>
			</div>
			<div class="carousel-item">
				<a href="index.php">
					<picture>
						<img srcset="images/slider/hall4.jpg" alt="responsive image" class="d-block img-fluid">
					</picture>
				</a>
			</div>
			<!-- /.carousel-item -->
		</div>
		<!-- /.carousel-inner -->
		<a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>

	<div class="container">
		<br><br>
		<div class="">
			<div class="row">
				<div class="col-md-5 p-3 mx-auto">
					<img src="images/teacher/man1.png" alt="">
				</div>
				<div class="col-md-5 p-3 mx-auto">
					<h3>Message From Hall Provost</h3>
					<hr>
					<p>It is my pleasure to introduce you to one of the vibrant Technological institutes in Bangladesh. Institute of Information Technology (IIT), Noakhali Science and Technology University. The Institute of Information Technology (IIT) has been established under Noakhali Science and Technology
						University Act 2001 section 41; as a constituent Institute with a separate Board of Governors.…</p>
				</div>
			</div>
			<br><br>
			<section>
				<div class="container">
					<h3 style="text-align: center">Our Hall Controller Team</h3>
					<div class="border-line"></div>
				</div>
				<br><br>
				<div class="row">
					<div class="col">
						<div class="card" style="width: 18rem;">
							<img src="images/teacher/man3.jfif" class="card-img-top" alt="...">
							<div class="card-body">
								<h5 class="card-title">provost</h5>
								<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
								<a href="#" class="btn btn-primary">Read About more</a>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card" style="width: 18rem;">
							<img src="images/teacher/man3.jfif" class="card-img-top" alt="...">
							<div class="card-body">
								<h5 class="card-title">Assistant provost</h5>
								<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
								<a href="#" class="btn btn-primary">Read About more</a>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card" style="width: 18rem;">
							<img src="images/teacher/man4.jfif" class="card-img-top" alt="...">
							<div class="card-body">
								<h5 class="card-title">Assistant provost</h5>
								<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
								<a href="#" class="btn btn-primary">Read About more</a>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="event-cal">
			<div class="container">
				<div id="calendar1"></div>
			</div>
			</section>

		</div>
	</div>
	</div>
</body>

<?php require_once('footer.php'); ?>
