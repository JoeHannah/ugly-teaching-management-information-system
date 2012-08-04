<?php
  session_start();
  unset($_SESSION['login']);
  header("HTTP/1.1 303 See Other");
  header("Location: ./login.php");
  exit;
?>