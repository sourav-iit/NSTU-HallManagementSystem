<?php
	session_start();
	require_once 'header.php';
  include("config.php");

		if(isset($_SESSION['login']))
		{

		}
		else
		{
			header("location:login.php");

		}
?>

<body>
  	<?php require_once('navbar.php'); ?>
    <?php
    $date=date('y-m-d');
    $date=strtotime($date);

    $statement=$db->prepare("select * from tbl_daymeal");
  	$statement->execute();
  	$result=$statement->fetchAll();
    $count=$statement->rowCount();
    ?>
<div class="container m-top m-bottom" style="width: 800px">
<h5 >Today Lunch Items</h5>
<hr>
<table class="table  table-striped table-bordered">
	<thead class="thead-dark">
  <tr id="mang-tbl-header">
    <th width="5%" style="text-align: center; border-right: 1px solid #FFF;">Item No</th>
    <th width="40%" style="text-align: center; border-right: 1px solid #FFF;">Food Name</th>
    <th width="10%" style="text-align: center; border-right: 1px solid #FFF;">Price</th>
		<th width="20%" style="text-align: center; border-right: 1px solid #FFF;">Book Meal</th>
  </tr>
</thead>
  <?php

?>

<?php
$i=0;
$blanklunch=0;
if($count>0){
  foreach($result as $row){
    if((strtotime(substr($row['time'],2,8))) == $date){
    $lunch=$row['lunch'];
    ?>
    <tr>
      <?php
         if ($lunch=="") {
           $blanklunch++;
         }else {
             $i++;
           ?>
             <td><?= $i ;?></td>
               <td><?php echo $lunch; ?></td>

           <?php
           $statement1=$db->prepare("select * from tbl_foods where name='$lunch'");
           $statement1->execute();
           $price1=$statement1->fetchAll()[0];
           ?>
           <td><?php echo $price1[2] ;?></td>
					 <td><a href="" class="btn btn-info">Confirm Meal</a></td>

           <?php
         }
       ?>

    </tr>
    <?php

}
}
}

 ?>
</table>
</div><br><br>

<div class="container m-bottom" style="width: 800px">
<h5>Today Dinner Items</h5>
<hr>
<table class="table  table-striped table-bordered">
	<thead class="thead-dark">
		<tr id="mang-tbl-header">
			<th width="5%" style="text-align: center; border-right: 1px solid #FFF;">Item No</th>
			<th width="40%" style="text-align: center; border-right: 1px solid #FFF;">Food Name</th>
			<th width="10%" style="text-align: center; border-right: 1px solid #FFF;">Price</th>
			<th width="20%" style="text-align: center; border-right: 1px solid #FFF;">Book Meal</th>
		</tr>
	</thead>

  <?php

$blankdinner=0;
  $j=0;
  if($count>0){
    foreach($result as $row){
    if((strtotime(substr($row['time'],2,8))) == $date){
      $dinner=$row['dinner'];
      /*
        retr
      */
      ?>
      <tr>
        <?php
           if ($dinner=="") {
             $blankdinner++;
             // code...
           }else {
               $j++;
             ?>
               <td><?= $j ?></td>
                 <td><?php echo $dinner; ?></td>

             <?php
             $statement2=$db->prepare("select * from tbl_foods where name='$dinner'");
             $statement2->execute();
             $price2=$statement2->fetchAll()[0];
             ?>
             <td><?php echo $price2[2]; ?></td>
						 <td><a href="" class="btn btn-info">Confirm Meal</a></td>
             <?php
           }
         ?>

      </tr>
      <?php

  }
}
  }
  ?>
</table>
</div>
</body>
<?php require_once('footer.php'); ?>
