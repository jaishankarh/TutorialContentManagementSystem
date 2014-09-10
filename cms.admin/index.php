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
        <h2>Welcome <?php echo $_SESSION['userdata']['uname']; ?> </h2>
    </article>
    
     <div class="sidebar2">
         
     </div>


<?php

require_once "footer.php";
?>