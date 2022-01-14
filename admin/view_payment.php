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
  <div id="content">
    <h2>View  All Payments</h2>

    <table class="table table-bordered table-hover table-responsive">
      <tr>
        <th>Serial</th>
        <th>Name</th>
        <th>Student ID</th>
        <th>Faculty</th>
        <th>Semester</th>
        <th>Action</th>
      </tr>

      <?php
      $i = 0;
      $statement = $db->prepare("SELECT * FROM tbl_payment ORDER BY name DESC");
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row) {
        $i++;
        ?>

        <tr>
          <td><?= $i; ?></td>
          <td><?= $row['name']; ?></td>
          <td><?= $row['student_id']; ?></td>
          <td><?= $row['faculty']; ?></td>
          <td><?= $row['semester']; ?></td>
          <td>
            <a class="btn btn-info fancybox" href="#viewModal<?= $i; ?>" data-toggle="modal">View</a>

            <div id="viewModal<?= $i; ?>" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">View Payment Informations</h4>
                  </div>
                  <div class="modal-body">
                    
                      <p><strong>Name : </strong> <?= $row['name']; ?></p>
                      <p><strong>Student Id : </strong> <?= $row['student_id']; ?></p>
                      <p><strong>Registration No : </strong> <?= $row['registration_no']; ?></p>
                      <p><strong>Faculty : </strong> <?= $row['faculty']; ?></p>
                      <p><strong>Phone : </strong> <?= $row['phone']; ?></p>
                      <p><strong>Email : </strong> <?= $row['email']; ?></p>
                      <p><strong>Session : </strong> <?= $row['session']; ?></p>
                      <p><strong>Semester : </strong> <?= $row['semester']; ?></p>
                      <p><strong>Amount : </strong> <span class="label label-info" style="font-size: 15px"><?= $row['amount']; ?></span></p>
                      <p><strong>Transaction Id : </strong><span class="label label-success" style="font-size: 15px"><?= $row['transaction_id']; ?></span> </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                  </div>
                </div>

              </div>
            </div>

            
            <a class="btn btn-danger" onclick='return confirmDeleteDoctor();' href="delete_payment.php?id=<?= $row['id']; ?>">Delete</a>

            <?php
                        if ($row['is_verified'] == 0) {
                            ?>
                            <a class="btn btn-warning" name="verify" href="approve_payment.php?id=<?= $row['id']; ?>">Confirm</a>
                            <?php
                        } else {
                            ?>
                            <a class="disabled" style="color: green; text-decoration: none">
                                Confirmed
                            </a>
                            <?php
                        }
                        ?>
          </td>
        </tr>
      <?php } ?>

    </table>
  </div>
</div>
<?php include("footer.php"); ?>
