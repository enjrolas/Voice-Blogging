<?php
if(isset($_POST['submit']))
{
include "remotePost.class.php";
$content['title'] = $_POST['title'];
$content['categories'] = $_POST['category'];
$content['description'] = $_POST['description'];
try
{
$posted = new remotePost($content);
$pid = $posted->postID;
}
catch(Exception $e)
{
echo $e->getMessage();
}
}
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WordPress Poster</title>
</head>
<body>
<?php
if(isset($_POST['submit'])) echo "Posted! <a href=\"http://myblog.com/?p=$pid\">View Post</a><br/><br/>";
 
?>
<form enctype="multipart/form-data" method="post" action="#">
<input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
<input type="file" name="pic" />
Title
 
<input type="text" name="title" />
Category
 
<select name="category">
<option value="Uncategorized">Uncategorized</option>
</select>
Description
 
<input type="text" name="description" />
<br/>
<input type="submit" value="Submit" name="submit" />
</form>
</body>
</html>
