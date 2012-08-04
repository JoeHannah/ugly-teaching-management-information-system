<?php
  function findscore($db, $sno, $sclass, $cno, $cname, $pass) {
    $query = "exec findscore '{$sno}', '{$sclass}', {$cno}, '{$cname}', {$pass}";
    $query = utf2gb($query);
    $sql = $db->query($query);
    $sql = $sql->fetchall();
    $sql = gb2utf($sql);
    $sql = unsetnull($sql);
	$sql = sqldate2date($sql);
    $db = null;
    return $sql;
  }

  function addscore($db, $sno, $cno, $score) {
    $query = "exec addscore '{$sno}', {$cno}, {$score}";
    $query = utf2gb($query);
    $sql = $db->query($query);
    $db = null;
    return $sql;
  }

  function updatescore($db, $sno, $cno, $score) {
    $query = "exec updatescore '{$sno}', {$cno}, {$score}";
    $query = utf2gb($query);
    $sql = $db->query($query);
    $db = null;
    return $sql;
  }

  function deletescore($db, $sno, $cno) {
    $query = "exec deletescore '{$sno}', {$cno}";
    $query = utf2gb($query);
    $sql = $db->query($query);
    $db = null;
    return $sql;
  }

?>