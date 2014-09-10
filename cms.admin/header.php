<?php
header('content-type: text/html; Charset=utf-8');
require_once 'admin_libs.php';
$tp=$DBVARS['tp'];
$site = dbRow('SELECT * FROM '.$tp.'site_info WHERE id=1');
?>

<html>
    <head>
        
        <script src="/common/js/1.10.2/jquery-1.10.2.js"></script>
<!--        <script src="/common/js/foundation/js/foundation/foundation.topbar.js"></script>-->
        
        <link rel="stylesheet" type="text/css" href="/common/css/jqueryui/1.8.0/jquery-ui.css"/>
        <!--        <link rel="stylesheet" type="text/css" href="/cms.admin/theme/admin.css"/>-->
        <link rel="stylesheet" type="text/css" href="/common/css/foundation/css/foundation.css"/>
        <link rel="stylesheet" type="text/css" href="/common/css/foundation/css/normalize.css"/>
<!--        <link rel="stylesheet" type="text/css" href="/cms.admin/theme/adminpage.css"/>-->
        <link rel="stylesheet" type="text/css" href="/common/css/adminStyles.css"/>
        
    </head>
    <body>
        <div class="pageWrapper">
            <header>
        <nav class="clear" data-topbar>
            <ul class="title-area"> 
                <li class="name"> <a href="#"><?php echo $site['site_name']; ?> </a></li> 
                <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li> 
                <li><a href="/index.php">View Site</a></li> 
                <li class="active"><a href="/cms.incs/logout.php?redirect=/cms.admin/">Log Out</a></li> 
            </ul> 
        </nav>
                <h1><?php echo $site['site_name']; ?></h1>
<script src="/common/js/foundation/js/jquery.js"></script>
<script src="/common/js/foundation/js/foundation.min.js"></script>
        <script src="/common/js/foundation/js/modernizr.js"></script>
        <script>
            $(document).foundation();
        </script>
            </header>