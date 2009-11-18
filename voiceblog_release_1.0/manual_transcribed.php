<?php
      $body="test";

      $param="description=".$body;
      $url="voicepost.php?".$param;
      $myHeader="Location: ".$url;
      header($myHeader);

?>