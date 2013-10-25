<?php 
class practice_controller extends base_controller{
/*---------------------------
-----------------------------*/



      public function test_db() {
      /* INSERT PRACTICE 
	  $q = 'INSERT INTO users
	       SET first_name = "Albert",
		       last_name = "Einstein"';
           echo $q;
      	   DB::instance(DB_NAME)->query($q); */
      
      /*  $q = 'UPDATE users
          SET email = "albert@aol.com"
          WHERE first_name = "Albert"';
	      DB::instance(DB_NAME)->query($q);
       */		  
	   /* THE WAY TO HARDCODE w/ SQL
           $new_user = Array (
             'first_name'=> 'Albert',
	         'last_name' => 'Einstein',
	         'email'=> 'albert@gmail.com',
          );
	        DB::instance(DB_NAME)->insert('users',$new_user); 
	   */
	   /*Get single item from database */
	   $_POST['first_name'] ='Albert';
	   $_POST = DB::instance(DB_NAME)->sanitize($_POST);
	   $q = 'SELECT email
	         FROM users
			 WHERE first_name ="'.$_POST['first_name'].'"';
		    echo DB::instance(DB_NAME)->select_field($q);
       }


      public function test1(){
		  require(APP_PATH.'/libraries/Image.php');
		  
          // echo APP_PATH."<br>";   generates the path of the app
		  // echo DOC_ROOT."<br>"; generates the root foler of the app
		  
		  $imageObj= new Image('http://placekitten.com/1000/1000');
		  $imageObj->resize(200,200);
         //$imageObj->display();

		  }

      public function test2(){
		  
		  # Static
		  echo Time::now();
		  }


}