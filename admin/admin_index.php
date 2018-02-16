<?php
   require_once('phpscripts/config.php');
   confirm_logged_in();
   
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome to the admin panel login</title>
</head>
<body>

  <?php echo $_SESSION['user_name']; ?>
</body>
</html>
