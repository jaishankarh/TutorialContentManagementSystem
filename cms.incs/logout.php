<?php
$url="/cms.user";
session_start();
//
//if(isset($_REQUEST['redirect']))
//{
//    $url = preg_replace('/[\?\&].*/', '', $_REQUEST['redirect']);
//    if($url == '')
//        $url='/';
//}
session_destroy();
unset($_SESSION['userdata']);

header('Location: '.$url);
echo '<a href="'.htmlspecialchars($url).'">redirect</a>';