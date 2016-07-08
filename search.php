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
      <h2>Search</h2>
      <h3>PHP/SQL Development Project</h3>
      <form action="search_result.php" method="post">
        <p><label class="label" for="fname">first name</label>
           <input id="fname" type="text" name="fname" size="30" maxlength="30"
           value="<?php if (isset($POST["lname"])) echo $POST["lname"]; ?>"/></p>
        <p><label class="label" for="lname">last name</label>
           <input id="lname" type="text" name="lname" size="30" maxlength="40"
            value="<?php if (isset($POST["fname"])) echo $POST["fname"]; ?>"/></p>
           <input type="submit" name="submit" value="search"/>
      </form>
    </div>
    <?php include('sidebar.php'); ?>
    </div>
    <?php include('footer.php'); ?>
</body>

<script src="#">
</script>

</html>
