<?php
  session_start();
  require_once('../config.php');
  require_once('../functions.php');
  require_once('./functions.php');

  prestudent();
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sno']) && isset($_POST['sname']) && isset($_POST['ssex']) && isset($_POST['byear']) && isset($_POST['bmonth']) && isset($_POST['bday']) && isset($_POST['sclass']) && isset($_POST['stel']) && isset($_POST['eyear']) && isset($_POST['emonth']) && isset($_POST['eday']) && isset($_POST['saddr']) && isset($_POST['scmt'])) {
    $sno = $_POST['sno'];
    $sname = $_POST['sname'];
    $ssex = $_POST['ssex'];
    $sbirth = $_POST['byear'].'-'.$_POST['bmonth'].'-'.$_POST['bday'];
    $sclass = $_POST['sclass'];
    $stel = $_POST['stel'];
    $sentertag = $_POST['eyear'].'-'.$_POST['emonth'].'-'.$_POST['eday'];
    $saddr = $_POST['saddr'];
    $scmt = $_POST['scmt'];
  }
  is_student($sno, $sname, $ssex, $sbirth, $sclass, $stel, $sentertag, $saddr, $scmt);
  $result = addstudent($db, $sno, $sname, $ssex, $sbirth, $sclass ,$stel, $sentertag, $saddr, $scmt);
?>
<!doctype html>
<html>
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="cache-control" content="no-cache">
  <meta http-equiv="expires" content="0">
  <title>添加学生信息</title>
 </head>
 <body>
  <p>
   <?php
     if ($result != false) {
       echo '成功添加'.$sname.'同学的信息！</p>';
     }
     else {
       echo '添加'.$sname.'同学的信息失败！';
     }
   ?>
  </p>
 </body>
</html>