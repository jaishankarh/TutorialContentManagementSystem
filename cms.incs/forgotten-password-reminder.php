<?php
require_once 'login-libs.php';

$tp=$DBVARS['tp'];

login_check_is_email_provided();
login_check_is_captcha_provided();
login_check_is_captcha_valid();

$r  = dbRow('SELECT email FROM '.$tp.'login WHERE email="'.$_REQUEST['email'].'" AND active;');
if($r == FALSE)
{
    login_redirect($url, 'nosuchemail');
}

$validation_code = md5(time().'|'.$r['email'] );
$email_domain = preg_replace('/^www\./', '', $_SERVER['HTTP_HOST']);
dbQuery('UPDATE '.$tp.'login SET activation_key="'.$validation_code.'" WHERE email="'.$r['email'].'"');
$validation_url = 'http://'.$_SERVER['HTTP_HOST'].'/cms.incs/forgotten-password-validate.php?'.htmlspecialchars(http_build_query(array("verification_code"=>$validation_code, 'email'=>$r['email'],'redirect'=>$url)));
$mailsent = mail($r['email'], 
     $email_domain.'Forgotten Password', 
     "Hello!\n\nThe forgotten password form at http://".$_SERVER['HTTP_HOST'].
     "/ was submitted. If you did not do this, you can safely discard this email.\n\n
     To log into your account, please use the link below, and then reset your password.\n\n$validation_url",
     "From: jaishankar@$email_domain\nReply-to: jaishankarh@gmail.com"   
        );
if($mailsent)
{
    login_redirect($url, "validationsent");
}
login_redirect($url, "novalidation");