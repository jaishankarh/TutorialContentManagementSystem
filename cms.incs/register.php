<?php
require_once 'login-libs.php';

$tp = $DBVARS['tp'];

login_check_is_captcha_provided();
login_check_is_captcha_valid();

if(!isset($_POST['username']))
    login_redirect ($GLOBALS['url'],'nousername');

login_check_is_email_provided();

if(!isset($_POST['password']) || $_POST['password']=='')
    login_redirect ($GLOBALS['url'],'nopassword');

if($_POST['password']!= $_POST['password2'])
{
    login_redirect ($GLOBALS['url'],'passwordmismatch');
}
else
{
    $password = md5($_POST['email'].'|'.$_POST['password']);
    $sql = 'set uname="'.$_POST['username'].'", email="'.$_POST['email'].'", password="'.$password.'", active=1, groups=\'["_users"]\'';
    dbQuery('insert into '.$tp.'login '.$sql);
    login_redirect ($GLOBALS['url'],'regisersuccess');
}
