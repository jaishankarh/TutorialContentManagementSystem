<?php
session_start();
if(isset($_SESSION['username']))
{
    $msg= "";
    if(isset($_POST['msg']))
    {
        global $msg;
        $msg = $_POST['msg'];
    }
    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['username']."</b>: ".stripslashes(htmlspecialchars($msg))."<br></div>");
    fclose($fp);
}
    


?>