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
    <h2>View  All problem</h2>
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
    	<table id="data" class="table table-bordered table-hover table-responsive">
    		<tr style="background-color: #0D7B7B;color: #FFF;height: 40px;">
    				<th width="5%" style="text-align: center; border-right: 1px solid #FFF;">No.</th>
            <th width="15%" style="text-align: center; border-right: 1px solid #FFF;">Name</th>
    				<th width="60%" style="text-align: center; border-right: 1px solid #FFF;">Dsscription</th>
    				<th width="40%" style="text-align: center; border-right: 1px solid #FFF;">E-mail</th>
    				<th width="15%" style="text-align: center; ">Stage</th>
    		</tr>
    		<?php
    		$i = 0;
        $connection = mysqli_connect("localhost", "root","","hall");
        if (isset($_POST['search'])) {
          $searchVal=$_POST['val'];

          $query="SELECT * FROM tbl_problems where description LIKE '%{$searchVal}%' or name='%{$searchVal}%'";
        }else{
              $query = "SELECT * FROM tbl_problems ORDER BY id DESC ";
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
                           <td><?php echo $row[3]; ?></td>
    											 <td><?php echo $row[1]; ?></td>
                           <?php
                              $statement=$db->prepare("select * from tbl_student where id='$row[2]'");
                              $statement->execute();
                              $vTemp = $statement->fetchAll();
                              if (count($vTemp) > 0) {
                              $values=$vTemp[0];
                              ?>
                              <td><?php echo $values[3]; ?></td>
                              <?php
                            } else {echo "<td></td>";}
                            ?>

    											 <?php
                                 if ($row[4]==0) {
                                 ?>
                                 <form class="" action="problem_solved.php" method="post">
                                   <td><button class="btn btn-danger" type="submit" name="verifiedId" value="<?php echo $row[0]; ?>">pending</button></td>
                                 </form>

    														 <?php
    														}else {
    															?>
    															<td> <input class="btn btn-success" type="button" name="" value="verified"></td>
    															<?php
    														}
    											  ?>
    										 </tr>

    <?php
    }
     ?>
    								<?php
    						 }else {
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
    	</div>

  </div>
</div>
<script>
$(document).ready (function () {
    $('#data').after ('<div id="nav"></div>');
    var rowsShown = 11;
    var rowsTotal = $('#data tbody tr').length;
    var numPages = rowsTotal/rowsShown;
    for (i = 0;i < numPages;i++) {
        var pageNum = i + 1;
        $('#nav').append ('<a href="#" rel="'+i+'">'+pageNum+'</a> ');
    }
    $('#data tbody tr').hide();
    $('#data tbody tr').slice (0, rowsShown).show();
    $('#nav a:first').addClass('active');
    $('#nav a').bind('click', function() {
    $('#nav a').removeClass('active');
   $(this).addClass('active');
        var currPage = $(this).attr('rel');
        var startItem = currPage * rowsShown;
        var endItem = startItem + rowsShown;
        $('#data tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
        css('display','table-row').animate({opacity:1}, 300);
    });
});
</script>
<?php include("footer.php"); ?>
