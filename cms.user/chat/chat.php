<?php
require_once '../user_libs.php';
$user=$_SESSION['userdata'];
$tp=$DBVARS['tp'];
if(isset($_GET['action'])&&$_GET['action']=="save")
{
    if(isset($_SESSION['userdata']))
    {
        
        if(isset($_POST['msg']) && isset($_POST['user2']) && isset($_POST['msg']))
        {
            $sql = 'SET user1='.$user['uid'].', user2='.$_POST['user2'].', content="'.$_POST['msg'].'"';
            var_dump($sql);
            //die();
            //$msg = $_POST['msg'];
            dbQuery('INSERT INTO '.$tp.'chats '.$sql);
        }

//        $fp = fopen("log.html", 'a');
//        fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['username']."</b>: ".stripslashes(htmlspecialchars($msg))."<br></div>");
//        fclose($fp);
    }
}    
else if(isset($_GET['action'])&&$_GET['action']=="getChats")
{
    
    if(isset($_SESSION['userdata']))
    {
        
        if(isset($_GET['user2']))
        {
            $query = 'SELECT * FROM '.$tp.'chats c WHERE (c.user1='.$user['uid'].' AND c.user2='.$_GET['user2'].') OR (c.user2='.$user['uid'].' AND c.user1='.$_GET['user2'].')';
            
            $chats = dbAll($query);
          
            $content = "";
            
            foreach($chats as $chat)
            {
                global $content;
                $user1 = dbRow('SELECT uname FROM '.$tp.'login WHERE uid='.$chat['user1']);
                $tempContent = '<div class="chat"><div class="msg">'.stripslashes(htmlspecialchars($chat['content'])).'</div><div class="userinfo">'.$user1['uname'].'<br />'.$chat['ts'].'</div></div>';
                
//                $c = "<div class='msgln'>(".$chat['ts'].") <b>".$user1['uname']."</b>:".stripslashes(htmlspecialchars($chat['content']))."<br/></div>";
                //header('Content-type: application/json');
                
                $content = $content.$tempContent;
            }
            //$c = '{"html":"hello"}';
            $a = array("html"=>$content,"user2"=>$_GET['user2']);
            //echo phpinfo();
            echo json_encode($a);
        }
    }
    else
    {
        echo "Please login again";
    }
}

?>