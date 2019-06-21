<?php
session_start(); //start the session

require "db.php";

$isLogedIn = false;

if(isset($_POST['user_name']) && isset($_POST['user_pass'])){
  $user_name = $_POST['user_name'];
  $user_pass = $_POST['user_pass'];

  $select_sql = "SELECT `user_id`, `user_name`, `user_pass` FROM `users` WHERE `user_name` LIKE '$user_name'";
  $execute_select = $connection -> query($select_sql);

  if($execute_select){
    $num_of_rows = mysqli_num_rows($execute_select);

    if($num_of_rows > 0){
      $row = $execute_select -> fetch_assoc();
      $db_user_id = $row['user_id'];
      $db_user_name = $row['user_name'];
      $db_user_pass = $row['user_pass'];

      if($db_user_name == $user_name && $db_user_pass == $user_pass){
        echo "logged in";
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $db_user_id;
        $isLogedIn = true;

        header("Location: ../../index.php");
      }else{
        echo "Username or password does not match."; //.$user_name." d".$db_user_name." ".$user_pass." d".$db_user_pass;
      }

    }else{
      echo "User not found";
    }

  }else{
    echo "Database Error!!".mysqli_error($connection);
  }

}else{
  echo "data not found";
}
?>
