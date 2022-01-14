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
  header("location: view_notice.php");
} else {
  $id = $_REQUEST['id'];
}
?>



<!--  Update start -->
<?php
if (isset($_POST['form_update_post'])) {
  try {
    if (empty($_POST['title'])) {
      throw new Exception('Notice title can not be empty');
    } else if (empty($_POST['description'])) {
      throw new Exception('Notice description can not be empty');
    }

    $statement = $db->prepare("UPDATE tbl_notices SET title=?,description=? where id=?");
    $statement->execute(array($_POST['title'], $_POST['description'],  $id));

    $success_message = 'Notice has updated successfully.';
  } catch (Exception $e) {
    $error_message = $e->getMessage();
  }
}
?>

<!---  Update finish --->

<?php
$statement = $db->prepare("SELECT * FROM tbl_notices WHERE id=?");
$statement->execute(array($id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
  $title = $row['title'];
  $description = $row['description'];
}
?>


<?php
include('header.php');
?>

<!---Content Part --->
<div class="col-sm-9 col-md-9 col-lg-9">
  <div id="content">
    <div class="wrapper-edit-post">
      <h2>Update post</h2>
      <?php
      if (isset($success_message)) {
        echo "<div class='success'>" . $success_message . '</div>';
      }
      if (isset($error_message)) {
        echo "<div class='error'>" . $error_message . '</div>';
      }
      ?>
      <form action="edit_notice.php?id=<?= $id; ?>" method="post">

        <table class="tbl1">
          <tr><th>Title </th></tr>
          <tr><td><input type="text" class="input-lg" name="title" value="<?php echo $title ?>"/> </td></tr>
          <tr><th>Description </th></tr>
          <tr><td><textarea name="description" class="well" cols="90" rows="30"><?php echo $description ?></textarea>
            <script>
            CKEDITOR.replace('description');
            </script>
          </td></tr>
        <tr><td><input type="submit" class="btn btn-info" name="form_update_post" value="Update post" /></td></tr>
      </table>

    </form>
  </div>
</div>
</div>


<?php
include('footer.php');
?>
