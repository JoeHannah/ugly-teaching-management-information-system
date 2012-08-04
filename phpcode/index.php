<?php
  session_start();
  require_once('./config.php');

  if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
  }
  elseif (isset($_SESSION['id']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['code']) && isset($_SESSION['AuthCode']) && $_POST['username'] == $username && $_POST['password'] == $password && md5($_POST['code']) == $_SESSION['AuthCode']) {
    $_SESSION['login'] = true;
  }
  else {
    header("HTTP/1.1 303 See Other");
    header("Location: ./login.php");
　　exit;
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="cache-control" content="no-cache">
  <meta http-equiv="expires" content="0">
  <title>教学管理信息系统</title>
 </head>
 <body style="overflow-y:hidden;">
  <table style="width:100%;height:100%" border="0" cellpadding="0" cellspacing="0">
   <tr style="height:96px">
    <td width="1024" colspan="2" style="background-image: url(./images/head.jpg);"></td>
   </tr>
   <tr>
    <td style="height:100%;width:14%;" border="0" valign="top">
	   <iframe height="100%" width="100%" scrolling="auto" frameborder="0" src="./sidebar/admin.php">
	   </iframe>
    </td>
    <td style="width:86%">
	   <iframe id="right" height="100%" width="100%" scrolling="auto" frameborder="0" src="./student/findstudent.php">
	   </iframe>
    </td>
   </tr>
  </table>
 </body>
</html>