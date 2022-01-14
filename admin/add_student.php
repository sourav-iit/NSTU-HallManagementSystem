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
    } else if (empty($_POST['room_id'])) {
      throw new Exception('Room can not be empty');
    }
    else if (empty($_POST['university_id'])) {
      throw new Exception('University ID can not be empty');

    }
    else if (empty($_POST['password'])) {
      throw new Exception('password needed for student next login into NSTU Hall system');
    }
    else if (empty($_POST['email'])) {
      throw new Exception('Email address needed');
    }
    $id=$_POST['room_id'];
    $value=0;
    $statement=$db->prepare("select count(*) from tbl_student where room_id='$id' group by room_id");
    $statement->execute();

    $value=$statement->fetchAll()[0];

    $statement1=$db->prepare("select size from tbl_rooms where id='$id'");
    $statement1->execute();
    $size=$statement1->fetchAll()[0];
    if ($value[0] >= $size[0]) {
    throw new Exception('Room Seat already Booked');
    }
    /* --------------- Image ----------------------- */
/*
    //Get the next autoincrement ID by PDO method for naming my image as my id_name because ID is unique
    $statement = $db->prepare("SHOW TABLE STATUS LIKE 'tbl_student'");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
      $new_id = $row[10];             //Make next increment id for images naming
    }
*/
    //Find out the image extension form the image


    $statement = $db->prepare("insert into tbl_student (university_id,  name, email, faculty, phone_no, address, room_id, session) values(?,?,?,?,?,?,?,?)");
    $statement->execute(array($_POST['university_id'], $_POST['name'],$_POST['email'], $_POST['faculty'], $_POST['phone_no'], $_POST['address'],  $_POST['room_id'], $_POST['session']));
    $statement1 = $db->prepare("insert into tbl_studentlogin (email, password) values(?,?)");
    $statement1->execute(array($_POST['email'], $_POST['password']));




    $success_message = 'Student has added successfully.';
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
    <h2>Add a new Student</h2>
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
        <tr><th>Student Name </th></tr>
        <tr><td><input type="text" name="name" class="form-control"/> </td></tr>
		<tr><th>Student ID </th></tr>
        <tr><td><input type="text" name="university_id" class="form-control"/> </td></tr>
        <tr><th>E-mail </th></tr>
            <tr><td><input type="text" name="email" class="form-control"/> </td></tr>
            <tr><th>Password </th></tr>
            <tr><td><input type="password" name="password" class="form-control"/> </td></tr>
        <tr><th>Department </th></tr>
        <tr><td><select class="form-control" name="faculty">
          <?php $dept=array("SE","CSTE","EDU","BGE","ACCE","ICE","EEE","PARMECY","AMATH","STAT","ENG");
        foreach($dept as $val){
          ?>
            <option value="<?php echo $val ?>"><?php echo $val ?></option>
          <?php
        }?>

        </select> </td></tr>

		<tr><th>Phone </th></tr>
        <tr><td><input type="text" name="phone_no" class="form-control"/> </td></tr>

		<tr><th>Address </th></tr>
        <tr><td><input type="text" name="address" class="form-control"/> </td></tr>

        <tr><th>Session</th></tr>
        <!--<tr><td><input type="text" name="session" class="form-control"/> </td></tr>-->
         <tr><td>
           <?php $a=20;$date=$a.date("y"); ?>
        <select class="form-control" name="session">
         <?php
             for ($i=2014; $i < $date ; $i++) {
               ?>
                  <option value="<?php echo $i."-".$i+1; ?>"><?php echo $i."-".$i+1; ?></option>
               <?php
             }
          ?>
        </select>

         </td></tr>

        <tr>
          <td>Select from the following rooms</td>
        </tr>
        <tr><td>
          <select name="room_id" class="form-control">
            <option value="">Select a room</option>
            <?php
            $statement = $db->prepare("SELECT * FROM tbl_rooms ORDER BY name ASC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) { ?>
              <option value="<?php echo $row['id']; ?>"><?php echo $row['block'] .'-'. $row['name']; ?></option>
            <?php } ?>
          </select>
        </td>
      </tr>

      <tr><td><input type="submit" class="btn btn-success" name="form_post_publish" value="Add Student" /></td></tr>
    </table>

  </form>
</div>
</div>


<?php
include('footer.php');
?>
