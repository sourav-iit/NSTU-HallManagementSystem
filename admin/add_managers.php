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
    }
    else if (empty($_POST['password'])) {
      throw new Exception('password needed for manager next login into NSTU Hall system');
    }
    else if (empty($_POST['email'])) {
      throw new Exception('Email address needed');
    }else if (empty($_POST['phone_no'])) {
      throw new Exception('Mobile Number needed');
    }

    $statement = $db->prepare("insert into tbl_managers (name, email, phone_no) values(?,?,?)");
    $statement->execute(array( $_POST['name'],$_POST['email'],$_POST['phone_no']));
    $statement1 = $db->prepare("insert into tbl_managerlogin (email, password) values(?,?)");
    $statement1->execute(array($_POST['email'], $_POST['password']));




    $success_message = 'manager has added successfully.';
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
    <h2>Add a new Manager</h2>
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
        <tr><th>Manager Name </th></tr>
        <tr><td><input type="text" name="name" class="form-control"/> </td></tr>
        <tr><th>E-mail </th></tr>
            <tr><td><input type="text" name="email" class="form-control"/> </td></tr>
            <tr><th>Password </th></tr>
            <tr><td><input type="password" name="password" class="form-control"/> </td></tr>
		<tr><th>Phone </th></tr>
        <tr><td><input type="text" name="phone_no" class="form-control"/> </td></tr>

      <tr><td><input type="submit" class="btn btn-success" name="form_post_publish" value="Add Manager" /></td></tr>
    </table>

  </form>
</div>
</div>


<?php
include('footer.php');
?>
