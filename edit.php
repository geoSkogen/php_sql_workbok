<?php
session_start();
/*if ($_SESSION['user_level'] != 1) {
  header("Location: login.php");
  exit();
}*/
?>
<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">

<title>
edit 
</title>

<link rel="stylesheet" href="include.css"/>

</head>

<body>
  <?php include('header_admin.php'); ?>
  <div class="flexOuter">
    <?php include('nav.php'); ?>
    <div class="flexInner">
      <h2>Edit a Record</h2>
      <h3>PHP/SQL Development Project</h3>
<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];
} elseif (isset($_POST['id']) && is_numeric($_POST['id'])) {
  $id = $_POST['id'];
} else {
  echo '<p class="error">This page has been accessed in error.</p>';
  exit();
}

require ('mysqli_connect.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $errors = array();
  if (empty($_POST['fname'])) {
    $errors[] = 'enter a first name';
  } else {
    $fn = mysqli_real_escape_string($dbcon, trim($_POST['fname']));
  }
  if (empty($_POST['lname'])) {
    $errors[] = 'enter a last name';
  } else {
    $fn = mysqli_real_escape_string($dbcon, trim($_POST['lname']));
  }
  if (empty($_POST['email'])) {
    $errors[] = 'enter an email';
  } else {
    $fn = mysqli_real_escape_string($dbcon, trim($_POST['email']));
  }
  if (empty($errors)) {
    $q = "UPDATE users SET fname='$fn', lname='$ln', email='$e'
          WHERE user_id=$id LIMIT 1";
    $result = @mysqli_query ($dbcon, $q);
    if (mysqli_affected_rows($dbcon) == 1) {
      echo '<h3>user profile updated</h3>';
    } else {
      echo '<p class="error">system error: profile update failed</p>';
      echo '<p>' . mysqli_error($dbcon). '<br/>Query: ' . $p . '</p>';
    }
  } else {
    echo '<p class="error">The following errors occurred:<br/>';
      foreach($errors as $msg) {
        echo " - $msg<br/>\n";
      }
    echo '</p><p>try again</p>';
  }
}
$q = "SELECT fname, lname, email, FROM users WHERE user_id=$id";
$result = @mysqli_query ($dbcon, $q);
if (mysqli_num_rows($result) == 1) {
  $row = mysqli_fetch_array($result, MYSQLI_NUM);
  echo '<form action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '"
         method="post"/>
          <p><label for="fname">first name</label>
            <input type="text" name="fname" size="30" maxlength="30"
              value="' . $row[0] . '" /></p>
          <p><label for="lname">last name</label>
            <input type="text" name="lname" size="30" maxlength="30"
              value="' . $row[1] . '" /></p>
          <p><label for="email">email</label>
            <input type="text" name="email"  size="30" maxlength="30"
              value="' . $row[2] . '"/></p>
        </form>';
} else {
  echo '<p class="error">This page has been accessed in error</p>';
}
mysqli_close($dbcon);
?>
    </div>
    <?php include('sidebar.php'); ?>
  </div>
  <?php include('footer.php'); ?>
</body>

<script src="#">
</script>

</html>
