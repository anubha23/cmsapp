<b> ARTICLES: </b><br>
<?php

require_once('DatabaseConn.php');

$con = new DatabaseConn();

// Execute the query to retrieve articles
//$result = $con->queryexec('SELECT ID,title,Time FROM cmsarticles ORDER BY ID DESC');
$result = $con->queryexec('SELECT ID,title FROM cmsarticles ORDER BY TitleTime.YEAR, TitleTime.MONTH DESC');
$result1=$con->queryexec('SELECT DISTINCT DATE_FORMAT( titletime,\'%M, %Y\' ) as time1 FROM cmsarticles');
 if ($result1)
 {
 while ($row1=$con->fetchArray($result1))
 {
 echo '<a href="viewArticle.php?articleaction=timewise&period='.$row1['time1'].'">'.$row1['time1'].'</a>';
 }
 }
 /*if ($result && result1)
 {
 
 while($row1=con->fetchArray($result1));
 echo $row1['Time.YEAR']." ".$row1['Time.MONTH'];
while ($row = $con->fetchArray($result)){
echo $row['Time.YEAR'].$row['Time.MONTH']
echo '<p> <a href="viewArticle.php?id='.$row['ID'].'">';
echo $row['title'];
echo '</a> </p>';
}
}
}*/
?>
