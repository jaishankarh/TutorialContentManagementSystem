<?php
require_once './user_libs.php';
require_once './header.php';
require_once './sidebarLeft.php';
?>

<article class = "main" style="border-top: 2px dashed rgba(255,255,255,.75);">
    <div class = "innerColumn">
        
<?php
$user = $_SESSION['userdata'];
?>
    
        
<?php
if(isset($_GET['feature'])&&$_GET['feature']=="tutorials")
    require_once 'tutorials/tutorials.php';
else if(isset($_GET['feature'])&&$_GET['feature']=="settings")
    require_once 'accounts/user-settings.php';
else if(isset($_GET['site'])&&$_GET['site']=="about")
    require_once 'site/about.php';
else {
?>
<h2>Welcome <?php echo $user['uname'];?>,</h2>  
        
        <h5>Please choose an option on the left to continue.</h5>    
<?php } ?>        
    </div>
</article>
<?php
 //   require_once './mainContent.php';

require_once './sidebarRight.php';
require_once './chats.php';
require_once './footer.php';
?>
