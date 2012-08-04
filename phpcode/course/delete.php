<?php
  session_start();
  require_once('../config.php');
  require_once('../functions.php');
  require_once('./functions.php');

  precourse();
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cno'])) {
    $cno = $_POST['cno'];
  }
  $cno = is_cno($cno);
  $result = deletecourse($db, $cno);
?>
<!doctype html>
<html>
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="cache-control" content="no-cache">
  <meta http-equiv="expires" content="0">
  <title>删除课程</title>
 </head>
 <body>
  <p>
   <?php
     if ($result != false) {
       echo '成功删除'.$cno.'号课程！</p>';
     }
     else {
       echo '删除'.$cno.'号课程失败！';
     }
   ?>
  </p>
 </body>
</html>