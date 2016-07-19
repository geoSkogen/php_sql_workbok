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
  <?php include('header_members.php'); ?>
  <div class="flexOuter">
    <?php include('nav.php'); ?>
    <div class="flexInner">
      <h2>Edit Your Contact Info</h2>
      <h3>PHP/SQL Development Project</h3>
      <?php
      if ($_SERVER['REQUEST_METHOD']=="GET")/*(isset($_GET['id']) && is_numeric($_GET['id']))*/ {
        $id = $_GET['id'];
      } elseif ($_SERVER['REQUEST_METHOD']=="POST")/*(isset($_POST['id']) && is_numeric($_POST['id']))*/ {
        $id = $_POST['id'];
      } else {
        echo '<p class="error">This page has been accessed in error--getpost.</p>';
        exit();
      }
      require('mysqli_connect_postal.php');
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
          $phone = mysqli_real_escape_string($dbcon, strip_tags($un_phone));
        } else {
          $phone = NULL;
        }
        if (empty($errors)) {
          $q = "SELECT user_id FROM users WHERE lname='$lname' AND user_id!='$id'";
          $result = @mysqli_query($dbcon, $q);
          if (mysqli_num_rows($result) == 0) {
            $q = "UPDATE users SET title='$title', fname='$fname', lname='$lname',
                  email='$e', addr_line1='$addr_line1', addr_line2='$addr_line2',
                  city='$city', state='$state', pcode='$pcode', phone='$phone'
                  WHERE user_id='$id' LIMIT 1";
            $result = @mysqli_query ($dbcon, $q);
            if (mysqli_affected_rows($dbcon) == 1) {
              echo '<h3>your profile has been updated</h3>';
            } else {
              echo '<p class="error">system error -- update failed</p>';
              echo '<p>' . mysqli_error($dbcon). '<br/>Query:' . $q . '</p>';
            }
          }
        } else {
          echo '<p class="error">the following error(s) occurred:</br>';
            foreach ($errors as $msg) {
              echo " - $msg<br/>\n";
            }
          echo '</p><p>fill out required fields</p>';
        }
     }
     $q = "SELECT title, fname, lname, email, addr_line1, addr_line2, city,
           state, pcode, phone FROM users WHERE user_id='$id'";
     $result = @mysqli_query ($dbcon, $q);
     if (mysqli_num_rows($result) == 1) {
       $row = mysqli_fetch_array ($result, MYSQLI_NUM);
       echo
       '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '"
         method="post">
         <p><label class="label">title(optional)</label><input id="title"
            type="text" name="title" size="15" maxlength="15"
            value="' . $row[0] . '"/></p>
         <p><label class="label" for="fname">first name</label>
            <input id="fname" type="text" name="fname" size="30" maxlength="30"
            value="' . $row[1] . '"/></p>
         <p><label class="label" for="lname">last name</label>
            <input id="lname" type="text" name="lname" size="30" maxlength="40"
            value="' . $row[2] . '"/></p>
         <p><label class="label" for="email">email</label>
            <input id="email" type="text" name="email" size="30" maxlength="60"
            value="' . $row[3] . '"/></p>
            <input id="addr_line1" type="text" name="addr_line1" size="50" maxlength="50"0
            value="' . $row[4] . '"/></label></p>
         <p><label class="label">address line 2</label>
           <input id="addr_line2" type="text" name="addr_line2" size="50" maxlength="50"
           value="' . $row[5] . '"/></label></p>
         <p><label class="label">city</label>
           <input id="city" type="text" name="city" size="50" maxlength="50"
           value="' . $row[6] . '"/></label></p>
         <p><label class="label">state</label>
           <input id="state" type="text" name="state" size="25" maxlength="25"
           value="' . $row[7] . '"/></label></p>
         <p><label class="label">postal code</label>
           <input id="pcode" type="text" name="pcode" size="10" maxlength="10"
           value="' . $row[8] . '"/></label></p>
         <p><label class="label">phone(optional)</label>
           <input id="phone" type="text" name="phone" size="15" maxlength="15"
           value="' . $row[9] . '"/></label></p>
          <input type="hidden" value="' . $id . '" name="id"/>
         <p><input id="submit" type="submit" name="submit" value="submit"/></p>
       </form>';
     } else {
       echo '<p class="error">could not locate user info.</p>';
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
