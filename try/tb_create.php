<?php
session_start();
if(isset($_POST['registration']))
{

	echo "<html>";
	echo "<head><title></title></head>";
	echo "<body bgcolor='#d0e4fe'>";
	$dbname=$_POST['dbname'];
	$dbuser=$_POST['dbuser'];
	$dbpassword=$_POST['dbpassword'];
	$tp=$_POST['tbprefix'];
	$hname=$_POST['hname'];
	mysql_connect($hname,$dbuser,$dbpassword) or die(mysql_error());
	$configFile="./.private/config.php";
	$fp = fopen($configFile, "w+");
	$phpDelimiter = '<?php';
	$fileContent = "\$DBVARS=array('username'=>'$dbuser','password'=>'$dbpassword','hostname'=>'$hname','db_name'=>'$dbname','tp'=>'$tp');";
	fwrite($fp, $phpDelimiter."\n".$fileContent);	
	mysql_select_db($dbname) or die("The database does not exist");
	$query1="create table if not exists ".$tp."role(id int(10) NOT NULL AUTO_INCREMENT,rname varchar(20) NOT NULL,PRIMARY KEY(id));";
	mysql_query($query1) or die(mysql_error());
        
        $query2='CREATE TABLE IF NOT EXISTS '.$tp.'login(uid int(10) NOT NULL AUTO_INCREMENT ,uname varchar(20) NOT NULL,email VARCHAR(32),password char(32) DEFAULT NULL, active tinyint DEFAULT 0,groups text, activation_key varchar(32) DEFAULT NULL, extras text,UNIQUE KEY(email),PRIMARY KEY (uid),UNIQUE KEY(uname));';
                
	//$query2="create table if not exists ".$tp."login(uid int(10) NOT NULL auto_increment,uname varchar(20) NOT NULL,emailid varchar(30) 			NOT NULL,passwd varchar(15) NOT NULL,UNIQUE KEY(emailid),PRIMARY KEY(uid),UNIQUE KEY(uname));";
	mysql_query($query2) or die(mysql_error());
	//$query3="create table if not exists ".$tp."login_role(uid int(10) NOT NULL,rid int(10) NOT NULL,PRIMARY KEY(uid,rid),FOREIGN KEY 			(uid) REFERENCES ".$tp."login(uid),FOREIGN KEY (rid) REFERENCES ".$tp."role(rid));";
	//mysql_query($query3) or die(mysql_error());
	$query4="create table if not exists ".$tp."author(id int(10) NOT NULL AUTO_INCREMENT,uid int(10) NOT NULL,auth_name varchar(50) NOT NULL,designation varchar(255) DEFAULT 'unemployed',experience MEDIUMTEXT,expertise_area TEXT,hobbys MEDIUMTEXT,PRIMARY KEY(id),FOREIGN KEY(uid) REFERENCES ".$tp."login(uid));";
	mysql_query($query4) or die(mysql_error());
	$query5="create table if not exists ".$tp."site_info(id int(10) NOT NULL AUTO_INCREMENT,site_name varchar(30) NOT NULL,logo MEDIUMTEXT,description TEXT NOT NULL,PRIMARY KEY (id));";
	mysql_query($query5) or die(mysql_error());
	/*$query6="create table if not exists ".$tp."site_contact(id int(10) NOT NULL AUTO_INCREMENT,site_id int(10),contact varchar(30),UNIQUE KEY(contact),FOREIGN KEY (site_id) REFERENCES ".$tp."site_info(id),PRIMARY KEY(id));";
	mysql_query($query6) or die(mysql_error());*/
	$query7="create table if not exists ".$tp."tutorial_fields(id int(10) NOT NULL AUTO_INCREMENT,field_type varchar(30), PRIMARY KEY(id));";
	mysql_query($query7);
// 	$query8="create table if not exists ".$tp."tutorialtype_features(id int(10) NOT NULL AUTO_INCREMENT,tutorialtype_id int(10),features varchar(100), UNIQUE KEY(features),FOREIGN KEY (tutorialtype_id) REFERENCES ".$tp."tutorial_type(id),PRIMARY KEY(id));";
// 	mysql_query($query8) or die(mysql_error());
	$query9="create table if not exists ".$tp."validator(id int(10) NOT NULL AUTO_INCREMENT,uid int(10),val_name varchar(50),designation varchar(255) NOT NULL DEFAULT 'unemployed',experience MEDIUMTEXT,expertise_area TEXT,comment MEDIUMTEXT,PRIMARY KEY(id),FOREIGN KEY(uid) REFERENCES ".$tp."login(uid));";
	mysql_query($query9) or die(mysql_error());
	$query10="create table if not exists ".$tp."tutorial(id int(10) NOT NULL AUTO_INCREMENT,title varchar(30), content text, isValidated boolean,postedBy int(10) FOREIGN KEY(postedBy) REFERENCES ".$tp."login(uid),PRIMARY KEY(id));";
	mysql_query($query10) or die(mysql_error());
	$query11="create table if not exists ".$tp."tutorial_pics(id int(10) NOT NULL AUTO_INCREMENT,tutorial_id int(10),picture varchar(300),FOREIGN KEY(tutorial_id) REFERENCES ".$tp."tutorial(id),PRIMARY KEY(id));";
	mysql_query($query11) or die(mysql_error());
	$query12="create table if not exists ".$tp."tutorial_vids(id int(10) NOT NULL AUTO_INCREMENT,tutorial_id int(10),video varchar(100),FOREIGN KEY(tutorial_id) REFERENCES ".$tp."tutorial(id),PRIMARY KEY(id));";
	mysql_query($query12) or die(mysql_error());
	$query13="create table if not exists ".$tp."tutorial_auth(id int(10) NOT NULL AUTO_INCREMENT,auth_id int(10),tutorial_id int(10),FOREIGN KEY(auth_id) REFERENCES ".$tp."author(id), FOREIGN KEY(tutorial_id) REFERENCES ".$tp."tutorial(id),PRIMARY KEY(id));";
	mysql_query($query13) or die(mysql_error());
	$query14="create table if not exists ".$tp."tutorial_validator(id int(10) NOT NULL AUTO_INCREMENT,validator_id int(10),tutorial_id int(10),FOREIGN KEY(validator_id) REFERENCES ".$tp."validator(id),FOREIGN KEY(tutorial_id) REFERENCES ".$tp."tutorial(id),PRIMARY KEY(id));";
	mysql_query($query14) or die(mysql_error());
	$query15="create table if not exists ".$tp."comment(id int(20) NOT NULL AUTO_INCREMENT,parent_cid int(20) NULL,uid int(10),tutorial_id int(10),content MEDIUMTEXT NOT NULL,likes int(10),FOREIGN KEY(uid) REFERENCES ".$tp."login(uid),FOREIGN KEY(tutorial_id) REFERENCES ".$tp."tutorial(id),FOREIGN KEY(parent_cid) REFERENCES ".$tp."comment(id),PRIMARY KEY(id));";
	mysql_query($query15) or die(mysql_error());
        $query16="create table if not exists ".$tp."tutorial_datatable(id int(10) NOT NULL AUTO_INCREMENT,data_content MEDIUMTEXT, tutorial_id int(10),FOREIGN KEY(tutorial_id) REFERENCES ".$tp."tutorial(id),PRIMARY KEY(id));";
	mysql_query($query14) or die(mysql_error());
        
        
        $insQuery1 = 'insert into '.$tp.'login(uid,uname, email,password, active, groups) values(1,"'.$_POST['username'].'","'.$_POST['email'].'",md5("'.$_POST['email'].'"|"'.$_POST['password'].'"),1,\'["_superadministrators"]\');';
        mysql_query($insQuery1) or die(mysql_error());
        
        $insQuery2 = 'insert into '.$tp.'role values(1,"_superadministrators");';
        mysql_query($insQuery2) or die(mysql_error());
        $insQuery3 = 'insert into '.$tp.'role values(2,"_users");';
        mysql_query($insQuery3) or die(mysql_error());
        $insQuery4 = 'insert into '.$tp.'role values(3,"_validators");';
        mysql_query($insQuery4) or die(mysql_error());
	echo "<h1><i><u>CMS installed successfully</u></i></h1>";
	echo "</body>";
	echo "</html>";

}
else
{
	echo "<h2>Please Click on Register</h2>";
	exit();	
}
?>

