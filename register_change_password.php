<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">

<title>
  change your password
</title>

<link rel="stylesheet" href="include.css"/>

</head>

<body>
  <?php include('template_header.php'); ?>
  <div class="flexOuter">
    <?php include('template_nav.php'); ?>
    <div class="flexInner">
      <h2>Change Your Password</h2>
      <h3>PHP/SQL Development Project</h3>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  require ('mysqli_connect.php');
  $errors = array();

  if (empty($_POST['email'])) {
    $errors[] = 'email required';
  } else {
    $e = mysqli_real_escape_string($dbcon, trim($_POST['email']));
  }

  if (empty($_POST['psword'])) {
    $errors[] = 'old password required';
  } else {
    $p = mysqli_real_escape_string($dbcon, trim($_POST['psword']));
  }

  if (!empty($_POST['psword1'])) {
    if ($_POST['psword1'] != $_POST['psword2']) {
      $errors[] = "new passwords don't match";
    } else {
    $np = mysqli_real_escape_string($dbcon, trim($_POST['psword1']));
    }
  } else {
    $errors[] = 'enter a new password';
  }
//unfinished -- add data validation here

?>
      <form action="register-password.php" method="post">
        <p><label class="label" for="email">email</label>
           <input id="email" type="text" name="email" size="30" maxlength="60"
            value="<?php if (isset($POST["email"])) echo $POST["email"]; ?>"/></p>
        <p><label class="label" for="psword">old password</label>
           <input id="psword" type="password" name="psword" size="12" maxlength="12"/></p>
        <p><label class="label" for="psword1">new password</label>
           <input id="psword1" type="password" name="psword1" size="12" maxlength="12"/></p>
        <p><label class="label" for="psword2">re-enter new password</label>
           <input id="psword2" type="password" name="psword2" size="12" maxlength="12"/></p>
        <p><input id="submit" type="submit" name="submit" value="submit"/></p>
      </form>
    </div>
    <?php include('template_sidebar.php'); ?>
  </div>
  <?php include('template_footer.php'); ?>
</body>

<script src="#">
</script>

</html>
