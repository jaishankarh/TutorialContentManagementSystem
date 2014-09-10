<?php

function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}


if(isset($_SESSION['userdata']))
    $user=$_SESSION['userdata'];
if(isset($_REQUEST['id']))
    $id=(int)$_REQUEST['id'];
$tp=$DBVARS['tp'];
if($_REQUEST['action']=='delete'){
	dbQuery('delete from '.$tp.'tutorial where id='.$id);
	unset($_REQUEST['id']);
}
$dbTutId=0;
if($_REQUEST['action']=='Save'){
	global $dbTutId;
        if(isset($_REQUEST['picDel']))
        {
            
        }
	$sql='set title="'.$_REQUEST['TITLE'].'", content="'.$_REQUEST['CONTENT'].'",postedBy='.$user['uid'].';';
	
	if($id==-1)
        {
                //save to the main tutorial table
		dbQuery('insert into '.$tp.'tutorial '.$sql);
        }
        else
        {
            dbQuery('UPDATE '.$tp.'tutorial '.$sql);
        }
                global $dbTutId;
                $dbTutId = dbLastInsertId();
                //save the pics and videos
                //var_dump($_FILES['PICTURES']);
                if(isset($_FILES['PICTURES']))
                {
                    $pictures = reArrayFiles($_FILES['PICTURES']);
                    
                    //die();
                    foreach($pictures as $pic)
                    {
                         //var_dump($value[]);
                        $baseFileName = $user['uid'].'-'.$dbTutId.basename($pic['name']);
                        //save to the main tutorial_multimedia table
                        $sql1 = 'set tutorial_id="'.$dbTutId.'", type="PICTURES", value="'.$baseFileName.'";';
                        if($id==-1)
                        {
                            dbQuery('insert into '.$tp.'tutorial_multimedia '.$sql1);
                        }
                        
                        //move uploaded files to its location..
                        if($pic['error'] == UPLOAD_ERR_OK)
                        {
                            $uploadFile = MEDIABASE.'pictures/'.$baseFileName;
                            if(!(move_uploaded_file($pic['tmp_name'], $uploadFile)))
                            {
                                var_dump($pic['tmp_name']);
                                die("ERROR MVOE not uploaded");
                                //$errors['photo']="Problem Occured while moving the file ".$_FILES['photo']['name'];
                            }
                        }
                        else 
                        {
                            if($_FILES[$pic]['error'] == UPLOAD_ERR_NO_FILE )
                            {
                                //$errors['photo']="No file was uploaded. Please upload a file";
                            }
                            if($_FILES[$pic]['error'] == UPLOAD_ERR_INI_SIZE || UPLOAD_ERR_FORM_SIZE)
                            {
                                //$errors['photo']=$_FILES['photo']['name']." is too big a file. Please upload a smaller file.";
                            }
                            else
                            {
                                //$errors['photo']="Sorry Internal Server error has occured!";	
                            }
					
                        }
                    
                        }
                }
                if(isset($_FILES['VIDEOS']))
                {
                    
                    
                    $videos = reArrayFiles($_FILES['VIDEOS']);
                    foreach($videos as $video)
                    {
                        $baseFileName = $user['uid'].'-'.$dbTutId.basename($video['name']);
                        //save to the main tutorial_multimedia table
                        $sql1 = 'set tutorial_id="'.$dbTutId.'", type="VIDEOS", value="'.$baseFileName.'";';
                        if($id == -1)
                        {
                            dbQuery('insert into '.$tp.'tutorial_multimedia '.$sql1);
                        }
                        
                        
                        //move uploaded files to its location..
                        if($video['error'] == UPLOAD_ERR_OK)
                        {
                            $uploadFile = MEDIABASE.'videos/'.$baseFileName;
                            if(!(move_uploaded_file($video['tmp_name'], $uploadFile)))
                            {
                                //$errors['photo']="Problem Occured while moving the file ".$_FILES['photo']['name'];
                            }
                        }
                        else 
                        {
                            if($video['error'] == UPLOAD_ERR_NO_FILE )
                            {
                                //$errors['photo']="No file was uploaded. Please upload a file";
                            }
                            if($video['error'] == UPLOAD_ERR_INI_SIZE || UPLOAD_ERR_FORM_SIZE)
                            {
                                //$errors['photo']=$_FILES['photo']['name']." is too big a file. Please upload a smaller file.";
                            }
                            else
                            {
                                //$errors['photo']="Sorry Internal Server error has occured!";	
                            }
					
                        }
                    
                        }
                }
                                
                if(isset($_REQUEST['DATATABLE']))
                {
                    
                    
                        //save to the main tutorial_multimedia table
                        
                        if($id == -1)
                        {
                            $sql1 = 'set tutorial_id="'.$dbTutId.'", type="DATATABLE", value="'.$_REQUEST['DATATABLE'].'";';
                            dbQuery('insert into '.$tp.'tutorial_multimedia '.$sql1);
                        }
                        else
                        {
                            $sql1 = 'set value="'.$_REQUEST['DATATABLE'].'";';
                            dbQuery('UPDATE '.$tp.'tutorial_multimedia '.$sql1.' WHERE tutorial_id="'.$dbTutId.'" AND type="DATATABLE";');
                        }
                        
                        
                    
                }
                //update the author and validator tables
                $authors = $_POST['AUTHOR'];
                foreach($authors as $author)
                {
                    $sql1 = 'set tutorial_id="'.$dbTutId.'", auth_id='.$author.', isValidated=0;';
                    
                    
                    if($id==-1)
                    {
                        dbQuery('INSERT INTO '.$tp.'tutorial_author '.$sql1);
                    }
//                    else
//                    {
//                        $sql1 = 'set tutorial_id='.$dbTutId.', auth_id='.$author.', isValidated=0';
//                        $query = 'UPDATE '.$tp.'tutorial_author '.$sql1.' WHERE tutorial_id='.$dbTutId.' AND auth_id='.$author; 
//                        var_dump($query);
//                        die();
//                        dbQuery($query);
//                    }
                        
                    
                }
                $validators = $_POST['VALIDATOR'];
                foreach($validators as $validator)
                {
                    
                    $sql1 = 'set isValidated=0, tutorial_id="'.$dbTutId.'", validator_id='.$validator.';';
                    if($id == -1)
                    {
                        dbQuery('INSERT INTO '.$tp.'tutorial_validator '.$sql1);
                    }
//                    else
//                    {
//                        dbQuery('UPDATE '.$tp.'tutorial_validator '.$sql1);
//                    }
//                    if($id == -1)
//                    {
//                        dbQuery('insert into '.$tp.'comment set uid='.$user['uid'].',tutorial_id='.$dbTutId.', content="Yeah It works!!", likes=345, ts=now();');
//                    }
//                    else
//                    {
//                        dbQuery('UPDATE '.$tp.'comment set uid='.$user['uid'].',tutorial_id='.$dbTutId.', content="Yeah It works!!", likes=345, ts=now();');
//                    }
                }
		
	
	
        echo '<h4>Tutorial updated</h4>';
        echo '<a href="/cms.user/index.php?feature=tutorials&amp;view=one&amp;id='.$dbTutId.'" class="button">View Your Tutorial</a>';
        require_once 'listings.php';
	
        //var_dump($dbTutId);
        
}
if(isset($_GET['action']) && $_GET['action']=="CommentAdd")
{
    if(isset($_POST['uid']) && $_POST['tid'])
    {
        dbQuery('insert into '.$tp.'comment set uid='.$_POST['uid'].',tutorial_id='.$_POST['tid'].', content="'.$_POST['content'].'", likes=0, ts=now();');
        
    }

    
}
if(isset($_GET['action']) && $_GET['action']=="validateTutorial")
{
    if(isset($_GET['id']))
    {
        dbQuery('UPDATE '.$tp.'tutorial_validator tv set isValidated=1, comment="'.$_POST['comment'].'"  WHERE tv.tutorial_id='.$_GET['id']);
        
    }


}
?>