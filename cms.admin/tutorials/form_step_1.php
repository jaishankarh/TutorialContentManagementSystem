<?php
require_once $_SERVER['DOCUMENT_ROOT']."/cms.admin/admin_libs.php";
require_once $_SERVER['DOCUMENT_ROOT']."/cms.admin/header.php";
?>

<div class="container">
    
    <div class="left-sidemenu">
    <?php
    require_once $_SERVER['DOCUMENT_ROOT']."left-sidemenu.php";
    ?>
    </div>
    <div class="content">
        <?php
            echo '<h1>Tutorial Management</h1>';
            echo '<div class="left-menu">';
            echo '<a href="/cms.admin/tutorials.php">Tutorials</a>';
            echo '</div>';
            echo '<div class="has-left-menu">';
            $id=(int)$_REQUEST['id'];
            //$groups=array();
            $tp = $DBVARS['tp'];
            $userid = $_SESSION['userdata']['uid'];
            
            $author=dbRow("SELECT * FROM ".$tp."author a WHERE a.uid = ".$userid);
            //$tutorial=dbRow("SELECT * FROM ".$tp."tutorial_author ta WHERE ta.auth_id = ".$author['id'].' AND ta.tutorial_id = '.);
            $picCheck = dbRow("SELECT * FROM ".$tp."tutorial_multimedia m WHERE m.tutorial_id = ".$id.' AND m.type=PICTURES');
            $dataCheck = dbRow("SELECT * FROM ".$tp."tutorial_multimedia m WHERE m.tutorial_id = ".$id.' AND m.type=DATATABLE');
            
            $vidCheck = dbRow("SELECT * FROM ".$tp."tutorial_multimedia m WHERE m.tutorial_id = ".$id.' AND m.type=VIDEOS');
            
            $commentCheck = dbRow("SELECT * FROM ".$tp."comment c WHERE c.tutorial_id = ".$id.'"');
           
?>

<div>
    <h2>Select Fields for your content type</h2>
    <form action='tutorials/form_step_2.php?id='<?php echo $id;?> method='POST'>
        <table>
            <tr>
                <th>Fields</th>
                <th>&nbsp;</th>
            </tr>
            <tr>
                <td>Author</td>
                <td><input type='checkbox' readonly="true" name='fields[]' checked="true" value='AUTHOR'/></td>
            </tr>
            <tr>
                <td>Content</td>
                <td><input type='checkbox' readonly="true" name='fields[]' checked="true" value='CONTENT'/></td>
            </tr>
            <tr>
                <td>Validator</td>
                <td><input type='checkbox' readonly="true" name='fields[]' checked="true" value='VALIDATOR'/></td>
            </tr>
            <tr>
                <td>Comments</td>
                <td><input type='checkbox' name='fields[]' <?php if(is_array($commentCheck) || count($commentCheck)) echo 'checked="true"';?> value='COMMENTS'/></td>
            </tr>
            <tr>
                <td>Pictures</td>
                <td><input type='checkbox' name="fields[]" <?php if(is_array($picCheck) || count($picCheck)) echo 'checked="true"';?> value='PICTURES'/></td>
            </tr>
            <tr>
                <td>Videos</td>
                <td><input type='checkbox' name='fields[]' <?php if(is_array($vidCheck) || count($vidCheck)) echo 'checked="true"';?> value='VIDEOS'/></td>
            </tr>
            <tr>
                <td>Data Table</td>
                <td><input type='checkbox' name='fields[]' <?php if(is_array($dataCheck) || count($dataCheck)) echo 'checked="true"';?> value='DATATABLE'/></td>
            </tr>
            <tr><td colspan="2"><input class="button" type="submit"  value='Next'/></td></tr>
        </table>
    </form>
</div>

        </div>
    
     <div class="right-sidemenu">
         
     </div>
</div>
        
<?php
  require_once $_SERVER['DOCUMENT_ROOT']."/cms.admin/footer.php";
?>