<?php
  session_start();
  require_once('../config.php');
  require_once('../functions.php');
  require_once('./functions.php');

  $result = findcourse($db, 0);
?>
<!doctype html>
<html>
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="cache-control" content="no-cache">
  <meta http-equiv="expires" content="0">
  <title>查看课程</title>
  <style>
   .color {text-align: center; border: 1px solid; background-color: #EEEEEE;}
   .nocolor {text-align: center; border: 1px solid;}
  </style>
 </head>
 <body>
  <table style="width:100%; border-collapse:collapse; border: 1px solid; font-size:13px;">
   <tbody>
    <tr>
     <td class="nocolor" width="16%">课程号</td>
     <td class="nocolor" width="16%">课程名</td>
     <td class="nocolor" width="16%">课程类型</td>
     <td class="nocolor" width="16%">学分</td>
     <td class="nocolor" width="16%">课程描述</td>
     <td class="nocolor" width="20%" colspan="2">&nbsp;</td>
   </tr>
<?php
    if (!is_null($result) && !empty($result) && is_array($result)) {
      $resultsize = count($result);
      for ($count = 0; $count < $resultsize; $count++) {
        if ($count % 2 == 0) {
          $color = '';
        }
        else {
          $color = 'no';
        }
?>
   <tr>
    <td class="<?php echo $color; ?>color" width="16%"><?php echo $result[$count]['cno']; ?></td>
    <td class="<?php echo $color; ?>color" width="16%"><?php echo $result[$count]['cname']; ?></td>
    <td class="<?php echo $color; ?>color" width="16%"><?php echo $result[$count]['ctype']; ?></td>
    <td class="<?php echo $color; ?>color" width="16%"><?php echo $result[$count]['credit']; ?></td>
    <td class="<?php echo $color; ?>color" width="16%"><?php echo $result[$count]['cdscrpt']; ?></td>
    <td class="<?php echo $color; ?>color" width="10%">
     <form action="./updatecourse.php" method="POST">
     <input type="hidden" name="cno" value="<?php echo $result[$count]['cno']; ?>" />
     <input type="submit" value="更新" />
     </form>
    </td>
    <td class="<?php echo $color; ?>color" width="10%">
     <form action="./delete.php" method="POST">
     <input type="hidden" name="cno" value="<?php echo $result[$count]['cno']; ?>" />
     <input type="submit" value="删除" />
     </form>
    </td>
   </tr>
<?php
      }
    }
?>
   </tbody>
  </table>
 </body>
</html>