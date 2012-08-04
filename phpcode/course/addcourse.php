<?php
  session_start();
  require_once('../config.php');
  require_once('../functions.php');
  require_once('./functions.php');
?>
<!doctype html>
<html>
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="cache-control" content="no-cache">
  <meta http-equiv="expires" content="0">
  <title>添加课程</title>
 </head>
 <body>
    <form action="./add.php" method="POST">
      课程号：<input type="text" name="cno" size="10" maxlength="10" value="" /><br />
      课程名：<input type="text" name="cname" size="30" maxlength="30"  value="" /><br />
      课程类型：<input type="text" name="ctype" size="20" maxlength="20"  value="" /><br />
      学分：<input type="text" name="credit" size="10" maxlength="5"  value="" /><br />
      课程描述：<input type="text" name="cdscrpt" size="50" maxlength="50"  value="" /><br />
      <input type="submit" value="提交" /></td>
    </form>
 </body>
</html>