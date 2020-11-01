<?php
	
	/* Pagination Example With Ajax */

  include "includes/db_connect.inc.php";

  $perPage = 2;
  $a = 1;

  $sql = "SELECT u.first_name, c.comment_text FROM users u, comments c
          WHERE u.user_id = c.user_id LIMIT $perPage;";
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

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script>
      $(document).ready(function(){
        var i = 2;
        $('#ldBtn').click(function(){
          i = i + 2;
          $('#comments').load('nextComments.php',{limitValue: i});
        });
      });

      $(document).ready(function(){
        var j = 0;
        $('#btnNext').click(function(){
          j = j + 2;
          $('#comments').load('nextComments.php',{startingVal: j});
        });

        $('#btnPrev').click(function(){
          j = j - 2;
          $('#comments').load('nextComments.php',{startingVal: j});
        });

      });

      $(document).ready(function(){
        $('#searchBox').on('blur',function(){
          $('#comments').load('nextComments.php',{searchText: document.getElementById('searchBox').value});
        });
      });

    </script>

  </head>
  <body>
    <input type="text" id="searchBox" placeholder="search comment here...">
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

    <!-- <button class="btnpg" type="button" name="btnLd" id="ldBtn">LOAD MORE...</button> -->
    <button class="btnpg" type="button" name="prevBtn" id="btnPrev">Previous</button>
    <button class="btnpg" type="button" name="nxtBtn" id="btnNext">Next</button>

  </body>














</html>
