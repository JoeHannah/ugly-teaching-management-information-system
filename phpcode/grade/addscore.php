<?php
  session_start();
  require_once('../config.php');
  require_once('../functions.php');
  require_once('./functions.php');

  prescore();
?>
<!doctype html>
<html>
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="cache-control" content="no-cache">
  <meta http-equiv="expires" content="0">
  <title>添加成绩</title>
  <style>
   .color {text-align: center; border: 1px solid; background-color: #EEEEEE;}
   .nocolor {text-align: center; border: 1px solid;}
  </style>
 </head>
 <body>
  <table style="width:100%; border-collapse:collapse; border: 1px solid;">
   <tbody>
    <tr>
     <td class="color" width="25%">学号</td>
     <td class="color" width="25%">课程号</td>
     <td class="color" width="25%">成绩</td>
     <td class="color" width="25%">提交</td>
    </tr>
    <form action="./add.php" method="POST">
      <td class="nocolor" width="25%"><input type="text" name="sno" size="10" maxlength="9" value="" /></td>
      <td class="nocolor" width="25%"><input type="text" name="cno" size="10" maxlength="7" value="" /></td>
      <td class="nocolor" width="25%"><input type="text" name="score" size="10" maxlength="3" value="" /></td>
      <td class="nocolor" width="25%"><input type="submit" value="提交" /></td>
    </form>
   </tbody>
  </table>
 </body>
</html>