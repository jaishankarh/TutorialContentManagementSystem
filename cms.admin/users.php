<?php
require_once "admin_libs.php";
require_once "header.php";
?>

<div class="sidebar1">
    
    <div class="innerColumn">
    <?php
    require_once "left-sidemenu.php";
    ?>
    </div>
</div>
<article class="main">
    <div class="innerColumn">
        <?php
            echo '<h1>User Management</h1>';
//            echo '<div class="left-menu">';
//            echo '<a href="/cms.admin/users.php">Users</a>';
//            echo '</div>';
            echo '<div class="has-left-menu">';

            if(isset($_REQUEST['action']))
                    require 'users/actions.php';
            if(isset($_REQUEST['id']))
                require 'users/form.php';
            require 'users/list.php';
            echo '</div>';
            echo '<script src="/cms.admin/users/users.js"></script>';
           ?>
    </div>
</article>
    
     <div class="right-sidemenu">
         
     </div>


<?php

require_once "footer.php";
?>