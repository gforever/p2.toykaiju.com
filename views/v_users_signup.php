<h2>Sign Up</h2>

<form method='POST' action='/users/p_signup'>

	First name: <input type='text' name='first_name'><br>
	Last name: <input type='text' name='last_name'><br>
	Email: <input type='text' name='email'><br>
	Password: <input type='password' name='password'><br>
    
    <?php if(isset($error)): ?>
        <div class='error'>
            Sign up failed. E-Mail address already registered.
        </div>
        <br>
    <?php endif; ?>
	
	<input type='submit' value='Sign Up'>

</form>