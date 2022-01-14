<?php
session_start();
require_once 'header.php' ?>
<?php require_once "config.php" ?>

<?php
if (!isset($_REQUEST['block'])) {
  header("location: students.php");
} else {
  $block = $_REQUEST['block'];
}

$statement = $db->prepare("SELECT * FROM tbl_rooms WHERE block=? ORDER BY name ASC");
$statement->execute(array($block));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!--doctor team-->
<section id="doctor-team" class="section-padding">
  <div class="container">
    <div class="row">

      <?php foreach ($result as $row) { ?>
        <div class="col-md-3">
          <div class="card card-body card-widget">
            <h2><a href="room.php?id=<?= $row['id'] ?>">Room No - <?= $row['name'] ?></a></h2>
          </div>
        </div>

      <?php } ?>

    </div>
  </div>
</section>
<?php require_once 'footer.php' ?>
