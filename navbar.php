<nav class="navbar navbar-expand-lg navbar-dark fixed-top border-bottom  bg-dark">
	<div class="container">
		<a class="navbar-brand page-scroll" href="#page-top">
			<img src="res/nstulogo.gif" alt="NSTU" height="32px" width="32px">
		</a><span class="brand-name">NSTU</span>
		<button class="navbar-toggler" id="menu-toggle" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon" id="changeToggleIcon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto mt-2 mt-lg-0 py-2">
				<!-- History -->
				<?php if (isset($_SESSION['login'])) {
				?>
					<li class='nav-item'>
						<a class='nav-link' href='index.php'>Home</a>
					</li>
					<li class='nav-item'>
						<a class='nav-link' href='availableroom.php'>Available Rooms</a>
					</li>
					<li class='nav-item'>
						<a class='nav-link' href='viewnotice.php'>View Notice</a>
					</li>
					<li class='nav-item'>
						<a class='nav-link' href='createproblem.php'>Create Problem</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Food Menu</span> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a class="nav-link" href="todaymeal.php">Today Items</a></li>
							<li><a class="nav-link" href="foodlist.php">Dining all Items</a></li>
						</ul>
					</li>
					<li class="dropdown ">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Contact Menu</span> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a class="nav-link" href="teacherlist.php">Teacher contact</a></li>
							<li><a class="nav-link" href="doctorlist.php">Doctor contact</a></li>
							<li><a class="nav-link" href="employeelist.php">Employee contact</a></li>
						</ul>
					</li>
					<li class='nav-item'>
						<a class='nav-link' href='logout.php'>Sign Out</a>
					</li>

				<?php
				} else {
				?>
					<li class='nav-item'>
						<a class='nav-link' href='index.php'>Home</a>
					</li>
					<li class='nav-item'>
						<a class='nav-link' href='availableroom.php'>Available Rooms</a>
					</li>
					<li class='nav-item'>
						<a class='nav-link' href='viewnotice.php'>View Notice</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Contact Menu</span> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a class="nav-link" href="teacherlist.php">Teacher contact</a></li>
							<li><a class="nav-link" href="doctorlist.php">Doctor contact</a></li>
						</ul>
					</li>
					<li class='nav-item'>
						<a class='nav-link' href='login.php'>Sign in</a>
					</li>

				<?php
				}
				?>
			</ul>
		</div>
	</div>
</nav>