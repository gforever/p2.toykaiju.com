<form method='post' action='/posts/p_edit/<?=$post['post_id']?>'>
    <textarea rows="5" cols="100" name='content'><?=$post['content']?></textarea>
    <br />
    <input type='Submit' value='Edit Sqeak' required>
</form>