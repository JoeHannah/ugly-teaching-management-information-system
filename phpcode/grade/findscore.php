<?php
  session_start();
  require_once('../config.php');
  require_once('../functions.php');
  require_once('./functions.php');

  prescore();
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sno']) && isset($_POST['sclass']) && isset($_POST['cno']) && isset($_POST['cname']) && isset($_POST['pass'])) {
    $sno = $_POST['sno'];
    $sclass = $_POST['sclass'];
    $cno = $_POST['cno'];
    $cname = $_POST['cname'];
    $pass = $_POST['pass'];
  }
  $sno = is_sno($sno);
  $sclass = is_sclass($sclass);
  $cno = is_cno($cno);
  $cname = is_cname($cname);
  $pass = is_pass($pass);
  $result = findscore($db, $sno, $sclass, $cno, $cname, $pass);
?>
<!doctype html>
<html>
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="cache-control" content="no-cache">
  <meta http-equiv="expires" content="0">
  <title>成绩查询</title>
  <style>
   .color {text-align: center; border: 1px solid; background-color: #EEEEEE;}
   .nocolor {text-align: center; border: 1px solid;}
  </style>
 </head>
 <body>
  <table style="width:100%; border-collapse:collapse; border: 1px solid; font-size:13px;">
   <tbody>
    <tr>
     <td class="color" width="10%">班级</td>
     <td class="color" width="10%">学号</td>
     <td class="color" width="16%">姓名</td>
     <td class="color" width="10%">课程号</td>
     <td class="color" width="20%">课程名</td>
     <td class="color" width="10%">成绩</td>
     <td class="color" width="24%" colspan="2">&nbsp;</td>
   </tr>
   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <tr>
     <td class="nocolor" width="10%">
      <input type="text" name="sclass" size="8" maxlength="7" value="<?php echo $sclass; ?>" />
     </td>
     <td class="nocolor" width="10%">
      <input type="text" name="sno" size="10" maxlength="9" value="<?php echo $sno; ?>" />
     </td>
     <td class="nocolor" width="16%">&nbsp;</td>
     <td class="nocolor" width="10%">
      <input type="text" name="cno" size="5" maxlength="4" value="<?php if($cno!=0) {echo $cno;} ?>" />
     </td>
     <td class="nocolor" width="20%">
      <input type="text" name="cname" size="15" maxlength="20" value="<?php echo $cname; ?>" />
     </td>
     <td class="nocolor" width="10%">
      <input type="radio" name="pass" value="0"<?php if($pass==0) {echo ' checked="checked"';}?> />全部<br />
      <input type="radio" name="pass" value="1"<?php if($pass==1) {echo ' checked="checked"';}?> />不及格
     </td>
     <td class="nocolor" width="24%" colspan="2">
      <input name="type" type="submit" value="查询" />
     </td>
    </tr>
   </form>
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
    <td class="<?php echo $color; ?>color" width="10%"><?php echo $result[$count]['sclass']; ?></td>
    <td class="<?php echo $color; ?>color" width="10%"><?php echo $result[$count]['sno']; ?></td>
    <td class="<?php echo $color; ?>color" width="16%"><?php echo $result[$count]['sname']; ?></td>
    <td class="<?php echo $color; ?>color" width="10%"><?php echo $result[$count]['cno']; ?></td>
    <td class="<?php echo $color; ?>color" width="20%"><?php echo $result[$count]['cname']; ?></td>
    <td class="<?php echo $color; ?>color" width="10%"><?php if($result[$count]['score']<60) {echo '<span  style="color:#E53333;">'.$result[$count]['score'].'</span>';} else {echo $result[$count]['score'];} ?></td>
    <td class="<?php echo $color; ?>color" width="12%">
     <form action="./updatescore.php" method="POST">
     <input type="hidden" name="sno" value="<?php echo $result[$count]['sno']; ?>" />
     <input type="hidden" name="cno" value="<?php echo $result[$count]['cno']; ?>" />
     <input type="submit" value="更新" />
     </form>
    </td>
    <td class="<?php echo $color; ?>color" width="12%">
     <form action="./delete.php" method="POST">
     <input type="hidden" name="sno" value="<?php echo $result[$count]['sno']; ?>" />
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