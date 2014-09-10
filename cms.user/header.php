<?php
$user = $_SESSION['userdata'];
$tp=$DBVARS['tp'];
$site = dbRow('SELECT * FROM '.$tp.'site_info WHERE id=1');
?>



<!doctype html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Home</title>
        <link href = "/common/css/styles.css" rel = "stylesheet">

        <script src="/common/js/1.10.2/jquery-1.10.2.js"></script>
<!--        <script src="/common/js/foundation/js/foundation/foundation.topbar.js"></script>-->
        
        <link rel="stylesheet" type="text/css" href="/common/css/jqueryui/1.8.0/jquery-ui.css"/>
        <!--        <link rel="stylesheet" type="text/css" href="/cms.admin/theme/admin.css"/>-->
        <link rel="stylesheet" type="text/css" href="/common/css/foundation/css/foundation.css"/>
        <link rel="stylesheet" type="text/css" href="/common/css/foundation/css/normalize.css"/>
        <link rel="stylesheet" type="text/css" href="/cms.admin/theme/adminpage.css"/>
        <link href="/common/css/chatStyles.css" type="text/css" rel="stylesheet"/>
        <style>
            #name{
                float:right;
            }
        </style>
    </head>
   

    <body>
        <div class = "pageWrapper">
            <header>

                <nav class = "clear">
                    <ul>
                        
                        <li><a href = "/cms.user/index.php">Home</a></li>
                        <li><a href = "/cms.user/login/login.php">Login</a></li>
                        <li><a href="/cms.incs/logout.php?<?php echo htmlspecialchars(http_build_query(array("redirect" => "/cms.user/"))); ?> ">Log Out</a></li>
                        <li><a href = "/cms.user/index.php?site=about">About Us</a></li>
                        <li><a class="right_links" href = "/cms.user/index.php">Welcome <?php  echo $user['uname']?>,</a></li>
                       
                    </ul>
                </nav>
                
                

                <h1><?php echo $site['site_name']; ?></h1>

            </header>