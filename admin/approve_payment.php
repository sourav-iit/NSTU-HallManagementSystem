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
    header('location: view_payment.php');
} else {
    $id = $_REQUEST['id'];
}
?>
<?php
if ($id != null) {

    $statement = $db->prepare("SELECT email FROM tbl_payment WHERE id=?");
    $statement->execute(array($id));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $email = $row['email'];
    }
//    var_dump($email);
//    function getSingleValue($tableName, $columnName, $prop, $value, $db)
//    {
//        $q = $db->query("SELECT $columnName FROM $tableName WHERE $prop ='" . $value . "'");
//        $f = $q->fetch();
//        $result = $f['$columnName'];
//        return $result;
//    }
//    $emailFound = getSingleValue(tbl_login, email, id, $id, $db);

//    $emailStatement = $db->prepare("select 'email' from tbl_login where id=?");
//    $emailStatement->execute(array($id));
//    $emailFound = $emailStatement->fetch(Pdo::FETCH_ASSOC);
//    $email = $emailFound;
//    var_dump($email);
//    include('view_student.php');
    //email start now

    include('../mail_pay.php');
    if ($email != null) {


        $result = sendMail($email);

        if ($result == true) {

            $statement = $db->prepare("UPDATE tbl_payment SET  is_verified=? where id=?");
            $statement->execute(array(1, $id));
            $successMessage = "Email sent successfully";
            $_SESSION['success_message'] = $successMessage;
        } else {
            $error_message = "Email is not sent. Check your Internet connection please/Any Internal error";
            $_SESSION['error_message'] = $error_message;
        }
    }else{
        $error_email = "Email Not Found to Approve";
        $_SESSION['error_email'] = $error_email;
    }

    //email end now
    header('location: view_payment.php');
}






