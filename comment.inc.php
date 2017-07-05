<?php

    function setComment($conn){
      if (isset($_POST['commentSubmit'])) {
        $uid = $_POST['uid'];
        $date = $_POST['date'];
        $message = $_POST['message'];

        $sql = "insert into comments(uid,date,message) values('$uid','$date','$message')";
        mysqli_query($conn,$sql);
      }
    }


    function getComment($conn){
      $sql = "select * from comments";
      $result = mysqli_query($conn,$sql);
      while($row = mysqli_fetch_assoc($result)){
        // get username for each comments
        $id = $row['uid'];
        $sqlGetUsername = "select * from users where id='$id'";
        $userresult = mysqli_query($conn,$sqlGetUsername);
        while ($userrow = mysqli_fetch_assoc($userresult)){
          $uid = $userrow['uid'];
          echo "<div class = 'comment-box'>";
          echo $uid.'</br><p>';
          echo $row['date'].'</br> ';
          echo nl2br($row['message']);
          echo "</p>";

          if(isset($_SESSION['id'])){
            if($_SESSION['id']==$userrow['id']){
                echo "<form class='delet-form' method='POST' action='".deletComment($conn)."'>
                        <input type='hidden' name='cid' value='".$row['cid']."'></input>
                        <input type='hidden' name='uid' value='".$row['uid']."'></input>
                        <button type='submit' name='submit'>Delet</button>
                      </form>
                      <form class='edit-form' method='POST' action='editcomment.php'>
                        <input type='hidden' name='cid' value='".$row['cid']."'></input>
                        <input type='hidden' name='uid' value='".$row['uid']."'></input>
                        <input type='hidden' name='date' value='".$row['date']."'></input>
                        <input type='hidden' name='message' value='".$row['message']."'></input>
                        <button>Edit</button>
                      </form>";
            } else{
                echo "<form class='edit-form' method='POST' action='".deletComment($conn)."'>
                        <input type='hidden' name='cid' value='".$row['cid']."'></input>
                        <input type='hidden' name='uid' value='".$row['uid']."'></input>
                        <button type='submit' name='submit'>Reply</button>
                      </form>";
              }
          }else{
            echo "<p class='commentmessage'>You need to login to reply</p>";
          }

          echo "</div>";
        }


      }
    }

    function editComment($conn){
      if (isset($_POST['submit'])) {
        $cid = $_POST['cid'];
        $uid = $_POST['uid'];
        $date = $_POST['date'];
        $message = $_POST['message'];

        $sql = "update comments set message='$message' where cid='$cid'";
        mysqli_query($conn,$sql);
        header('Location: index.php');
        exit();
      }
    }
    function deletComment($conn){
      if (isset($_POST['submit'])) {
        $cid = $_POST['cid'];
        $uid = $_POST['uid'];
        $sql = "delete from comments where cid='$cid'";
        mysqli_query($conn,$sql);
        header('Location: index.php');
        exit();
      }
    }

    function getlogin($conn){
      if(isset($_POST['loginSubmit'])){
        $uid = mysqli_real_escape_string($conn,$_POST['uid']);
        $pwd = mysqli_real_escape_string($conn,$_POST['pwd']);
        $sql = "select * from users where uid='$uid' and pwd='$pwd'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)==1){
          if($row = mysqli_fetch_assoc($result)){
            $_SESSION['id'] = $row['id'];
            $_SESSION['uid'] = $row['uid'];
          }
        }else{
          header("Location: index.php?loginsuccess=");
          exit();
        }
      }

    }

    function userLogout(){
      if(isset($_POST['logoutSubmit'])){
        session_start();
        session_destroy();
        header("Location: index.php");
        exit();
      }
    }
