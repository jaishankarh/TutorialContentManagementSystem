<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/cms.incs/basics.php';
    //require_once SCRIPTBASE.'cms.incs/common.php';
    require_once SCRIPTBASE.'cms.incs/recaptcha.php';
    require_once SCRIPTBASE.'cms.incs/login-libs.php';
    $captcha = recaptcha_get_html(RECAPTCHA_PUBLIC);
    if(isset($_SESSION['userdata']))
    {
        login_redirect("/cms.user/index.php");
        
    }

?>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="/cms.admin/login/login.css"/>
        <link rel="stylesheet" type="text/css" href="/common/css/jqueryui/1.8.0/jquery-ui.css"/>
        
        <script type="text/javascript" src="/common/js/1.4.2/jquery.min.js"></script>
        <script type="text/javascript" src="/common/js/jqueryui/1.8.0/jquery-ui.min.js"></script>
        
        <script type="text/javascript" src="/cms.admin/login/login.js"></script>
<!--        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
		<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/themes/south-street/jquery-ui.css" />
		<script src="/cms.admin/login/login.js"></script>
		<link rel="stylesheet" type="text/css" href="/cms.admin/login/login.css" />-->
        <style>
            body{
                background-image: url('/common/images/background.jpg'); 
            }
        </style>
    </head>
    <body>
        <div id="header"></div>
        <?php
            if(isset($_REQUEST['login_msg']))
            {
                require SCRIPTBASE.'cms.incs/login-codes.php';
                $login_msg = $_REQUEST['login_msg'];
                if(isset($login_msg_codes[$login_msg]))
                {
                    echo '<script> $(function(){'
                    . '$("<strong>'.htmlspecialchars($login_msg_codes[$login_msg]).'</strong>").dialog({modal:true});});</script>';

                }
            }
        
        
        ?>
        <div class="tabs">
            <ul>
                <li><a href="#tab1">Login</a></li>
                <li><a href="#tab2">Forgotten Password</a></li>
                <li><a href="#tab3">Register</a></li>
                
                
            </ul>
            <div id="tab1">
                <form method="POST" action="/cms.incs/login.php?redirect=<?php echo $_SERVER['PHP_SELF'];?>">
                    <table>
                        <tr>
                            <th>Email *</th>
                            <td><input type="email" name="email" id="email"/></td>
                        </tr>
                        <tr>
                            <th>Password *</th>
                            <td><input type="password" id="password" name="password"/></td>
                        </tr>
                        <tr id="captcha">
                            <th>Captcha *</th>
                            <td><?php echo $captcha;?></td>
                        </tr>
                        <tr>
                            <th colspan="2" align="right">
                                <input name="action" type="submit" value="login" class="login"/>
                            </th>
                        </tr>
                        <tr><td>* Required Fields</td></tr>
                    </table>
                    
                </form>
            </div>
            <div id="tab2">
                <form method="POST" action="/cms.incs/forgotten-password-reminder.php?redirect=<?php echo $_SERVER['PHP_SELF'];?>">
                    <table>
                        <tr>
                            <th>Email *</th>
                            <td><input type="email" name="email" id="email"/></td>
                        </tr>
                        
                        <tr>
                            <th colspan="2" align="right">
                                <input name="action" type="submit" value="Resend My Password" class="login"/>
                            </th>
                        </tr>
                        <tr><td>* Required Fields</td></tr>
                    </table>
                </form>
            </div>
            <div id="tab3">
                <form method="POST" action="/cms.incs/register.php?redirect=<?php echo $_SERVER['PHP_SELF'];?>">
                    <table>
                        <tr>
                            <th>Username *</th>
                            <td><input type="text" name="username" id="email" required="true"/></td>
                        </tr>
                        <tr>
                            <th>Email *</th>
                            <td><input type="email" name="email" id="email" required="true"/></td>
                        </tr>
                        <tr>
                            <th>Password *</th>
                            <td><input type="password" id="password" name="password" required="true"/></td>
                        </tr>
                        <tr>
                            <th>Password Confirm *</th>
                            <td><input type="password" id="password2" name="password2" required="true" /></td>
                        </tr>
                        
                        <tr>
                            <th colspan="2" align="right">
                                <input name="action" type="submit" value="register" class="login"/>
                            </th>
                        </tr>
                        <tr><td>* Required Fields</td></tr>
                    </table>
                    
                </form>
            </div>
        </div>
        
    </body>
</html>