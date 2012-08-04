<?php
  session_start();
  require_once('../config.php');
  require_once('../functions.php');
  require_once('./functions.php');

  prescore();
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sno']) && isset($_POST['cno']) && isset($_POST['score'])) {
    $sno = $_POST['sno'];
    $cno = $_POST['cno'];
    $score = $_POST['score'];
  }
  $sno = is_sno($sno);
  $cno = is_cno($cno);
  $score = is_score($score);
  $result = updatescore($db, $sno, $cno, $score);
?>
<!doctype html>
<html>
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="cache-control" content="no-cache">
  <meta http-equiv="expires" content="0">
  <title>更新成绩</title>
 </head>
 <body>
  <p>
   <?php
     if ($result != false) {
       echo '成功更新'.$sno.'同学的成绩！</p>';
     }
     else {
       echo '更新'.$sno.'同学的成绩失败！';
     }
   ?>
  </p>
 </body>
</html>