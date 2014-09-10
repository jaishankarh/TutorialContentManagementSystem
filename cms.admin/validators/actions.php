<?php
$id=(int)$_REQUEST['id'];
$tp=$DBVARS['tp'];
if($_REQUEST['action']=='delete'){
	dbQuery('delete from '.$tp.'validator where id='.$id);
	unset($_REQUEST['id']);
}
if($_REQUEST['action']=='Save'){
	$sql='set val_fname="'.$_REQUEST['fname'].'", val_lname="'.$_REQUEST['lname'].'",designation="'.$_REQUEST['designation'].'",experience="'.$_REQUEST['experience'].'",expertise_area="'.$_REQUEST['expertise'].'"';
//        $sql='set uid = "'.$_REQUEST['user']['uid'].'", val_fname="'.$_REQUEST['fname'].'", val_lname="'.$_REQUEST['lname'].'",designation="'.$_REQUEST['designation'].'",experience="'.$_REQUEST['experience'].'",expertise_area="'.$_REQUEST['expertise'].'", comment="'.$_REQUEST['comment'].'";';
   
	if($id==-1){
                global $sql;
                $sql.= ', uid = "'.$_REQUEST['user'].'"';
		dbQuery('insert into '.$tp.'validator '.$sql);
		$_REQUEST['id']=dbLastInsertId();
	}
	else{
                $query = 'update '.$tp.'validator '.$sql.' where id='.$id;
//                var_dump($query);
//                die();
		dbQuery($query);
	}
	echo '<em>Validators updated</em>';
}
