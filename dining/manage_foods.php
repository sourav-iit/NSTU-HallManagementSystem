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
      throw new Exception('Food name can not be empty');
    }
    if (empty($_POST['price'])) {
      throw new Exception('Food price can not be empty');
    }

    $statement = $db->prepare("select * from tbl_foods where name=?");
    $statement->execute(array($_POST['name']));
    $total_cat = $statement->rowCount();
    if ($total_cat > 0) {
      throw new Exception("Sorry..!! Food has already exists");
    }

    $statement = $db->prepare("insert into tbl_foods (name,price) values(?,?)");
    $statement->execute(array($_POST['name'],$_POST['price']));
    $success_message = 'Food has been added successfully.';
  } catch (Exception $e) {
    $error_message = $e->getMessage();
  }
}
?>
<?php
if (isset($_POST['form2'])) {
  try {
    if (empty($_POST['name'])) {
      throw new Exception('Food name can not be empty');
    }elseif (empty($_POST['price'])) {
        throw new Exception('price can not be empty');
    }

    $statement = $db->prepare("UPDATE tbl_foods SET name=?,price=? where id=?");
    $statement->execute(array($_POST['name'],$_POST['price'], $_POST['hdn']));

    $success_message2 = 'Food Item has been updated successfully.';
  } catch (Exception $e) {
    $error_message = $e->getMessage();
  }
}
?>
<?php
if (isset($_REQUEST['id'])) {

  $id = $_REQUEST['id'];

  $statement = $db->prepare("DELETE FROM tbl_foods where id=?");
  $statement->execute(array($id));

  $success_message_delete = 'Food Item has deleted successfully';
}
?>
<?php include("header.php"); ?>
<!---Content Part -->

<div class="col-sm-9 col-md-9 col-lg-9">
  <div id="content">
    <h2>Manage Meals</h2><hr />
    <div class="wrapper-manage-Room">
      <div class="well">
        <form class="form-horizontal" role="form" action="" method="post">
          <div class="form-group">
            <label class="control-label col-sm-2" for="name">Food Name:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="name">Price:</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="size" name="price" placeholder="Enter price" value="10 Tk">
            </div>
          </div>


          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" name="form1" class="btn btn-default">Add Food</button>
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
      <table class="table table-responsive table-striped table-bordered">
        <tr id="mang-tbl-header">
          <th>No</th>
          <th>Food Name</th>
          <th>price</th>
          <th >Action</th>
        </tr>
        <?php
        $i = 0;
        $statement = $db->prepare("SELECT * FROM tbl_foods ORDER BY name DESC");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
          $i++;
          ?>
          <tr>
            <td><?= $i; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['price']; ?></td>
            <td><a class="btn btn-success" data-toggle="modal" href="#editModal<?= $i; ?>" > Edit </a>

              <!-- Edit Modal -->
              <div id="editModal<?= $i; ?>" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Edit Food</h4>
                    </div>
                    <div class="modal-body">
                      <form action="" method="post">
                        <input type="hidden" name="hdn" value="<?= $row['id']; ?>">
                        <label for="">Name</label><br>
                        <input id="footer-change-text" class="form-control" name="name" type="text" value="<?= $row['name'] ?>"/>

                        <br>




                        <label for="">price</label><br>
                        <input id="footer-change-text" class="form-control" name="price" type="number" value="<?= $row['price'] ?>"/>

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


              <a class="btn btn-danger" onclick='return confirmDeleteRoom();' href="manage_foods.php?id=<?= $row['id']; ?>">Delete
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
