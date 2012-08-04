<?php
  function findcourse($db, $cno) {
    $query = "select * from course";
	if ($cno>0) {
	  $query .= ' where cno = '.$cno;
	}
    $query = utf2gb($query);
    $sql = $db->query($query);
    $sql = $sql->fetchall();
    $sql = gb2utf($sql);
    $sql = unsetnull($sql);
	$sql = sqldate2date($sql);
    $db = null;
    return $sql;
  }

  function addcourse($db, $cno, $cname, $ctype, $credit, $cdscrpt) {
    $query = "exec addcourse {$cno}, '{$cname}', '{$ctype}', {$credit}, '{$cdscrpt}'";
    $query = utf2gb($query);
    $sql = $db->query($query);
    $db = null;
    return $sql;
  }

  function updatecourse($db, $oldcno, $cno, $cname, $ctype, $credit, $cdscrpt) {
    $query = "exec updatecourse {$oldcno}, {$cno}, '{$cname}', '{$ctype}', {$credit}, '{$cdscrpt}'";
    $query = utf2gb($query);
    $sql = $db->query($query);
    $db = null;
    return $sql;
  }

  function deletecourse($db, $cno) {
    $query = "exec deletecourse {$cno}";
    $query = utf2gb($query);
    $sql = $db->query($query);
    $db = null;
    return $sql;
  }

?>