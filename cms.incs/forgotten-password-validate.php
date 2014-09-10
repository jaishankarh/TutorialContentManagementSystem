<?php
require_once 'login-libs.php';
$tp=$DBVARS['tp'];
login_check_is_email_provided();

if(!isset($_REQUEST['verification_code']) || $_REQUEST['verification_code'] == '')
{
    login_redirect ($url, 'validationfailed');
}
$r = dbRow('SELECT email FROM '.$tp.'login WHERE email="'. $_REQUEST['email'].'" AND activation_key="'.$_REQUEST['verification_code'].'" AND active;');
if($r == FALSE)
{
    login_redirect($url, 'validationfailed');
}
dbQuery('UPDATE '.$tp.'login SET activation_key="" WHERE email="'.$_REQUEST['email'].'"');



login_redirect($url, 'verified');