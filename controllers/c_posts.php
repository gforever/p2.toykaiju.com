<?php

class posts_controller extends base_controller{
	
	#public function __construct() {
	#	parent::__construct();
	#    if(!$this->user) {
	#		die("Members only");
	#	}
	#}
	public function add() {
		#Sets up the view
		$this->template = View::instance("v_posts_add");
		echo $this->template;
	}

	public function p_add() {
        $_POST['user_id']  = $this->user->user_id;
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();
		
		DB::instance(DB_NAME)->insert('posts', $_POST);
		
	}
	################################

        ########### //Edit Posts ###########
        public function edit($post = NULL){
        
                //Determine if the user is logged in
                if(!$this->user) {
                        Router::redirect('/users/login/?no-permission');
                
                }
                
                //Specify the current logged in users ID. Required to compare if the user created the post.        
                $user = $this->user->user_id;
                
                //Query to determine which user the post and if it belongs to the logged in user.
                $q = "SELECT * FROM posts WHERE post_id = $post and user_id = $user";        
                $posts = DB::instance(DB_NAME)->select_rows($q);
                
                        
                if(!empty($posts)){
                
                                //Define view parameters
                                $this->template->content = View::instance('v_posts_edit');
                                $this->template->title = "Edit a New Post";
                                
                                //Send post array to the view
                                $this->template->content->posts = $posts;

                                //Display the template
                                echo $this->template;
                                        
                        }else{
                
                                //Redirect to view posts with an error
                                Router::redirect('/posts/stream/?no-permission');
                        
                        }// End of Else
                
        }// End of Function


        
        ########### //Edit Posts ###########
        public function p_edit($post = NULL){
        
                //Determine if the user is logged in
                if(!$this->user) {
                        Router::redirect('/users/login/?no-permission');
                
                }
                
                //Specify the current logged in users ID. Required to compare if the user created the post.        
                $user = $this->user->user_id;
                
                //Query to determine which user the post and if it belongs to the logged in user.
                $q = "SELECT * FROM posts where post_id = $post and user_id = $user";        
                $posts = DB::instance(DB_NAME)->select_rows($q);
                
                                
                if(!empty($posts)){
                                
                                
                                //Added strip_tags() to remove and HTML or markup
                                $title = $_POST['title'];
                                $title = strip_tags(html_entity_decode(stripslashes(nl2br($title)),ENT_NOQUOTES,"Utf-8"));

                                $content = $_POST['content'];
                                $content = strip_tags(html_entity_decode(stripslashes(nl2br($content)),ENT_NOQUOTES,"Utf-8"));
                                
                                
                                //If any portion of the POST is empty, redirect.
                                if($title == '' || $content == '') {
                                        Router::redirect('/posts/view/posts/'.$post.'/?empty-post');
                                }
                                                
                                // Specify created and modified time that will be posted to the DB.
                                $modified = $_POST['modified'] = Time::now();

                                //Data to update in the DB into an ARRAY
                                $data = Array('title' => $title, 'content' => $content, 'modified' => $modified);
                                
                                // Process from _POST parameters and insert them into the DB.
                                DB::instance(DB_NAME)->update("posts", $data, "WHERE id = $post");
                                
                                //Set success message for the view
                                Router::redirect('/posts/view/posts/'.$post.'/?post-updated');
                
                        }else{
                        
                                //Redirect to view posts with an error
                                Router::redirect('/posts/stream/?no-permission');
                        
                }// End of else
                
                
        }//End of function
        
        

        ########### //Delete Post ###########
        public function delete($post = NULL){
        
                //Determine if the user is logged in
                if(!$this->user) {
                        Router::redirect('/users/login/?no-permission');
                }
                        
                //Specify the current logged in users ID. Required to compare if the user created the post.        
                $user = $this->user->user_id;
                
                //Query to determine which user the post and if it belongs to the logged in user.
                $q = "select * from posts where id = $post and created_by = $user";        
                $posts = DB::instance(DB_NAME)->select_rows($q);
                                                                        
                //Determin if the post belongs to the user who created it
                if(!empty($posts)){
                                                                        
                                //Delete the post.
                                DB::instance(DB_NAME)->delete('posts', "WHERE id = '$post'");
                                
                                //Redirect to view posts with a success message.
                                Router::redirect('/posts/user/'.$this->user->user_id.'/?delete-success');
                                                
                        //The query will be empty if the user did not create the post.                
                        }else{
                        
                                //Redirect to view posts stream with an error
                                Router::redirect('/posts/stream/?no-permission');
                        
                                }//end of else                        
                
                }//End of function
####################################################################
		
	public function index() {
        $this->template->content = View::instance('v_posts_index');
		$q= 'SELECT 
               posts.content,
               posts.created,
               posts.user_id AS post_user_id,
               users_users.user_id AS follower_id,
               users.first_name,
               users.last_name
        FROM posts
        INNER JOIN users_users 
           ON posts.user_id = users_users.user_id_followed
        INNER JOIN users 
           ON posts.user_id = users.user_id
        WHERE users_users.user_id = '.$this->user->user_id;
			
		$posts = DB::instance(DB_NAME)->select_rows($q);
		$this->template->content->posts = $posts;
		echo $this->template;
	}	
	
	public function users() {
		
		# Set up view
		$this->template->content = View::instance("v_posts_users");
		
		# Set up query to get all users
		$q = 'SELECT *
			FROM users';
			
		# Run query
		$users = DB::instance(DB_NAME)->select_rows($q);
		
		# Set up query to get all connections from users_users table
		$q = 'SELECT *
			FROM users_users
			WHERE user_id = '.$this->user->user_id;
			
		# Run query
		$connections = DB::instance(DB_NAME)->select_array($q,'user_id_followed');
		
		# Pass data to the view
		$this->template->content->users       = $users;
		$this->template->content->connections = $connections;
		
		# Render view
		echo $this->template;
		
	}
	
	/*-------------------------------------------------------------------------------------------------
	Creates a row in the users_users table representing that one user is following another
	-------------------------------------------------------------------------------------------------*/
	public function follow($user_id_followed) {
	
	    # Prepare the data array to be inserted
	    $data = Array(
	        "created"          => Time::now(),
	        "user_id"          => $this->user->user_id,
	        "user_id_followed" => $user_id_followed
	        );
	
	    # Do the insert
	    DB::instance(DB_NAME)->insert('users_users', $data);
	
	    # Send them back
	    Router::redirect("/posts/users");
	
	}
	
	
	/*-------------------------------------------------------------------------------------------------
	Removes the specified row in the users_users table, removing the follow between two users
	-------------------------------------------------------------------------------------------------*/
	public function unfollow($user_id_followed) {
	
	    # Set up the where condition
	    $where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
	    
	    # Run the delete
	    DB::instance(DB_NAME)->delete('users_users', $where_condition);
	
	    # Send them back
	    Router::redirect("/posts/users");
	
	}
}