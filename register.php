<head>

<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">

<title>
</title>

<link rel="stylesheet" href="include.css"/>

</head>

<body>
  <?php include('header_register.php'); ?>
  <div class="flexOuter">
    <?php include('nav.php'); ?>
    <div class="flexInner">
      <h2>Register Page</h2>
      <h3>PHP/SQL Development Project</h3>
      <?php
      require('mysqli_connect.php');
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = array();
        if (empty($_POST["fname"])) {
          $errors[] = "enter first name";
        } else {
          $fn = mysqli_real_escape_string($dbcon, trim($_POST["fname"]));
        }

        if (empty($_POST["lname"])) {
          $errors[] = "enter last name";
        } else {
          $ln = mysqli_real_escape_string($dbcon, trim($_POST["lname"]));
        }

        if (empty($_POST["email"])) {
          $errors[] = "enter email";
        } else {
          $e = mysqli_real_escape_string($dbcon, trim($_POST["email"]));
        }

        if (!empty($_POST["psword1"])) {
          if ($_POST["psword1"] != $_POST["psword2"]) {
            $errors[] = "passwords don't match";
          } else {
            $p = mysqli_real_escape_string($dbcon, trim($_POST["psword1"]));
          }
        } else {
          $errors[] = "enter a password";
        }

        if (empty($errors)) {
          require ('mysqli_connect.php');
          $q = "INSERT INTO users (user_id, fname, lname, email, psword,
            registration_date)
                VALUES ('', '$fn', '$ln', '$e', SHA1('$p'), NOW())";
          $result = @mysqli_query ($dbcon, $q);
          if ($result) {
            header ("location: thanks.php");
            exit();
          } else {
            echo '<h2>System Error</h2>
                  <p class="error">We could not log you in due to a System
                   error.</p>';
            echo '<p>' . mysqli_error($dbcon) . '<br/><br/>Query:' . $q . '</p>';
          }
          mysqli_close($dbcon);
        } else {
          echo '<h2>Input Error</h2>
                <p class="error">The following error(s) occurred:<br/>';
          foreach ($errors as $msg) {
            echo " - $msg<br/>\n";
          }
          echo '</p><h3>Please try again.</h3><p><br/></p>';
        }

      } ?>
      <form action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
        method="post">
        <p><label class="label" for="fname">first name</label>
           <input id="fname" type="text" name="fname" size="30" maxlength="30"
             value="<?php if (isset($POST["lname"])) echo $POST["lname"]; ?>"/></p>
        <p><label class="label" for="lname">last name</label>
           <input id="lname" type="text" name="lname" size="30" maxlength="40"
           value="<?php if (isset($POST["fname"])) echo $POST["fname"]; ?>"/></p>
        <p><label class="label" for="email">email</label>
           <input id="email" type="text" name="email" size="30" maxlength="60"
           value="<?php if (isset($POST["email"])) echo $POST["email"]; ?>"/></p>
        <p><label class="label" for="psword1">password</label>
           <input id="psword1" type="password" name="psword1" size="12" maxlength="12"/></p>
        <p><label class="label" for="psword2">re-enter password</label>
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
