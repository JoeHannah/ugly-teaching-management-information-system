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
  $result = findstudent($db, $sno, $sname, $ssex, $sbirth, $sclass ,$stel, $sentertag, $saddr, $scmt);
?>
<!doctype html>
<html>
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="cache-control" content="no-cache">
  <meta http-equiv="expires" content="0">
  <title>查找学生信息</title>
  <style>
   .color {text-align: center; border: 1px solid; background-color: #EEEEEE;}
   .nocolor {text-align: center; border: 1px solid;}
  </style>
 </head>
 <body>
  <table style="width:100%; border-collapse:collapse; border: 1px solid; font-size:13px;">
   <tbody>
    <tr>
     <td class="color" width="9%">学号</td>
     <td class="color" width="9%">姓名</td>
     <td class="color" width="5%">性别</td>
     <td class="color" width="8%">班级</td>
     <td class="color" width="9%">入学时间</td>
     <td class="color" width="9%">生日</td>
     <td class="color" width="13%">电话</td>
     <td class="color" width="20%">地址</td>
     <td class="color" width="6%">备注</td>
     <td class="color" width="12%" colspan="2">&nbsp;</td>
   </tr>
   <form name=f1 action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <tr>
     <td class="nocolor" width="9%">
      <input type="text" name="sno" size="9" maxlength="9" value="<?php echo $sno; ?>" />
     </td>
     <td class="nocolor" width="9%">
      <input type="text" name="sname" size="7" maxlength="10" value="<?php echo $sname; ?>" />
     </td>
     <td class="nocolor" width="5%">
      <select name="ssex">
       <option value=""></option>
       <option value="男"<?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ssex']) && $_POST['ssex'] == '男') {echo ' selected="selected"';} ?>>男</option>
       <option value="女"<?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ssex']) && $_POST['ssex'] == '女') {echo ' selected="selected"';} ?>>女</option>
       <option value="--"<?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ssex']) && $_POST['ssex'] == '--') {echo ' selected="selected"';} ?>>--</option>
      </select>
     </td>
     <td class="nocolor" width="8%">
      <input type="text" name="sclass" size="7" maxlength="7" value="<?php echo $sclass; ?>" />
     </td>
     <td class="nocolor" width="9%">
      <select name=eyear size=1 onchange="eshowmonth();eshowday();">
      <script>
        var yearbegin=1970,yearend=new Date().getFullYear();
        document.write("<option value=''selected>年</option>")
        for(var i=yearbegin;i<=yearend;i++){
        document.write ("<option value="+i+">"+i+"</option>")
        }
      </script>
      </select>
      <select name=emonth size=1 onchange="eshowday();">
      <option value="">月</option>
      </select>
      <select name=eday size=1>
      <option value="">日</option>
      </select>
     </td>
     <td class="nocolor" width="9%">
      <select name=byear size=1 onchange="bshowmonth();bshowday();">
      <script>
        var yearbegin=1970,yearend=new Date().getFullYear();
        document.write("<option value=''selected>年</option>")
        for(var i=yearbegin;i<=yearend;i++){
        document.write ("<option value="+i+">"+i+"</option>")
        }
      </script>
      </select>
      <select name=bmonth size=1 onchange="bshowday();">
      <option value="">月</option>
      </select>
      <select name=bday size=1>
      <option value="">日</option>
      </select>
     </td>
     <td class="nocolor" width="13%">
      <input type="text" name="stel" size="15" maxlength="20" value="<?php echo $stel; ?>" />
     </td>
     <td class="nocolor" width="20%">
      <input type="text" name="saddr" size="20" maxlength="50" value="<?php echo $saddr; ?>" />
     </td>
     <td class="nocolor" width="6%">
      <input type="text" name="scmt" size="8" maxlength="50" value="<?php echo $scmt; ?>" />
     </td>
     <td class="nocolor" width="12%" colspan="2">
      <input name="type" type="submit" value="查找学生" /><br />
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
    <td class="<?php echo $color; ?>color" width="9%"><?php echo $result[$count]['sno']; ?></td>
    <td class="<?php echo $color; ?>color" width="9%"><?php echo $result[$count]['sname']; ?></td>
    <td class="<?php echo $color; ?>color" width="5%"><?php echo $result[$count]['ssex']; ?></td>
    <td class="<?php echo $color; ?>color" width="8%"><?php echo $result[$count]['sclass']; ?></td>
    <td class="<?php echo $color; ?>color" width="9%"><?php echo $result[$count]['sentertag']; ?></td>
    <td class="<?php echo $color; ?>color" width="9%"><?php echo $result[$count]['sbirth']; ?></td>
    <td class="<?php echo $color; ?>color" width="13%"><?php echo $result[$count]['stel']; ?></td>
    <td class="<?php echo $color; ?>color" width="20%"><?php echo $result[$count]['saddr']; ?></td>
    <td class="<?php echo $color; ?>color" width="6%"><?php echo $result[$count]['scmt']; ?></td>
    <td class="<?php echo $color; ?>color" width="6%">
     <form action="./updatestudent.php" method="POST">
     <input type="hidden" name="sno" value="<?php echo $result[$count]['sno']; ?>" />
     <input type="submit" value="更新" />
     </form>
    </td>
    <td class="<?php echo $color; ?>color" width="6%">
     <form action="./delete.php" method="POST">
     <input type="hidden" name="sno" value="<?php echo $result[$count]['sno']; ?>" />
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
   <script>
    var eYear=eval(document.f1.eyear)
    var eMonth=eval(document.f1.emonth);
    function eshowmonth(){
        if(eYear.value!=""){
            for(var i=0;i<12;i++){
                eMonth.options.add(new Option(i+1, i+1));
            }
        }
    }
    
    function eshowday(){
        var eDay=eval(document.f1.eday);
        if(eMonth.value!="" && eYear.value!=""){
            eDay.length=1;
            for(var i=0;i<28;i++){
                eDay.options.add(new Option(i+1, i+1)); 
            }
            if(eMonth.value!="2"){
                eDay.options.add(new Option(29, 29));
                eDay.options.add(new Option(30, 30));
            }
            switch(eMonth.value){
                case "1":
                case "2":{
                    var nYear=eYear.value;
                    if(nYear%400==0 || nYear%4==0 && nYear%100!=0)eDay.options.add(new Option(29, 29));
                }
                case "3":
                case "5":
                case "7":
                case "8":
                case "10":
                case "12":{
                    eDay.options.add(new Option(31, 31));
                }
                
            }
        }
    }

    var byear=eval(document.f1.byear)
    var bmonth=eval(document.f1.bmonth);
    function bshowmonth(){
        if(byear.value!=""){
            for(var i=0;i<12;i++){
                bmonth.options.add(new Option(i+1, i+1));
            }
        }
    }
    
    function bshowday(){
        var bday=eval(document.f1.bday);
        if(bmonth.value!="" && byear.value!=""){
            bday.length=1;
            for(var i=0;i<28;i++){
                bday.options.add(new Option(i+1, i+1)); 
            }
            if(bmonth.value!="2"){
                bday.options.add(new Option(29, 29));
                bday.options.add(new Option(30, 30));
            }
            switch(bmonth.value){
                case "1":
                case "2":{
                    var nYear=byear.value;
                    if(nYear%400==0 || nYear%4==0 && nYear%100!=0)bday.options.add(new Option(29, 29));
                }
                case "3":
                case "5":
                case "7":
                case "8":
                case "10":
                case "12":{
                    bday.options.add(new Option(31, 31));
                }
                
            }
        }
    }
   </script>
 </body>
</html>