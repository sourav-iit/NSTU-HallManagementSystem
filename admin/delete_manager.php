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
    header('location: view_managers.php');
} else {
    $id = $_REQUEST['id'];
}
?>

<?php
$statement=$db->prepare("select * from tbl_managerlogin WHERE id='$id'");
$statement->execute();
$result=$statement->fetchAll(PDO::FETCH_ASSOC);
$email="";
foreach($result as $row) {
  $email=$row['email'];
    $statement = $db->prepare("DELETE FROM tbl_managerlogin WHERE email=?");
    $statement->execute(array($email));
}

$statement = $db->prepare("DELETE FROM tbl_managers WHERE id=?");
$statement->execute(array($id));
header('location: view_managers.php');
?>
