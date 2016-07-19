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
  view users
</title>

<link rel="stylesheet" href="include.css"/>

</head>

<body>
  <?php include('header_admin.php'); ?>
  <div class="flexOuter">
    <?php include('nav.php'); ?>
    <div class="flexInnerTable">
      <h2>View Users</h2>
      <h3>PHP/SQL Development Project</h3>
<?php
require('mysqli_connect_postal.php');
$pagerows = 4;
if (isset($_GET['p']) && is_numeric($_GET['p'])) {
  $pages = $_GET['p'];
} else {
  $q = "SELECT COUNT(user_id) FROM users";
  $result = @mysqli_query($dbcon, $q);
  $row = @mysqli_fetch_array ($result, MYSQLI_NUM);
  $records = $row[0];

  if ($records > $pagerows) {
    $pages = ceil ($records/$pagerows);
  } else {
    $pages = 1;
  }
}
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
  $start = $_GET['s'];
} else {
  $start = 0;
}
$q = "SELECT lname, fname, email,
      DATE_FORMAT(registration_date, '%m %d %Y') AS regdat, user_id, class, paid
      FROM users
      ORDER BY registration_date DESC LIMIT $start, $pagerows";
$result = @mysqli_query ($dbcon, $q);
$members = mysqli_num_rows($result);
if ($result) {
  echo '<table>
          <tr>
            <td><strong>edit</strong></td>
            <td><strong>delete</strong></td>
            <td><strong>last</strong></td>
            <td><strong>first</strong></td>
            <td><strong>email</strong></td>
            <td><strong>join date</strong></td>
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
$result = @mysqli_query($dbcon, $q);
$row = @mysqli_fetch_array($result, MYSQLI_NUM);
$members = $row[0];
mysqli_close($dbcon);
echo "<p>total membership: $members</p>";
if ($pages > 1) {
  echo '<p>';
  $current_page = ($start/$pagerows) + 1;
  if ($current_page != 1) {
    echo '<a class="regLink" href="viewusers_contact.php?s=' . ($start - $pagerows) . '&p=' .
    $pages . '">previous&nbsp;&nbsp;&nbsp;&nbsp;</a>';
  }
  if ($current_page != $pages) {
    echo '<a class="regLink" href="viewusers_contact.php?s=' . ($start + $pagerows) . '&p=' .
    $pages . '">next</a>';
  }
  echo '</p>';
}
?>
    </div>
    <?php include('sidebar.php'); ?>
  </div>
  <?php include('footer.php'); ?>
</body>

<script src="#">
</script>

</html>
