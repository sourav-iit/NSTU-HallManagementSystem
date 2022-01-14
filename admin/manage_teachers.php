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
      throw new Exception('Teacher name can not be empty');
    }
     if(empty($_POST['email'])) {
      throw new Exception('Email can not be empty');
    }if(empty($_POST['work'])) {
     throw new Exception('work can not be empty');
   }if(empty($_POST['phone'])) {
    throw new Exception('phone can not be empty');
  }

    $statement = $db->prepare("select * from tbl_teachers where phone=?");
    $statement->execute(array($_POST['phone']));
    $total_cat = $statement->rowCount();
    if ($total_cat > 0) {
      throw new Exception("Sorry..!! teacher has already exists");
    }

    $statement = $db->prepare("insert into tbl_teachers (name,email,work,phone) values(?,?,?,?)");
    $statement->execute(array($_POST['name'],$_POST['email'],$_POST['work'],$_POST['phone']));
    $success_message = 'Teacher has been added successfully.';
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
    }if(empty($_POST['work'])) {
     throw new Exception('work can not be empty');
   }if(empty($_POST['phone'])) {
    throw new Exception('phone can not be empty');
  }

    $statement = $db->prepare("UPDATE tbl_teachers SET name=?,email=?,work=?,phone=? where id=?");
    $statement->execute(array($_POST['name'],$_POST['email'],$_POST['work'],$_POST['phone'], $_POST['hdn']));

    $success_message2 = 'Teacher Info has been updated successfully.';
  } catch (Exception $e) {
    $error_message = $e->getMessage();
  }
}
?>
<?php
if (isset($_REQUEST['id'])) {

  $id = $_REQUEST['id'];

  $statement = $db->prepare("DELETE FROM tbl_teachers where id=?");
  $statement->execute(array($id));

  $success_message_delete = 'Teacher record has deleted successfully';
}
?>
<?php include("header.php"); ?>
<!---Content Part -->

<div class="col-sm-9 col-md-9 col-lg-9">
  <div id="content">
    <h2>Manage Teachers</h2><hr />
    <div class="wrapper-manage-Room">
      <div class="well">
        <form class="form-horizontal" role="form" action="" method="post">
          <div class="form-group">
            <label class="control-label col-sm-2" for="name">Teacher Name:</label>
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
            <label class="control-label col-sm-2" for="name">At Work:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="work" name="work" placeholder="Enter working Dept">
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
              <button type="submit" name="form1" class="btn btn-default">Add Teacher</button>
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
          <th>No</th>
          <th>Teacher Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th >Contact</th>
        </tr>
        <?php
        $i = 0;
        if (isset($_POST['search'])) {
          $searchVal=$_POST['val'];

          $statement=$db->prepare("SELECT * FROM tbl_teachers where name LIKE '%{$searchVal}%' or email='$searchVal'  or work='$searchVal' or phone='$searchVal'");
          $statement->execute();
          //$result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }else{

          $statement = $db->prepare("SELECT * FROM tbl_teachers ORDER BY name DESC");
          $statement->execute();
        }

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
                      <h4 class="modal-title">Edit Teacher Info</h4>
                    </div>
                    <div class="modal-body">
                      <form action="" method="post">
                        <input type="hidden" name="hdn" value="<?= $row['id']; ?>">
                        <label for="">Name</label><br>
                        <input id="footer-change-text" class="form-control" name="name" type="text" value="<?= $row['name'] ?>"/>

                        <label for="">E-mail</label><br>
                        <input id="footer-change-text" class="form-control" name="email" type="text" value="<?= $row['email'] ?>"/>
                        <label for="">At Work</label><br>
                        <input id="footer-change-text" class="form-control" name="work" type="text" value="<?= $row['work'] ?>"/><br>

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


              <a class="btn btn-danger" onclick='return confirmDeleteRoom();' href="manage_teachers.php?id=<?= $row['id']; ?>">Delete
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
