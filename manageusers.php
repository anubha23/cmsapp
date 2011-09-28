<?php
require_once('AccessChecker.php');
require_once('DatabaseConn.php');
$con=new DatabaseConn();
$access = new AccessChecker();
if(time()-$_SESSION['time']>300)
$access->signout();
else
$_SESSION['time']=time();
if (!(isset($_SESSION['user']) & isset($_SESSION['pass'])))
{ header("Location: login.html"); die(); }

if($_SESSION["designation"]!=1)
{ header("Location: login.html"); echo 'You need to be an admin to have access to that page'; die(); }
if($_POST)
{
if (isset($_POST['hiddenfield']))
{
$id1=$_POST['hiddenfield'];
echo $id1;
$username='txtusername'.$id1;
$firstname='txtfirstname'.$id1;
$lastname='txtlastname'.$id1;
$result1=$con->queryexec('UPDATE cmsusers SET user="'.$_POST[$username].'",firstname="'.$_POST[$firstname].'",lastname="'.$_POST[$lastname].'"where ID="'.$id1.'"');
if ($result1)
echo 'Database updated successfully';
else
echo 'There was a problem updating to the database';
}
/*else if ($_POST['delete'])
{
//$result1=$con->queryexec('DELETE from cmsusers where user="'.$_POST['txtusername'].'",

}*/
}
$result=$con->queryexec('Select * from cmsusers');
?>
<html>
<head>
<script language="javascript">
function edit(d)
{
document.forms['frm'].elements['txtusername'+d].disabled=false;
document.forms['frm'].elements['txtfirstname'+d].disabled=false;
document.forms['frm'].elements['txtlastname'+d].disabled=false;
document.forms['frm'].elements['btnupdate'+d].disabled=false;
document.forms['frm'].elements['btnedit'+d].disabled=true;
id1=d;
}

function update(id1)
{
document.frm.hiddenfield.value=id1;
alert(document.frm.hiddenfield.value);
}

</script>
</head>
<body>
<?php
if($result)
{
echo '<form id="frm" action="manageusers.php" method="post"><table><tr><td>Username</td><td>First Name</td><td>Last Name</td><td>Operations</td></tr>';
while($userlist=$con->fetchArray($result))
{
?>
<tr>
<td><input type="text" disabled="true" name="txtusername<?php echo $userlist['ID'];?>" id="<?php echo $userlist['ID']; ?>" value="<?php echo $userlist['user'];?>"></td>
<td><input type="text" disabled="true" name="txtfirstname<?php echo $userlist['ID'];?>" id="<?php echo $userlist['ID']; ?>" value="<?php echo $userlist['firstname'];?>"></td>
<td><input type="text" disabled="true" name="txtlastname<?php echo $userlist['ID'];?>" id="<?php echo $userlist['ID']; ?>" value="<?php echo $userlist['lastname'];?>"></td>
<td><input type="button" name= "btnedit<?php echo $userlist['ID'];?>" value="Edit" id="<?php echo $userlist['ID']; ?>" onclick="edit(<?php echo $userlist['ID'];?>)">
<input type="submit" name= "btnupdate<?php echo $userlist['ID'];?>" disabled="true" value="Update" id="<?php echo $userlist['ID'];?>" onclick="update(<?php echo $userlist['ID']?>)">
<input type="submit" name= "btndelete<?php echo $userlist['ID'];?>" value="Delete" id="<?php echo $userlist['ID'];?>">

</td></tr>


<?php
} echo '</table><input type="hidden" name="hiddenfield"/></form></body></html>';

}
?>
<form id="frm2" action="addnew.php">
<input type="submit" name="btnaddnew" value="Add new user"/>
</form>