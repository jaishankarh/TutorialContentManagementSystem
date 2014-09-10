<div class = "sidebar1">
                <div class = "innerColumn">
                    <h3>Quick Access</h3>
                    <ul>
                        <li><a href= "<?php echo '/cms.user/index.php?feature=tutorials&amp;view=all'?>">My Tutorials</a></li>
                        <li><a href= "<?php echo '/cms.user/index.php?feature=settings&amp;settings=user'?>">My Account Profile</a></li>
                        <li><a href= "<?php echo '/cms.user/index.php?feature=settings&amp;settings=author&amp;authorCreate=true'?>">My Author Profile</a></li>
                        <li><a href= "<?php echo '/cms.user/index.php?feature=tutorials&amp;create=true&amp;step=1&amp;id=-1'?>">Create a Tutorial</a></li>
                        
                        <?php 
                        $user = $_SESSION['userdata'];
                        //var_dump(isset($user['groups']['_superadmin']));
                        
                        if(isset($user['groups']['_validators']))
                        {
                            
                            echo '<li><a href="/cms.user/index.php?feature=settings&amp;settings=validator">Reviewer Profile</a></li>';
                            echo '<li><a href="/cms.user/index.php?feature=tutorials&amp;review=all">My Reviews</a></li>';
                        }
                        
                        
                        ?>
                    </ul>
                </div>
    
                <div class = "innerColumn">
                    <h3>My Recent Additions</h3>
                    <ul>
<?php
$tp = $DBVARS['tp'];
$id=(int)$_SESSION['userdata']['uid'];
$author = dbRow('SELECT * FROM '.$tp.'author a WHERE a.uid='.$id.' LIMIT 1;');
if($author==false)
{
    echo '<li>No Recent Posts</li>';
}
else
{

//$posts = dbAll('SELECT t.id,t.title FROM '.$tp.'tutorial_author a, '.$tp.'tutorial t WHERE a.tutorial_id = t.id AND a.auth_id='.$author['id'].' LIMIT 5;');
//$posts = dbAll('SELECT * FROM '.$tp.'tutorial t WHERE t.id='.$author['tutorial_id'].' ORDER BY t.ts LIMIT 5;');
    $posts= dbAll('select t.id,t.title from '.$tp.'tutorial_author a, '.$tp.'tutorial t WHERE a.tutorial_id=t.id AND a.auth_id='.$author['id'].' ORDER BY t.ts DESC LIMIT 5;');

?>
    
<?php
if(!count($posts) || !is_array($posts))
{
    echo '<li>No Recent Posts</li>';
}
else
{
    foreach($posts as $post)
    {
        echo '<li><a href="index.php?feature=tutorials&amp;view=one&amp;id='.$post['id'].'">'.$post['title'].'</a></li>';
    }

}
    
}
?>
                    </ul>
                </div>

            </div>