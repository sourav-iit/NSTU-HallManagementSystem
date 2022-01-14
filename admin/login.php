<?php
if (isset($_POST['form_login'])) {

  try {
    if (empty($_POST['email'])) {
      throw new Exception('Email can not be empty');
    }

    if (empty($_POST['password'])) {
      throw new Exception('Password can not be empty');
    }


    $password = $_POST['password'];
  //  $password = md5($password);     

    include('../config.php');
    $num = 0;
    $statement = $db->prepare("select * from tbl_login where email=? and password=?");
    $statement->execute(array($_POST['email'], $password));

    $num = $statement->rowCount();

    if ($num > 0) {
      session_start();
      $_SESSION['name'] = "admin";
      header("location: index.php");
    } else {
      throw new Exception('Invalid email or password');
    }
  } catch (Exception $e) {
    $error_message = $e->getMessage();
  }
}
?>

<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="style-admin.css">
  <!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> -->
  <!--    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
  <!-- Bootstrap CSS file -->
  <link href="lib/bootstrap-3.0.3/css/bootstrap.min.css" rel="stylesheet" />
  <link href="lib/bootstrap-3.0.3/css/bootstrap-theme.min.css" rel="stylesheet" />

  <title>Login Admin panel || Tech World</title>
  <style>
  a:hover{
    text-decoration: underline;
  }
  </style>
</head>
<body>
  <div class="container">
    <div class="wrapperLogin">
      <div class="login_header">
        <h2>Login to admin panel </h2>
      </div>
      <div class="row" style="margin-left:20px;margin-top:20px;">
        <form class="" name="form_login" action="login.php" method="post">
          <?php if (isset($error_message)) {
            echo "<div class='error'>" . $error_message . '</div>';
          } ?>
          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="text" name="email" class="form-control"  style="width: 60%;margin-bottom: 20px;" placeholder="Admin email"/>
            </div>
          </div>

          <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
              <input type="password" name="password" class="form-control"  style="width: 60%;margin-bottom: 20px;" placeholder="Admin password"/>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2  col-sm-10" >

              <button type="submit" class="btn btn-primary" name="form_login" >Login</button>

            </div>

          </div>


        </form>
      </div>
    </div>

  </div>

  <!-- Jquery and Bootstrap Script files -->
  <script src="lib/jquery 3.0.min.js"></script>
  <script src="lib/bootstrap-3.0.3/js/bootstrap.min.js"></script>
</body>
</html>
