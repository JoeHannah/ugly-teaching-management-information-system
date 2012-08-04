<?php
  session_start();
  require_once('../config.php');
  require_once('../functions.php');
  require_once('./functions.php');

  prestudent();
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sno'])) {
    $sno = $_POST['sno'];
  }
  $sno = is_sno($sno);
  $result = deletestudent($db, $sno);
?>
<!doctype html>
<html>
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="cache-control" content="no-cache">
  <meta http-equiv="expires" content="0">
  <title>删除学生信息</title>
 </head>
 <body>
  <p>
   <?php
     if ($result != false) {
       echo '成功删除'.$sname.'同学的信息和成绩！</p>';
     }
     else {
       echo '删除'.$sname.'同学的信息失败！';
     }
   ?>
  </p>
 </body>
</html>