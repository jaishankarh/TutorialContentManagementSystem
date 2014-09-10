<?php


$tp = $DBVARS['tp'];
$r=dbRow("select * from ".$tp."site_info;");
if(!is_array($r) || !count($r)){
	$r=array('site_name'=>'', 'description'=>'','logo'=>'','about_us'=>'','footer'=>'');
}
echo '<form action="site-info.php?action=Save" method="post" enctype="multipart/form-data"><table>';
if(isset($errors['site_name']))
{
    echo '<tr><td>'.$errors['site_name'].'</td></tr>';
}
echo '<tr><th>Site Name</th><td><input type="text" name="site_name" value="'.$r['site_name'].'" /></td></tr>';
if(isset($errors['description']))
{
    echo '<tr><td>'.$errors['description'].'</td></tr>';
}
echo '<tr><th>Description</th><td><textarea name="description" >'.$r['description'].'</textarea></td></tr>';
echo '<input type="hidden" name="MAX_FILE_SIZE" value="100000"/>';
if(isset($errors['logo']))
{
    echo '<tr><td>'.$errors['logo'].'</td></tr>';
}
echo '<tr><th>Logo</th><td><input type="file" name="logo" /></td></tr>';
if(isset($errors['about_us']))
{
    echo '<tr><td>'.$errors['about_us'].'</td></tr>';
}
echo '<tr><th>About Us</th><td><textarea name="about_us" >'.$r['about_us'].'</textarea></td></tr>';
if(isset($errors['footer']))
{
    echo '<tr><td>'.$errors['footer'].'</td></tr>';
}
echo '<tr><th>Footer Content</th><td><textarea name="footer" >'.$r['footer'].'</textarea></td></tr>';
echo '</table>';
echo '<input type="submit" class="button" name="action" value="Save" />';

echo '</form>';
