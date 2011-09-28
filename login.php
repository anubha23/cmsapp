<?php

require_once('AccessChecker.php');
require_once('DatabaseConn.php');
$accesscheck = new AccessChecker();
$con=new DatabaseConn();


if ($_POST)
{
if ($_POST['user'] != ''){
	$result=$con->queryexec("SELECT firstname,designation from cmsusers WHERE user='".$_POST['user']."' and pass=PASSWORD('".$_POST['pass']."')");
if($result)
{
	$userdetails=$con->fetchArray($result);
	$firstname=$userdetails['firstname'];
	$designation=$userdetails['designation'];
	}

$accesscheck->checkLogin($_POST['user'],$_POST['pass'],'welcome.php?firstname='.$firstname.'&designation='.$designation,'failed.html');
	
}
}
 if(isset( $_GET['action'] ) && $_GET['action'] == 'logout') 
{
	if ($accesscheck->signout()){
		echo '<center>You have been logged out</center><br>';
		echo 'Click <a href="login.html">here</a> to login again';
	}
}
?>