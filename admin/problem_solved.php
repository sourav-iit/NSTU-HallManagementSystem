<?php

include("../config.php");
$problemId= $_POST['verifiedId'];

$statement=$db->prepare("update tbl_problems SET is_solved=1 where id='$problemId'");
$statement->execute();
echo"<script>
window.location='view_problem.php';
</script>";
 ?>
