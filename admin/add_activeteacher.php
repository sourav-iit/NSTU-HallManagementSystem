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
    $e=$_POST['email'];
    $statement = $db->prepare("SELECT * FROM tbl_teachers where email=?");
    $statement->execute(array($_POST['email']));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

     $name="";
     $phone=0;
   foreach ($result as $row) {
    $name= $row['name'];
    $phone=$row['phone'];
   }

    $statement = $db->prepare("insert into tbl_activeteachers (name,phone) values(?,?)");
    $statement->execute(array($name,$phone));
    $success_message = 'Today Active Teacher added successfully.';
  } catch (Exception $e) {
    $error_message = $e->getMessage();
  }
}
?>
<?php include("header.php"); ?>
<!---Content Part -->

<div class="col-sm-9 col-md-9 col-lg-9">
  <div id="content">
    <h2>Manage Current Active Teachers</h2><hr />
    <div class="wrapper-manage-Room">
      <div class="well">
        <form class="form-horizontal" role="form" action="" method="post">
          <div class="form-group">
            <?php
            $statement = $db->prepare("SELECT * FROM tbl_teachers ORDER BY name ASC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <label class="control-label col-sm-2" for="name">Active teacher:</label>
            <div class="col-sm-10">
                <select class="form-control" name="email">
                  <?php
                  foreach ($result as $row) { ?>
                    <option value="<?php echo $row['email']; ?>"><?php echo $row['name'] .'-'. $row['work']; ?></option>
                  <?php
                }
                ?>
                  </select>
                <?php

                  ?>

                <?php
                 ?>

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
          <th>No</th>
          <th>Name</th>
          <th>Time</th>
        </tr>
        <?php
        $date=date('y-m-d');
        $date=strtotime($date);
      //  $date=strtotime($date);
        $i = 0;

        $statement = $db->prepare("SELECT * FROM tbl_activeteachers");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
          if((strtotime(substr($row['time'],2,8))) == $date){

            $i++;
            ?>
            <tr>
              <td><?= $i; ?></td>
              <td><?= $row['name']; ?></td>

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
