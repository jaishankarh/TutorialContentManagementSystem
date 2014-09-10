<?php

            $id=(int)$_REQUEST['id'];
            //$groups=array();
            $tp = $DBVARS['tp'];
            $userid = $_SESSION['userdata']['uid'];
            
            $author=dbRow("SELECT * FROM ".$tp."author a WHERE a.uid = ".$userid.";");
            if($author==false)
            {
                echo '<h2> Please first update your author details before proceeding!!</h2>';
                echo '<a class="button" href="/cms.user/index.php?feature=settings&amp;settings=author&amp;authorCreate=true"/>Click here to update your profile</a>';
                
            }
            else 
            {
            
            //$tutorial=dbRow("SELECT * FROM ".$tp."tutorial_author ta WHERE ta.auth_id = ".$author['id'].' AND ta.tutorial_id = '.);
            $picCheck = dbRow("SELECT * FROM ".$tp."tutorial_multimedia m WHERE m.tutorial_id = ".$id.' AND m.type="PICTURES";');
            $dataCheck = dbRow("SELECT * FROM ".$tp."tutorial_multimedia m WHERE m.tutorial_id = ".$id.' AND m.type="DATATABLE";');
            
            $vidCheck = dbRow("SELECT * FROM ".$tp."tutorial_multimedia m WHERE m.tutorial_id = ".$id.' AND m.type="VIDEOS";');
            
            $commentCheck = dbRow("SELECT * FROM ".$tp."comment c WHERE c.tutorial_id = ".$id.";");
//            $_SESSION['picCheck']=$picCheck;
//            $_SESSION['dataCheck']=$dataCheck;
//            $_SESSION['vidCheck']=$vidCheck;
//            $_SESSION['commentCheck']=$commentCheck;
           
?>

<!--<article class = "main">
                <div class = "innerColumn">-->
    <h2>Select Fields for your content type</h2>
    <?php if(isset($_REQUEST['edit']))
            {
                echo "<form  action='/cms.user/index.php?feature=tutorials&amp;edit=true&amp;id=".$id."&amp;step=2' method='POST'>";
            }
            else {
                echo "<form  action='/cms.user/index.php?feature=tutorials&amp;create=true&amp;id=".$id."&amp;step=2' method='POST'>";
            }
    ?>
        <table style="width:100%;">
            <tr>
                <th>Fields</th>
                <th>&nbsp;</th>
            </tr>
            <tr>
                <td>Title *</td>
                <td><input type='checkbox' readonly="true" name='fields[]' checked="true" value='TITLE'/></td>
                <td>Comments</td>
                <td><input type='checkbox' name='fields[]' <?php if($commentCheck!=false) echo 'checked="true"';?> value='COMMENTS'/></td>
            </tr>
            <tr>
                <td>Author *</td>
                <td><input type='checkbox' readonly="true" name='fields[]' checked="true" value='AUTHOR'/></td>
                <td>Pictures</td>
                <td><input type='checkbox' name="fields[]" <?php if($picCheck!=false) echo 'checked="true"';?> value='PICTURES'/></td>
            </tr>
            <tr>
                <td>Content *</td>
                <td><input type='checkbox' readonly="true" name='fields[]' checked="true" value='CONTENT'/></td>
                <td>Videos</td>
                <td><input type='checkbox' name='fields[]' <?php if($vidCheck!=false) echo 'checked="true"';?> value='VIDEOS'/></td>
            </tr>
            <tr>
                <td>Validator *</td>
                <td><input type='checkbox' readonly="true" name='fields[]' checked="true" value='VALIDATOR'/></td>
                <td>Data Table</td>
                <td><input type='checkbox' name='fields[]' <?php if($dataCheck!=false) echo 'checked="true"';?> value='DATATABLE'/></td>
            </tr>
            
            <tr>
                
            </tr>
            <tr>
                <td>* Required Fields</td>
            </tr>
            <tr><td colspan="4"><input class="button" type="submit"  value='Next'/></td></tr>
        </table>
    </form>
            <?php
            
            
            }  //for the else on top 
            
            ?>
<!--                </div>
</article>-->

        