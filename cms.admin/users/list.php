 <?php
$users=dbAll('select * from '.$DBVARS['tp'].'login order by email');
echo '<table style="min-width:50%">
<tr><th>User</th><th>Email</th><th>Groups</th><th>Actions</th></tr>';
foreach($users as $user)
{
    echo '<tr><th><a href="users.php?id='.$user['uid'].'">'.$user['uname'].'</a></th>';
    echo '<th><a href="users.php?id='.$user['uid'].'">'.htmlspecialchars($user['email']).'</a></th>';
    echo '<td>'.join(', ',json_decode($user['groups'])).'</td>';
    echo '<td><a href="users.php?id='.$user['uid'].'">edit</a>';
    echo '&nbsp;<a href="users.php?id='.$user['uid'].'&amp;action=delete" onclick="return confirm(\'are you sure you want to delete this user?\');">[x]</a></td></tr>';
}
echo '</table>';
echo '<a class="button" href="users.php?id=-1">
Create User</a>';

