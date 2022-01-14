<?php
	session_start();
	require_once 'header.php';
require_once('config.php');
if(isset($_SESSION['login']))
{

}
else
{
	header("location:login.php");

}
?>

<body id="page-top" data-spy="scroll" data-target=".fixed-top">
	<?php include 'navbar.php'; ?>
  <div class="container m-top m-bottom" style="width: 500px">
    <table class="table  table-striped table-bordered">
			<thead>
				<tr class="thead-dark">
					<th width="5%" style="text-align: center; border-right: 1px solid #FFF;">Item No</th>
					<th width="40%" style="text-align: center; border-right: 1px solid #FFF;">Food Name</th>
					<th width="20%" style="text-align: center; border-right: 1px solid #FFF;">Price</th>
				</tr>
			</thead>

      <?php
      $i=0;
        $statement=$db->prepare("select * from tbl_foods ORDER By name ASC");
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        $count=$statement->rowCount();
        if ($count>0) {
          foreach ($result as $row) {
            $i++
            ?>
            <tr>
              <td><?php echo $i; ?></td>
             <td><?php echo $row['name']; ?></td>
             <td><?php echo $row['price']; ?></td>
            </tr>
            <?php
          }
        }else {
        ?>
         <td>Food Not available in the Hall Dining</td>
        <?php
        }

       ?>
    </table>

  </div>
</body>

<?php require_once('footer.php'); ?>
