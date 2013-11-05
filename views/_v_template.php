<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					
	<!-- JS/CSS File we want on every page -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>				
										
	<!-- Controller Specific JS/CSS -->
	<link rel="stylesheet" href="/css/sample-app.css" type="text/css">
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
		
</head>

<body>	
	 
<?php if(isset($content)) echo $content; ?> 

<? php if(isset($client_files_body)) echo $client_files_body; ?> 
<table class="navigation" border="0" align="center">
  <tr>
    <td><nav>
		<menu> 
			<?php if($user): ?>
             <ul>
				<li><a href='/posts/add'>Add Post</a></li> 
                <li><a href='/posts/edit'>Edit Posts</a></li> 
                <li><a href='/posts/delete_p'>Delete Posts</a></li> 
				<li><a href='/posts/'>View Posts</a></li>
				<li><a href='/posts/users'>Follow users</a></li>
				<li><a href='/users/logout'>Logout</a></li>
			<?php else: ?>
				<li><a href='/users/signup'>Sign up</a></li>
				<li><a href='/users/login'>Log in</a></li>
            </ul>
			<?php endif; ?>
		</menu>
	</nav></td>
  </tr>
</table>
<p>Squeaker is an application project for CSCI E-15 at Harvard University Extension School. <br/>
Created by: Andrew Wong</p>
</body>
</html>