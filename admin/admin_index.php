<?php
   //ini_set('display_errors',1);
   //error_reporting(E_ALL);

   require_once('phpscripts/config.php');
   confirm_logged_in();

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/main.css">
<title>CMS Portal Login</title>
</head>
<body>
  <div id="container2">
  <h1>Welcome!</h1>
  <?php echo "<h2>Hi {$_SESSION['user_name']}</h2>"; ?>
  <?php echo "<h3>You were here last: {$_SESSION['past_login']}</h3>"?>
  <div id="down"><?php
    $timezone = date_default_timezone_set("America/Toronto");
    $time = date("H");

    if ($time < "12") {
        echo "Good Morning!";
    } else

    if ($time >= "12" && $time < "17") {
        echo "Good Afternoon";
    } else

    if ($time >= "17" && $time < "19") {
        echo "Good Evening!";
    } else

    if ($time >= "19") {
        echo "Good Night!";
    }
  ?></div>
</div>
</body>
</html>
