<?php
//to be changed.....................................
function boolConvert($var)
{
    if($var == 0)
    {return "False";}
    return "True";
    
}
 $tp = $DBVARS['tp'];
 $user = $_SESSION['userdata'];
 $author = dbRow('SELECT * from '.$tp.'author a WHERE a.uid='.$user['uid'].';');
 $tutorials=array();
 if($author!=false)
{
     global $tutorials;
    $tutorials=dbAll('SELECT t.* FROM '.$tp.'tutorial t, '.$tp.'tutorial_author ta WHERE t.id=ta.tutorial_id AND ta.auth_id='.$author['id'].';');
}

?>

<!-- <article class = "main">
                <div class = "innerColumn">-->
<?php
echo '<h1> My Tutorials</h1>';
echo '<table style="width:100%">
<tr><th>Id</th><th>Posted By</th><th>Title</th><th>Validated</th></tr>';

if(count($tutorials)==0)
{
    echo '<tr><th colspan="4">No Records Found</th></tr>';
    echo '</table>';
}
else
{
foreach($tutorials as $tutorial)
{
    
    echo '<tr><th><a href="/cms.user/index.php?feature=tutorials&amp;view=one&amp;id='.$tutorial['id'].'">'.$tutorial['id'].'</a></th>';
    echo '<th><a href="/cms.user/index.php?feature=tutorials&amp;view=one&amp;id='.$tutorial['id'].'">'.$user['uname'].'</a></th>';
    echo '<th><a href="/cms.user/index.php?feature=tutorials&amp;view=one&amp;id='.$tutorial['id'].'">'.$tutorial['title'].'</a></th>';
//    echo '<th><a href="/cms.user/index.php?feature=tutorials&amp;view=one&amp;id='.$tutorial['id'].'">'.boolConvert($tutorial['isValidated']).'</a></th>';
    echo '<td><a href="/cms.user/index.php?feature=tutorials&amp;edit=true;&amp;step=1;&amp;id='.$tutorial['id'].'">edit</a>';
    echo '&nbsp;<a href="/cms.user/index.php?feature=tutorials&amp;view=one&amp;id='.$tutorial['id'].'&amp;action=delete" onclick="return confirm(\'are you sure you want to delete this tutorial?\')">[x]</a></td></tr>';
}
echo '</table>';
}
echo '<a class="button" href="/cms.user/index.php?feature=tutorials&amp;create=true&amp;step=1&amp;id=-1">Create Tutorial</a>';
?>
<!-- </div>
            </article>-->
