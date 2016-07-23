<?php
session_start();
//if (empty($_SESSION['user_level']) || $_SESSION['user_level'] != 0) {
//  header('Location: index.php');
//}
?>
<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">

<title>
  contact us
</title>

<link rel="stylesheet" href="include.css"/>

</head>

<body>
  <?php
  include('header_thanks.php'); ?>
  <div class="flexOuter">
    <?php include('nav.php');?>
    <div class="flexInner">
      <h2>Contact Us</h2>
      <form action="feedback_handler.php" method="post">
        <p><label class="label" for="username">your username</label>
           <input id="username" name="username" size="30" type="text"/><br/></p>
        <p><label class="label" for="useremail">your email</label>
           <input id="useremail" name="useremail" size="30" type="text"/><br/></p>
        <p><label class="label" for="userphone">phone #</label>
           <input id="userphone" name="userphone" size="30" type="number"/><br/></p>
        <br/>
        <p class="box">
           <input id="checkbox1" name="brochure" value="yes" type="checkbox"/>
           <p class="box">send me a brochure</p>
        </p>
        <p><label class="label" for="addr_line1">address line 1</label>
           <input id="addr_line1" name="addr_line1" size="30" type="text"/><br/></p>
        <p><label class="label" for="addr_line2">address line 2</label>
           <input id="addr_line2" name="addr_line2" size="30" type="text"/><br/></p>
        <p><label class="label" for="city">city</label>
           <input id="city" name="city" size="30" type="text"/><br/></p>
        <p><label class="label" for="state">state</label>
           <input id="state" name="state" size="30" type="text"/><br/></p>
        <p><label class="label" for="pcode">postal code</label>
           <input id="state" name="pcode" size="30" type="text"/><br/></p>
           <br/><br/>
           <h3>would you like to recieve our weekly newsletter?</h3>
        <p class="box">
          <p class="box">
            <input type="radio" name="newsletter" id="radio1" value="yes"/>
             &nbsp;&nbsp;yes&nbsp;&nbsp;</p>
          <p class="box">
            <input type="radio" name="newsletter" id="radio2" value="no"/>
             &nbsp;&nbsp;no</p>
         </p>
         <h3>enter your message below:</h3>
         <textarea id="comment" name="comment" rows="12" cols="60">
         </textarea><br/>
         <input type="submit" value="send" id="sb" title="send"/><br/>
      </form>
    </div>
    <?php include('sidebar.php'); ?>
  </div>
  <?php include('footer.php'); ?>
</body>

<script src="#">
</script>

</html>
