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


    $statement = $db->prepare("insert into tbl_daymeal (lunch, dinner) values(?,?)");
    $statement->execute(array($_POST['lunch'], $_POST['dinner']));
    $success_message = 'Today meal added successfully.';
  } catch (Exception $e) {
    $error_message = $e->getMessage();
  }
}
?>
<?php include("header.php"); ?>
<!---Content Part -->

<div class="col-sm-9 col-md-9 col-lg-9">
  <div id="content">
    <h2>Manage Meal</h2><hr />
    <div class="wrapper-manage-Room">
      <div class="well">
        <form class="form-horizontal" role="form" action="" method="post">
          <div class="form-group">
            <?php
            $statement = $db->prepare("SELECT * FROM tbl_foods ORDER BY name ASC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <label class="control-label col-sm-2" for="name">Lunch Item:</label>
            <div class="col-sm-10">
                <select class="form-control" name="lunch">
                  <option value="">None</option>
                  <?php
                  foreach ($result as $row) { ?>
                    <option value="<?php echo $row['name']; ?>"><?php echo $row['name'] .'-'. $row['price']; ?></option>
                  <?php } ?>
                </select>

            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="name">Dinner Item:</label>
            <div class="col-sm-10">
            <select class="form-control" name="dinner">
              <option value="">None</option>
            <?php
              foreach ($result as $row) { ?>
                <option value="<?php echo $row['name']; ?>"><?php echo $row['name'] .'-'. $row['price']; ?></option>
              <?php } ?>
            </select>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" name="form1" class="btn btn-default">Done</button>
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
      <?php
      date_default_timezone_set('Asia/dhaka');
       ?>
       <br>
       <?php
       //2018-07-12 18:37:01
       //21-10-03 06:02:57

       ?>
      <table class="table table-responsive table-striped table-bordered">
        <tr id="mang-tbl-header">
          <th>Day</th>
          <th>Lunch</th>
          <th>Dinner</th>
          <th>Time</th>
        </tr>
        <?php
        $date=date('y-m-d');
        $date=strtotime($date);
      //  $date=strtotime($date);
        $i = 0;

        $statement = $db->prepare("SELECT * FROM tbl_daymeal");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
          if((strtotime(substr($row['time'],2,8))) == $date){

            $i++;
            ?>
            <tr>
              <td><?= $i; ?></td>
              <td><?= $row['lunch']; ?></td>
              <td><?= $row['dinner']; ?></td>

                <td><?= $row['time']; ?></td>
                <!-- Edit Modal -->
            </tr>
            <?php
          }

        }
        ?>
      </table>
    </div>
  </div>
</div>
<?php include("footer.php"); ?>
