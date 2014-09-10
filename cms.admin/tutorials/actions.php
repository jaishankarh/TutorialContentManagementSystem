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
$id=(int)$_REQUEST['id'];
$tp=$DBVARS['tp'];
if($_REQUEST['action']=='delete'){
	dbQuery('delete from '.$tp.'tutorial where id='.$id);
	unset($_REQUEST['id']);
}
if($_REQUEST['action']=='Save'){
	
	$sql='set title="'.$_REQUEST['TITLE'].'", content="'.$_REQUEST['CONTENT'].'",isValidated =0 ,postedBy='.$user['uid'].';';
	
	if($id==-1)
        {
                //save to the main tutorial table
		dbQuery('insert into '.$tp.'tutorial '.$sql);
                $dbTutId = dbLastInsertId();
                //save the pics and videos
                if(isset($_REQUEST['PICTURES']))
                {
                    $pictures = reArrayFiles($_FILES['PICTURES']);
                    
                    //die();
                    foreach($pictures as $pic)
                    {
                         //var_dump($value[]);
                        $baseFileName = $user['uid'].'-'.$dbTutId.basename($pic['name']);
                        //save to the main tutorial_multimedia table
                        $sql1 = 'set tutorial_id="'.$dbTutId.'", type="PICTURES", value="'.$baseFileName.'";';
                        dbQuery('insert into '.$tp.'tutorial_multimedia '.$sql1);
                        //move uploaded files to its location..
                        if($pic['error'] == UPLOAD_ERR_OK)
                        {
                            $uploadFile = MEDIABASE.'pictures/'.$baseFileName;
                            if(!(move_uploaded_file($pic['tmp_name'], $uploadFile)))
                            {
                                var_dump($pic['tmp_name']);
                                die("ERROR");
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
                if(isset($_REQUEST['VIDEOS']))
                {
                    $videos = reArrayFiles($_FILES['VIDEOS']);
                    foreach($videos as $video)
                    {
                        $baseFileName = $user['id'].'-'.$dbTutId.basename($video['name']);
                        //save to the main tutorial_multimedia table
                        $sql1 = 'set tutorial_id="'.$dbTutId.'", type="VIDEOS", value="'.$baseFileName.'";';
                        dbQuery('insert into '.$tp.'tutorial_multimedia '.$sql1);
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
                //update the author and validator tables
                $authors = $_POST['AUTHOR'];
                foreach($authors as $author)
                {
                    $sql1 = 'set tutorial_id="'.$dbTutId.'", auth_id='.$author.', isValidated=0;';
                    dbQuery('INSERT INTO '.$tp.'tutorial_author '.$sql1);
                    
                }
                $validators = $_POST['VALIDATOR'];
                foreach($validators as $validator)
                {
                    
                    $sql1 = 'set tutorial_id="'.$dbTutId.'", validator_id='.$validator.';';
                    dbQuery('INSERT INTO '.$tp.'tutorial_validator '.$sql1);
                    
                }
		die();
	}
	else{
		dbQuery('update '.$tp.'tutorial '.$sql.' where id='.$id);
	}
	echo '<em>Tutorial updated</em>';
}
?>