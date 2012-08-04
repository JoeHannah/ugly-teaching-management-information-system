<?php
  function findstudent($db, $sno, $sname, $ssex, $sbirth, $sclass, $stel, $sentertag, $saddr, $scmt) {
    $query = "exec findstudent '{$sno}', '{$sname}', '{$ssex}', '{$sbirth}', '{$sclass}', '{$stel}', '{$sentertag}', '{$saddr}', '{$scmt}'";
    $query = utf2gb($query);
    $sql = $db->query($query);
    $sql = $sql->fetchall();
    $sql = gb2utf($sql);
    $sql = unsetnull($sql);
	$sql = sqldate2date($sql);
    $db = null;
    return $sql;
  }

  function addstudent($db, $sno, $sname, $ssex, $sbirth, $sclass, $stel, $sentertag, $saddr, $scmt) {
    $query = "exec addstudent '{$sno}', '{$sname}', '{$ssex}', '{$sbirth}', '{$sclass}', '{$stel}', '{$sentertag}', '{$saddr}', '{$scmt}'";
    $query = utf2gb($query);
    $sql = $db->query($query);
    $db = null;
    return $sql;
  }

  function updatestudent($db, $oldsno, $sno, $sname, $ssex, $sbirth, $sclass, $stel, $sentertag, $saddr, $scmt) {
    $query = "exec updatestudent '{$oldsno}', '{$sno}', '{$sname}', '{$ssex}', '{$sbirth}', '{$sclass}', '{$stel}', '{$sentertag}', '{$saddr}', '{$scmt}'";
    $query = utf2gb($query);
    $sql = $db->query($query);
    $db = null;
    return $sql;
  }

  function deletestudent($db, $sno) {
    $query = "exec deletestudent '{$sno}'";
    $query = utf2gb($query);
    $sql = $db->query($query);
    $db = null;
    return $sql;
  }

?>