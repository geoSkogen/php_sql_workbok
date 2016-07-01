<?php
session_start();
/*if (!isset($_SESSION['user_level']) or ($_SESSION['user_level']) != 0) {
  header("Location: login.php");
  exit();
}*/
?>
<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">

<title>
  home
</title>

<link rel="stylesheet" href="include.css"/>

</head>

<body>
  <?php include('header_members.php'); ?>
  <div class="flexOuter">
    <?php include('nav.php'); ?>
    <div class="flexInner">
      <h2>Members Page</h2>
      <h3>PHP/SQL Development Project</h3>
      <p>Imagine this lone sentence.</p>
      <p>Image members-only content.</p>
    </div>
    <?php include('sidebar.php'); ?>
  </div>
  <?php include('footer.php'); ?>
</body>

<script src="#">
</script>

</html>
