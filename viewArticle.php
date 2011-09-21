<?php
// Require the database class
require_once('DatabaseConn.php');

// Create a new DbConnector object
$con = new DatabaseConn();

if(isset($_GET['id']))
{
$id=$_GET['id'];
}


if(isset($_POST['articleaction']))
{
$action=($_POST['articleaction']);
switch ($action)
{
case "timewise":
$result=$con->queryexec('SELECT title,content FROM cmsarticles WHERE DATE_FORMAT( titletime,\'%M, %Y\')='.$_POST['period']);
break;

default:
$result = $con->queryexec('SELECT title,content FROM cmsarticles WHERE ID = '.$id);
break;
}
}
else
{
$result=$con->queryexec('SELECT title,content FROM cmsarticles ORDER BY ID DESC LIMIT 0,10');
}



// Get an array containing the resulting record
while($row = $con->fetchArray($result)){
echo $row['title'];?>
<br><br>
<?php echo $row['content'];?><br><br>
<?php } ?>
