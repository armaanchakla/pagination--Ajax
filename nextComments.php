<?php

  include "includes/db_connect.inc.php";

  if(isset($_POST['limitValue'])){
    $lv = $_POST['limitValue'];
    $sql = "SELECT u.first_name, c.comment_text FROM users u, comments c
            WHERE u.user_id = c.user_id LIMIT $lv;";

    $result = mysqli_query($conn, $sql);
  }
  else if(isset($_POST['startingVal'])){
    $sv = $_POST['startingVal'];
    $sql = "SELECT u.first_name, c.comment_text FROM users u, comments c
            WHERE u.user_id = c.user_id LIMIT $sv, 2;";

    $result = mysqli_query($conn, $sql);
  }
  else if(isset($_POST['searchText'])){
    $st = $_POST['searchText'];
    $sql = "SELECT u.first_name, c.comment_text FROM users u, comments c
            WHERE u.user_id = c.user_id AND c.comment_text LIKE '%$st%';";

    $result = mysqli_query($conn, $sql);
  }


  while($row = mysqli_fetch_assoc($result)){
    echo "<b>" . $row['first_name'] . ": </b>";
    echo "<br>";
    echo $row['comment_text'];
    echo "<br><br>";
  }

?>
