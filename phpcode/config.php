<?php
  $username = 'admin';
  $password = '12345';

  $sql_host = 'localhost';
  $sql_dbname = 'student_info';
  $sql_user = 'sa';
  $sql_pwd = '';

  try {
    $db = new PDO('mssql:host='.$sql_host.';dbname='.$sql_dbname, $sql_user, $sql_pwd);
  } catch(PDOException $exception) {
    echo '连接数据库出错：'.$exception->getMessage()."\n";
  }
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
?>
