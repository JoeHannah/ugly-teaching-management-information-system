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
  $result = findscore($db, $sno, $sclass, $cno, $cname, $pass);
  if (!is_null($result) && !empty($result) && is_array($result)) {
    $sname = $result[0]['sname'];
    $sclass = $result[0]['sclass'];
    $cname = $result[0]['cname'];
    $score = $result[0]['score'];
  }
?>
<!doctype html>
<html>
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="cache-control" content="no-cache">
  <meta http-equiv="expires" content="0">
  <title>更新成绩</title>
  <style>
   .color {text-align: center; border: 1px solid; background-color: #EEEEEE;}
   .nocolor {text-align: center; border: 1px solid;}
  </style>
 </head>
 <body>
  <table style="width:100%; border-collapse:collapse; border: 1px solid;">
   <tbody>
    <tr>
     <td class="color" width="10%">班级</td>
     <td class="color" width="15%">学号</td>
     <td class="color" width="15%">姓名</td>
     <td class="color" width="10%">课程号</td>
     <td class="color" width="25%">课程名</td>
     <td class="color" width="15%">成绩</td>
     <td class="color" width="10%">提交</td>
    </tr>
    <form action="./update.php" method="POST">
      <td class="nocolor" width="10%"><?php echo $sclass; ?></td>
      <td class="nocolor" width="15%">
        <input type="hidden" name="sno" value="<?php echo $sno; ?>" />
        <?php echo $sno; ?>
      </td>
      <td class="nocolor" width="15%"><?php echo $sname; ?></td>
      <td class="nocolor" width="10%">
        <input type="hidden" name="cno" value="<?php echo $cno; ?>" />
        <?php echo $cno; ?>
      </td>
      <td class="nocolor" width="25%"><?php echo $cname; ?></td>
      <td class="nocolor" width="15%"><input type="text" name="score" size="10" maxlength="3" value="<?php echo $score; ?>" /></td>
      <td class="nocolor" width="10%"><input type="submit" value="提交" /></td>
    </form>
   </tbody>
  </table>
 </body>
</html>