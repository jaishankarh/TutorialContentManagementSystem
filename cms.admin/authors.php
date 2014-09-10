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
            echo '<h1>Author Management</h1>';
            
            echo '<div class="has-left-menu">';

            if(isset($_REQUEST['action']))
                    require 'authors/actions.php';
            if(isset($_REQUEST['id']))
                require 'authors/form.php';
            require 'authors/list.php';
            echo '</div>';
            echo '<script src="/cms.admin/users/users.js"></script>';
           ?>
    </div>
    </article>
     <div class="sidebar2">
         
     </div>
</div>

<?php

require_once "footer.php";
?>