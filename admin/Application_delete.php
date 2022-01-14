<?php

ob_start();
session_start();
if ($_SESSION['name'] != 'admin') {
    header('location: login.php');
}
include("../config.php");
?>
<?php

if (!isset($_REQUEST['verifiedId'])) {
    header('location: view_application.php');
} else {
    $id = $_REQUEST['verifiedId'];
}
?>

<?php

$statement = $db->prepare("DELETE FROM tbl_application WHERE id=?");
$statement->execute(array($id));
header('location: view_application.php');
?>
