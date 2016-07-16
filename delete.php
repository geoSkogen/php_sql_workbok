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
 delete
</title>

<link rel="stylesheet" href="include.css"/>

</head>

<body>
  <?php include('header_admin.php'); ?>
  <div class="flexOuter">
    <?php include('nav.php'); ?>
    <div class="flexInner">
      <h2>Delete Record</h2>
      <h3>PHP/SQL Development Project</h3>
<?php
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) {
  $id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ){
  $id = $_POST['id'];
} else {
  echo '<p class="error">This page has been accessed in error.</p>';
  exit();
}
require ('mysqli_connect.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($_POST['confirm_delete'] == 'delete') {
    $q = "DELETE FROM users WHERE user_id=$id LIMIT 1";
    $result = @mysqli_query ($dbcon, $q);
    if (mysqli_affected_rows($dbcon) == 1) {
      echo '<h4>record deleted</h4>';
    } else {
      echo '<p class="error">The record would not delete &mdash; system error</p>';
      echo '<p>' . mysqli_error($dbcon) . '<br/>Query:' . $q .'</p>';
    }
  } else {
    echo '<h4>record will not be deleted</4>';
  }
} else {
  $q = "SELECT CONCAT(fname, ' ', lname) FROM users WHERE user_id=$id";
  $result = @mysqli_query ($dbcon, $q);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array ($result, MYSQLI_NUM);
    echo "<h3>Permanently Delete $row[0]?</h3>";
    echo '<form action=" ' . htmlspecialchars($_SERVER['PHP_SELF']) . ' " method="post">
            <input id="submit" type="submit" name="confirm_delete" value="delete"></input>
            <input id="submit" type="submit" name="confirm_delete" value="cancel"></input>
            <input id="submit" type="hidden" name="id" value=" '. $id .'"></input>
          </form>';
  } else {
    echo '<p class="error">invalid user ID</p>';
  }
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
