<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

-->
<?php
require_once '../user_libs.php';
$user=$_SESSION['userdata'];
$tp=$DBVARS['tp'];


?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="/common/css/chatStyles.css" type="text/css" rel="stylesheet"/>
        <title></title>
    </head>
    <style>
        /* CSS Document */
/*body {
    font:12px arial;
    color: #222;
    text-align:center;
    padding:35px; }
  
form, p, span {
    margin:0;
    padding:0; }
  
input { font:12px arial; }
  
a {
    color:#0000FF;
    text-decoration:none; }
  
    a:hover { text-decoration:underline; }
  
#wrapper, #loginform {
    margin:0 auto;
    padding-bottom:25px;
    background:#EBF4FB;
    width:504px;
    border:1px solid #ACD8F0; }
  
#loginform { padding-top:18px; }
  
    #loginform p { margin: 5px; }
  
.chatbox {
    text-align:left;
    margin:0 auto;
    margin-bottom:25px;
    padding:10px;
    background:#fff;
    height:270px;
    width:430px;
    border:1px solid #ACD8F0;
    overflow:auto; }
  
#usermsg {
    width:395px;
    border:1px solid #ACD8F0; }
  
#submit { width: 60px; }
  
.error { color: #ff0000; }
  
#menu { padding:12.5px 25px 12.5px 25px; }
  
.welcome { float:left; }
  
.logout { float:right; }
  
.msgln { margin:0 0 2px 0; }*/
    </style>
    <body>
        <div id="chats">
<!--        <div class="chatWrapper">
            <div class="chatHeader"><h4>Nishtha</h4></div>
            <div class="chatbox">
               
                
            </div>
            <div class="chatForm">
                <form name="message" action="" method="post">
                    <input name="msg" type="text" id="usermsg"/>
                    <input name="user2" type="hidden" size="63" value="3" />
                    <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
        
                </form>
            </div>
        </div>-->
        </div>
        
<!--        <div id="wrapper">
    <div id="menu">
        <p class="welcome">Welcome, <b><?php // echo $user['uname']; ?></b></p>
        <p class="logout"><a id="exit" href="#">Exit Chat</a></p>
        <div style="clear:both"></div>
    </div>   
            
            <div id="chats">
            <div class="chatbox">
               
                
            </div>
     
                <form name="message" action="" method="post">
        <input name="msg" type="text" id="usermsg" size="63" />
        <input name="user2" type="hidden" size="63" value="3" />
        <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
        
    </form>
            </div>-->
<?php
    $tp = $DBVARS['tp'];
    $query = 'SELECT * FROM '.$tp.'login WHERE logged_in=1';
    $users_logged_in = dbAll($query);
    foreach($users_logged_in as $u)
    { ?>
        <div>
                <a class="chatUsers" data-user2='<?php echo $u['uid'];?>' data-user2name='<?php echo $u['uname'];?>'><?php echo $u['uname'];?></a>
                
        </div>
    <?php }
?>
<!--            <div>
                <a class="chatUsers" data-user2="3" data-user2name="Nishtha">Nishtha</a>
                <a class="chatUsers" data-user2="1" data-user2name="admin">Admin</a>
            </div>-->
            
</div>
        <script type="text/javascript" src="/common/js/1.10.2/jquery-1.10.2.js"></script>
<script type="text/javascript">
// jQuery Document
function ChatBox(user2,chatBoxId)
{
    //this.user1 = user1;
    this.user2 = user2;
//    this.id = id;
    this.chatBoxId = chatBoxId;
}
var chatArr = new Array();
$(document).ready(function(){
//    $("#submitmsg").click(function(){
//            var name = "usermsg";
//            var id_pre = "#";
//            var id = id_pre.concat(name);
//            var msg = $(id).val();
//            $.post("chat.php?action=save",{msg:msg,user2:3});
//            $("#usermsg").attr({"value":""});
//            return false;
//    
//    });
    $("#chats").on("submit","form",function(){
        //alert("hello");
//            var name = "user1msg";
//            var id_pre = "#";
//            var id = id_pre.concat(name);
//            var msg = $(id).val();
            $.post("chat.php?action=save",$(this).serializeArray());
            $("input[name='msg']").attr({"value":""});
            return false;
    
    });
//    $("#newChat").click(function(){
//        var user2 = $("#newChat").attr("data-user2");
//        $("#chats").append("<div class='chatbox'> \
//                <form id='newform' action='' method=''>\
//                <input name='msg' type='text' id='usermsg' size='63' />\
//                <input name='user2' type='hidden' value='"+ user2 +"'/>\
//                    <input name='submitmsg' type='submit'  id='submit2msg' value='Send'/>\
//                </form></div>");
//    });
    $(".chatUsers").click(function(){
        var user2 = $(this).attr("data-user2");
        var user2name = $(this).attr("data-user2name");
        //alert("hello");
        $("#chats").append("<div class='chatWrapper'>\
            <div class='chatHeader'><h4>" + user2name + "</h4></div>\
            <div class='chatbox' id='chatbox"+user2+"'>\
            </div>\
            <div class='chatForm'>\
                <form name='message' action='' method='post'>\
                    <input name='msg' type='text' />\
                    <input name='user2' type='hidden' value='"+user2+"'/>\
                    <input name='submitmsg' type='submit' value='Send'/></form></div></div>");
       chatArr.push(new ChatBox(user2,"chatbox"+user2));
       for (i = 0; i< chatArr.length; i++)
       {
            alert(chatArr[i].chatBoxId);
        }
    });
});
function loadChat()
{
    //alert(chatArr[0].chatBoxId);
    
    
    for (i = 0; i< chatArr.length; i++)
    {
        var cid = chatArr[i].chatBoxId;
        var oldscrollHeight = $("#"+cid).attr("scrollHeight") - 20;
//    $.ajax({
//        url:"chat.php?action=getChats&user2="+chatArr[i].user2,
//        cache:false,
//        success:function(html){
//            //alert(cid);
//            html = html + "<p>" + cid + "</p>";
//            $("#"+cid).html(html);
//            var newscrollHeight = $("#"+cid).attr("scrollHeight") - 20; //Scroll height after the request
//            if(newscrollHeight > oldscrollHeight){
//                $("#"+cid).animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
//            }
//            },      
//        
//    });
    $.get("chat.php",{action: "getChats", user2:chatArr[i].user2},function(data){
            //alert(cid);
            
            var c = $.parseJSON(data);
            var cid = c['user2'];
            var html = c['html'];
            //alert(cid);
            
            //html = html + "<p>" + cid + "</p>";
            $("#chatbox"+cid).html(html);
            var newscrollHeight = $("#chatbox"+cid).attr("scrollHeight") - 20; //Scroll height after the request
            if(newscrollHeight > oldscrollHeight){
                $("#chatbox"+cid).animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
            }
            });
    }
    
}
     

        setInterval(loadChat,2500);
</script>

    </body>
</html>
