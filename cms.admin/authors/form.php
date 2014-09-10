<?php
$id=(int)$_REQUEST['id'];

$tp = $DBVARS['tp'];
$r=dbRow("select * from ".$tp."author where id=$id");
$users = dbAll("SELECT * FROM ".$tp."login");
if(!is_array($r) || !count($r)){
	$r=array('auth_fname'=>'','id'=>-1,'auth_lname'=>'','designation'=>'','experience'=>'','expertise_area'=>'','hobbys'=>'','uid'=>-1);
}
echo '<form action="authors.php?id='.$id.'" method="post">';
echo '<input type="hidden" name="id" value="'.$id.'" /><table>';
echo '<tr><th>User</th><td><select name="user" size="6">';
foreach($users as $user)
{
    echo '<option value="'.$user['uid'].'">'.$user['uname'].'</option>';
}
echo '</select></td></tr>';
echo '<tr><th>First Name</th><td><input type="text" name="fname" value="'.$r['auth_fname'].'" /></td></tr>';
echo '<tr><th>Last Name</th><td><input name="lname" type="text" value="'.$r['auth_lname'].'"/></td></tr>';
echo '<tr><th>Designation</th><td><textarea name="designation">'.$r['designation'].'</textarea></td></tr>';
echo '<tr><th>Experience</th><td><textarea name="experience"/>'.$r['experience'].'</textarea></td></tr>';
echo '<tr><th>Expertise</th><td><textarea name="expertise"/>'.$r['expertise_area'].'</textarea></td></tr>';
echo '<tr><th>Hobbys</th><td><textarea name="hobbys"/>'.$r['hobbys'].'</textarea></td></tr>';

echo '</table>';
echo '<input type="submit" class="button" name="action" value="Save" />';

echo '</form>';
