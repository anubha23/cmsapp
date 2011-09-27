<?php
require_once('AccessChecker.php');
$access = new AccessChecker();
if(time()-$_SESSION['time']>300)
$access->signout();
else
$_SESSION['time']=time();
if (!(isset($_SESSION['user']) & isset($_SESSION['pass'])))
{ header("Location: login.html"); die(); }

if ($_POST)
{
require_once('DatabaseConn.php');
$con=new DatabaseConn();
$result=$con->queryexec("INSERT INTO cmsusers (user,pass,firstname,lastname) VALUES (". "'".$_POST['txtusername']."'".", ".
"PASSWORD('".$_POST['txtpassword']."')".",'".$_POST['txtfirstname']."','".$_POST['txtlastname']."')");
if($result)
echo 'User added to the database. Click <a href="addnew.php">here</a> to add another user';
else
//echo 'There was a problem adding the user to the database. You might want to <a href="addnew.php">try again</a>';
echo mysql_error();
}
else
{
?>
<html>
<head>
<script language='javascript'>
function validate()
{
if (document.forms['add'].elements['txtpassword'].value!=document.forms['add'].elements['txtconfpassword'].value)
{
alert('Passwords dont match');
return false;
}
}
</script>
</head>
<body>
<form id='add' method='post' action='addnew.php' onsubmit='return validate()'>
Username: <input type='text' name='txtusername'/>
<br/><br/>
Password: <input type='password' name='txtpassword'/>
<br/><br/>
Confirm Password: <input type='password' name='txtconfpassword'/>
<br/><br/>
Firstname: <input type='text' name='txtfirstname'/>
<br/><br/>
Last name: <input type='text' name='txtlastname'/>
<br/><br/>
<input type='submit' name='btnadd' value='Add'/>

</form>
<?php
}?>
<br/><a href="manageusers.php">Manage Users</a>
</body>
</html>
 