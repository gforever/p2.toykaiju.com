<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
     //   echo "users_controller construct called<br><br>";
    } 

    public function index() {
        echo "This is the index page";
    }

    public function signup() {
		#set up the view
		$this->template->content = View::instance('v_users_signup');		        
		#render the view
		echo $this->template;
    }
	
	public function p_signup(){
	    
		$_POST['created'] = Time::now();
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
    	$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
		
	    echo"<pre>";
		print_r($_POST);
		echo"<pre>";
		
		DB::instance(DB_NAME)->insert_row('users', $_POST);
		#Send them to the login page
		//Router::redirect('/users/login');
	}

    public function login() {
		$this->template->content = View::instance('v_users_login');
		echo $this->template; 
    }
	
	public function p_login(){
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
		echo"<pre>";
		print_r($_POST);
		echo"<pre>";
		
		$q = 
		     'SELECT token
			 FROM users
			 WHERE email = "'.$_POST['email'].'"
			 AND password ="'.$_POST['password'].'"';
		
		$token = DB::instance(DB_NAME)->select_field($q);
		#echo $token;
		#Sucess
		if($token){
			setcookie('token',$token,strtotime('+1 year'), '/');
		   echo "You are logged in!";
		}
		#Fail
		else{
			echo "Login Failed!";
			}
	}

    public function logout() {
        echo "This is the logout page";
    }

    public function profile($user_name = NULL) {
        #Set up the view
		$this->template->content = View::instance('v_users_profile');
		$this->template->title = "Profile";
	    
		#Load client files	
        $client_files_head = Array(
		'/css/profile.css', 
		);
		
		$this->template->client_files_head = Utils::load_client_files($client_files_head);

     $client_files_body = Array(
		'/js/profile.js',
		
		);
		
		$this->template->client_files_body = Utils::load_client_files($client_files_body);

        #Pass the data to the view
		$this->template->content->user_name = $user_name;

        #Display the view
		echo $this->template;
    }

} # end of the class