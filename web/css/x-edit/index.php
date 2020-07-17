<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>X-editable PHP backend sample22</title>
        <!-- jquery -->
        <!-- <script src="https://code.jquery.com/jquery-1.8.2.min.js"></script> -->
		<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
		
		<script src="//code.jquery.com/jquery-2.0.3.min.js"></script> 
		<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>  
        <!-- x-editable -->
   <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/js/bootstrap-editable.min.js"></script>
    
    </head>
    <body style="padding: 100px 100px">
         
      <?php
      /*
      Let's assume we have loaded record from database 
      */
      $user = array(
      'user_id' => 1,
      'user_name' => 'Awesome',
      'group_id' => 3
      );
      
      /*
      Render user_name and group as editable links
      */
      echo '<div id="user">';
      echo 'Username: <a href="#" id="user_name" data-type="text" data-pk="'.$user['user_id'].'" title="Enter username">'.$user['user_name'].'</a><br>';
      echo 'Username: <a href="#" id="user_name" data-type="text" data-pk="'.$user['user_id'].'" title="Enter username">0503843096</a><br>';
      echo 'Group: <a href="#" id="group_id" data-type="select" data-pk="'.$user['user_id'].'" data-value="'.$user['group_id'].'" data-source="groups.php" title="Select group"></a><br>';
      echo '</div>';
      ?>
                         
     <?
      /*
       In javascript apply $().editable() to both links on DOM ready
      */
     ?>
	 
	 
     <script>   
       $(function(){
		  $.fn.editable.defaults.mode = 'inline';
         
		 $('#user a').editable({
            url: 'post.php',
			send: 'always',
			showbuttons : 'false',
			
			
			
          });
		  
		/*  $('#username').on('save', function(e, params) {
				alert('Saved value: ' + params.newValue);
			});
		*/
       });
     </script>
        
    </body>
</html>