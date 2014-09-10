<?php
$tp=$DBVARS['tp'];
$user = $_SESSION['userdata'];


   if(isset($_GET['edit'])&&isset($_GET['id']))
        {
  
            $id = $_GET['id'];
            $picCheck = dbAll("SELECT * FROM ".$tp."tutorial_multimedia m WHERE m.tutorial_id = ".$id.' AND m.type="PICTURES";');
            $dataCheck = dbAll("SELECT * FROM ".$tp."tutorial_multimedia m WHERE m.tutorial_id = ".$id.' AND m.type="DATATABLE";');
            
            $vidCheck = dbAll("SELECT * FROM ".$tp."tutorial_multimedia m WHERE m.tutorial_id = ".$id.' AND m.type="VIDEOS";');
            
            $commentCheck = dbAll("SELECT * FROM ".$tp."comment c WHERE c.tutorial_id = ".$id.";");
            //var_dump($id);
            $selectedFields = $_POST['fields'];
            $authors = dbAll("SELECT * FROM ".$tp."author a");
            $validators = dbAll("SELECT * FROM ".$tp."validator a");
            $authorsel= dbAll('SELECT a.* FROM '.$tp.'tutorial_author ta, '.$tp.'author a WHERE ta.auth_id = a.id AND ta.tutorial_id='.$id.';');
            $validatorsel=  dbAll('SELECT v.*,tv.isValidated,tv.comment FROM '.$tp.'tutorial_validator tv, '.$tp.'validator v WHERE tv.tutorial_id='.$id.';');
            $post=  dbRow('SELECT * FROM '.$tp.'tutorial ta WHERE ta.id='.$id.';');
            $pics=  dbAll('SELECT * FROM '.$tp.'tutorial_multimedia tm WHERE tm.tutorial_id='.$id.' AND type="PICTURES";');
            $vids=  dbAll('SELECT * FROM '.$tp.'tutorial_multimedia tm WHERE tm.tutorial_id='.$id.' AND type="VIDEOS";');
            $datatable=  dbOne('SELECT * FROM '.$tp.'tutorial_multimedia tm WHERE tm.tutorial_id='.$id.' AND type="DATATABLE";','value');
            $comments = dbAll('SELECT * FROM '.$tp.'comment c WHERE c.tutorial_id='.$id.';');
            //var_dump($authors);
            //die();
            if(count($picCheck)!=0)
            {
                if(!in_array('PICTURES',$selectedFields))
                {
                    dbQuery("DELETE FROM ".$tp."tutorial_multimedia m WHERE m.tutorial_id = ".$id.' AND m.type="PICTURES";');
                }
            }
            if(count($vidCheck)!=0)
            {
                if(!in_array('VIDEOS',$selectedFields))
                {
                    dbQuery("DELETE FROM ".$tp."tutorial_multimedia m WHERE m.tutorial_id = ".$id.' AND m.type="VIDEOS";');
                }
            }
            if(count($dataCheck)!=0)
            {
                if(!in_array('DATATABLE',$selectedFields))
                {
                    dbQuery("DELETE FROM ".$tp."tutorial_multimedia m WHERE m.tutorial_id = ".$id.' AND m.type="DATATABLE";');
                }
            }
            if(count($commentCheck)!=0)
            {
//                var_dump($selectedFields);
//                die();
                if(!in_array('COMMENTS',$selectedFields))
                {
                    dbQuery("DELETE FROM ".$tp."tutorial_multimedia m WHERE m.tutorial_id = ".$id.' AND m.type="COMMENTS";');
                }
            }
            
        
        echo '<h2>'.$post['title'].'</h2>';
        echo '<form action="/cms.user/index.php?feature=tutorials&amp;action=Save&amp;id='.$id.'" enctype="multipart/form-data" method="POST">';
        echo '<table style="width:100%">';
        foreach($selectedFields as $sfield)
        {
            if($sfield!='COMMENTS')
            { ?>
                <tr>
                    <td><?php echo $sfield; ?></td>
                    <?php 
                    if($sfield == 'AUTHOR')
                    { ?>
                    <td><select name="AUTHOR[]" size="3" multiple="multiple" required="true">
                            <?php foreach($authors as $author)
                            {
                                $selected = "false";
                                if(in_array($author, $authorsel))
                                {
                                    global $selected;
                                   $selected = "true";
                                }
                                echo '<option value="'.$author['id'].'" selected="'.$selected.'">'.$author['auth_fname']." ".$author['auth_lname'].'</option>';
                            }
                            ?>
                            </select></td>

                    
                    
                    <?php }
                    else if($sfield=='CONTENT')
                    { 
                       
                        echo '<td><textarea name="'.$sfield.'" style="height:20rem" >'.$post['content'].'</textarea></td>';
                    }
                    else if($sfield=='DATATABLE')
                    {
                        echo '<td><textarea name="'.$sfield.'" style="height:20rem" >'.$datatable.'</textarea></td>';
                    }
                    else if($sfield=='PICTURES' || $sfield=='VIDEOS')
                    {   echo '<tr><td>MARK FOR DELETE</td><td></td>';
                        foreach($pics as $pic)
                        {

                            echo '<tr><td><input type="checkbox" value="'.$pic['id'].'" name="picDel" /></td><td><img src="/cms.multimedia/pictures/'.$pic['value'].'" alt=" " width="200" height="200"/></td>'
                                .'</tr>';

                        }
                        echo '<td><div id="'.$sfield.'_add_id"></div><input class="button" type="button" id="'.$sfield.'_id" value="Add"/></td>';
                    }
                    else if($sfield == 'VALIDATOR')
                    { ?>
                            <td><select name="VALIDATOR[]" size="3" multiple="multiple" required="true">
                            <?php foreach($validators as $validator)
                            {
                                $selected = "false";
                                if(in_array($validator, $validatorsel))
                                {
                                    global $selected;
                                   $selected = "true";
                                }
                                echo '<option value="'.$validator['id'].'" selected="'.$selected.'">'.$validator['val_fname']." ".$validator['val_lname'].'</option>';
                            }
                            ?>
                            </select></td>
                    <?php }
                    else if($sfield=='TITLE')
                    {
//     var_dump($post['title']);
//     die();
                        echo '<td><input type="text" name="'.$sfield.'" value="'.$post['title'].'"/></td>';
                    }
                    ?>
                </tr>
            
        <?php 
                    }
              }
    
    echo '</table>';
?>
                <script>
                    $(document).ready(function(){
                        $('#PICTURES_id').click(function() {
                        var selectObj = $(this);
                        var targetDiv = $("#PICTURES_add_id");
                        targetDiv.append($("<input type='file' name='PICTURES[]'/>"));
                    });
                    $('#VIDEOS_id').click(function() {
                        var selectObj = $(this);
                        var targetDiv = $("#VIDEOS_add_id");
                        targetDiv.append($("<input type='file' name='VIDEOS[]'/>"));
                    });
                });
                </script>
<?php
echo '<input type="submit" class="button" name="action" value="Save" />';

echo '</form>';

if($comments!=FALSE)
{    


?>
<!--                </div>-->
<!--</article>-->
        
        
        
        
        
         
    
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
        
        }
         