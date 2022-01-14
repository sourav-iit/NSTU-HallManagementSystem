<?php
ob_start();
session_start();
if ($_SESSION['name'] != 'admin') {
  header('location: login.php');
}
include("../config.php");
?>
<?php include("header.php"); ?>
<!---Content Part -->

<div class="col-sm-9 col-md-9 col-lg-9">
    <h2>View  All Application</h2>

    <!--Start searching selction-->

   <div class="">
     <form class="" action="" method="post">

     <table>
       <tr>
         <td width="70%"></td>
         <td><input type="text" class="form-control" name="val" value="" placeholder="Searching here"></td>
         <td><input type="submit" class="form-control" name="search" value="search"></td>
       </tr>
     </table>
     </form>
   </div>

     <!--End searching selction-->

  <div id="content">
    <div class="">
    	<table>
    		<tr style="background-color: #0D7B7B;color: #FFF;height: 40px;">
    				<th width="5%" style="text-align: center; border-right: 1px solid #FFF;">No.</th>
    				<th width="60%" style="text-align: center; border-right: 1px solid #FFF;">Reason For apply</th>
    				<th width="40%" style="text-align: center; border-right: 1px solid #FFF;">E-mail-phone</th>
            	<th width="20%" style="text-align: center; border-right: 1px solid #FFF;">Room</th>
    				<th width="15%" style="text-align: center; ">state</th>
            <th width="15%" style="text-align: center; ">Remove Apllication</th>
    		</tr>
    		<?php
    		$i = 0;

    $connection = mysqli_connect("localhost", "root","","hall");

    if (isset($_POST['search'])) {
      $searchVal=$_POST['val'];

     $query = "SELECT * FROM tbl_application where email LIKE '%{$searchVal}%' or time LIKE '%{$searchVal}%' reason LIKE '%{$searchVal}%'";
    }else{
     $query = "SELECT * FROM tbl_application";
    }


    	 $result = mysqli_query($connection, $query);
    $booked=0;
    	 if ($result)
    	 {
    			 $row = mysqli_num_rows($result);

    					if ($row)
    						 {
    								//printf("Number of row in the table : " . $row);
    									 while($row=$result->fetch_row()){
                              $i++;



    										 ?>
    										 <tr>
    											 <td><?php echo $i; ?></td>
    											 <td><?php echo $row[8];  ?></td>
                           <td><?php echo $row[3];echo " <br>"; echo $row[5]; ?></td>
                           <?php
                              $statement=$db->prepare("select * from tbl_rooms where id='$row[10]'");
                              $statement->execute();
                              $vTemp = $statement->fetchAll();
                              if (count($vTemp) > 0) {
                              $values=$vTemp[0];
                              ?>
                              <td><?php echo $values[1]; ?></td>
                              <?php
                            } else {echo "<td></td>";}
                            ?>

    											 <?php
                                 if ($row[9]==0) {
                                 ?>
                                 <form class="" action="Application_accept.php" method="post">
                                   <td><button class="btn btn-danger" type="submit" name="verifiedId" value="<?php echo $row[0];
                                    ?>">pending</button>
                                   </td>
                                 </form>

    														 <?php
    														}else {
    															?>
    															<td> <input class="btn btn-success" type="button" name="" value="Accepted"></td>
    															<?php
    														}
                                    ?>
                                <form class="" action="Application_delete.php" method="post">
                                  <td><button class="btn btn-danger" type="submit" name="verifiedId" value="<?php echo $row[0];
                                   ?>">Delete</button>
                                  </td>
                                </form>
    										 </tr>

    <?php
    }
     ?>
    								<?php
    						 }else {
    							 ?>
    							 <tr>
    							 	<td></td>
    								<td> no Application Here</td>
    							 </tr>

    							 <?php
    						 }
    			// mysqli_free_result($result);
    	 }
    				 ?>

    	</table>
    </div>
    	</div>

  </div>
</div>
<?php include("footer.php"); ?>
