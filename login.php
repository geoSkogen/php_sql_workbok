<?php
session_start();
?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">

<title>
  login
</title>

<link rel="stylesheet" href="include.css"/>

</head>

<body>
  <?php include('header_login.php'); ?>
  <div class="flexOuter">
    <?php include('nav.php'); ?>
    <div class="flexInner">
      <h2>Login Page</h2>
      <h3>PHP/SQL Development Project</h3>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require('mysqli_connect_postal.php');

  if (!empty($_POST['email'])) {
    $e = mysqli_real_escape_string($dbcon, $_POST['email']);
  } else {
    $e = FALSE;
    echo '<p class="error">enter an email address</p>';
  }

  if (!empty($_POST['psword'])) {
    $p = mysqli_real_escape_string($dbcon, $_POST['psword']);
  } else {
    $p = FALSE;
    echo '<p class="error">enter a password</p>';
  }

  if ($e && $p) {
    $q = "SELECT user_id, fname, user_level FROM users WHERE
          (email='$e' AND password=SHA1('$p'))";
    $result = mysqli_query ($dbcon, $q);
    if (@mysqli_num_rows($result) == 1) {

      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $_SESSION['user_level'] = (int) $row['user_level'];
      $url = ($_SESSION['user_level'] === 1)? 'adminpage.php' : 'memberspage.php';
      header('Location: ' . $url);
      mysqli_free_result($result);
      mysqli_close($dbcon);
      exit();

    } else {
      echo '<p class="error">authentication failed &mdash; invalid username &/or password</p>
            <p>new user? register
              <a href="register.php" class="regLink">here</a></p>';
    }
  } else {
    echo 'try again';
  }
  mysqli_close($dbcon);
}
?>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <p><label class="label" for="email">email</label>
          <input id="email" type="text" name="email" size="30" maxlength="60"/></p>
        <p><label class="label" for="psword">password</label>
          <input id="psword" type="password" name="psword" size="12" maxlength="12"/></p>
        <input id="submit" type="submit" name="submit" value="login"/>
      </form>
    </div>
    <p id="testy"></p>
    <form action="<?php if (isset($url)) echo $url; ?>" method="post" class="hideMe">
    <input id="datum" name="user_level"
     value=" <?php if (isset($_SESSION['user_level'])) echo $_SESSION['user_level']; ?>"/>
    <input id="clickMe" type="submit" name="submit" value="submit"/>
    </form>

    <?php include('sidebar.php'); ?>
  </div>
  <?php include('footer.php'); ?>
</body>

<!--<script src="loginScript.js">
</script>-->

</html>
