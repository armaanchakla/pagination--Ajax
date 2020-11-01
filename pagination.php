<?php

/* Pagination Example Without Ajax */

  include "includes/db_connect.inc.php";

  $perPage = 3;
  $a = 1;

  if(isset($_GET['next'])){
    $a = $_GET['next'];
  }
  else if(isset($_GET['prev'])){
    $a = $_GET['prev'];
  }
  else if(isset($_GET['pg'])){
    $a = $_GET['pg'];
  }

  $startingRow = ($a-1) * $perPage;

  $sql = "SELECT u.first_name, c.comment_text FROM users u, comments c
          WHERE u.user_id = c.user_id LIMIT $startingRow, $perPage;";
  $result = mysqli_query($conn, $sql);

  $sqlTotalComments = "SELECT id FROM comments;";
  $resultTotalComments = mysqli_query($conn, $sqlTotalComments);
  $commentCount = mysqli_num_rows($resultTotalComments);

  $totalPage = ceil($commentCount / $perPage);

?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Comments</title>
    <style>
      body{
        background-color: #ffffff
      }
      #comments{
        background-color: #ffffff;
        padding: 10px;
        width: 40%;
      }
      #btn_load, .btnpg {
        background-color: white;
        color: black;
        border: 2px solid #000000;
        cursor: pointer;
        padding: 16px 32px;
      }

      #btn_load, .btnpg:hover {
        background-color: #000000;
        color: white;
      }

    </style>

  </head>
  <body>
    <div id="comments">
      <?php
        while($row = mysqli_fetch_assoc($result)){
          echo "<b>" . $row['first_name'] . ": </b>";
          echo "<br>";
          echo $row['comment_text'];
          echo "<br><br>";
        }
      ?>
    </div>

    <a class="btnpg" href="pagination.php?prev=<?php echo $a-1; ?>">Previous</a>
    <?php
      for($i=1; $i<=$totalPage; $i++){ ?>
        <a class="btnpg" href="pagination.php?pg=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php
      }
    ?>
    <a class="btnpg" href="pagination.php?next=<?php echo $a+1; ?>">Next</a>

  </body>














</html>
