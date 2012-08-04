<?php
  session_start();
  require_once('../config.php');
  require_once('../functions.php');
  require_once('./functions.php');

  prescore();
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sno']) && isset($_POST['cno'])) {
    $sno = $_POST['sno'];
    $cno = $_POST['cno'];
  }
  $sno = is_sno($sno);
  $cno = is_cno($cno);
  $result = deletescore($db, $sno, $cno, $score);
?>
<!doctype html>
<html>
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="cache-control" content="no-cache">
  <meta http-equiv="expires" content="0">
  <title>删除成绩</title>
 </head>
 <body>
  <p>
   <?php
     if ($result != false) {
       echo '成功删除'.$sno.'同学的成绩！</p>';
     }
     else {
       echo '删除'.$sno.'同学的成绩失败！';
     }
   ?>
  </p>
 </body>
</html>