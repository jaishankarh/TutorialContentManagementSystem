 <?php
$site=  dbRow('select * from '.$DBVARS['tp'].'site_info where id=1;');
//var_dump($site);
//die();
echo '<table style="min-width:50%;border:1px">
<tr></tr>';
if($site==false)
    $site=array('site_name'=>'', 'description'=>'','logo'=>'','about_us'=>'','footer'=>'');
    echo '<tr><th>Site Name</th><th>'.$site['site_name'].'</th></tr>';
    echo '<tr><th>Description</th><td>'.$site['description'].'</td></tr>';
    echo '<tr><th>Logo</th><td><img width="10%" src="/cms.multimedia/pictures/logo/'.$site['logo'].'"></td></tr>';
    echo '<tr><th>About Us</th><td>'.$site['about_us'].'</a></td></tr>';
    echo '<tr><th>Footer Content</th><td>'.$site['footer'].'</td></tr>';
    echo '<tr><td><a class="button" href="/cms.admin/site-info.php?edit=true">Edit</a></td>';

echo '</table>';


