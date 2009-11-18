<?php
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
/*
    if (!isset($_REQUEST['email'])) {
        echo "Must specify email address";
        die;
    }
*/
?>
<Response>
    <Say>Whatever you say here will be posted on your blog</Say>
    <Record transcribe="true" transcribeCallback="<?php 
        echo "voicepost.php?email=".urlencode($_REQUEST['email']); ?>"        
        action="goodbye.php" maxLength="150" />
</Response>
