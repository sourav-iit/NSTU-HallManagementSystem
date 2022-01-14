<?php
	session_start();
	require_once 'header.php';
  include("config.php");
?>
<body>
  <?php include('navbar.php') ?>
  <div class="container mt-5" style="width: 500px">
  	<h5>Our Hall Doctors list</h5>
  	<table class="table  table-striped table-bordered">
     <tr>
     	<th>No</th>
  		<th>Doctor Name</th>
  		<th>Specialist</th>
  		<th>phone</th>
  		<th>E-mail</th>
     </tr>
  	 <?php
     date_default_timezone_set('Asia/dhaka');
     $i=0;
  	 $statement=$db->prepare("select * from tbl_doctors");
   	$statement->execute();
   	$result=$statement->fetchAll();
   	$count=$statement->rowCount();
  	if($count>0){
  	  foreach($result as $row){
  			$i++;
  	    ?>
  	    <tr>
  	      <?php
  	           ?>
  	             <td><?= $i ;?></td>
  	               <td><?php echo $row['name']; ?></td>
  								 <td><?php echo $row['specialist']; ?></td>
  								 <td><a href="tel:<?= $row['phone'] ?>" class="btn btn-info">Call Now</a></td>
  								 <td><a href="mailto:<?= $row['email'] ?>" class="btn btn-info">Email Now</a></td>

  	           <?php
  	           ?>

  	           <?php
  	       ?>

  	    </tr>
  	    <?php
  	}
  }else {
  	?>
  <tr>
  	<td>No doctor Available at this moment</td>
  </tr>
  	<?php
  }
  	  ?>
  	</table>
  </div>
</body>
<?php require_once('footer.php'); ?>
