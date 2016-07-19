<?php
session_start();
//if (empty($_SESSION['user_level']) || $_SESSION['user_level'] != 0) {
//  header('Location: index.php');
//}
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
  <?php
  include('header_members.php'); ?>
  <div class="flexOuter">
    <?php include('nav.php');?>
    <div class="flexInner">
      <h2>Members Page</h2>
      <div class="centerMe">
        <img src="hotdog.jpg" alt="hotdog" width="300" height="300"/>
      </div>
      <p>Imagine this lone sentence.</p>
      <p>Imagine members-only content.</p>
    </div>
    <?php include('sidebar.php'); ?>
  </div>
  <?php include('footer.php'); ?>
</body>

<script src="#">
</script>

</html>
