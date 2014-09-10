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
    $("#chats").on("click",".minbut",function(){
        //alert("i am here");
        //alert($(this).parent().parent().find(".chatbox").attr("class"));
        $(this).parent().parent().find(".chatbox").slideToggle()
        
    })
    $("#chats").on("submit","form",function(){
        //alert("hello");
//            var name = "user1msg";
//            var id_pre = "#";
//            var id = id_pre.concat(name);
//            var msg = $(id).val();
            $.post("/cms.user/chat/chat.php?action=save",$(this).serializeArray());
            $(this).find("input[name=msg]").val("");
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
            <div class='chatHeader'>" + user2name + "<div class='minbut'>-</div></div>\
            <div class='chatbox' id='chatbox"+user2+"'>\
            </div>\
            <div class='chatForm'>\
                <form name='message' action='' method='post'>\
                    <input class='msg' name='msg' type='text' value='' />\
                    <input name='user2' type='hidden' value='"+user2+"'/>\
                    <input name='submitmsg' class='' type='submit' value='Send'/></form></div></div>");
       chatArr.push(new ChatBox(user2,"chatbox"+user2));
//       for (i = 0; i< chatArr.length; i++)
//       {
//            alert(chatArr[i].chatBoxId);
//        }
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
    $.get("/cms.user/chat/chat.php",{action: "getChats", user2:chatArr[i].user2},function(data){
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
     

        setInterval(loadChat,2000);