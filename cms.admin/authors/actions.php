<?php
$id=(int)$_REQUEST['id'];
$tp=$DBVARS['tp'];
if($_REQUEST['action']=='delete'){
	dbQuery('delete from '.$tp.'author where id='.$id);
	unset($_REQUEST['id']);
}
if($_REQUEST['action']=='Save'){
	$sql='set uid = "'.$_REQUEST['user'].'", auth_fname="'.$_REQUEST['fname'].'", auth_lname="'.$_REQUEST['lname'].'",designation="'.$_REQUEST['designation'].'",experience="'.$_REQUEST['experience'].'",expertise_area="'.$_REQUEST['expertise'].'", hobbys="'.$_REQUEST['hobbys'].'"';
	
	
	if($id==-1){
		dbQuery('insert into '.$tp.'author '.$sql);
		$_REQUEST['id']=dbLastInsertId();
	}
	else{
		dbQuery('update '.$tp.'author '.$sql.' where uid='.$id);
	}
	echo '<em>Authors updated</em>';
}
