<?php
session_start();
$_SESSION['test'] = "hello session";
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
<p><?php echo $_SESSION['test']; ?></p>
</body>
</html>
