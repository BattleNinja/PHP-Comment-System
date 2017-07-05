<?php
date_default_timezone_set('America/New_York');
include 'dbh.inc.php';
include 'comment.inc.php';
session_start();
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php
  //login
  if(!isset($_SESSION['id'])){
    echo "<form action='".getlogin($conn)."' method='POST'>
            <input type='text' name='uid' placeholder='Username'>
            <input type='password' name='pwd' placeholder='Password'>
            <button type='submit' name='loginSubmit'>Login</button>
          </form>" ;
  }

 //logput
 if(isset($_SESSION['id'])){
   echo "<form class='' action='".userLogout()."' method='post'>
           <button type='submit' name='logoutSubmit'>Logout</button>
         </form>" ;
 }


  ?>


<?php
// comment
if(isset($_SESSION['id'])){
  $username =$_SESSION['id'];
  echo '<form class="" action="'.setComment($conn).'" method="POST">
              <input type="hidden" name="uid" value="'.$username.'">
              <input type="hidden" name="date" value="' .date("Y-m-d H:i:s"). '">
              <textarea name="message"></textarea>
              </br>
              <button type="submit" name="commentSubmit">Comment</button>
            </form>';
}else{
  echo '<h1>You need log in</h1>';




}

getComment($conn);
?>

</body>
</html>
