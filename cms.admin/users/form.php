<?php
$id=(int)$_REQUEST['id'];
$groups=array();
$tp = $DBVARS['tp'];
$r=dbRow("select * from ".$tp."login where uid=$id");
if(!is_array($r) || !count($r)){
	$r=array('uname'=>'','id'=>-1,'email'=>'','active'=>0,'groups'=>'');
}
echo '<form action="users.php?id='.$id.'" method="post">';
echo '<input type="hidden" name="id" value="'.$id.'" /><table>';
echo '<tr><th>Username</th><td><input type="text" name="username" value="'.$r['uname'].'" /></td></tr>';
echo '<tr><th>Email</th><td><input type="text" name="email" value="'.htmlspecialchars($r['email']).'" /></td></tr>';
echo '<tr><th>Password</th><td><input name="password" type="password" /></td></tr>';
echo '<tr><th>(repeat)</th><td><input name="password2" type="password" /></td></tr>';
echo '<tr><th>Groups</th><td class="groups">';
$grs=dbAll('select id,rname from '.$tp.'role');
$gms=array();
foreach($grs as $g){
	$groups[$g['id']]=$g['rname'];
}
$gms=json_decode($r['groups']);
if(is_null($gms))
{
    $gms=array("_users");
}
foreach($groups as $k=>$g){
	echo '<input type="checkbox" name="roles['.$k.']"';
	if(in_array($g,$gms))
            echo ' checked="checked"';
	echo ' />'.htmlspecialchars($g).'<br />';
}
echo '</td></tr>';
// }
echo '<tr><th>Active</th><td><select name="active"><option value="0">No</option><option value="1"'.($r['active']?' selected="selected"':'').'>Yes</option></select></td></tr>';
echo '</table>';
echo '<input type="submit" class="button" name="action" value="Save" />';

echo '</form>';
