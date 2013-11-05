<?php foreach ($posts as $post): ?>
    <form method='POST' action='/posts/p_edit/<?php echo $post['id']; ?>'>      
          <label><small>Quote Title</small></label>
          <input type="text" name="title" maxlength="100" class="form-control limited" value="<?php echo $post['title']; ?>" placeholder="Your Quote Title" autofocus="">
            <p class="char-count"><strong>Characters left:</strong> <span class="charsLeftInput">10</span></small></p>

                
          <label><small>Your Quote</small></label>
          <textarea class="form-control limited" maxlength="250" rows="4" cols="50" name="content"><?php echo $post['content']; ?></textarea>
             <p class="char-count"><strong>Characters left:</strong> <span class="charsLeft">10</span></small></p><br />
                
          <button class="btn btn-lg btn-primary btn-block" type="submit">Update My Quote!</button>        
    </form>
<?php endforeach; ?>