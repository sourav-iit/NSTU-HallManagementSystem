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
  <h2>View  All Employees</h2>

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
    <table class="table table-bordered table-hover table-responsive">
      <tr>
        <th>Serial</th>
        <th>Name</th>
        <th>Job</th>
        <th>Address</th>
        <th>Phone</th>
      </tr>

      <?php
      $i = 0;
      $statement = $db->prepare("SELECT * FROM tbl_employee ORDER BY name ASC");
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row) {
        $i++;
        ?>

        <tr>
          <td><?= $i; ?></td>
          <td><?= $row['name']; ?></td>
          <td><?= $row['job']; ?></td>
          <td><?= $row['address']; ?></td>
          <td><?= $row['phone']; ?></td>
          <td>
            <a class="btn btn-info fancybox" href="#viewModal<?= $i; ?>" data-toggle="modal">View</a>

            <div id="viewModal<?= $i; ?>" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">View Employee Informations</h4>
                  </div>
                  <div class="modal-body">
                    <p><strong>Name : </strong> <?= $row['name']; ?></p>
                    <p><strong>Job : </strong> <?= $row['job']; ?></p>
                    <p><strong>Address : </strong> <?= $row['address']; ?></p>

                    <img src="../images/employees/<?= $row['image']; ?>" alt="" style="width: 200px">

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  </div>
                </div>

              </div>
            </div>


            <a class="btn btn-success" href="edit_employee.php?id=<?= $row['id']; ?>">Edit</a>

            <a class="btn btn-danger" onclick='return confirmDeleteDoctor();' href="delete_employee.php?id=<?= $row['id']; ?>">Delete</a>
          </td>
        </tr>
      <?php } ?>

    </table>
  </div>
</div>
<?php include("footer.php"); ?>
