<?php
$posts= dbAll('select t.id,t.title from '.$tp.'tutorial t LIMIT 15;');
?>

<div class = "sidebar2">
                <div class = "innerColumn">
                    <h4>Search By Title</h4>
                    <form action="/cms.user/index.php?feature=tutorials&amp;search=true" method="POST">
                        <input type="text" name="parameter"/>
                        <input type="submit" value="Search Tutorials" class="button [tiny small large]"/> 
                    </form>
                    
                    
                    <h5>Recent Popular Posts</h5>
                    <ul>
<?php
if(!count($posts) || !is_array($posts))
{
    echo '<li>No Recent Posts</li>';
}
else
{
    foreach($posts as $post)
    {
        echo '<li><a href="/cms.user/index.php?feature=tutorials&amp;view=one&amp;id='.$post['id'].'">'.$post['title'].'</a></li>';
    }

}
?>    
                    </ul>
                    <div>
                        <h4 class="chatUserHeader">Active Users</h4>
<?php
    $tp = $DBVARS['tp'];
    $query = 'SELECT * FROM '.$tp.'login WHERE logged_in=1';
    $users_logged_in = dbAll($query);
    foreach($users_logged_in as $u)
    { ?>
        <ul>
            <li><a class="chatUsers" class="button [tiny small large]" data-user2='<?php echo $u['uid'];?>' data-user2name='<?php echo $u['uname'];?>'><?php echo $u['uname'];?></a></li>
                
        </ul>
    <?php }
?>
                    </div>
                    
                </div>
                    
            </div>
