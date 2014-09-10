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
    <div class="content">
        <?php
            echo '<h1>Site Management</h1>';
            
            echo '<div class="has-left-menu">';

            if(isset($_REQUEST['action']))
            {
                    require 'site-info/actions.php';
                    
                    if(count($errors)!=0)
                        require 'site-info/form.php';
            }
            if(isset($_REQUEST['edit']))
                require 'site-info/form.php';
            require 'site-info/list.php';
            echo '</div>';
           
           ?>
    </div>
</article>
    
     <div class="right-sidemenu">
         
     </div>
</div>

<?php

require_once "footer.php";