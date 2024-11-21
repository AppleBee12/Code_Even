<?php

  include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php'); // DB 연결

  $leid = isset($_GET['leid']) ? $_GET['leid'] : '';

  $sql_default_book = "
      SELECT b.boid, b.title 
      FROM book b
      JOIN lecture l ON b.boid = l.boid
      WHERE l.leid = '$leid'
  ";

  $result_default_book = $mysqli->query($sql_default_book);

  if ($result_default_book && $result_default_book->num_rows > 0) {
  $default_book = $result_default_book->fetch_assoc();
  } else {
  $default_book = null;
  }


?>
