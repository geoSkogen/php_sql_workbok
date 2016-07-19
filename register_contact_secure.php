<?php
session_start();
/*if (!isset($_SESSION['user_level']) or ($_SESSION['user_level']) != 1) {
  header("Location: login.php");
  exit();
}*/
?>

<!DOCTYPE html>

<html lang="en">

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
      <h2>Registeration Page</h2>
      <h3>PHP/SQL Development Project</h3>
      <?php
      require('mysqli_connect_postal.php');
      $paid = 'NO';
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = array();
        if (!empty($_POST["title"])) {
          $un_title = trim($_POST["title"]);
          $title = mysqli_real_escape_string($dbcon, strip_tags($un_title));
        } else {
          $title = NULL;
        }

        if (!empty($_POST["fname"])) {
          $un_fname = trim($_POST["fname"]);
          $fname = mysqli_real_escape_string($dbcon, strip_tags($un_fname));
          $len = mb_strlen($fname, 'utf-8');
          if ($len < 1) {
            $errors[] = "enter first name";
          } else {
            if (!preg_match("/^([a-zA-Z\-\']+[[:space:]]?)+$/",$fname)) {
              $errors[] = "enter a valid first name";
            }
          }
        } else {
          $errors[] = "enter first name";
        }

        if (!empty($_POST["lname"])) {
          $un_lname = trim($_POST["lname"]);
          $lname = mysqli_real_escape_string($dbcon, strip_tags($un_lname));
          $len = mb_strlen($lname, 'utf-8');
          if ($len < 1) {
            $errors[] = "enter last name";
          } else {
            if (!preg_match("/^([a-zA-Z\-\']+[[:space:]]?)+$/",$lname)) {
              $errors[] = "enter a valid last name";
            }
          }
        } else {
          $errors[] = "enter a last name";
        }

        $e = FALSE;
        if (empty($_POST["email"])) {
          $errors[] = "enter an email address";
        }
        if (filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
          $e = mysqli_real_escape_string($dbcon, (trim($_POST['email'])));
        } else {
          $errors[] = "enter a valid email address";
        }

        if (!empty($_POST["uname"])) {
          $un_uname = trim($_POST["uname"]);
          $uname = mysqli_real_escape_string($dbcon, strip_tags($un_uname));
          $len = mb_strlen($uname, 'utf-8');
          if ($len < 1) {
            $errors[] = "enter your user name";
          }
        } else {
          $errors[] = "enter your user name";
        }

        if (empty($_POST["psword1"])) {
          $errors[] = "enter a password";
        } else {
          $p1 = trim($_POST["psword1"]);
          if (!preg_match('/^\w{8,12}$/', $p1)) {
            $errors[] = "invalid password format";
          } else {
            if ($_POST["psword1"] == $_POST["psword2"]) {
            $p = mysqli_real_escape_string($dbcon, trim($p1));
            } else {
            $errors[] = "passwords don't match";
            }
          }
        }

        if (empty($_POST["class"])) {
          $errors[] = "select membership class";
        } else {
          $class = trim($_POST["class"]);
        }

        if (!empty($_POST["addr_line1"])) {
          $un_add1 = trim($_POST["addr_line1"]);
          $addr_line1 = mysqli_real_escape_string($dbcon, strip_tags($un_add1));
          $len = mb_strlen($addr_line1, 'utf-8');
          if ($len < 1) {
            $errors[] = "enter a street address";
          } else {
            if (!preg_match("/^[0-9]+([[:space:]][[:alnum:]]+\.*)+$/", $addr_line1)) {
              $errors[] = "enter a valid street address";
            }
          }
        } else {
          $errors[] = "enter a street address";
        }

        if (!empty($_POST["addr_line2"])) {
          $un_add2 = trim($_POST["addr_line2"]);
          $addr_line2 = mysqli_real_escape_string($dbcon, strip_tags($un_add2));
        } else {
          $addr_line2 = NULL;
        }

        if (!empty($_POST["city"])) {
          $un_city = trim($_POST["city"]);
          $city = mysqli_real_escape_string($dbcon, strip_tags($un_city));
          $len = mb_strlen($city, 'utf-8');
          if ($len < 1) {
            $errors[] = "enter a city";
          } else {
            if ((!preg_match("/^([a-zA-Z\-\']+[[:space:]]?)+$/",$city))) {
              $errors[] = "enter a valid city name";
            }
          }
        } else {
          $errors[] = "enter a city";
        }

        if (!empty($_POST["state"])) {
          $un_state = trim($_POST["state"]);
          $state = mysqli_real_escape_string($dbcon, strip_tags($un_state));
          $len = mb_strlen($state, 'utf-8');
          if ($len < 1) {
            $errors[] = "enter a state";
          } else {
            if (!preg_match("/^[A-Z]{2}$/",$state)) {
              $errors[] = "enter a valid state code";
            }
          }
        } else {
          $errors[] = "enter a state";
        }

        if (!empty($_POST["pcode"])) {
          $un_pcode = trim($_POST["pcode"]);
          $pcode = mysqli_real_escape_string($dbcon, strip_tags($un_pcode));
          $len = mb_strlen($pcode, 'utf-8');
          if ($len < 1) {
            $errors[] = "enter a postal code";
          } else {
            if (!preg_match("/^([0-9]{5}){1}(-[0-9]{4})?$/",$pcode)){
              $errors[] = "enter a valid postal code";
            }
          }
        } else {
          $errors[] = "enter a postal code";
        }

        if (!empty($_POST["phone"])) {
          $un_phone = trim($_POST["phone"]);
          $repl_phone = mysqli_real_escape_string($dbcon, strip_tags($un_phone));
          $phone = preg_replace('/\D+/', '', ($repl_phone));
        } else {
          $phone = NULL;
        }

        if (empty($errors)) {
        //  require ('mysqli_connect_postal.php');
          $q = "SELECT user_id FROM users WHERE email='$e' ";
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
