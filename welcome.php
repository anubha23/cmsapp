<?php
require_once('AccessChecker.php');
require_once('DatabaseConn.php');
$access = new AccessChecker();
//if (!$access->checkLogin(2) ){ header("Location: login.php"); die(); }
if(isset($_POST['username']) & isset($_POST['designation']))

?>
<html>
<head>
<title>Welcome</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
Welcome <?php echo $_GET['username'];?> <br> <br>

<form name="form1" method="post" action="newArticle.php">
<p>Enter a new article:</p>
        <p>&nbsp;Title:
          <input name="title" type="text" id="title">
        </p>
        <p>&nbsp;Article:
          <textarea name="content" cols="50" rows="6" id="content"></textarea>
        </p>
        <p align="center">
          <input type="submit" name="Submit" value="Publish">
        </p>
</form>
<br>
<a href="allarticles.php">Browse old articles</a>
<br>
<?php if ($_GET['designation']==1)
echo '<a href="manageusers.php">Manage your users</a><br/>';
?>
<a href="changepwd.php">Change your password</a>
<br/>
</body>

</html>
