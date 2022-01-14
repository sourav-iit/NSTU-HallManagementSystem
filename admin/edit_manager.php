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
    header("location: view_managers.php");
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
        }  else if (empty($_POST['phone_no'])) {
            throw new Exception('Number can not be empty');
        }

            $statement = $db->prepare("UPDATE tbl_managers SET name=?, email=?, phone_no=? where id=?");
            $statement->execute(array($_POST['name'], $_POST['email'], $_POST['phone_no'],$id));

        $success_message = 'Student has updated successfully.';
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>

<!---  Update finish --->

<?php
$statement = $db->prepare("SELECT * FROM tbl_managers WHERE id=?");
$statement->execute(array($id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $name = $row['name'];
    $email = $row['email'];
    $phone_no = $row['phone_no'];
}
?>


<?php
include('header.php');
?>

<!---Content Part --->
<div class="col-sm-9 col-md-9 col-lg-9">
    <div id="content">
        <div class="wrapper-edit-post">
            <h2>Update Manager Informations</h2>
            <?php
            if (isset($success_message)) {
                echo "<div class='success'>" . $success_message . '</div>';
            }
            if (isset($error_message)) {
                echo "<div class='error'>" . $error_message . '</div>';
            }
            ?>
            <form action="edit_manager.php?id=<?= $id; ?>" method="post" enctype="multipart/form-data">

                <table class="table table-hover table-bordered">
                    <tr>
                        <th>Manager Name</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="name" class="form-control" value="<?= $name ?>"/>
                        </td>
                    </tr>

                    <tr>
                        <th>Manager Email</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="email" class="form-control" value="<?= $email ?>"/></td>
                    </tr>



                    <tr>
                        <th>Phone</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="phone_no" class="form-control" value="<?= $phone_no ?>"/></td>
                    </tr>
                    <tr>
                        <td><input type="submit" class="btn btn-success" name="form_update_post"
                                   value="Update Manager"/></td>
                    </tr>
                </table>

            </form>
        </div>
    </div>
</div>


<?php
include('footer.php');
?>
