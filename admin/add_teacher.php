<?php
//ob_start();
session_start();
//if ($_SESSION['name'] != 'admin') {
//  header('location: login.php');
//}
include("../config.php");
?>
<?php
if (isset($_POST['form_post_publish'])) {
  try {
    if (empty($_POST['name'])) {
      throw new Exception('Name can not be empty');
    } else if (empty($_POST['email'])) {
      throw new Exception('Email can not be empty');
    }
    else if (empty($_POST['work'])) {
      throw new Exception('work can not be empty');
    }
    else if (empty($_POST['phone'])) {
      throw new Exception('phone must be needed');
    }
    $statement = $db->prepare("insert into tbl_teachers (name,email,work, phone) values(?,?,?,?)");
    $statement->execute(array($_POST['name'], $_POST['email'],$_POST['work'], $_POST['phone']));
    $success_message = 'Teacher has added successfully.';
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
    <h2>Add a new Teacher</h2>
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
        <tr><th>Teacher Name </th></tr>
        <tr><td><input type="text" name="name" class="form-control"/></td></tr>
<!--
		<tr><th>Registration number </th></tr>
        <tr><td><input type="text" name="registration_no" class="form-control"/> </td></tr>
-->
        <tr><th>E-mail </th></tr>
            <tr><td><input type="text" name="email" class="form-control"/> </td></tr>
            <tr><th>At Work </th></tr>
                <tr><td><input type="text" name="work" class="form-control"/> </td></tr>
		<tr><th>phone </th></tr>
        <tr><td><input type="number" name="phone" class="form-control"/> </td></tr>

      <tr><td><input type="submit" class="btn btn-success" name="form_post_publish" value="Add Doctor" /></td></tr>
    </table>

  </form>
</div>
</div>


<?php
include('footer.php');
?>
