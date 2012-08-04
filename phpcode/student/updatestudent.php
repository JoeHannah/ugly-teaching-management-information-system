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
  $result = findstudent($db, $sno, '', '', '', '', '', '', '', '');
  if (!is_null($result) && !empty($result) && is_array($result)) {
    $sname = $result[0]['sname'];
    $ssex = $result[0]['ssex'];
    $sbirth = $result[0]['sbirth'];
    $sclass = $result[0]['sclass'];
    $stel = $result[0]['stel'];
    $sentertag = $result[0]['sentertag'];
    $saddr = $result[0]['saddr'];
    $scmt = $result[0]['scmt'];
  }
?>
<!doctype html>
<html>
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="cache-control" content="no-cache">
  <meta http-equiv="expires" content="0">
  <title>更新学生信息</title>
 </head>
 <body>
  <form name=f1 action="./update.php" method="POST">
      学号：<?php echo $sno; ?><input type="hidden" name="sno" value="<?php echo $sno; ?>" /><br />
      姓名：<input type="text" name="sname" size="20" maxlength="20" value="<?php echo $sname; ?>" /><br />
      性别：<select name="ssex">
       <option value=""></option>
       <option value="男"<?php if ($ssex == '男') {echo ' selected="selected"';} ?>>男</option>
       <option value="女"<?php if ($ssex == '女') {echo ' selected="selected"';} ?>>女</option>
       <option value="--"<?php if ($ssex == '--') {echo ' selected="selected"';} ?>>--</option>
      </select>
      <br />
	   班级：<input type="text" name="sclass" size="20" maxlength="7" value="<?php echo $sclass; ?>" /><br />
	   入学时间：<select name=eyear size=1 onchange="eshowmonth();eshowday();">
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
	   <br />
	   生日：<select name=byear size=1 onchange="bshowmonth();bshowday();">
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
	   <br />
      电话：<input type="text" name="stel" size="20" maxlength="20" value="<?php echo $stel; ?>" /><br />
      地址：<input type="text" name="saddr" size="80" maxlength="50" value="<?php echo $saddr; ?>" /><br />
      备注：<input type="text" name="scmt" size="80" maxlength="50" value="<?php echo $scmt; ?>" /><br />
      <input type="submit" value="更新学生信息" /><br />
   </form>
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