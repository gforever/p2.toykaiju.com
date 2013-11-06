<?php foreach($posts as $post): ?>
 <!--Displays the user's name -->
         <span class="uName">
		   <?=$post['first_name']?> 
         </span>
 <!--Displays the post -->
           <?=$post['content']?> 
 <!--Displays the time -->
         <span class="postDate"> 
	       <?=Time::display($post['created'])?><br /> 
         </span>

       <!--If the user id  matches with the user who made the post, then provide the option of editing or deleting entry -->
        <?php if($user->user_id == $post['post_user_id']): ?>                
         <a href=/posts/edit/<?=$post['post_id']?>>Edit</a> - 
         <a href=/posts/delete/<?=$post['post_id']?>>Delete</a>        
        
        <?php endif; ?>                         
           
<?php endforeach; ?>