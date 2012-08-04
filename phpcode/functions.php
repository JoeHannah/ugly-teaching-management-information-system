<?php
  function prestudent() {
    global $sno;
    global $sname;
    global $ssex;
    global $sbirth;
    global $sclass;
    global $stel;
    global $sentertag;
    global $saddr;
    global $scmt;
    $sno = '';
    $sname = '';
    $ssex = '';
    $sbirth = '';
    $sclass = '';
    $stel = '';
    $sentertag = '';
    $saddr = '';
    $scmt = '';
  }

  function prescore() {
    global $sno;
    global $sclass;
    global $cno;
    global $cname;
    global $pass;
    $sno = '';
    $sclass = '';
    $cno = 0;
    $cname = '';
    $pass = 0;
  }

  function precourse() {
    global $cno;
    global $cname;
    global $ctype;
    global $credit;
    global $cdscrpt;
    $cno = 0;
    $cname = '';
    $ctype = '';
    $credit = 0;
    $cdscrpt = '';
  }

  function gb2utf($var) {
    if (!is_null($var) && !empty($var)) {
      if(is_array($var)) {
        reset($var);
        do {
          if (is_string(current($var))){
            $var[key($var)] = iconv('GB2312', 'UTF-8', current($var));
          }
          else if (is_array(current($var))) {
            $var[key($var)] = gb2utf(current($var));
          }
        } while (next($var));
      }
      else if (is_string($var)) {
        $var = iconv('GB2312', 'UTF-8', $var);
      }
    }
    return $var;
  }

  function utf2gb($var) {
    if (!is_null($var) && !empty($var)) {
      if(is_array($var)) {
        reset($var);
        do {
          if (is_string(current($var))){
            $var[key($var)] = iconv('UTF-8', 'GB2312', current($var));
          }
          else if (is_array(current($var))) {
            $var[key($var)] = utf2gb(current($var));
          }
        } while (next($var));
      }
      else if (is_string($var)) {
        $var = iconv('UTF-8', 'GB2312', $var);
      }
    }
    return $var;
  }

  function is_student($sno, $sname, $ssex, $sbirth, $sclass, $stel, $sentertag, $saddr, $scmt) {
    global $sno;
    global $sname;
    global $ssex;
    global $sbirth;
    global $sclass;
    global $stel;
    global $sentertag;
    global $saddr;
    global $scmt;
    $sno = is_sno($sno);
    $sname = is_sname($sname);
    $ssex = is_ssex($ssex);
    $sbirth = is_sbirth($sbirth);
    $sclass = is_sclass($sclass);
    $stel = is_stel($stel);
    $sentertag = is_sentertag($sentertag);
    $saddr = is_saddr($saddr);
    $scmt = is_scmt($scmt);
  }

  function is_sno($sno) {
    if (!is_null($sno) && !empty($sno) && is_string($sno)) {
      $sno = preg_replace('/[^0-9]/', '', $sno);
      if (strlen($sno) != 9) {
        $sno = '';
      }
    }
    else {
      $sno ='';
    }
    return $sno;
  }

  function is_sname($sname) {
    if (!is_null($sname) && !empty($sname) && is_string($sname)) {
      $sname = preg_replace('/[^a-zA-Z\x{4e00}-\x{9fa5}]/u', '', $sname);
    }
    else {
      $sname ='';
    }
    return $sname;
  }

  function is_ssex($ssex) {
    if (!is_null($ssex) && !empty($ssex) && is_string($ssex)) {
      preg_match('/男|女|--/', $ssex, $ssex);
    }
    else {
      $ssex ='';
    }
    return $ssex[0];
  }

  function is_sbirth($sbirth) {
    if (!is_null($sbirth) && !empty($sbirth) && is_string($sbirth)) {
      if (!preg_match('/[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}/',  $sbirth)) {
        $sbirth = '';
      }
    }
    else {
      $sbirth ='';
    }
    return $sbirth;
  }

  function is_sclass($sclass) {
    if (!is_null($sclass) && !empty($sclass) && is_string($sclass)) {
      $sclass = preg_replace('/[^0-9]/', '', $sclass);
      if (strlen($sclass) != 7) {
        $sclass = '';
      }
    }
    else {
      $sclass ='';
    }
    return $sclass;
  }

  function is_stel($stel) {
    if (!is_null($stel) && !empty($stel) && is_string($stel)) {
      $stel = preg_replace('/[^0-9-*]/', '', $stel);
    }
    else {
      $stel ='';
    }
    return $stel;
  }

  function is_sentertag($sentertag) {
    if (!is_null($sentertag) && !empty($sentertag) && is_string($sentertag)) {
      if (!preg_match('/[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}/', $sentertag)) {
        $sentertag = '';
      }
    }
    else {
      $sentertag ='';
    }
    return $sentertag;
  }

  function is_saddr($saddr) {
    if (!is_null($saddr) && !empty($saddr) && is_string($saddr)) {
      $saddr = preg_replace('/[^0-9a-zA-Z\x{4e00}-\x{9fa5}]/u', '', $saddr);
    }
    else {
      $saddr ='';
    }
    return $saddr;
  }

  function is_scmt($scmt) {
    if (!is_null($scmt) && !empty($scmt) && is_string($scmt)) {
      $scmt = preg_replace('/[^0-9a-zA-Z\x{4e00}-\x{9fa5}]/u', '', $scmt);
    }
    else {
      $scmt ='';
    }
    return $scmt;
  }

  function is_cno($cno) {
    if (!is_null($cno) && !empty($cno)) {
      $cno = intval($cno);
      if ($cno < 0 || $cno > 9999) {
        $cno = 0;
      }
    }
    else {
      $cno = 0;
    }
    return $cno;
  }

  function is_cname($cname) {
    if (!is_null($cname) && !empty($cname) && is_string($cname)) {
      $cname = preg_replace('/[^a-zA-Z\x{4e00}-\x{9fa5}]/u', '', $cname);
    }
    else {
      $cname ='';
    }
    return $cname;
  }

  function is_ctype($ctype) {
    if (!is_null($ctype) && !empty($ctype) && is_string($ctype)) {
      $ctype = preg_replace('/[^a-zA-Z\x{4e00}-\x{9fa5}]/u', '', $ctype);
    }
    else {
      $ctype ='';
    }
    return $ctype;
  }

  function is_cdscrpt($cdscrpt) {
    if (!is_null($cdscrpt) && !empty($cdscrpt) && is_string($cdscrpt)) {
      $cdscrpt = preg_replace('/[^a-zA-Z\x{4e00}-\x{9fa5}]/u', '', $cdscrpt);
    }
    else {
      $cdscrpt ='';
    }
    return $cdscrpt;
  }

  function is_credit($credit) {
    if (!is_null($credit) && !empty($credit)) {
      $credit = intval($credit);
      if ($credit <= 0) {
        $credit = -1;
      }
    }
    else {
      $credit = -1;
    }
    return $credit;
  }

  function is_score($score) {
    if (!is_null($score) && !empty($score)) {
      $score = intval($score);
      if ($score < 0 || $score > 100) {
        $score = -1;
      }
    }
    else {
      $score = -1;
    }
    return $score;
  }

  function is_pass($pass) {
    if (!is_null($pass) && !empty($pass)) {
      $pass = intval($pass);
      if ($pass != 1) {
        $pass = 0;
      }
    }
    else {
      $pass = 0;
    }
    return $pass;
  }

  function unsetnull($array) {
    if (!is_null($array) && !empty($array)) {
      reset($array);
      do {
        if (is_null(current($array))){
          $array[key($array)] = '';
        }
        else if (is_array(current($array))) {
          $array[key($array)] = unsetnull(current($array));
        }
      } while (next($array));
    }
    return $array;
  }

  function sqldate2date($var) {
    if (!is_null($var) && !empty($var)) {
      if(is_array($var)) {
        reset($var);
        do {
          if (is_string(current($var)) && (key($var) == 'sbirth' || key($var) == 'sentertag')) {
            $temp = explode(' ', current($var), 4);
            switch($temp[1]) {
              case '一月':
              $temp[1] = 1;
              break;
              case '二月':
              $temp[1] = 2;
              break;
              case '三月':
              $temp[1] = 3;
              break;
              case '四月':
              $temp[1] = 4;
              break;
              case '五月':
              $temp[1] = 5;
              break;
              case '六月':
              $temp[1] = 6;
              break;
              case '七月':
              $temp[1] = 7;
              break;
              case '八月':
              $temp[1] = 8;
              break;
              case '九月':
              $temp[1] = 9;
              break;
              case '十月':
              $temp[1] = 10;
              break;
              case '十一月':
              $temp[1] = 11;
              break;
              case '十二月':
              $temp[1] = 12;
              break;
            }
            $var[key($var)] = $temp[0].'-'.$temp[1].'-'.$temp[2];
          }
          else if (is_array(current($var))) {
            $var[key($var)] = sqldate2date(current($var));
          }
        } while (next($var));
      }
      else if (is_string($var)) {
        $temp = explode(' ', current($var));
        switch($temp[1]) {
          case '一月':
          $temp[1] = 1;
          break;
          case '二月':
          $temp[1] = 2;
          break;
          case '三月':
          $temp[1] = 3;
          break;
          case '四月':
          $temp[1] = 4;
          break;
          case '五月':
          $temp[1] = 5;
          break;
          case '六月':
          $temp[1] = 6;
          break;
          case '七月':
          $temp[1] = 7;
          break;
          case '八月':
          $temp[1] = 8;
          break;
          case '九月':
          $temp[1] = 9;
          break;
          case '十月':
          $temp[1] = 10;
          break;
          case '十一月':
          $temp[1] = 11;
          break;
          case '十二月':
          $temp[1] = 12;
          break;
        }
        $var[key($var)] = $temp[0].'-'.$temp[1].'-'.$temp[2];
      }
    }
    return $var;
  }
?>