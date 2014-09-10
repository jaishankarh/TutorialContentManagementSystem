<?php
$id=(int)$_REQUEST['id'];
//$groups=array();
$tp = $DBVARS['tp'];
$r=dbRow("select * from ".$tp."tutorial where id=$id");



    
        $selectedFields = $_POST['fields'];
        //var_dump($selectedFields);
        //$fields=dbAll('select * from '.$tp.'tutorial_fields order by id');
        $authors = dbAll("SELECT * FROM ".$tp."author a");
        $validators = dbAll("SELECT * FROM ".$tp."validator a");
        echo '<form action="tutorials.php?action=Save&amp;id='.$id.'" enctype="multipart/form-data" method="POST">';
        echo "<h2>Enter Data </h2>\n";
        echo "<table style='width:100%;cell-padding:5px'>\n";
        foreach($selectedFields as $sfield)
        {
            if($sfield!='COMMENTS')
            { ?>
                <tr>
                    <td><?php echo $sfield;?></td>
                    <?php 
                    if($sfield == 'AUTHOR')
                    { ?>
                        <td><select name="AUTHOR[]" size="6" multiple="multiple">
                            <?php foreach($authors as $author)
                            {
                                echo '<option value="'.$author['id'].'">'.$author['auth_fname']." ".$author['auth_lname'].'</option>';
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
                        echo '<td><div id="'.$sfield.'_add_id"><input type="file" name="'.$sfield.'[]"/></div><input class="button" type="button" id="'.$sfield.'_id" value="Add"/></td>';
                    }
                    else if($sfield == 'VALIDATOR')
                    { ?>
                        <td><select name="VALIDATOR[]" size="6" multiple="multiple">
                            <?php foreach($validators as $validator)
                            {
                                echo '<option value="'.$validator['id'].'">'.$validator['val_fname']." ".$validator['val_lname'].'</option>';
                            }
                            ?>
                            </select></td>
                    <?php }
                    else 
                    {
                        echo '<td><input type="text" name="'.$sfield.'"/></td>';
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
?>