 <?php
$tp = $DBVARS['tp'];
$authors=dbAll('select * from '.$DBVARS['tp'].'author order by auth_fname');
echo '<table style="min-width:50%">
<tr><th>First Name</th><th>Last Name</th><th>User</th><th>Designation</th><th>Experience</th><th>Expertise Area</th> <th>Hobbys</th></tr>';
foreach($authors as $author)
{
    $user = dbRow("SELECT l.uname FROM ".$tp."login l,".$tp."author a WHERE l.uid=a.uid ");
    
    echo '<tr><th><a href="authors.php?id='.$author['id'].'">'.$author['auth_fname'].'</a></th>';
    echo '<th><a href="authors.php?id='.$author['id'].'">'.$author['auth_lname'].'</a></th>';
    echo '<th><a href="authors.php?id='.$author['id'].'">'.$user['uname'].'</a></th>';
    echo '<th><a href="authors.php?id='.$author['id'].'">'.$author['designation'].'</a></th>';
    echo '<th><a href="authors.php?id='.$author['id'].'">'.$author['experience'].'</a></th>';
    echo '<th><a href="authors.php?id='.$author['id'].'">'.$author['expertise_area'].'</a></th>';
    echo '<th><a href="authors.php?id='.$author['id'].'">'.$author['hobbys'].'</a></th>';
    echo '<td><a href="authors.php?id='.$author['id'].'">edit</a>';
    echo '&nbsp;<a href="authors.php?id='.$author['id'].'&amp;action=delete" onclick="return confirm(\'are you sure you want to delete this author?\');">[x]</a></td></tr>';
}
echo '</table>';
echo '<a class="button" href="authors.php?id=-1">
Create Author</a>';

