<?php
require_once "admin_libs.php";
require_once "header.php";
?>

<div class="container">
    
    <div class="left-sidemenu">
    <?php
    require_once "left-sidemenu.php";
    ?>
    </div>
    <div class="content">
        <?php
            echo '<h1>Tutorial Management</h1>';
            echo '<div class="left-menu">';
            echo '<a href="/cms.admin/tutorials.php">Tutorials</a>';
            echo '</div>';
            echo '<div class="has-left-menu">';

            if(isset($_REQUEST['action']))
                    require 'tutorials/actions.php';
            if(isset($_REQUEST['id']))
                require 'tutorials/form.php';
            if(isset($_REQUEST['step']))
                require 'tutorials/form.php';
            require 'tutorials/list.php';
            echo '</div>';
            
           ?>
    </div>
    
     <div class="right-sidemenu">
         
     </div>
</div>

<?php

require_once "footer.php";
?>