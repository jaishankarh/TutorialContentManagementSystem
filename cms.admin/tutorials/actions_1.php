<?php
require_once $_SERVER['DOCUMENT_ROOT']."/cms.admin/admin_libs.php";
require_once $_SERVER['DOCUMENT_ROOT']."/cms.admin/header.php";
?>

<div class="container">
    
    <div class="left-sidemenu">
    <?php
    require_once $_SERVER['DOCUMENT_ROOT']."left-sidemenu.php";
    ?>
    </div>
    <div class="content">
        <?php
            echo '<h1>Tutorial Management</h1>';
            echo '<div class="left-menu">';
            echo '<a href="/cms.admin/tutorials.php">Tutorials</a>';
            echo '</div>';
            echo '<div class="has-left-menu">';
$id=(int)$_REQUEST['id'];
$tp=$DBVARS['tp'];
if($_REQUEST['action']=='delete'){
	dbQuery('delete from '.$tp.'login where uid='.$id);
	unset($_REQUEST['id']);
}
if($_REQUEST['action']=='Save'){
	$roles=$_REQUEST['roles'];
	if(!count($roles))
		$roles=array(0);
	$grs=dbAll('select rname from '.$tp.'role where id in ('.join(',',array_keys($roles)).') order by rname');
	$roles=array();
	foreach($grs as $r)
		$roles[]=$r['rname'];
	$sql='set uname="'.$_REQUEST['username'].'", email="'.$_REQUEST['email'].'",active="'.(int)$_REQUEST['active'].'",groups=\''.json_encode($roles).'\'';
	if(isset($_REQUEST['password']) && $_REQUEST['password']!=''){
		if($_REQUEST['password']!==$_REQUEST['password2'])
			echo '<em>Password not updated. Must be entered the same twice.</em>';
		else $sql.=',password=md5("'.$_REQUEST['email'].'|'.$_REQUEST['password'].'")';
	}
	if($id==-1){
		dbQuery('insert into '.$tp.'login '.$sql);
		$_REQUEST['id']=dbLastInsertId();
	}
	else{
		dbQuery('update '.$tp.'login '.$sql.' where id='.$id);
	}
	echo '<em>Users updated</em>';
}
?>
        
        </div>
    
     <div class="right-sidemenu">
         
     </div>
</div>
<?php
require_once $_SERVER['DOCUMENT_ROOT']."footer.php";
?>