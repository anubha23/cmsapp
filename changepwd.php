<?php
require_once('AccessChecker.php');
require_once('DatabaseConn.php');
$con= new DatabaseConn();
$access = new AccessChecker();
if(time()-$_SESSION['time']>300)
$access->signout();
else
$_SESSION['time']=time();
if (!(isset($_SESSION['user']) & isset($_SESSION['pass'])))
{ header("Location: login.html"); die(); }
else if ($_POST)
{
$result=$con->queryexec("Select user, pass from cmsusers where user='".$_POST['hiddenusername']."' and pass=PASSWORD('".$_POST['txtoldpwd']."')");
if($con->getNumRows($result)>0)
{
$arr=$con->fetchArray($result);
$username=$arr['user'];
$password=$arr['pass'];
$result1=$con->queryexec("Update cmsusers SET pass=PASSWORD('".$_POST['txtnewpwd']."') where user='".$username."' and pass='".$password."'");
if ($result1)
echo 'Password changed successfully';
else 
echo 'Could not change password';
}
else
{
echo mysql_error();
echo 'no record found';
}
}
else
{
?>
<form name="pwdform" method="post">
Welcome
Enter old password : <input type='password' name='txtoldpwd'><br/>
Enter new password : <input type='password' name='txtnewpwd'><br/>
<input type='hidden' name='hiddenusername' value='<?php echo $_SESSION['user'] ?>'>
<br/>
<input type='submit' name='btnchange' value='Change password' action='changepwd.php'>
</form>
<a href="login.php?action=logout">Logout</a>
<br/>
<?php } ?>
