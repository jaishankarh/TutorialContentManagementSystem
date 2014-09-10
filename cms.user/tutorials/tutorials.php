<?php
require_once './user_libs.php';
//require_once './header.php';
//
//require_once './sidebarLeft.php';

if(isset($_REQUEST['action']))
    require_once 'actions.php';
//if(isset($_REQUEST['id']))
//    require 'tutorials/form1.php';
else if(isset($_REQUEST['create'])&&isset($_REQUEST['step']) && $_REQUEST['step']==1 )
    require_once 'form1.php';
else if(isset($_REQUEST['create'])&&isset($_REQUEST['step']) && $_REQUEST['step']==2 )
    require_once 'form2.php';
else if(isset($_GET['view'])&&$_GET['view']=="one")
    require_once 'view.php';
else if(isset($_GET['view'])&&$_GET['view']=="all")
    require_once 'listings.php';
else if(isset($_GET['review'])&&$_GET['review']=="all")
{
    require_once 'reviews.php';
}
else if(isset($_GET['review'])&&$_GET['review']=="one"&&isset ($_GET['id']))
{
    require_once 'view.php';
    require_once 'reviews.php';
    
}
else if(isset($_GET['search']))
{
    require_once 'search.php';
    
}
else if(isset($_GET['edit'])&&isset($_REQUEST['step']) && $_REQUEST['step']==1)
{
    require_once 'form1.php';
}
else if(isset($_REQUEST['edit'])&&isset($_REQUEST['step']) && $_REQUEST['step']==2 )
    require_once 'form2_edit.php';


//
//
//require_once './sidebarRight.php';
//require_once './footer.php';
?>
