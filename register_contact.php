<head>

<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">

<title>
  register
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
      require('mysqli_connect_postal.php');
      $paid = 'NO';
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = array();
        if (!empty($_POST["title"])) {
          $title = mysqli_real_escape_string($dbcon, trim($_POST["title"]));
        } else {
          $title = NULL;
        }

        if (empty($_POST["fname"])) {
          $errors[] = "enter first name";
        } else {
          $fname = mysqli_real_escape_string($dbcon, trim($_POST["fname"]));
        }

        if (empty($_POST["lname"])) {
          $errors[] = "enter last name";
        } else {
          $lname = mysqli_real_escape_string($dbcon, trim($_POST["lname"]));
        }

        if (empty($_POST["email"])) {
          $errors[] = "enter email";
        } else {
          $e = mysqli_real_escape_string($dbcon, trim($_POST["email"]));
          if (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "invalid email format";
          }
        }

        if (empty($_POST["uname"])) {
          $errors[] = "enter last name";
        } else {
          $uname = mysqli_real_escape_string($dbcon, trim($_POST["uname"]));
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

        if (empty($_POST["class"])) {
          $errors[] = "select membership class";
        } else {
          $class = trim($_POST["class"]);
        }

        if (empty($_POST["addr_line1"])) {
          $errors[] = "enter address";
        } else {
          $addr_line1 = mysqli_real_escape_string($dbcon, trim($_POST["addr_line1"]));
        }

        if (!empty($_POST["addr_line2"])) {
          $addr_line2 = mysqli_real_escape_string($dbcon, trim($_POST["addr_line2"]));
        } else {
          $addr_line2 = NULL;
        }

        if (empty($_POST["city"])) {
          $errors[] = "enter city";
        } else {
          $city = mysqli_real_escape_string($dbcon, trim($_POST["city"]));
        }

        if (empty($_POST["state"])) {
          $errors[] = "enter state";
        } else {
          $state = mysqli_real_escape_string($dbcon, trim($_POST["state"]));
        }

        if (empty($_POST["pcode"])) {
          $errors[] = "enter postal code";
        } else {
          $pcode = mysqli_real_escape_string($dbcon, trim($_POST["pcode"]));
        }

        if (!empty($_POST["phone"])) {
          $phone = mysqli_real_escape_string($dbcon, trim($_POST["phone"]));
        } else {
          $phone = NULL;
        }

        if (empty($errors)) {
        //  require ('mysqli_connect_postal.php');
          $q = "SELECT user_id FROM users WHERE email='e' ";
          $result = mysqli_query ($dbcon, $q);
          if (mysqli_num_rows($result) == 0) {
            $q = "INSERT INTO users (user_id, title, fname, lname, email, password,
                  registration_date, uname, class, addr_line1, addr_line2, city,
                  state, pcode, phone, paid)
                  VALUES ('', '$title', '$fname', '$lname', '$e', SHA1('$p'), NOW(),
                  '$uname', '$class', '$addr_line1', '$addr_line2', '$city',
                  '$state', '$pcode', '$phone', '$paid' )";
            $result = @mysqli_query ($dbcon, $q);
            if ($result) {
              mysqli_close($dbcon);
              header ("location: thanks.php");
              exit();
            } else {
              echo '<h2>System Error</h2>
                    <p class="error">We could not log you in due to a System
                     error.</p>';
              echo '<p>' . mysqli_error($dbcon) . '<br/><br/>Query:' . $q . '</p>';
            }
          } else {
            echo '<p class="error">there is already an account registered to
                            this email address</p>';
          }
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
        <label class="label" for="class">
            membership level</label>
           <select name="class">
             <option value="30" <?php if (isset($_POST['class']) AND
               ($_POST['class'] == 30)) echo ' selected="selected"';?>>
               1 year pro &mdash; $30</option>
             <option value="125" <?php if (isset($_POST['class']) AND
               ($_POST['class'] == 125)) echo ' selected="selected"';?>>
               5 year pro &mdash; $125</option>
             <option value="5" <?php if (isset($_POST['class']) AND
               ($_POST['class'] == 5)) echo ' selected="selected"';?>>
               armed forces 1 year pro &mdash; $5</option>
             <option value="2" <?php if (isset($_POST['class']) AND
               ($_POST['class'] == 2)) echo ' selected="selected"';?>>
                21 &amp; younger &mdash; $2</option>
             <option value="15" <?php if (isset($_POST['class']) AND
               ($_POST['class'] == 15)) echo ' selected="selected"';?>>
               1 year basic &mdash; $5</option>
           </select><br/>
        <p><label class="label">title(optional)</label><input id="title"
            type="text" name="title" size="15" maxlength="15"
            value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>"/></p>
        <p><label class="label" for="fname">first name</label>
           <input id="fname" type="text" name="fname" size="30" maxlength="30"
             value="<?php if (isset($POST["lname"])) echo $POST["lname"]; ?>"/></p>
        <p><label class="label" for="lname">last name</label>
           <input id="lname" type="text" name="lname" size="30" maxlength="40"
           value="<?php if (isset($POST["fname"])) echo $POST["fname"]; ?>"/></p>
        <p><label class="label" for="email">email</label>
           <input id="email" type="text" name="email" size="30" maxlength="60"
           value="<?php if (isset($POST["email"])) echo $POST["email"]; ?>"/></p>
        <p><label class="label">username</label>
           <input id="uname" type="text" name="uname" size="15" maxlength="15"
           value="<?php if (isset($_POST['uname'])) echo $_POST['uname']; ?>"/></label></p>
        <p><label class="label" for="psword1">password</label>
           <input id="psword1" type="password" name="psword1" size="12" maxlength="12"/></p>
        <p><label class="label" for="psword2">confirm password</label>
           <input id="psword2" type="password" name="psword2" size="12" maxlength="12"/></p>
        <p><label class="label">address line 1</label>
          <input id="addr_line1" type="text" name="addr_line1" size="50" maxlength="50"0
           value="<?php if (isset($_POST['addr_line1'])) echo $_POST['addr_line1']; ?>"/></label></p>
        <p><label class="label">address line 2</label>
          <input id="addr_line2" type="text" name="addr_line2" size="50" maxlength="50"
          value="<?php if (isset($_POST['addr_line2'])) echo $_POST['addr_line2']; ?>"/></label></p>
        <p><label class="label">city</label>
          <input id="city" type="text" name="city" size="50" maxlength="50"
          value="<?php if (isset($_POST['city'])) echo $_POST['city']; ?>"/></label></p>
        <p><label class="label">state</label>
          <input id="state" type="text" name="state" size="25" maxlength="25"
          value="<?php if (isset($_POST['state'])) echo $_POST['state']; ?>"/></label></p>
        <p><label class="label">postal code</label>
          <input id="pcode" type="text" name="pcode" size="10" maxlength="10"
          value="<?php if (isset($_POST['pcode'])) echo $_POST['pcode']; ?>"/></label></p>
        <p><label class="label">phone(optional)</label>
          <input id="phone" type="text" name="phone" size="15" maxlength="15"
          value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; ?>"/></label></p>
        <p><input id="submit" type="submit" name="submit" value="submit"/></p>
      </form>
    </div>
  <?php include('sidebar_register_contact.php'); ?>
</div>
<?php include('footer.php'); ?>
</body>

<script src="#">
</script>

</html>
