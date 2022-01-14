<?php
session_start();
require_once "header.php"; ?>

<?php
if (!isset($_REQUEST['id'])) {
  header("location: index.php");
} else {
  $id = $_REQUEST['id'];
}

$statement = $db->prepare("SELECT * FROM tbl_doctors WHERE id=?");
$statement->execute(array($id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
  $name = $row['name'];
  $email = $row['email'];
  $address = $row['address'];
  $image = $row['image'];
  $division_id = $row['division_id'];
  $phone = $row['phone'];
  $specialist = $row['specialist'];
}
 ?>

<!--/ banner-->


<!--doctor team-->
<section id="doctor-team" class="section-padding doctor-single">
  <div class="container m-top m-bottom">
    <h2 class="ser-title">Doctor - <?= $name ?></h2>
    <hr class="botm-line">
    <div class="row">
      <div class="col-md-5">
        <img src="img/doctors/<?= $image ?>" class="img img-responsive">
      </div>
      <div class="col-md-7 text-info">
        <p><strong>Name : </strong> <?= $name ?></p>
        <p><strong>Phone : </strong> <?= $phone ?></p>
        <p><strong>Email : </strong> <?= $email ?></p>
        <p><strong>Address : </strong> <?= $address ?></p>
        <p><strong>Specialist : </strong> <?= $specialist ?></p>
        <p>
          <a href="tel:<?= $phone ?>" class="btn btn-info">Call Now</a>
          <a href="mailto:<?= $email ?>" class="btn btn-danger">Email Now</a>
        </p>
      </div>
    </div>
  </div>
</section>
<!--/ doctor team-->



<?php require_once "footer.php"; ?>
