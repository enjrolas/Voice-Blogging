<?php
 
class remotePost
{
  private $client;
  private $wpURL = 'http://www.artiswrong.com/wordpress/xmlrpc.php ';  //replace me
  private $ixrPath = 'xmlrpc.php';
  private $uname = 'XXXXXX';     //relace me
  private $pass = 'XXXXXX';     //replace me
  private $maxSize = 2097152; //2MB
  private $tempDir = '';
  public $postID;

  function __construct($content)
  {
    if(!is_array($content)) throw new Exception('Invalid Argument');
    include $this->ixrPath;
    $this->client = new IXR_Client($this->wpURL);
    $this->postID = $this->postContent('',$content);
  }

  private function uploadImage()
  {
    $fileName = $_FILES['pic']['name'];
    $fileType = $_FILES['pic']['type'];
    $fileTempName = $_FILES['pic']['tmp_name'];
    $fileSize = $_FILES['pic']['size'];
    $fileError = $_FILES['pic']['error'];
    if($fileError == UPLOAD_ERR_NO_FILE)
      {
	$imgURL = null;
	return $imgURL;
      }
else
  {
    if($fileError == UPLOAD_ERR_OK)
      {
	if($fileSize > $this->maxSize) throw new Exception('File too large!');
	if(!eregi('image/',$fileType)) throw new Exception('Uploaded file is not an image!');
	$fileInfo = getimagesize($fileTempName);
	if(!eregi('image/',$fileInfo['mime'])) throw new Exception('Uploaded file is not an image!');
	$fileName = rand(0,time()) . $fileName;
	if(!move_uploaded_file($fileTempName,"$this->tempDir/$fileName")) throw new Exception('Unable to move uploaded image!');
	$filePath = "$this->tempDir/$fileName";
      }
  }
 
    $img = file_get_contents($filePath);
    $encoded = new IXR_Base64($img);
    $fileName = basename($filePath);
    $imgData['name'] = $fileName;
    $imgData['type'] = $fileInfo['mime'];
    $imgData['bits'] = $encoded;
    $imgData['overwrite'] = false;
    if(!$this->client->query('metaWeblog.newMediaObject','',$this->uname,$this->pass,$imgData)) throw new Exception($this->client->getErrorMessage());
    unlink($filePath);
    $info = $this->client->getResponse();
    $imgURL = $info['url'];
    return $imgURL;
  }

  private function postContent($imgURL,$content)
  {
    /*    if(isset($imgURL))
      {
	$imgString = "<img src=\"$imgURL\" class=\"alignleft\" title=\"$content[title]\" alt=\"$content[title]\" width=\"300\" />";
	$content['description'] = $imgString . $content['description'];
      }
    */
    if(!$this->client->query('metaWeblog.newPost','',$this->uname,$this->pass,$content,true)) throw new Exception($this->client->getErrorMessage());
    return $this->client->getResponse();
  }
}
?>