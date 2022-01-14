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
//    if (empty($_POST['name'])) {
//      throw new Exception('Name can not be empty');
//    } else if (empty($_POST['room_id'])) {
//      throw new Exception('Room can not be empty');
//    }
//    else if (empty($_POST['university_id'])) {
//      throw new Exception('University ID can not be empty');
//    }
//    else if (empty($_POST['registration_no'])) {
//      throw new Exception('Registration no can not be empty');
//    }

        if (empty($_POST['name'])) {
            throw new Exception('Name can not be empty');
        } else if (empty($_POST['email'])) {
            throw new Exception('email can not be empty');
        } else if (empty($_POST['university_id'])) {
            throw new Exception('University ID can not be empty');
        }  else if (empty($_POST['room_id'])) {
            throw new Exception('Room can not be empty');
        }


            $statement = $db->prepare("UPDATE tbl_student SET university_id=?, name=?,email=?, faculty=?, phone_no=?, address=?, room_id=?,  session=? where id=?");
            $statement->execute(array($_POST['university_id'], $_POST['name'], $_POST['email'], $_POST['faculty'], $_POST['phone_no'], $_POST['address'], $_POST['room_id'], $_POST['session'], $id));

        //$success_message = 'Student has updated successfully.';
        header('location: view_student.php');
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>

<!---  Update finish --->

<?php
$statement = $db->prepare("SELECT * FROM tbl_student WHERE id=?");
$statement->execute(array($id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $name = $row['name'];
    $email = $row['email'];
    $faculty = $row['faculty'];
    $university_id = $row['university_id'];
    $session = $row['session'];
    $phone_no = $row['phone_no'];
    $room_id = $row['room_id'];
    $address = $row['address'];

}
?>


<?php
include('header.php');
?>

<!---Content Part --->
<div class="col-sm-9 col-md-9 col-lg-9">
    <div id="content">
        <div class="wrapper-edit-post">
            <h2>Update Student Informations</h2>
            <?php
            if (isset($success_message)) {
                echo "<div class='success'>" . $success_message . '</div>';
            }
            if (isset($error_message)) {
                echo "<div class='error'>" . $error_message . '</div>';
            }
            ?>
            <form action="edit_student.php?id=<?= $id; ?>" method="post" enctype="multipart/form-data">

                <table class="table table-hover table-bordered">
                    <tr>
                        <th>Student ID</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="university_id" class="form-control" value="<?= $university_id ?>"/>
                        </td>
                    </tr>


                    <tr>
                        <th>Student Name</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="name" class="form-control" value="<?= $name ?>"/></td>
                    </tr>
                    <tr>
                        <th>Student Email</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="email" class="form-control" value="<?= $email ?>"/></td>
                    </tr>

                    <tr>
                        <th>faculty</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="faculty" class="form-control" value="<?= $faculty ?>"/></td>
                    </tr>

                    <tr>
                        <th>Phone</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="phone_no" class="form-control" value="<?= $phone_no ?>"/></td>
                    </tr>

                    <tr>
                        <th>Address</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="address" class="form-control" value="<?= $address ?>"/></td>
                    </tr>

                    <tr>
                        <th>Session</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="session" class="form-control" value="<?= $session ?>"/></td>
                    </tr>



                    <tr>
                        <td>Select from the following rooms</td>
                    </tr>
                    <tr>
                        <td>
                            <select name="room_id" class="form-control">
                                <option value="">Select a room</option>
                                <?php
                                $statement = $db->prepare("SELECT * FROM tbl_rooms ORDER BY name ASC");
                                $statement->execute();
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) { ?>
                                    <option value="<?php echo $row['id']; ?>" <?= $room_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['block'] . '-' . $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td><input type="submit" class="btn btn-success" name="form_update_post"
                                   value="Update Student"/></td>
                    </tr>
                </table>

            </form>
        </div>
    </div>
</div>


<?php
include('footer.php');
?>
