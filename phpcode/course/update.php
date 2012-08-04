<?php
  session_start();
  require_once('../config.php');
  require_once('../functions.php');
  require_once('./functions.php');

  precourse();
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cno']) && isset($_POST['cname']) && isset($_POST['ctype']) && isset($_POST['credit']) && isset($_POST['cdscrpt'])) {
    $cno = $_POST['cno'];
    $cname = $_POST['cname'];
    $ctype = $_POST['ctype'];
    $credit = $_POST['credit'];
    $cdscrpt = $_POST['cdscrpt'];
  }
  $cno = is_cno($cno);
  $cname = is_cname($cname);
  $ctype = is_ctype($ctype);
  $credit = is_credit($credit);
  $cdscrpt = is_cdscrpt($cdscrpt);
  $result = updatecourse($db, $cno, $cno, $cname, $ctype, $credit, $cdscrpt);
?>
<!doctype html>
<html>
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="cache-control" content="no-cache">
  <meta http-equiv="expires" content="0">
  <title>更新课程</title>
 </head>
 <body>
  <p>
   <?php
     if ($result != false) {
       echo '成功更新'.$cno.'号课程！</p>';
     }
     else {
       echo '更新'.$cno.'号课程失败！';
     }
   ?>
  </p>
 </body>
</html>