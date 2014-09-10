<?php
$user = $_SESSION['userdata'];
$tp=$DBVARS['tp'];
$site = dbRow('SELECT * FROM '.$tp.'site_info WHERE id=1');

if(isset($_REQUEST['site']) && $_REQUEST['site'] == 'about' )
{
    echo "<h2> About Us </h2>";
    echo $site['about_us'];
    echo "This is the about us page";
    
}