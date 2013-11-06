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
		$this->template->content = View::instance("v_posts_add");
		
		echo $this->template;
	}

	public function p_add() {
        $_POST['user_id']  = $this->user->user_id;
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();
		
		DB::instance(DB_NAME)->insert('posts', $_POST);
	   
	    #Then send user back to view posts
        Router::redirect('/posts');
	}
##############################################################
     public function delete($post_id) {
       #delete the post when post id match is found  
       DB::instance(DB_NAME)->delete('posts','WHERE post_id ='.$post_id);
       
       #Then send user back to view posts
       Router::redirect('/posts');
    }  
	
	
     public function edit($post_id) {
        # Set up view
                $this->template->content = View::instance("v_posts_edit");
                
                # Set up query to get all users
                $q = 'SELECT * FROM posts WHERE post_id = '.$post_id;
                        
                # Run query
                $post = DB::instance(DB_NAME)->select_row($q);
                
                
                
                # Pass data to the view
                $this->template->content->post = $post;
                
                # Render view
                echo $this->template;

    }        
    

    public function p_edit($post_id) {
                
                $content = $_POST['content'];
                                
                # Update their row in the DB with the new token
        $data = Array(
                'content' => $content
        );
        
                DB::instance(DB_NAME)->update('posts',$data, 'WHERE post_id ='.$post_id);                
                Router::redirect('/posts');
                
        }        

##############################################################
		
	public function index() {
        $this->template->content = View::instance('v_posts_index');
		$q= 'SELECT 
               posts.post_id,
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