<?php
$id=(int)$_REQUEST['id'];

$tp = $DBVARS['tp'];
$r=dbRow("select * from ".$tp."validator where id=$id");
$users = dbAll("SELECT * FROM ".$tp."login");
if(!is_array($r) || !count($r)){
	$r=array('val_fname'=>'','id'=>-1,'val_lname'=>'','designation'=>'','experience'=>'','expertise_area'=>'','comment'=>'','uid'=>-1);
}
echo '<form action="validators.php?id='.$id.'" method="post">';
echo '<input type="hidden" name="id" value="'.$id.'" /><table>';
echo '<tr><th>User</th><td><select name="user" size="6">';
foreach($users as $user)
{
    echo '<option value="'.$user['uid'].'">'.$user['uname'].'</option>';
}
echo '</select></td></tr>';
echo '<tr><th>First Name</th><td><input type="text" name="fname" value="'.$r['val_fname'].'" /></td></tr>';
echo '<tr><th>Last Name</th><td><input name="lname" type="text" value="'.$r['val_lname'].'"/></td></tr>';
echo '<tr><th>Designation</th><td><textarea name="designation">'.$r['designation'].'</textarea></td></tr>';
echo '<tr><th>Experience</th><td><textarea name="experience"/>'.$r['experience'].'</textarea></td></tr>';
echo '<tr><th>Expertise</th><td><textarea name="expertise"/>'.$r['expertise_area'].'</textarea></td></tr>';


echo '</table>';
echo '<input type="submit" class="button" name="action" value="Save" />';

echo '</form>';
