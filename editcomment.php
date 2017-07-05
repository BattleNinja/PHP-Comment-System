<?php
  include 'dbh.inc.php';
  include 'comment.inc.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>cao</h1>
    <?php
    $cid = $_POST['cid'];
    $uid = $_POST['uid'];
    $date = $_POST['date'];
    $message =  $_POST['message'];


    echo ' <form action="'.editcomment($conn).'"  method="POST">';
    echo   ' <input type="hidden" name="cid" value="'.$cid.'">';
    echo   ' <input type="hidden" name="uid" value="'.$uid.'">';
    echo   ' <input type="hidden" name="date" value="'.$date.'">';
    echo   ' <textarea name="message" rows="8" cols="80">'.$message.'</textarea>';
    echo    '<button type="submit" name="submit">Edit</button>';
    echo '</form>';
    ?>



  </body>
</html>
