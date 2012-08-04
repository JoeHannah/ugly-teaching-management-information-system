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
  $result = findcourse($db, $cno);
  if (!is_null($result) && !empty($result) && is_array($result)) {
    $cname = $result[0]['cname'];
    $ctype = $result[0]['ctype'];
    $credit = $result[0]['credit'];
    $cdscrpt = $result[0]['cdscrpt'];
  }
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
    <form action="./update.php" method="POST">
      课程号：<?php echo $cno; ?><input type="hidden" name="cno" value="<?php echo $cno; ?>" /><br />
      课程名：<input type="text" name="cname" size="30" maxlength="30"  value="<?php echo $cname; ?>" /><br />
      课程类型：<input type="text" name="ctype" size="20" maxlength="20"  value="<?php echo $ctype; ?>" /><br />
      学分：<input type="text" name="credit" size="10" maxlength="5"  value="<?php echo $credit; ?>" /><br />
      课程描述：<input type="text" name="cdscrpt" size="50" maxlength="50"  value="<?php echo $cdscrpt; ?>" /><br />
      <input type="submit" value="提交" /></td>
    </form>
 </body>
</html>