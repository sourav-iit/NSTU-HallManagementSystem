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
    header('location: view_student.php');
} else {
    $id = $_REQUEST['id'];
}
?>

<?php
$statement=$db->prepare("select * from tbl_student WHERE id='$id'");
$statement->execute();
$result=$statement->fetchAll(PDO::FETCH_ASSOC);
$email="";
foreach($result as $row) {
  $email=$row['email'];
    $statement = $db->prepare("DELETE FROM tbl_studentlogin WHERE email=?");
    $statement->execute(array($email));
}


$statement1 = $db->prepare("SELECT * FROM tbl_student WHERE id=?");
$statement1->execute(array($id));
$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
foreach ($result1 as $row1) {
    $real_path = "../images/students/" . $row1['image'];
    unlink($real_path); //Delete the exixting image
}

$statement = $db->prepare("DELETE FROM tbl_student WHERE id=?");
$statement->execute(array($id));
header('location: view_student.php');
?>
