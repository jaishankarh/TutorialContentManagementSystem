<?php

$tp=$DBVARS['tp'];
if($_REQUEST['action']=='delete'){
	dbQuery('delete from '.$tp.'site_info where id=1');
	unset($_REQUEST['id']);
}
$errors=array();
if($_REQUEST['action']=='Save'){
    
    if($_FILES['logo']['error'] == UPLOAD_ERR_OK)
    {
        $size = getimagesize($_FILES['logo']['tmp_name']);
        if($size[0]!=0 || $size[1]!=0)
        {
            if($size[0] <= 100 && $size[1]<= 100)
            {
                $uploadFile = $_SERVER['DOCUMENT_ROOT']."cms.multimedia/pictures/logo/".basename($_FILES['logo']['name']);
            //$uploadFile = "/home/jaishankar/".basename($_FILES['photo']['name']);
            // echo $uploadFile;
            // die();
                if(!(move_uploaded_file($_FILES['logo']['tmp_name'], $uploadFile)))
                {
                    global $errors;
                    $errors['logo']="Problem Occured while moving the file ".$_FILES['logo']['name'];
                }
            }
            
        }
        else
        {
            global $errors;
            $errors['logo'] = "Please check the dimensions of the photo before uploading!";
        }
            

    }
    else 
    {
            if($_FILES['logo']['error'] == UPLOAD_ERR_NO_FILE )
            {
                    global $errors;
                    $errors['logo']="No file was uploaded. Please upload a file";
            }
            if($_FILES['logo']['error'] == UPLOAD_ERR_INI_SIZE || UPLOAD_ERR_FORM_SIZE)
            {
                    global $errors;
                    $errors['logo']=$_FILES['logo']['name']." is too big a file. Please upload a smaller file.";
            }
            else
            {
                    global $errors;
                    $errors['logo']="Sorry Internal Server error has occured!";	
            }

    }
    if(!isset($_REQUEST['site_name']) || $_REQUEST['site_name'] == "")
    {
        global $errors;
        $errors['site_name'] = "This is a required field";
    }
    if(!isset($_REQUEST['description']) || $_REQUEST['description'] == "")
    {
        global $errors;
        $errors['description'] = "This is a required field";
    }
    if(!isset($_REQUEST['about_us']) || $_REQUEST['about_us'] == "")
    {
        global $errors;
        $errors['about_us'] = "This is a required field";
    }
    if(!isset($_REQUEST['footer']) || $_REQUEST['footer'] == "")
    {
        global $errors;
        $errors['footer'] = "This is a required field";
    }
    
        global $errors;
        
        if(count($errors)==0)
        {
            
            $sql='set site_name="'.$_REQUEST['site_name'].'", description="'.$_REQUEST['description'].'", about_us="'.$_REQUEST['about_us'].'", footer="'.$_REQUEST['footer'].'", logo="'.basename($_FILES['logo']['name']).'"';
            dbQuery('update '.$tp.'site_info '.$sql.' where id=1');
            echo '<em>Site Info updated</em>';
        }
	
//	echo $sql;
//        die();
		
}
