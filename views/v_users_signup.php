<h2>Sign Up</h2>

<form method='POST' action='/users/p_signup'>

	First name: <input type='text' name='first_name' required><br /> 
	Last name: <input type='text' name='last_name' required><br />
	Email: <input type='email' name='email' required><br />
	Password: <input type='password' name='password' required><br />
        <?php if(isset($error)): ?>
        <div class='error'>
            Sign up failed. E-Mail address already registered.
        </div>
        <br>
    <?php endif; ?>	
	<input type='submit' value='Sign Up'>
</form>
