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
	 
<table class="navigation" border="0" align="center">
  <tr>
    <td><nav>
		<menu> 
            <img src="/imgs/sqeaker_mini.png" width="128" height="74" class="minilogo" alt="Sqeaker_mini_logo" />   
            <br />
			<?php if($user): ?>
             <ul>
				<li><a href='/posts/add'>New Sqeak</a></li> 
				<li><a href='/posts/'>View Sqeaks</a></li>
				<li><a href='/posts/users'>Follow Sqeakers</a></li>
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
<?php if(isset($content)) echo $content; ?> 
<?php if(isset($client_files_body)) echo $client_files_body; ?> 

<p class="footnote">Squeaker is an application project for CSCI E-15 at Harvard University Extension School. <br/>
Created by: Andrew Wong</p>
</body>
</html>