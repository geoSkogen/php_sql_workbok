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
</title>

<link rel="stylesheet" href="include.css"/>

</head>

<body>
  <?php include('header_thanks.php'); ?>
  <div class="flexOuter">
    <?php include('nav.php'); ?>
    <div class="flexInnerTable">
      <h2>View Users</h2>
      <h3>PHP/SQL Development Project</h3>
<?php
require('mysqli_connect.php');
$q = "SELECT lname, fname, email,
      DATE_FORMAT(registration_date, '%m %d %Y') AS regdat, user_id
      FROM users
      ORDER BY registration_date ASC";
$result = @mysqli_query ($dbcon, $q);
if ($result) {
  echo '<table>
          <tr>
            <td><strong>edit</strong></td>
            <td><strong>delete</strong></td>
            <td><strong>Last</strong></td>
            <td><strong>First</strong></td>
            <td><strong>email</strong></td>
            <td><strong>Join Date</strong></td>
            <td><strong>User ID</strong></td>
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
           </tr>';
  }
  echo '</table>';
  mysqli_free_result ($result);
} else {
  echo '<p class="error">could not retrieve user records</p>';
  echo '<p>' . mysqli_error($dbcon) . '<br/><br/>Query: ' . $q . '</p>';
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
