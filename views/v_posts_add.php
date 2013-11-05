<!-- Prevent user from submitting empty post -->

<?php if(isset($error)): ?>
   <div class='error'>  
           Sorry empty posts not allowed! Please try again. 
   </div>
<?php endif; ?>

<!-- REMEMBER TO REMOVE THE SPACE BETWEEN THE ? and PHP-->
<!-- if a $post_id has been set, this means that the user is actually editing a prior post.
User needs to be redirected to posts/p_edit/post_id instead -->
<!--
< ?php if(isset($post_id)): ?>
    <form method='POST' action='/posts/p_edit/<?=$post_id?>'>
< ?php else: ?>
    <form method='POST' action='/posts/p_add'>
< ?php endif; ?>

<!-- if the $post_id is set, then pre-populate text area with prior post 
       <textarea name='content'>
         < ?php if(isset($post_id)): ?>
         < ?=$post?>
         < ?php endif; ?>
        </textarea>
        <input type='Submit' value='Add new post'>
    </form>

-->

<form method='post' action='/posts/p_add'>
    <textarea name='content'></textarea>
    <input type='Submit' value = 'Add new post'>
</form> 
