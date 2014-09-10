<?php
require_once 'login-libs.php';

$tp = $DBVARS['tp'];
login_check_is_email_provided();

if(!isset($_REQUEST['password']) || $_REQUEST['password']=='')
    login_redirect ($GLOBALS['url'],'nopassword');
login_check_is_captcha_provided();
login_check_is_captcha_valid();
 
// check that the email and password provided exists in the database..
$password = md5($_REQUEST['email'].'|'.$_REQUEST['password']);
//var_dump($_REQUEST['email']);
//die();
//echo $_REQUEST['email'].'<br/>';
//echo $_REQUEST['password'].'<br/>';
//echo $password;
//die();
//$password = md5('jaishankarh@gmail.com|123456789');

//$check_query = 'SELECT * FROM user_accounts WHERE email="'.$_REQUEST['email'].'" AND password="'.$password.'" AND active=1';
$check_query = 'SELECT * FROM '.$tp.'login WHERE email="'.$_REQUEST['email'].'" AND password="'.$password.'" AND active=1';
$r = dbRow($check_query);

if($r == false)
{
    login_redirect($GLOBALS['url'],'loginfailed');
}
//success set the session variable, then redirect
$_SESSION['userdata'] = $r;
$groups = json_decode($r['groups']);
$_SESSION['userdata']['groups'] = array();
foreach($groups as $g)
    $_SESSION['userdata']['groups'][$g] = true;

$query = 'UPDATE '.$tp.'login SET logged_in=1 WHERE uid='.$r['uid'];
dbQuery($query);
login_redirect($GLOBALS['url']);

