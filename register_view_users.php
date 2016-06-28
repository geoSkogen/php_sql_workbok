<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">

<title>
</title>

<link rel="stylesheet" href="include.css"/>

</head>

<body>
  <?php include('template_header.php'); ?>
  <div class="flexOuter">
    <?php include('template_nav.php'); ?>
    <div class="flexInnerTable">
      <h2>View Users</h2>
      <h3>PHP/SQL Development Project</h3>
<?php
require('mysqli_connect.php');
$q = "SELECT CONCAT(lname, ', ', fname) AS name,
      DATE_FORMAT(registration_date, '%m %d %Y') AS regdat FROM users
      ORDER BY registration_date ASC";
      $result = @mysqli_query ($dbcon, $q);
      if ($result) {
        echo '<table>
               <tr>
                 <td><strong>Name</strong></td>
                 <td><strong>Register Date</strong></td>
               </tr>';
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          echo '<tr>
                  <td>' . $row['name'] . '&nbsp;&nbsp;</td>
                  <td>' . $row['regdat'] . '&nbsp;&nbsp;</td>
                </tr>';
        }
      mysqli_free_result ($result);
    } else {
      echo '<p class="error">could not retrieve user records</p>';
      echo '<p>' . mysqli_error($dbcon) . '<br/><br/>Query: ' . $q . '</p>';
    }
  mysqli_close($dbcon);
?>
    </div>
  </div>
</body>

<script src="#">
</script>

</html>
