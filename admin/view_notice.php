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

    <h2>View  All Notices</h2>
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

    <table class="table table-bordered table-hover table-responsive" width="100%">
      <tr style="background-color: #0D7B7B;color: #FFF;height: 40px;">
        <th>Serial</th>
        <th>Title</th>
        <th>date</th>
        <th>Action</th>
      </tr>

      <?php
      $i = 0;
      if (isset($_POST['search'])) {
        $searchVal=$_POST['val'];

        $statement = $db->prepare("SELECT * FROM tbl_notices where title LIKE '%{$searchVal}%' or time LIKE '%{$searchVal}%'");
        $statement->execute();
      }else{

        $statement = $db->prepare("SELECT * FROM tbl_notices ORDER BY id DESC");
        $statement->execute();
      }

      $result = $statement->fetchAll(PDO::FETCH_ASSOC);

      foreach ($result as $row) {
        $i++;
        ?>

        <tr>
          <td><?= $i; ?></td>
          <td><?= $row['title']; ?></td>
          <td><?php echo $row['time']; ?></td>
          <td>
            <a class="btn btn-info" data-toggle="modal" href="#inline<?= $i; ?>">View</a>
            <div id="inline<?= $i; ?>" class="modal fade" role="dialog">
              <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">View Student</h4>
                  </div>
                  <div class="modal-body">
                    <div>
                      <h3 style="border-bottom: 4px solid rgba(15, 46, 46, 0.85);background-color: #428bca;margin-bottom: 15px;padding: 10px;">View All Data</h3>
                      <p>
                        <form action="" method="post">
                          <table>
                            <tr>
                              <td><b>Title</b></td>
                            </tr>
                            <tr>
                              <td><?= $row['title']; ?></td>
                            </tr>
                            <tr>
                              <td><b>Description</b></td>
                            </tr>
                            <tr>
                              <td><?= $row['description']; ?></td>
                            </tr>
                            <tr>
                              <td><a class="btn btn-info" href="edit_notice.php?id=<?= $row['id']; ?>">Edit</a></td>
                            </tr>
                          </table>
                        </form>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <a class="btn btn-success" href="edit_notice.php?id=<?= $row['id']; ?>">Edit</a>

            <a class="btn btn-danger" onclick='return confirm("Do you want to delete the notice ?");' href="delete_notice.php?id=<?= $row['id']; ?>">Delete</a>
          </td>
        </tr>


        <?php
      }
      ?>




    </table>
  </div>
</div>
<?php include("footer.php"); ?>
