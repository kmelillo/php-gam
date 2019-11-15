<?php
# Create as many usernames and passwords as you wish below.
# Format : $u['username'] = 'password';
# If possible do not associate the same password with more than one username.
# If you wish to remove authentication from the system simply remove any user details below.
$u['admin']  = 'admin';
$u['admin2']  = 'admin2';
# This can be any value. It is recommended that this value is a variable to ensure maximum security.
# The default is todays date as this value is variable.
$secretkey = date("m.d.y");
##
## No need to edit below.
##
if (@$_GET['do'] == 'logout')  {
		 setcookie ("user", '', time() - 12200);
		 setcookie ("token", '', time() - 12200);
		 $ref = $_SERVER['HTTP_REFERER'];
		 header("Location: $ref");
}
if (!empty($u)) {
 if(@$_GET['do'] == 'login') {
	 $username = $_POST['username'];
	 $password = $_POST['password'];
	 if( array_search($password, $u) == $username && $u[$username] == $password ) {
		 setcookie ("user", $username, time() + 12200);
		 setcookie ("token", sha1($username.$secretkey), time() + 12200);
		 header('Location: index.php');
	 } else {
		 show_login("Username & Password Do Not Match.");
		 die();
	 }
 }
if (!$_COOKIE['token'] || !$_COOKIE['user'])
 {
		 show_login("Please Login");
		 die();
 } else {
	 if ( sha1($_COOKIE['user'].$secretkey) !== $_COOKIE['token'] ) {
		 setcookie ("user", "", time() - 3600);
		 setcookie ("token", "", time() - 3600);
		 show_login("Please Login");
		 die();
	 }
 }
 }
function show_login($message) {
	?>
	<style type="text/css">
body {
	background-color: #F5F5F5;
	font-family: Arial, Helvetica, sans-serif;
	color:#666;
}
input {
	background-color: #EEE;
	padding: 5px;
	border: 1px solid #CCC;
}
#logintable {
	font-family: Arial, Helvetica, sans-serif;
	background-color: #fefefe;
	border: 1px solid #CCC;
	color: #333;
	box-shadow:0px 0px 8px #cccccc;
	-moz-box-shadow:0px 0px 8px #cccccc;
	-webkit-box-shadow:0px 0px 8px #cccccc;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	padding:10px;
}
.message {
	text-align: center;
	padding: 20px;
	font-size: 24px;
	text-shadow: 1px 1px 0px #ffffff;
	filter: dropshadow(color=#ffffff, offx=1, offy=1);
}
    </style>
<form action="index.php?do=login" method="post">
<div class="message"><?php echo $message; ?></div>
<table width="258" border="0" align="center" cellpadding="05" cellspacing="0" id="logintable">  <tr>
  <td width="80"> </td>
  <td width="192"> </td>
</tr>
  <tr>
    <td>Username</td>
    <td><label for="username"></label>
    <input name="username" type="text" id="username" value="admin"></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><label for="password"></label>
    <input name="password" type="password" id="password" value="admin"></td>
  </tr>
  <tr>
    <td> </td>
    <td> </td>
  </tr>
  <tr>
    <td> </td>
    <td><input type="submit" name="button" id="button" value="Submit"></td>
  </tr>
</table>
</form>
	<?php
}
?>
