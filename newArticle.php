<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php

require_once('DatabaseConn.php');


if ($_POST){


$connector = new DatabaseConn();


$content=mysql_real_escape_string($_POST['content']);

$ins= "INSERT INTO cmsarticles (title,content,TitleTime) VALUES (".
"'".$_POST['title']."', ".
"'".$content."'".",NOW())";

// Save the form data into the database 
if ($result = $connector->queryexec($ins)){
$query="Select * from cmsarticles";
if ($res=$connector->queryexec($query)
$id=($connector->getNumRows($res))+1;
echo '<center><b>Article added to the database</b></center><br> Click <a href="content.php?articleaction=0&id='.$id.'">here</a> to view your article!';
}
else{

//exit('<center>Sorry, there was an error saving to the database</center>');
echo mysql_error();
}

}
?>

