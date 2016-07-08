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
Admin Page
</title>

<link rel="stylesheet" href="include.css"/>

</head>

<body>
  <?php include('header_admin.php'); ?>
  <div class="flexOuter">
    <?php include('nav.php'); ?>
    <div class="flexInner">
      <h2>Admin</h2>
      <h3>PHP/SQL Development Project</h3>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  function validate($db, $datum, $errMsg) {
    if (empty($datum)) {
      $errors[] = "enter your $errMsg";
    } else {
      $validArr[$index] = mysqli_real_escape_string($db, trim($datum));
    }
  }
}
?>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"/>
        <p><label for="lname">last name</label>
        <input type="text" name="lname" /></p>
        <p><label for="fname">first name</label>
        <input type="text" name="fname" /></p>
        <p><label for="email">email</label>
        <input type="text" name="email" /></p>
      </form>
    </div>
    <?php include('sidebar.php'); ?>
  </div>
  <?php include('footer.php'); ?>
</body>

<script src="#">
</script>

</html>
