<!--<article class = "main">
    
                <div class = "innerColumn">-->
<?php
$id=(int)$_SESSION['userdata']['uid'];
$tp = $DBVARS['tp'];

if(isset($_REQUEST['settings'])&& $_REQUEST['settings']=='user')
{
if(isset($_REQUEST['action'])&&isset($_REQUEST['id'])&&$_GET['action']=='Save')
{
    
    if(isset($_REQUEST['password']) && $_REQUEST['password']!=''){
		if($_REQUEST['password']!==$_REQUEST['password2'])
			echo '<em>Password not updated. Must be entered the same twice.</em>';
		else
                {
                    $sql ='SET password=md5("'.$_REQUEST['email'].'|'.$_REQUEST['password'].'")';
                    dbQuery('update '.$tp.'login '.$sql.' where uid='.$id.';');
                    echo '<h4>Users updated</h4>';
                }
	}
        
}
 

$groups=array();

$r=dbRow("select * from ".$tp."login where uid=$id");
echo '<h2>My Account Settings</h2>';
echo '<form action="/cms.user/index.php?feature=settings&amp;settings=user&amp;action=Save&amp;id='.$id.'" method="post">';
echo '<input type="hidden" name="id" value="'.$id.'" /><table style="width:100%">';
echo '<tr><th>Username *</th><td><input type="text" readonly="true" name="username" value="'.$r['uname'].'" /></td></tr>';
echo '<tr><th>Email *</th><td><input type="text" readonly="true" name="email" value="'.htmlspecialchars($r['email']).'" /></td></tr>';
echo '<tr><th>Password *</th><td><input name="password" type="password" /></td></tr>';
echo '<tr><th>(repeat) *</th><td><input name="password2" type="password" /></td></tr>';
echo '<tr><th>Groups *</th><td class="groups">';
$grs=dbAll('select id,rname from '.$tp.'role');
$gms=array();
foreach($grs as $g){
	$groups[$g['id']]=$g['rname'];
}
$gms=json_decode($r['groups']);
if(is_null($gms))
{
    $gms=array("_users");
}
foreach($groups as $k=>$g){
	echo '<input type="checkbox" readonly="true" name="roles['.$k.']"';
	if(in_array($g,$gms))
            echo ' checked="checked"';
	echo ' />'.htmlspecialchars($g).'<br />';
}
echo '</td></tr>';
// }
$a = "NO";
if($r['active'])
{
    $a="YES";
}
echo '<tr><th>Active *</th><td>'.$a.'</td></tr>';
echo '<tr><td>* Required Fields</td></tr></table>';
echo '<input type="submit" class="button" name="action" value="Save" />';

echo '</form>';
}//user settings tilll here..

else if(isset($_GET['settings'])&& $_GET['settings']=='author')
{
if(isset($_GET['action'])&&isset($_GET['id'])&&$_GET['action']=='Save')
{
    if(isset($_POST['fname'])&&isset($_POST['lname']))
    {
        
//        var_dump($_GET['authorCreate']);
//        die();
        $sql='set auth_fname="'.$_REQUEST['fname'].'", auth_lname="'.$_REQUEST['lname'].'",designation="'.$_REQUEST['designation'].'",experience="'.$_REQUEST['experience'].'",expertise_area="'.$_REQUEST['expertise'].'", hobbys="'.$_REQUEST['hobbys'].'", uid='.(int)$_SESSION['userdata']['uid'].'';
        $sql1='set auth_fname="'.$_REQUEST['fname'].'", auth_lname="'.$_REQUEST['lname'].'",designation="'.$_REQUEST['designation'].'",experience="'.$_REQUEST['experience'].'",expertise_area="'.$_REQUEST['expertise'].'", hobbys="'.$_REQUEST['hobbys'].'"';
        if(isset($_GET['authorCreate'])&&$_GET['authorCreate']==true)
        {
            dbQuery('INSERT INTO '.$tp.'author '.$sql.';');
        }
        else
        {
            dbQuery('update '.$tp.'author '.$sql1.' where uid='.$id.';');
            
        }
        echo '<h3>Author Information updated</h3>';
        echo '<a href="/cms.user/index.php?feature=tutorials&amp;create=true&amp;step=1&amp;id=-1" class="button">Click Here to create your first Tutorial</a>';
    }
    else
    {
        echo '<em>First Name and Last Names are Required Fields!</em>';
    }
        
}

$id=(int)$_SESSION['userdata']['uid'];
$tp = $DBVARS['tp'];
$r=dbRow("select * from ".$tp."author a where a.uid=$id");
?>
  
       
<?php       

echo '<h2>My Author Account Settings</h2>';
echo '<form action="/cms.user/index.php?feature=settings&amp;id='.$id.'&amp;action=Save&amp;settings=author&amp;authorCreate='.$_GET['authorCreate'].'" method="post">';
echo '<input type="hidden" name="id" value="'.$id.'" /><table style="width:100%">';
echo '<tr><th>First Name *</th><td><input type="text" name="fname" value="'.$r['auth_fname'].'" required/></td></tr>';
echo '<tr><th>Last Name *</th><td><input name="lname" type="text" value="'.$r['auth_lname'].'" required/></td></tr>';
echo '<tr><th>Designation *</th><td><textarea name="designation" required>'.$r['designation'].'</textarea></td></tr>';
echo '<tr><th>Experience *</th><td><textarea name="experience" required>'.$r['experience'].'</textarea></td></tr>';
echo '<tr><th>Expertise *</th><td><textarea name="expertise" required>'.$r['expertise_area'].'</textarea></td></tr>';
echo '<tr><th>Hobbies</th><td><textarea name="hobbys">'.$r['hobbys'].'</textarea></td></tr>';

echo '<tr><td>* Required Fields</td></tr></table>';
echo '<input type="submit" class="button" name="action" value="Save" />';

echo '</form>';
}
else if(isset($_GET['settings'])&& $_GET['settings']=='validator')
{
if(isset($_GET['action'])&&isset($_GET['id'])&&$_GET['action']=='Save')
{
    if(isset($_POST['val_fname'])&&isset($_POST['val_lname']))
    {
        
//        var_dump($_GET['authorCreate']);
//        die();
        
        $sql1='set val_fname="'.$_POST['val_fname'].'", val_lname="'.$_POST['val_lname'].'",designation="'.$_POST['designation'].'",experience="'.$_POST['experience'].'",expertise_area="'.$_POST['expertise'].'"';
        dbQuery('update '.$tp.'validator '.$sql1.' where uid='.$id.';');
        
        echo '<h3>Validator Information updated</h3>';
        echo '<a href="/cms.user/index.php?feature=tutorials&amp;review=all" class="button">My Tutorials</a>';
    }
    else
    {
        echo '<em>First Name and Last Names are Required Fields!</em>';
    }
        
}

$id=(int)$_SESSION['userdata']['uid'];
$tp = $DBVARS['tp'];
$r=dbRow("select * from ".$tp."validator v where v.uid=$id");
?>
  
       
<?php       

echo '<h2>My Validator Account Settings</h2>';
echo '<form action="/cms.user/index.php?feature=settings&amp;id='.$id.'&amp;action=Save&amp;settings=validator" method="post">';
echo '<input type="hidden" name="id" value="'.$id.'" /><table style="width:100%">';
echo '<tr><th>First Name</th><td><input type="text" name="val_fname" value="'.$r['val_fname'].'" /></td></tr>';
echo '<tr><th>Last Name</th><td><input name="val_lname" type="text" value="'.$r['val_lname'].'"/></td></tr>';
echo '<tr><th>Designation</th><td><textarea name="designation">'.$r['designation'].'</textarea></td></tr>';
echo '<tr><th>Experience</th><td><textarea name="experience"/>'.$r['experience'].'</textarea></td></tr>';
echo '<tr><th>Expertise</th><td><textarea name="expertise"/>'.$r['expertise_area'].'</textarea></td></tr>';


echo '</table>';
echo '<input type="submit" class="button" name="action" value="Save" />';

echo '</form>';
}
?>