<?php
ob_start();
session_start();
if ($_SESSION['name'] != 'admin') {
    header('location: login.php');
}
?>
<?php
include('header.php');
?>
<div class="col-sm-9 col-md-9 col-lg-9">
    <div id="content">
        <div class="dashboard_description">
            <h2><span class="glyphicon glyphicon-dashboard" style="color:#000000;"></span> &nbsp; &nbsp; Dashboard of NSTU Hall management System</h2><hr />
            <p> Dashboard of NSTU Hall
                This is the dashboard of Dining manager. You can manage everythings from here.
            </p>
            <a target="_blank" href="../index.php" class="btn btn-primary">Go to User View</a>
        </div>
    </div>
</div>


<?php
include('footer.php');
?>
