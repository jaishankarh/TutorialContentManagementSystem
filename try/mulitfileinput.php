<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="/common/js/1.10.2/jquery-1.10.2.js"></script>
        
    </head>
    <body>
        <div>
<!--  <select id="input_count">
    <option value="1">1 input</option>
    <option value="2">2 inputs</option>
    <option value="3">3 inputs</option>
  </select>-->
            <form method="POST" action='/try/mulitfileinput.php'>
    <input id="input_count" type="button" value="add"/>
    </form>
<div>
    
<div id="inputs">
    
    <script>
//            $('#pizza').click(function() {
//      
//
//      var targetDiv = $("#output").html("");
//      
//        targetDiv.append($("<input type='text' />"));
//     
//  });
  $(document).ready(function(){
      $('#input_count').click(function() {
          var selectObj = $(this);
          
    
          var targetDiv = $("#inputs");
          //targetDiv.html("");
          
            targetDiv.append($("<input type='file' name='pics[]'/>"));
          
      });
      
  });
  
  
//  $('#input_count').change(function() {
//          var selectObj = $(this);
//          var selectedOption = selectObj.find(":selected");
//          var selectedValue = selectedOption.val();
//    
//          var targetDiv = $("#inputs");
//          targetDiv.html("");
//          for(var i = 0; i < selectedValue; i++) {
//            targetDiv.append($("<input />"));
//          }
//      });
  
        </script>
  
</div>
        
<!--        
        
        
            <input type="text" name="numbers[]"/>
            <input type="text" name="numbers[]"/>
            <input type="text" name="numbers[]"/>
            <input type="text" name="numbers[]"/>
            <input type="submit" value="add"/>
            <input id="pizza" type='button' value='add more'/>
</form>
        <div id="output"></div>-->
        
        <?php
    if(isset($_REQUEST['numbers']))
    {
        var_dump($_REQUEST['numbers']);
    }
    
    
    ?>
    </body>
    
</html>
