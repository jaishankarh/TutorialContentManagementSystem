<?php
$tp=$DBVARS['tp'];
$user = $_SESSION['userdata'];


?>
            
<?php   if(isset($_GET['view'])&&isset($_GET['id']))
        {
    ?>
<!--        <article class = "main">
                <div class = "innerColumn">
                    <h2>Welcome <?php echo $user['uname'];?></h2>-->
<?php
            $id = $_GET['id'];
            //var_dump($id);
            $authors= dbAll('SELECT a.* FROM '.$tp.'tutorial_author ta, '.$tp.'author a WHERE ta.auth_id = a.id AND ta.tutorial_id='.$id.';');
            $validators=  dbAll('SELECT v.*,tv.isValidated,tv.comment FROM '.$tp.'tutorial_validator tv, '.$tp.'validator v WHERE tv.tutorial_id='.$id.';');
            $post=  dbRow('SELECT * FROM '.$tp.'tutorial ta WHERE ta.id='.$id.';');
            $pics=  dbAll('SELECT * FROM '.$tp.'tutorial_multimedia tm WHERE tm.tutorial_id='.$id.' AND type="PICTURES";');
            $vids=  dbAll('SELECT * FROM '.$tp.'tutorial_multimedia tm WHERE tm.tutorial_id='.$id.' AND type="VIDEOS";');
            $datatable=  dbOne('SELECT * FROM '.$tp.'tutorial_multimedia tm WHERE tm.tutorial_id='.$id.' AND type="DATATABLE";','value');
            $comments = dbAll('SELECT * FROM '.$tp.'comment c WHERE c.tutorial_id='.$id.';');
            //var_dump($authors);
            //die();
        
        echo '<h2>'.$post['title'].'</h2>';
        echo '<table style="width:100%">';
        echo '<tr><th>Author(s)</th><td><ul>';
        foreach($authors as $author)
        {
            
            echo '<li>'.$author['auth_fname'].' '.$author['auth_lname'].'</li>';
        }
        echo '</ul></td></tr>';
        $valid=false;
        foreach($validators as $validator)
        {
            //the isvalidated field comes because of the query run on top isValidated field does not belong to the validator table
            if($validator['isValidated']==1)
            {
//                var_dump($validator);
//                die();
                $valid = true;
                echo '<tr><th>Reviewed by(s)</th><td><ul>';
                echo '<li>Name: '.$validator['val_fname'].' '.$validator['val_lname'].'</li>';
                echo '<li>Designation: '.$validator['designation'].'</li>';
                echo '<li>Experience: '.$validator['experience'].'</li>';
                echo '<li>Expertise: '.$validator['expertise_area'].'</li>';
                //the comment field comes because of the query run on top comment field does not belong to the validator table
                echo '<li>Remark: '.$validator['comment'].'</li>';
            }
//                echo '<li>Remark:'.$validator['comment'].'</li>';
        }
            echo '</ul></td></tr>';
        
        if(!$valid)
        {
            echo '<tr><th colspan="2">View Content at Your Own Risk. Content not yet reviewed!</th></tr>';
        }
        
        echo '<tr><th colspan="2"><h3>Description</h3></th></tr>';
        echo '<tr><td colspan="2"><div class="tut_content">'.$post['content'].'</div></td></tr>';
        if($pics!=false)
        {
            echo '<tr><h6><th colspan="2">Images</th></h6></tr>';
            foreach($pics as $pic)
            {

                echo '<tr><td><img src="/cms.multimedia/pictures/'.$pic['value'].'" alt=" " width="200" height="200"/></td>'
                        . '<td><img alt=" " src="/cms.multimedia/pictures/'.$pic["value"].'"/></td></tr>';

            }
        }
        if($vids!=false)
        {
            echo '<tr><h6><th colspan="2">Images</th></h6></tr>';
            foreach($vids as $vid)
            {?>

    <tr><td colspan="2"><video  style="width:100%" controls>
                        <source src="/cms.multimedia/videos/<?php echo $vid['value'];?>" type="video/mp4">

                       Your browser does not support the video tag.
            </video></td></tr> 
    <?php            
            }
        }
        echo '</table>';
        if($datatable!=false)
        {
            echo '<h4>Some more info: </h4>';
            echo $datatable;
        }
        
        if(isset($_GET['review'])&&$_GET['review']="one")
        {
            echo '<form action="/cms.user/index.php?feature=tutorials&amp;action=validateTutorial&amp;id='.$_GET['id'].'&amp;vid='.$user['uid'].'" method="POST">';
            echo '<textarea name="comment"></textarea>';
            echo '<input class="button" type="submit" value="Validate"/>';
            echo '</form>';
        }
        ?>
<style>
    .commentContainer {
        margin-top: 20px;
        padding: 5px;
    }
    .commentuserinfo{
        padding: 5px;
    }
</style>
<?php
        echo '<h4>Comments </h4>';
        foreach($comments as $comment)
        {
            echo '<div class="commentContainer">';
            echo '<div class="comment">';
            echo '<textarea readonly="true" rows="4" cols="50">'.$comment['content'].'</textarea>';
            echo '</div>';
            $commentUser = dbRow('SELECT l.* FROM '.$tp.'comment c, '.$tp.'login l WHERE c.uid=l.uid;');
            echo '<div class="commentuserinfo">'.$commentUser['uname']." ".$comment['ts'].'</div>';
            echo '</div>';
            
        }
        echo '<div class="commentContainer">';
        echo '<div class="comment">';
        echo '<form action="/cms.user/index.php?feature=tutorials&amp;action=CommentAdd" method="POST">';
        echo '<input type="hidden" name="uid" value="'.$user['uid'].'"/>';
        echo '<input type="hidden" name="tid" value="'.$id.'"/>';
        echo '<textarea style="height:9rem" rows="10" cols="50" name="content"></textarea>';
        
        echo '<div><input type="submit" class="button" value="Submit Comment"/></div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
       // echo '</div></article>';
        }
        else
        {
?>
<!--                    <article class = "main">
                <div class = "innerColumn">
                    <h2>Welcome <?php echo $user['uname'];?></h2>
                    <p>Please choose an option on the left to continue...</p>
                </div>
            </article>-->

        <?php } ?>
