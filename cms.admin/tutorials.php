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
            echo '<h1>Tutorial Management</h1>';
            
            echo '<div class="has-left-menu">';
            if(isset($_REQUEST['action']))
                    require 'tutorials/actions.php';
//             if(isset($_REQUEST['id']))
//                    require 'tutorials/form1.php';
            else if(isset($_REQUEST['step']) && $_REQUEST['step']==1 )
                require 'tutorials/form1.php';
            else if(isset($_REQUEST['step']) && $_REQUEST['step']==2 )
                require 'tutorials/form2.php';
            
            require 'tutorials/list.php';
            echo '</div>';
            
           ?>
    </div>
</article>
    
     <div class="right-sidemenu">
         
     </div>


<?php

require_once "footer.php";
?>