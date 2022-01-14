<?php

include("../config.php");
$problemId= $_POST['verifiedId'];

$statement=$db->prepare("update tbl_application SET is_accept=1 where id='$problemId'");
$statement->execute();
echo"<script>
window.location='view_application.php';
</script>";
 ?>
