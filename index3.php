<?php
	//this file is included to include the common functionality required
    include_once('cms.incs/common.php');
	$page=isset($_REQUEST['page'])?$_REQUEST['page']:'';
	$id=isset($_REQUEST['id'])?(int)$_REQUEST['id']:0;
	
	//get current page by id
	if(!$id)
	{
		if($page)
		{
			$r=Page::getInstanceByName($page);
			if($r && isset($r->id))
			{
				$id=$r->id;
			}
			unset($r);
		}
		//load by special if name is not set
		if(!$id)
		{
			$special=1;
			if(!$page)
			{
				$r=Page::getInstanceBySpecial($special);
				if($r && isset($r->id))
				{
					$id=$r->id;
				}
				unset($r);
			}
		}
	}
	//load page dataa.. 
	if($id)
	{
		$PAGEDATA=(isset($r) && $r) ? $r : Page::getInstance($id);
	}
	else
	{
		echo '404 Page not found';
		exit;	
	}
	echo $PAGEDATA->body;
