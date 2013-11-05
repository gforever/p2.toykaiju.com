<!-- Prevent user from submitting empty post -->
<!--
< ?php if(isset($error)): ?>
   <div class='error'>  
           Sorry empty posts not allowed! Please try again. 
   </div>
   
< ?php else: ?>   

< ?php endif; ?>
-->
<form method='post' action='/posts/p_add'>
    <textarea name='content'></textarea>
    <input type='Submit' value = 'Add new post'>
</form> 
   




