 <?php
$tp = $DBVARS['tp'];
$validators=dbAll('select * from '.$DBVARS['tp'].'validator order by val_fname');
echo '<table style="min-width:50%">
<tr><th>First Name</th><th>Last Name</th><th>User</th><th>Designation</th><th>Experience</th><th>Expertise Area</th> </tr>';
foreach($validators as $validator)
{
    $user = dbRow("SELECT l.uname FROM ".$tp."login l,".$tp."validator v WHERE l.uid=v.uid AND v.id=".$validator['id']);
    
    echo '<tr><th><a href="validators.php?id='.$validator['id'].'">'.$validator['val_fname'].'</a></th>';
    echo '<th><a href="validators.php?id='.$validator['id'].'">'.$validator['val_lname'].'</a></th>';
    echo '<th><a href="validators.php?id='.$validator['id'].'">'.$user['uname'].'</a></th>';
    echo '<th><a href="validators.php?id='.$validator['id'].'">'.$validator['designation'].'</a></th>';
    echo '<th><a href="validators.php?id='.$validator['id'].'">'.$validator['experience'].'</a></th>';
    echo '<th><a href="validators.php?id='.$validator['id'].'">'.$validator['expertise_area'].'</a></th>';

    echo '<td><a href="validators.php?id='.$validator['id'].'">edit</a>';
    echo '&nbsp;<a href="validators.php?id='.$validator['id'].'&amp;action=delete" onclick="return confirm(\'are you sure you want to delete this validator?\');">[x]</a></td></tr>';
}
echo '</table>';
echo '<a class="button" href="validators.php?id=-1">
Create Validator</a>';

