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
      <h2>Search Results</h2>
      <h3>PHP/SQL Development Project</h3>
<?php
require('mysqli_connect_postal.php');
$fname = mysqli_real_escape_string($dbcon, trim($_POST['fname']));
$lname = mysqli_real_escape_string($dbcon, trim($_POST['lname']));
$q = "SELECT lname, fname, email, DATE_FORMAT(registration_date, '%M %d, %Y')
      AS regdat, user_id, class, paid FROM users WHERE lname='$lname' AND fname='$fname'
      ORDER BY registration_date ASC";
$result = @mysqli_query ($dbcon, $q);
if ($result) {
  echo '<table>
          <tr>
            <td><strong>edit</strong></td>
            <td><strong>delete</strong></td>
            <td><strong>last</strong></td>
            <td><strong>first</strong></td>
            <td><strong>email</strong></td>
            <td><strong>join date</strong></td>
            <td><strong>user ID</strong></td>
            <td><strong>member level</strong></td>
            <td><strong>paid?</strong></td>
           </tr>';
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
     echo '<tr>
             <td><a href="edit.php?id=' . $row['user_id'] . '"
                  class="regLink">edit&nbsp;&nbsp;</a></td>
             <td><a href="delete.php?id=' . $row['user_id'] . '"
                  class="regLink">delete&nbsp;&nbsp;</a></td>
             <td>' . $row['lname'] . '&nbsp;&nbsp;</td>
             <td>' . $row['fname'] . '&nbsp;&nbsp;</td>
             <td>' . $row['email'] . '&nbsp;&nbsp;</td>
             <td>' . $row['regdat'] . '&nbsp;&nbsp;</td>
             <td>' . $row['user_id'] . '&nbsp;&nbsp;</td>
             <td>' . $row['class'] . '&nbsp;&nbsp;</td>
             <td>' . $row['paid'] . '&nbsp;&nbsp;</td>
           </tr>';
  }
  echo '</table>';
  mysqli_free_result ($result);
} else {
  echo '<p class="error">could not retrieve user records</p>';
  echo '<p>' . mysqli_error($dbcon) . '<br/><br/>Query: ' . $q . '</p>';
}
$q = "SELECT COUNT(user_id) FROM users";
$result = @mysqli_query ($dbcon, $q);
$row = @mysqli_fetch_array ($result, MYSQLI_NUM);
$members = $row[0];
mysqli_close($dbcon);
echo "<p>total members: $members</p>";
?>
    </div>
    <?php include('sidebar.php'); ?>
  </div>
  <?php include('footer.php'); ?>
</body>

<script src="#">
</script>

</html>
