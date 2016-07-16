<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">

<title>
  thanks
</title>

<link rel="stylesheet" href="include.css"/>

</head>

<body>
  <?php include('header_thanks.php'); ?>
  <div class="flexOuter">
    <?php include('nav.php'); ?>
    <div class="flexInner">
      <h2>Registration Successful</h2>
      <h3>Now what?</h3>
      <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_s-xclick"/>
        <input type="hidden" name="hosted_button_id" value="XXXXXXXXXXXX"/>
        <table>
          <tr><td><input type="hidden" name="on0" value="membership level">
                  <b>membership level</b></td></tr>
          <tr><td>
          <select name="os0">
            <option value="1 year pro &mdash; $30">1 year pro &mdash; $30</option>
            <option value="5 year pro &mdash; $125">5 year pro &mdash; $125</option>
            <option value="armed forces 1 year pro &mdash; $5">armed forces 1 year pro &mdash; $5</option>
            <option value="21 &amp; younger &mdash; $2">21 &amp; younger &mdash; $2</option>
            <option value="1 year basic &mdash; $5">1 year basic &mdash; $5</option>
          </select>
          </tr></td>
        </table>
        <input type="hidden" name="currency_code" value="GBP">
        <input type="image"
         src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_buynowCC_LG.gif"
         name="submit" alt="paypal"/>
        <img alt="" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif"
         width="1" height="1"/>
      </form>
    </div>
  <?php include('sidebar_register_contact.php'); ?>
</div>
<?php include('footer.php'); ?>
</body>
<script src="#">
</script>

</html>
