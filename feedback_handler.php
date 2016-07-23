<?php
$mailto = "geoseph@msn.com";
$subject = "new comment";
$formurl = "contactus.php";
$errorurl = "errorpage_url.php";
$errorurlempty = "errorpage_empty.php";
$erroremailurl = "errorpage_email.php";
$errorcommenturl = "errorpage_comment.php";
$thankyouurl = "thanks_message.php";
$uself = 0;

$headersep = (!isset($uself) || ($uself==0)) ? "\r\n" : "\n";
$username = $_POST['username'];
$useremail = $_POST['useremail'];
$userphone = $_POST['userphone'];
if ($_POST['brochure']=='yes') {
  $brochure = $_POST['brochure'];
} else {
  $brochure = NULL;
}
$addr_line1 = $_POST['addr_line1'];
$addr_line2 = $_POST['addr_line2'];
$city = $_POST['city'];
$pcode = $_POST['pcode'];
$newsletter = $_POST['newsletter'];
$comment = $_POST['comment'];
$http_referrer = getenv("HTTP_REFERER");

if (empty($username) || empty($useremail) || empty($comment)) {
  header("Location: $errorurlempty");
  exit();
}

if (strpos($username, '://') || strpos($username, 'www') != false) {
  header("Location: $errorurl");
  exit();
}

if (strpos($useremail, '://') || strpos($useremail, 'www') != false) {
  header("Location: $errorurl");
  exit();
}

if (preg_match( "[\r\n]", $username) || preg_match( "[\r\n]", $useremail)) {
  header("Location: $errorurlempty");
  exit();
}

$useremail = trim($useremail);
$_name = "/^[-!#$%&\'*+\\.\/0-9=?A-Z^_`{|}~]+";
$_host = "([-0-9A-Z]+\.)+";
$_tlds = "([0-9A-Z]){2,4}$/i";
if (!preg_match($_name."@".$_host.$_tlds, $useremail)) {
  header("Location: $erroremailurl");
  exit();
}

if (strpos($addr_line1, '://') || strpos($addr_line1, 'www') != false) {
  header("Location: $errorurl");
  exit();
}

if (strpos($addr_line2, '://') || strpos($addr_line2, 'www') != false) {
  header("Location: $errorurl");
  exit();
}

if (strpos($city, '://') || strpos($city, 'www') != false) {
  header("Location: $errorurl");
  exit();
}

if (strpos($state, '://') || strpos($state, 'www') != false) {
  header("Location: $errorurl");
  exit();
}

if (strpos($pcode, '://') || strpos($pcode, 'www') != false) {
  header("Location: $errorurl");
  exit();
}

if (strpos($comment, '://') || strpos($comment, 'www') != false) {
  header("Location: $errorcommenturl");
  exit();
}

if($newsletter != NULL) {$newsletter = $newsletter;}
$messageproper =
"This message was sent from:\n" .
"$http_referrer\n" .
"---------------------------------------------------------------------------\n";
"Name of sender: $username\n" .
"Email of sender: $useremail\n" .
"Telephone: $phone\n" .
"brochure?: $brochure\n" .
"Address: $addr_line1" .
"Address: $addr_line2" .
"City: $city\n" .
"Postcode: $postcode\n" .
"Newsletter: $letter\n" .
"------------------------------------------------------------------------\n\n" .
$comment .
"\n\n-----------------------------------------------------------------------\n";
mail($mailto, $subject, $messageproper, "From: \"$username\" <$useremail>");
header("Location: $thankyouurl");
exit();
?>
