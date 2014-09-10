<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/cms.incs/basics.php';

function is_admin()
{
    if(!isset($_SESSION['userdata']))
        return FALSE;
    if(isset($_SESSION['userdata']['groups']['_administrators']))
        return true;
    if(isset($_SESSION['userdata']['groups']['_superadministrators']))
        return true;
    if(!isset($_REQUEST['login_msg']))
        $_REQUEST['login_msg'] = 'permissiondenied';
    return false;
}
if(!is_admin())
{
    require SCRIPTBASE.'cms.admin/login/login.php';
    exit;
}