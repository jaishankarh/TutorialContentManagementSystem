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
$r=dbRow("select * from ".$tp."tutorial where id=$id");



    
        $selectedFields = $_POST['fields'];
        //var_dump($selectedFields);
        //$fields=dbAll('select * from '.$tp.'tutorial_fields order by id');
        $authors = dbAll("SELECT * FROM ".$tp."author a");
        echo '<form action="tutorials/actions.php?id="'.$id.'" >';
        echo "<h2>Enter Data </h2>\n";
        echo "<table>\n";
        foreach($selectedFields as $sfield)
        { ?>
                <tr>
                    <td><?php echo $sfield;?></td>
                    <?php 
                    if($sfield == 'AUTHOR')
                    { ?>
                        <td><select name="AUTHOR[]" size="6" multiple="multiple">
                            <?php foreach($authors as $author)
                            {
                                echo '<option value="'.$author['id'].'">'.$author['fname']." ".$author['lname'].'</option>';
                            }
                            ?>
                            </select></td>

                    
                    
                    <?php }
                    else if($sfield=='CONTENT' || $sfield=='DATATABLE')
                    { 
                        echo '<td><textarea name="'.$sfield.'" rows="20" cols="50" ></textarea></td>';
                    }
                    else if($sfield=='PICTURES' || $sfield=='VIDEOS')
                    {
                        echo '<td><input type="file" name="'.$sfield.'"/></td>';
                    }
                    else
                    {
                        echo '<td><input type="text" name="'.$sfield.'"/></td>';
                    }
                    ?>
                </tr>
            
        <?php }
    
    echo '</table>';
?>

<?php
echo '<input type="submit" class="button" name="action" value="Save" />';

echo '</form>';
?>
                </div>
    
     <div class="right-sidemenu">
         
     </div>
</div>
<?php
require_once $_SERVER['DOCUMENT_ROOT']."/cms.admin/footer.php";
?>

