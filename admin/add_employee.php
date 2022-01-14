<?php
ob_start();
session_start();
if ($_SESSION['name'] != 'admin') {
  header('location: login.php');
}
include("../config.php");
?>
<?php
if (isset($_POST['form_post_publish'])) {
  try {
    if (empty($_POST['name'])) {
      throw new Exception('Name can not be empty');
    } else if (empty($_POST['job'])) {
      throw new Exception('Job can not be empty');
    } else if (empty($_POST['address'])) {
      throw new Exception('Address name can not be empty');
    }

    /* --------------- Image ----------------------- */

    //Get the next autoincrement ID by PDO method for naming my image as my id_name because ID is unique
    $statement = $db->prepare("SHOW TABLE STATUS LIKE 'tbl_employee'");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
      $new_id = $row[10];             //Make next increment id for images naming
    }

    //Find out the image extension form the image
    $up_fileName = $_FILES["image"]["name"];
    $file_baseName = substr($up_fileName, 0, strripos($up_fileName, '.')); //get image or file names
    $file_ext = substr($up_fileName, strripos($up_fileName, '.'));             //get image or file extension name
    $image_name = $new_id . $file_ext; //name the new file like id.jpg or 2.png etc.
    //check the image extension if the image is jpg,png,gif or jpeg

    // if (($file_ext != '.png') || ($file_ext != '.jpg') || ($file_ext != '.jpeg') || ($file_ext != '.gif')) {
    //   throw new Exception("Only jpg,jpeg,png and gif images are allowed");
    // }
    //move image to my upload folder
    move_uploaded_file($_FILES["image"]["tmp_name"], "../images/employees/" . $image_name);
    /* --------------- Image finish ----------------------- */

    //Make here the inserted code of the post to the directory

    $statement = $db->prepare("insert into tbl_employee (name, job, address, phone, image) values(?,?,?,?,?)");
    $statement->execute(array($_POST['name'], $_POST['job'], $_POST['address'], $_POST['phone'], $image_name ));



    $success_message = 'Employee has added successfully.';
  } catch (Exception $e) {
    $error_message = $e->getMessage();
  }
}
?>


<?php
include('header.php');
?>

<!---Content Part -->
<div class="col-sm-9 col-md-9 col-lg-9">
  <div id="content">
    <h2>Add new employee</h2>
    <?php
    if (isset($error_message)) {
      echo "<div class='error'>" . $error_message . '</div>';
    }
    ?>
    <?php
    if (isset($success_message)) {
      echo "<div class='success'>" . $success_message . '</div>';
    }
    ?>
    <form action="" method="post" enctype="multipart/form-data">

      <table class="tbl1">
        <tr><th>Employee Name </th></tr>
        <tr><td><input type="text" name="name" class="form-control"/> </td></tr>

        <tr><th>Job </th></tr>
        <tr><td><input type="job" name="job" class="form-control"/> </td></tr>

        <tr><th>Address </th></tr>

        <tr><td><input type="text" name="address" class="form-control"/> </td></tr>


        <tr><th>Phone </th></tr>
        <tr><td><input type="text" name="phone" class="form-control"/> </td></tr>



        <tr><th>Add a featured Image </th></tr>
        <tr><td><input type="file" name="image" /> </td></tr>


      <tr><td><input type="submit" class="btn btn-success" name="form_post_publish" value="Add Employee" /></td></tr>
    </table>

  </form>
</div>
</div>


<?php
include('footer.php');
?>
