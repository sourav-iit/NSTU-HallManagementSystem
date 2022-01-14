<?php
ob_start();
session_start();
if ($_SESSION['name'] != 'admin') {
  header('location: login.php');
}
include '../config.php';

?>
<?php
if (isset($_POST['form1'])) {
  try {
    if (empty($_POST['name'])) {
      throw new Exception('Room name can not be empty');
    }
    if (empty($_POST['block'])) {
      throw new Exception('Room block name can not be empty');
    }
    if (empty($_POST['size'])) {
      throw new Exception('Room Size can not be empty');
    }if ($_POST['size']<=0) {
      throw new Exception('Room Size can not negative');
    }

    $statement = $db->prepare("select * from tbl_rooms where name=? and block=?");
    $statement->execute(array($_POST['name'],$_POST['block']));
    $total_cat = $statement->rowCount();
    if ($total_cat > 0) {
      throw new Exception("Sorry..!! Room name has already exists");
    }

    $statement = $db->prepare("insert into tbl_rooms (name, block,size) values(?,?,?)");
    $statement->execute(array($_POST['name'], $_POST['block'],$_POST['size']));
    $success_message = 'Room has been added successfully.';
  } catch (Exception $e) {
    $error_message = $e->getMessage();
  }
}
?>
<?php
if (isset($_POST['form2'])) {
  try {
    if (empty($_POST['name'])) {
      throw new Exception('Room name can not be empty');
    }elseif (empty($_POST['size'])) {
        throw new Exception('Room size can not be empty');
    }

    $statement = $db->prepare("UPDATE tbl_rooms SET name=?,block=?,size=? where id=?");
    $statement->execute(array($_POST['name'],$_POST['block'],$_POST['size'], $_POST['hdn']));

    $success_message2 = 'Room name has been updated successfully.';
  } catch (Exception $e) {
    $error_message = $e->getMessage();
  }
}
?>
<?php
if (isset($_REQUEST['id'])) {

  $id = $_REQUEST['id'];

  $statement = $db->prepare("DELETE FROM tbl_rooms where id=?");
  $statement->execute(array($id));

  $success_message_delete = 'Room has deleted successfully';
}
?>
<?php include("header.php"); ?>
<!---Content Part -->

<div class="col-sm-9 col-md-9 col-lg-9">
  <div id="content">
    <h2>Manage Rooms</h2><hr />
    <div class="wrapper-manage-Room">
      <div class="well">
        <form class="form-horizontal" role="form" action="" method="post">
          <div class="form-group">
            <label class="control-label col-sm-2" for="name">Room Name:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="name">Room Size:</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="size" name="size" placeholder="Enter Room size" value="3">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="name">Block:</label>
            <div class="col-sm-10">
              <select class="form-control" name="block">
                <option value="A">Block A</option>
                <option value="B">Block B</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" name="form1" class="btn btn-default">Add Room</button>
            </div>
          </div>
        </form>


      </div>


      <?php
      if (isset($success_message2)) {
        echo "<div class='success'>" . $success_message2 . '</div>';
      }
      ?>
      <?php
      if (isset($success_message_delete)) {
        echo "<div class='success'>" . $success_message_delete . '</div>';
      }
      ?>
	  <?php
      if (isset($error_message)) {
        echo "<div class='alert alert-danger'>" . $error_message . '</div>';
      }
      ?>
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
      <table class="table table-responsive table-striped table-bordered">
        <tr id="mang-tbl-header">
          <th>Serial</th>
          <th>Block Name</th>
          <th>Room name</th>
          <th>Totall Seat</th>
          <th >Action</th>
        </tr>
        <?php
        $i = 0;
        if (isset($_POST['search'])) {
          $searchVal=$_POST['val'];

          $statement=$db->prepare("SELECT * FROM tbl_rooms where name LIKE '%{$searchVal}%' or size='$searchVal'  or block='$searchVal'");
          $statement->execute();
          //$result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }else{

          $statement = $db->prepare("SELECT * FROM tbl_rooms ORDER BY name DESC");
          $statement->execute();
        }

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
          $i++;
          ?>
          <tr>
            <td><?= $i; ?></td>
            <td><?= $row['block']; ?></td>
            <td><?= $row['name']; ?></td>
              <td><?= $row['size']; ?></td>
            <td><a class="btn btn-success" data-toggle="modal" href="#editModal<?= $i; ?>" > Edit </a>

              <!-- Edit Modal -->
              <div id="editModal<?= $i; ?>" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Edit Room</h4>
                    </div>
                    <div class="modal-body">
                      <form action="" method="post">
                        <input type="hidden" name="hdn" value="<?= $row['id']; ?>">
                        <label for="">Name</label><br>
                        <input id="footer-change-text" class="form-control" name="name" type="text" value="<?= $row['name'] ?>"/>

                        <br>

                        <div class="form-group">
                          <label class="control-label col-sm-2" for="name">Block:</label>
                          <div class="col-sm-10">
                            <select class="form-control" name="block">
                              <option value="A"  <?= $row['block'] == 'A' ? 'selected' : '' ?>>Block A</option>
                              <option value="B" <?= $row['block'] == 'B' ? 'selected' : '' ?>>Block B</option>
                            </select>
                          </div>
                        </div>


                        <label for="">Size</label><br>
                        <input id="footer-change-text" class="form-control" name="size" type="number" value="<?= $row['size'] ?>"/>

                        <br>
                        <input  class="btn btn-success" style="margin-top: 10px;"  name="form2" type="submit" value="Update"/>

                      </form>


                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>

                </div>
              </div>


              <a class="btn btn-danger" onclick='return confirmDeleteRoom();' href="manage_rooms.php?id=<?= $row['id']; ?>">Delete
              </a>
            </td>
          </tr>
          <?php
        }
        ?>
      </table>
    </div>
  </div>
</div>
<?php include("footer.php"); ?>
