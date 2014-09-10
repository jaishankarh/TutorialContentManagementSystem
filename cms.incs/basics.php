<?php
	//start the session
    session_start();
	
	
	//initialise the database..
	function dbInit()
	{
		if(isset($GLOBALS['db']))
		{
			return $GLOBALS['db'];
		}
		global $DBVARS;
		$db = new PDO('mysql:host='.$DBVARS['hostname']
					.';dbname='.$DBVARS['db_name'],
					$DBVARS['username'],
					$DBVARS['password']	
						);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->query('set names utf8');
		$db->num_queries=0;
		$GLOBALS['db']=$db;
		return $db;
	}
	function dbQuery($query)
	{
		$db = dbInit();
		$q = $db->query($query);
		$db->num_queries++;
		return $q;
		
	}
	function dbRow($query)
	{
		$q = dbQuery($query);
		return $q->fetch(PDO::FETCH_ASSOC);
	}
        function dbAll($query) 
        {
            $q = dbQuery($query);
            $results=array();
            while($r=$q->fetch(PDO::FETCH_ASSOC))
            {
                    $results[]=$r;
            }
            return $results;
            
        }

function dbOne($query, $field='') {
$r = dbRow($query);
return $r[$field];
}
function dbLastInsertId() {
return dbOne('select last_insert_id() as id','id');
}

	
	
	
	
	define('SCRIPTBASE',$_SERVER['DOCUMENT_ROOT'].'/');
	require SCRIPTBASE.'.private/config.php';
	if(!defined('CONFIG_FILE'))
	{
		define('CONFIG_FILE',SCRIPTBASE.'private/config.php');
	}
        define('MEDIABASE',SCRIPTBASE.'cms.multimedia/');
	
        