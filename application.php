<?php
//ob_start();
//session_start();
include("config.php");
?>
<?php
if (!isset($_REQUEST['id'])) {
    header("location: application.php");
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
        } else if (empty($_POST['email'])) {
            throw new Exception('email can not be empty');
        } else if (empty($_POST['university_id'])) {
            throw new Exception('University ID can not be empty');
        }  else if (empty($_POST['phone'])) {
            throw new Exception('phone can not be empty');
        } else if (empty($_POST['faculty'])) {
            throw new Exception('faculty can not be empty');
        }else if (empty($_POST['reason'])) {
            throw new Exception('Reason can not be empty');
        }
        $stage=0;

        $statement=$db->prepare("insert into tbl_application (university_id,name,email,faculty,phone,address,session,reason,is_accept,room_id) values(?,?,?,?,?,?,?,?,?,?)");
        $statement->execute(array($_POST['university_id'],$_POST['name'],$_POST['email'],$_POST['faculty'],$_POST['phone'],$_POST['address'],
        $_POST['session'],$_POST['reason'],$stage,$id));
        $success_message = 'Apllication has send successfully.Hall authority will notified by phone or mail address,Thanks';
      ?>
      <?php
        echo"<script>
    		window.location='availableroom.php';
    		</script>";
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>

<!---  Update finish --->



<?php
include('header.php');
?>

<!---Content Part --->
<div class="col-sm-9 col-md-9 col-lg-9">
    <div id="content">
        <div class="wrapper-edit-post">
            <h2>application for seat allocation</h2>
            <?php
            if (isset($success_message)) {
                echo "<div class='success'>" . $success_message . '</div>';
            }
            if (isset($error_message)) {
                echo "<div class='error'>" . $error_message . '</div>';
            }
            ?>
            <form action="application.php?id=<?= $id; ?>" method="post" enctype="multipart/form-data">

                <table class="table table-hover table-bordered">
                    <tr>
                        <th>Student ID</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="university_id" class="form-control" value=""/>
                        </td>
                    </tr>


                    <tr>
                        <th>Student Name</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="name" class="form-control" value=""/></td>
                    </tr>
                    <tr>
                        <th>Student Email</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="email" class="form-control" value=""/></td>
                    </tr>

                    <tr>
                        <th>faculty</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="faculty" class="form-control" value=""/></td>
                    </tr>

                    <tr>
                        <th>Phone</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="phone" class="form-control" value=""/></td>
                    </tr>

                    <tr>
                        <th>Address</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="address" class="form-control" value=""/></td>
                    </tr>

                    <tr>
                        <th>Session</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="session" class="form-control" value=""/></td>
                    </tr>
                    <tr>
                        <th>Why need seat</th>
                    </tr>
                    <tr>
                        <td><textarea  class="form-control" name="reason" rows="3" cols="50"></textarea></td>

                    </tr>

                    <tr>
                        <td><input type="submit" class="btn btn-success" name="form_update_post"
                                   value="Apply for Seat"/></td>
                    </tr>
                    <tr>
<td>gbhgbv</td>
                    </tr>
                </table>

            </form>
        </div>
    </div>
</div>


<?php
include('footer.php');
?>
