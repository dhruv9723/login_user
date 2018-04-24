<?php
   //ini_set('display_errors',1);
   //error_reporting(E_ALL);

   require_once('phpscripts/config.php');

   $ip = $_SERVER['REMOTE_ADDR']; // accesses the ip address of the PC
   //echo $ip;
   if(isset($_POST['submit'])){
     $username = trim($_POST['username']); //it removes the whitespace the spaces at the beginning or end of the username could be there if copy or pasted in there.
     $password = trim($_POST['password']);
     if($username !== "" && $password !== ""){ // !     == "" this does not mean exactly equal to, this means they have to put in a username or password.
       $result = logIn($username, $password, $ip);
       $message = $result;
     }else{
       $message = "Please fill in the required fields";
     }
   }

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/main.css">
<title>CMS Portal Login</title>
</head>
<body>

<div id="container">
  <h1>Welcome!</h1>
  <?php if(!empty($message)){echo $message;}?>
  <form action="admin_login.php" method="post">
    <lable>Username:</lable>
    <input type="text" name="username" value="" id="username">
    <br>
    <lable>Password</lable>
    <input type="text" name="password" value="" id="password">
    <br>
      <div id="downfirst">
        <input type="submit" name="submit" value="Login">
      </div>
  </form>
</div>

</body>
</html>
