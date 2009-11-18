<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WordPress Poster</title>
</head>
<body>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include "remotePost.class.php";
        $body ="<p style=\"text-align: center;\">";
        $body .= "<a href=\"";
        $body .= $_REQUEST['RecordingUrl'];
        $body .= "\"><img class=\"aligncenter\" src=\"http://farm3.static.flickr.com/2538/4082861842_cd8c3f7bfb_m.jpg\"></a></p>";
        $body.="<h2 style=\"text-align:  center;\">click the image to listen!</h2>\n</center>";
        $body .= "<hr><br/><b>Auto-transcription:</b><br/>";
        $body .= $_REQUEST['TranscriptionText']."\n\n";

$content['title'] = '<center>Voice Blog!</center>';
$content['categories'] = 'voice blogging';
$content['description'] = $body;
try
{
$posted = new remotePost($content);
$pid = $posted->postID;
echo $content['description'];
}
catch(Exception $e)
{
echo $e->getMessage();
}
 
?>



 
</body>
</html>
