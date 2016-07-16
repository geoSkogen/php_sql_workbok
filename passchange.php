<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">

<title>
  change password
</title>

<link rel="stylesheet" href="include.css"/>

</head>

<body>
  <?php include('header_passchange.php'); ?>
  <div class="flexOuter">
    <?php include('nav.php'); ?>
    <div class="flexInner">
      <h2>Change Your Password</h2>
      <h3>PHP/SQL Development Project</h3>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  require ('mysqli_connect_postal.php');
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

  if (empty($errors)) {
    $q = "SELECT user_id FROM users WHERE (email='$e' AND password=SHA1('$p'))";
    $result = @mysqli_query($dbcon, $q);
    $num = @mysqli_num_rows($result);
    if ($num == 1) {
      $row = mysqli_fetch_array($result, MYSQLI_NUM);
      $q = "UPDATE users SET password=SHA1('$np') WHERE user_id=$row[0]";
      $result = @mysqli_query($dbcon, $q);
      echo '<h2>Password Change</h2>
            <h3>Your password has been updated.</h3>';
      exit();
    } else {
      echo '<h2>System Error</h2>
             <p clas"error>Password update failed.</p>';
      echo '<p>' . mysqli_error($dbcon) . '<br/><br/>Query: ' . $q . '</p>';
    }
  } else {
    echo '<h2>Error Message</h2>
          <p class="error">The following error(s) occurred:<br/>';
    foreach ($errors as $msg) {
      echo " - $msg<br/>\n";
    }
    echo '</p><p class="error">Please try again.</p><br/>';
  }
  mysqli_close($dbcon);
}
?>
      <form action="<?php echo htmlspecialchars(trim($_SERVER['PHP_SELF'])); ?>" method="post">
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
    <?php include('sidebar.php'); ?>
  </div>
  <?php include('footer.php'); ?>
</body>

<script src="#">
</script>

</html>
