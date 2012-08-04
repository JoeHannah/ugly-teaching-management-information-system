<?php
  session_start();
  $_SESSION['id'] = session_id();
?>
<!doctype html>
<html>
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="cache-control" content="no-cache">
  <meta http-equiv="expires" content="0">
  <title>教学管理信息系统</title>
 </head>
 <body>
 <form action="./index.php" method="POST">
 <table style="width:648px;" cellpadding="0" cellspacing="0" align="center" border="0">
	<tbody>
		<tr>
			<td colspan="3" style="width=200px;text-align:center;">
				<img src="./images/tu1.jpg" alt="" /> 
			</td>
		</tr>
		<tr>
			<td colspan="3" style="text-align:center;">
				<img src="./images/tu2.jpg" alt="" /> 
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<br />
			</td>
		</tr>
		<tr>
			<td style="width:250px;text-align:right;">
				用户名：
			</td>
			<td style="width:200px;">
				<input type="text" name="username" size="20" maxlength="16" value="" /> 
			</td>
			<td rowspan="3" style="width:198px;">
				<input type="submit" value="登录" style="width:60;height:50;" /> 
			</td>
		</tr>
		<tr>
			<td style="width:250px;text-align:right;">
				密码：
			</td>
			<td style="width:200px;">
				<input type="password" name="password" size="20" maxlength="16" value="" /> 
			</td>
		</tr>
		<tr>
			<td style="width:250px;text-align:right;">
				验证码：
			</td>
			<td style="width:200px;">
				<input type="text" name="code" size="5" maxlength="4" value="" /> 
				<img src="./auth/authcode.php" alt="" /> 
			</td>
		</tr>
	</tbody>
 </table>
 </form>
</body>
</html>