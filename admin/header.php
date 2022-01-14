<?php
ob_start();
// session_start();
if ($_SESSION['name'] != 'admin') {
    header('location: login.php');
}
?>

<html>
<head>
    <title>
        Dashboard
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->


    <script src="../fancybox/jquery-1.9.0.min.js"></script>
    <!-- <script src="../lib/jquery 3.0.min.js"></script> -->
    <script src="../fancybox/jquery.fancybox.js"></script>
    <script src="../fancybox/main.js"></script>
    <link rel="stylesheet" href="../fancybox/jquery.fancybox.css">

    <!-- Ck Editor  cdn version-->
    <!-- <script src="//cdn.ckeditor.com/4.5.9/full/ckeditor.js"></script> -->
    <!-- Ck Editor  -->
    <script src="../ckeditor/ckeditor.js"></script>
    <script  src="../js/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap CSS file -->
    <link href="lib/bootstrap-3.0.3/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="lib/bootstrap-3.0.3/css/bootstrap-theme.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="style-admin.css">
</head>
<body>
<div class="container-fluid" style="margin: 5px 27px 0px 27px;">
    <nav class="navbar" style="background-color: rgb(174, 198, 198);margin: 6px 0px 3px 0px;padding: 10px;">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" style="font-size: 2.5em;color: #000;" href="index.php"><span class="text_admin1">Admin</span>
                <span class="text_admin2">Panel</span></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown admin_top_text">
                    <a class="dropdown-toggle admin_top_text" data-toggle="dropdown" href="#">
                        Admin
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out">&nbsp;</span>Logout</a></li>
                    </ul>

                </li>


            </ul>
        </div>
    </nav>
</div>
<div class="container-fluid" style="background-color: rgba(173, 14, 6, 0.09);margin: 0px 2% 1px 3%;">

    <div class="row">
        <div class="col-sm-2 col-md-2 col-lg-2 admin_sidebar">
            <h2 data-toggle="collapse" data-target="#pageOption">Page Options
                <small><span class="glyphicon glyphicon-chevron-down" style="float: right;cursor: pointer;"></span>
                </small>
            </h2>
            <div id="pageOption" class="collapse in">
                <ul class="list-group">
                    <li class="list-group-item list_mystyle"><span class="glyphicon glyphicon-home"> &nbsp;</span><a
                                href="index.php">Home</a></li>
                </ul>
            </div>

            <h2 data-toggle="collapse" data-target="#blogOption">Manage Notice
                <small><span class="glyphicon glyphicon-chevron-down" style="float: right;cursor: pointer;"></span>
                </small>
            </h2>
            <div class="collapse in" id="blogOption">
                <ul class="list-group">
                    <li class="list-group-item list_mystyle"><span class="glyphicon glyphicon-plus"></span> &nbsp; <a
                                href="add_notice.php"> Add new Notice </a></li>
                    <li class="list-group-item list_mystyle"><span class="glyphicon glyphicon-th-large"></span> &nbsp;
                        <a href="view_notice.php">View all Notices</a></li>
                </ul>
            </div>


            <h2 data-toggle="collapse" data-target="#stdOption">Manage Students
                <small><span class="glyphicon glyphicon-chevron-down" style="float: right;cursor: pointer;"></span>
                </small>
            </h2>
            <div class="collapse in" id="stdOption">
                <ul class="list-group">
                  <li class="list-group-item list_mystyle"><span class="glyphicon glyphicon-th-large"></span> &nbsp;
                      <a href="add_student.php">Add Student </a></li>
                    <li class="list-group-item list_mystyle"><span class="glyphicon glyphicon-th-large"></span> &nbsp;
                        <a href="manage_rooms.php"> Manage Rooms </a></li>
                    <!--            <li class="list-group-item list_mystyle"><span class="glyphicon glyphicon-plus"></span> &nbsp; <a href="add_student.php"> Add new student </a></li>-->
                    <li class="list-group-item list_mystyle"><span class="glyphicon glyphicon-th-large"></span> &nbsp;
                        <a href="view_student.php">View all Student</a></li>
                </ul>
            </div>

            <h2 data-toggle="collapse" data-target="#empOption">Manage Employee
                <small><span class="glyphicon glyphicon-chevron-down" style="float: right;cursor: pointer;"></span>
                </small>
            </h2>
            <div class="collapse in" id="empOption">
                <ul class="list-group">
                  <li class="list-group-item list_mystyle"><span class="glyphicon glyphicon-plus"></span> &nbsp; <a
                              href="add_managers.php"> Add Dining Manager </a></li>
                    <li class="list-group-item list_mystyle"><span class="glyphicon glyphicon-plus"></span> &nbsp; <a
                                href="add_employee.php"> Add new Employee </a></li>
                    <li class="list-group-item list_mystyle"><span class="glyphicon glyphicon-plus"></span> &nbsp; <a
                              href="view_managers.php"> View All Dining Manager </a></li>
                    <li class="list-group-item list_mystyle"><span class="glyphicon glyphicon-th-large"></span> &nbsp;
                        <a href="view_employee.php">View all Employee</a></li>
                </ul>
            </div>
            <!-- manage dianing-->
            <h2 data-toggle="collapse" data-target="#stdOption">Emergency person
                <small><span class="glyphicon glyphicon-chevron-down" style="float: right;cursor: pointer;"></span>
                </small>
            </h2>
            <div class="collapse in" id="stdOption">
                <ul class="list-group">
                  <li class="list-group-item list_mystyle"><span class="glyphicon glyphicon-th-large"></span> &nbsp;
                      <a href="manager_doctors.php">Manage Doctors </a></li>
                      <li class="list-group-item list_mystyle"><span class="glyphicon glyphicon-th-large"></span> &nbsp;
                          <a href="add_activeteacher.php">Today Active teacher </a></li>
                      <li class="list-group-item list_mystyle"><span class="glyphicon glyphicon-th-large"></span> &nbsp;
                          <a href="manage_teachers.php">manage teacher </a></li>

                    <!--            <li class="list-group-item list_mystyle"><span class="glyphicon glyphicon-plus"></span> &nbsp; <a href="add_student.php"> Add new student </a></li>-->

                </ul>
            </div>
            <!-- manage problem-->

            <h2 data-toggle="collapse" data-target="#payOption">Manage Problem
                <small><span class="glyphicon glyphicon-chevron-down" style="float: right;cursor: pointer;"></span>
                </small>
            </h2>
            <div class="collapse in" id="problemoption">
                <ul class="list-group">

                    <li class="list-group-item list_mystyle"><span class="glyphicon glyphicon-th-large"></span> &nbsp; <a
                                href="view_problem.php"> View Problem </a></li>
                    <li class="list-group-item list_mystyle"><span class="glyphicon glyphicon-th-large"></span> &nbsp; <a
                                href="view_application.php"> View Application </a></li>

                </ul>
            </div>

            <h2 data-toggle="collapse" data-target="#payOption">Manage Payments
                <small><span class="glyphicon glyphicon-chevron-down" style="float: right;cursor: pointer;"></span>
                </small>
            </h2>
            <div class="collapse in" id="payOption">
                <ul class="list-group">
                    <li class="list-group-item list_mystyle"><span class="glyphicon glyphicon-th-large"></span> &nbsp; <a
                                href="view_payment.php"> View Payments </a></li>

                </ul>
            </div>


        </div>
