<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/cms.incs/basics.php';

function is_user()
{
    if(!isset($_SESSION['userdata']))
        return FALSE;
    
    if(isset($_SESSION['userdata']['groups']['_validators']))
        return true;
    
    if(isset($_SESSION['userdata']['groups']['_users']))
        return true;
    if(isset($_SESSION['userdata']['groups']['_superadministrators']))
        return true;
    
    if(!isset($_REQUEST['login_msg']))
        $_REQUEST['login_msg'] = 'permissiondenied';
    
    return false;
}
if(!is_user())
{
    
    require_once SCRIPTBASE.'cms.user/login/login.php';
    exit;
}