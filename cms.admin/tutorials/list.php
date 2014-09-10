<?php
//to be changed.....................................
function boolConvert($var)
{
    if($var == 0)
    {return "False";}
    return "True";
    
}
 $tp = $DBVARS['tp'];
$tutorials=dbAll('select * from '.$DBVARS['tp'].'tutorial order by id');
echo '<table style="width:100%">
<tr><th>Id</th><th>Posted By</th><th>Title</th><th>Validated</th></tr>';
foreach($tutorials as $tutorial)
{
    $uname = dbRow('SELECT l.uname FROM '.$tp.'tutorial t,'.$tp.'login l WHERE t.postedBy=l.uid;');
    echo '<tr><th><a href="tutorials.php?id='.$tutorial['id'].'">'.$tutorial['id'].'</a></th>';
    echo '<th><a href="tutorials.php?id='.$tutorial['id'].'">'.$uname['uname'].'</a></th>';
    echo '<th><a href="tutorials.php?id='.$tutorial['id'].'">'.$tutorial['title'].'</a></th>';
    echo '<th><a href="tutorials.php?id='.$tutorial['id'].'">'.boolConvert($tutorial['isValidated']).'</a></th>';
    echo '<td><a href="tutorials.php?id='.$tutorial['id'].'">edit</a>';
    echo '&nbsp;<a href="tutorials.php?id='.$tutorial['id'].'&amp;action=delete" onclick="return confirm(\'are you sure you want to delete this tutorial?\')">[x]</a></td></tr>';
}
echo '</table>';
echo '<a class="button" href="tutorials.php?step=1&amp;id=-1">
Create Tutorial</a>';

