<?php
	session_start();
	require_once 'header.php';
  include("config.php");
?>
<body>
  <?php include('navbar.php') ?>
  <div class="container m-top m-bottom" style="width: 500px">
  	<h5>Our Hall Employee list</h5>
  	<table class="table  table-striped table-bordered">
     <tr>
     	<th>No</th>
  		<th>Employee Name</th>
  		<th>Job</th>
  		<th>Mobile</th>
     </tr>
  	 <?php
     date_default_timezone_set('Asia/dhaka');
     $i=0;
  	 $statement=$db->prepare("select * from  tbl_employee");
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
  								 <td><?php echo $row['job']; ?></td>
  								 <td><a href="tel:<?= $row['phone'] ?>" class="btn btn-info">Call Now</a></td>
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
  	<td>No Employee Available at this moment</td>
  </tr>
  	<?php
  }
  	  ?>
  	</table>
  </div>
</body>
<?php require_once('footer.php'); ?>
