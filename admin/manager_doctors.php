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
      throw new Exception('Doctor name can not be empty');
    }
     if(empty($_POST['email'])) {
      throw new Exception('Email can not be empty');
    }if(empty($_POST['phone'])) {
    throw new Exception('phone can not be empty');
  }if(empty($_POST['specialist'])) {
  throw new Exception('specialist can not be empty');
}

    $statement = $db->prepare("select * from tbl_doctors where email=?");
    $statement->execute(array($_POST['email']));
    $total_cat = $statement->rowCount();
    if ($total_cat > 0) {
      throw new Exception("Sorry..!! teacher has already exists");
    }

    $statement = $db->prepare("insert into tbl_doctors (name,email,specialist,phone) values(?,?,?,?)");
    $statement->execute(array($_POST['name'],$_POST['email'],$_POST['specialist'],$_POST['phone']));
    $success_message = 'Doctor has been added successfully.';
  } catch (Exception $e) {
    $error_message = $e->getMessage();
  }
}
?>
<?php
if (isset($_POST['form2'])) {
  try {
    if (empty($_POST['name'])) {
      throw new Exception('Teacher name can not be empty');
    }
     if(empty($_POST['email'])) {
      throw new Exception('Email can not be empty');
    }if(empty($_POST['specialist'])) {
     throw new Exception('specialist can not be empty');
   }if(empty($_POST['phone'])) {
    throw new Exception('phone can not be empty');
  }

    $statement = $db->prepare("UPDATE tbl_doctors SET name=?,email=?,specialist=?,phone=? where id=?");
    $statement->execute(array($_POST['name'],$_POST['email'],$_POST['specialist'],$_POST['phone'], $_POST['hdn']));

    $success_message2 = 'Doctor Info has been updated successfully.';
  } catch (Exception $e) {
    $error_message = $e->getMessage();
  }
}
?>
<?php
if (isset($_REQUEST['id'])) {

  $id = $_REQUEST['id'];

  $statement = $db->prepare("DELETE FROM tbl_doctors where id=?");
  $statement->execute(array($id));

  $success_message_delete = 'Doctor record has deleted successfully';
}
?>
<?php include("header.php"); ?>
<!---Content Part -->

<div class="col-sm-9 col-md-9 col-lg-9">
  <div id="content">
    <h2>Manage Doctors</h2><hr />
    <div class="wrapper-manage-Room">
      <div class="well">
        <form class="form-horizontal" role="form" action="" method="post">
          <div class="form-group">
            <label class="control-label col-sm-2" for="name">Doctor Name:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="name">E-Mail:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="email" name="email" placeholder="Enter e-mail">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="name">specialist:</label>
            <div class="col-sm-10">
              <select class="form-control" name="specialist">
                <option value="">select</option>
                <option value="medicine">medicine</option>
                <option value="neurologist">neurologist</option>
                 <option value="urologist">urologist</option>
                 <option value="prediatric">prediatric</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="name">Phone:</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="number" name="phone" placeholder="Enter personal contact">
            </div>
          </div>


          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" name="form1" class="btn btn-default">Add Doctor</button>
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
          <th>Doctor Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th >Action</th>
        </tr>
        <?php
        $i = 0;
        $statement = $db->prepare("SELECT * FROM tbl_doctors ORDER BY name DESC");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
          $i++;
          ?>
          <tr>
            <td><?= $i; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['phone']; ?></td>
            <td><a class="btn btn-success" data-toggle="modal" href="#editModal<?= $i; ?>" > Edit </a>

              <!-- Edit Modal -->
              <div id="editModal<?= $i; ?>" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Edit Doctor Info</h4>
                    </div>
                    <div class="modal-body">
                      <form action="" method="post">
                        <input type="hidden" name="hdn" value="<?= $row['id']; ?>">
                        <label for="">Name</label><br>
                        <input id="footer-change-text" class="form-control" name="name" type="text" value="<?= $row['name'] ?>"/>

                        <label for="">E-mail</label><br>
                        <input id="footer-change-text" class="form-control" name="email" type="text" value="<?= $row['email'] ?>"/>
                        <label for="">Specialist</label><br>
                        <select class="form-control" name="specialist">
                          <?php
                          $medicine="";
                          $neurologist="";
                          $urologist="";
                          $prediatric="";
                             if (strcmp($row['specialist'],"medicine")==0) {
                                $medicine="selected";
                             }elseif (strcmp($row['specialist'],"neurologist")==0) {
                              $neurologist="selected";
                            }elseif (strcmp($row['specialist'],"urologist")==0) {
                              $urologist="selected";
                            }elseif (strcmp($row['specialist'],"prediatric")==0) {
                              $prediatric="selected";
                             }

                           ?>
                          <option value="">select</option>
                          <option value="medicine" <?php echo $medicine; ?> >medicine</option>
                          <option value="neurologist" <?php echo $neurologist; ?>>neurologist </option>
                           <option value="urologist" <?php echo $urologist; ?>>urologist</option>
                           <option value="prediatric" <?php echo $prediatric; ?>>prediatric </option>
                        </select>
                        <label for="">Phone</label><br>
                        <input id="footer-change-text" class="form-control" name="phone" type="number" value="<?= $row['phone'] ?>"/>
                        <input  class="btn btn-success" style="margin-top: 10px;"  name="form2" type="submit" value="Update"/>

                      </form>


                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>

                </div>
              </div>


              <a class="btn btn-danger" onclick='return confirmDeleteRoom();' href="manager_doctors.php?id=<?= $row['id']; ?>">Delete
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
