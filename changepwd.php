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
$result=$con->queryexec("Update cmsusers set pass=PASSWORD('".$_POST['txtnewpwd']."') where user='".$_POST['hiddenusername']."' and pass=PASSWORD('".$_POST['txtoldpwd']."')");
if($result)
echo 'Password changed successfully';
else
echo mysql_error();
}
else
{
?>
<form name="pwdform" method="post">
Welcome <?php echo $_GET['username'] ?>
Enter old password : <input type='password' name='txtoldpwd'><br/>
Enter new password : <input type='password' name='txtnewpwd'><br/>
<input type='hidden' name='hiddenusername' value='<?php echo $_GET['username'] ?>'>
<br/>
<input type='submit' name='btnchange' value='Change password' action='changepwd.php'>
</form>
<?php } ?>
