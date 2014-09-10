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
 //$author = dbRow('SELECT * from '.$tp.'author a WHERE a.uid='.$user['uid'].';');
 $tutorials=array();
 
     global $tutorials;
     if(isset($_GET['search']))
     {
         $query='SELECT t.* FROM '.$tp.'tutorial t, WHERE t.title LIKE "%'.$_POST['parameter'].'%";';
//     var_dump($query);
//     die();
    $tutorials=dbAll('SELECT * FROM '.$tp.'tutorial t WHERE t.title LIKE "%'.$_POST['parameter'].'%";');
     }


?>

<!-- <article class = "main">
                <div class = "innerColumn">-->
<?php

echo '<table style="width:100%">
<tr><th>Id</th><th>Posted By</th><th>Title</th></tr>';

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
    echo '<th><a href="/cms.user/index.php?feature=tutorials&amp;view=one&amp;id='.$tutorial['id'].'">'.$tutorial['title'].'</a></th></tr>';
   
}
echo '</table>';
}
echo '<a class="button" href="/cms.user/index.php?feature=tutorials&amp;create=true&amp;step=1&amp;id=-1">Create Tutorial</a>';
?>
<!-- </div>
            </article>-->
