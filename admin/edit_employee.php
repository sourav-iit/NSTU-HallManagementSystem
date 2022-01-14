<?php
ob_start();
session_start();
if ($_SESSION['name'] != 'admin') {
  header('location: login.php');
}
include("../config.php");
?>
<?php
if (!isset($_REQUEST['id'])) {
  header("location: view-post.php");
} else {
  $id = $_REQUEST['id'];
}
?>



<!--  Update start -->
<?php
if (isset($_POST['form_update_post'])) {
  try {
    if (empty($_POST['name'])) {
      throw new Exception('Name can not be empty');
    } else if (empty($_POST['job'])) {
      throw new Exception('Job can not be empty');
    }
    else if (empty($_POST['address'])) {
      throw new Exception('Address can not be empty');
    }
    else if (empty($_POST['phone'])) {
      throw new Exception('Phone no can not be empty');
    }


    /* --------------- Image ----------------------- */
    if (empty($_FILES["image"]["name"])) {
      $statement = $db->prepare("UPDATE tbl_employee SET name=?, job=?, address=?, phone=? where id=?");
      $statement->execute(array($_POST['name'], $_POST['job'],$_POST['address'], $_POST['phone'],  $id));
    } else {

      //Find out the image extension form the image
      $up_fileName = $_FILES["image"]["name"];
      $file_baseName = substr($up_fileName, 0, strripos($up_fileName, '.'));      //get image or file names
      $file_ext = substr($up_fileName, strripos($up_fileName, '.'));             //get image or file extension name
      $image_name = $id . $file_ext; //name the new file like id.jpg or 2.png etc.
      //check the image extension if the image is jpg,png,gif or jpeg


      //
      // if (($file_ext != '.png') && ($file_ext != '.jpg') && ($file_ext != '.jpeg') && ($file_ext != '.gif')) {
      //   throw new Exception("Only jpg,jpeg,png and gif images are allowed");
      // }


      $statement1 = $db->prepare("SELECT * FROM tbl_employee WHERE id=?");
      $statement1->execute(array($id));
      $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);

      foreach ($result1 as $row1) {
        if ($row1['image'] != NULL) {
          $real_path = "../images/employees/" . $row1['image'];
          unlink($real_path); //Delete the existing image
        }
      }

      //newly inserted images
      move_uploaded_file($_FILES["image"]["tmp_name"], "../images/employees/" . $image_name);

      $statement = $db->prepare("UPDATE tbl_employee SET name=?, job=?, address=?, phone=? where id=?");
      $statement->execute(array($_POST['name'], $_POST['job'],$_POST['address'], $_POST['phone'],  $id));
    }
          header("location: view_employee.php");
    //$success_message = 'Employee has updated successfully.';
  } catch (Exception $e) {
    $error_message = $e->getMessage();
  }
}
?>

<!---  Update finish --->

<?php
$statement = $db->prepare("SELECT * FROM tbl_employee WHERE id=?");
$statement->execute(array($id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
  $name = $row['name'];
  $job = $row['job'];
  $address = $row['address'];
  $phone = $row['phone'];
  $image = $row['image'];
}
?>


<?php
include('header.php');
?>

<!---Content Part --->
<div class="col-sm-9 col-md-9 col-lg-9">
  <div id="content">
    <div class="wrapper-edit-post">
      <h2>Update Emlpoyee Informations</h2>
      <?php
      if (isset($success_message)) {
        echo "<div class='success'>" . $success_message . '</div>';
      }
      if (isset($error_message)) {
        echo "<div class='error'>" . $error_message . '</div>';
      }
      ?>
      <form action="edit_employee.php?id=<?= $id; ?>" method="post" enctype="multipart/form-data">

        <table class="table table-hover table-bordered">

          <tr><th>Employee Name </th></tr>
          <tr><td><input type="text" name="name" class="form-control" value="<?= $name ?>"/> </td></tr>

          <tr><th>Job </th></tr>
          <tr><td><input type="text" name="job" class="form-control" value="<?= $job ?>"/> </td></tr>

          <tr><th>Address </th></tr>
          <tr><td><input type="text" name="address" class="form-control" value="<?= $address ?>"/> </td></tr>

          <tr><th>Phone </th></tr>
          <tr><td><input type="text" name="phone" class="form-control" value="<?= $phone ?>"/> </td></tr>

          <tr><th>Update Image </th></tr>
          <tr><th>Old Image </th></tr>
          <tr><th><img src="../images/employees/<?= $image ?>" class="img img-thumbnail img-responsive"> </th></tr>
          <tr><th>New Image </th></tr>

          <tr><td><input type="file" name="image" /> </td></tr>

        <tr><td><input type="submit" class="btn btn-success" name="form_update_post" value="Update Employee" /></td></tr>
      </table>

    </form>
  </div>
</div>
</div>


<?php
include('footer.php');
?>
