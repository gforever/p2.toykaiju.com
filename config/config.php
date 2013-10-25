<?php

# Http protocol
	if(!defined('PROTOCOL')) define('PROTOCOL', (isset($_SERVER['HTTPS'])) ? 'https://' : 'http://');

# App url
	if(!defined('APP_URL')) define('APP_URL', PROTOCOL.$_SERVER['HTTP_HOST'].'/');
	
# Admins	
	if(!defined('ADMINS')) define('ADMINS', serialize(Array()));
		
# All routes go through index.php	
//	define('ROUTER', 'index.php');

# All of the following constants only get set if they're not already defined by app level constants

# Set locale
	if(!defined('LOCALE')) define('LOCALE', 'en_US');
    setlocale(LC_ALL, LOCALE);
    
# Set timezone
	if(!defined('TIMEZONE')) define('TIMEZONE', 'America/New_York'); 
    date_default_timezone_set(TIMEZONE);
    
# Error reporting - default to off. Set in environment.php to turn on
	if(!defined('DISPLAY_ERRORS')) define('DISPLAY_ERRORS', FALSE);
	
	if(DISPLAY_ERRORS) 
		error_reporting(-1); // Report all PHP errors
	else 
		error_reporting(0); // Turn off all error reporting
	
# Default log location
	if(!defined('LOG_PATH')) define('LOG_PATH', APP_PATH.'logs/');

# Default time format
	if(!defined('TIME_FORMAT')) define('TIME_FORMAT', 'F j, Y g:ia'); 
	
# Default geolocation feature
	if(!defined('ENABLE_GEOLOCATION')) define('ENABLE_GEOLOCATION', TRUE);
	
# Default encrypting salts	
	if(!defined('PASSWORD_SALT')) define('PASSWORD_SALT', 'Rft&xw^WWz)x-mr2&M9P0MinjGag6tRJbLgVwXo*'); 
	if(!defined('TOKEN_SALT')) define('TOKEN_SALT', 'kNX6dtnDOkd7D%muL2jHQcJP1!rb8AnGGnx%CjjU'); 

# Default Image / Avatar settings
	if(!defined('AVATAR_PATH')) define('AVATAR_PATH', "/uploads/avatars/");
	if(!defined('SMALL_W')) define('SMALL_W', 200);
	if(!defined('SMALL_H')) define('SMALL_H', 200);
	if(!defined('PLACE_HOLDER_IMAGE')) define('PLACE_HOLDER_IMAGE', "/core/images/placeholder.png");

# Default app settings
	if(!defined('APP_EMAIL')) define('APP_EMAIL', 'awong@fas.harvard.edu'); # Should match domain name to avoid hitting the spam box
	if(!defined('APP_NAME')) define('APP_NAME', 'Toykaiju Blog'); # Should match domain name to avoid hitting the spam box
	if(!defined('SYSTEM_EMAIL')) define('SYSTEM_EMAIL', 'akwong84@gmail.com'); 
	
# Default DB name for this app
    define('DB_NAME', 'p2_toykaiju-practice.com');
		

# Whether or not to send outgoing emails - default to on.
# Overide in environment.php
# Typically you'll always want this false in local and true in live.
# When it's on false, it will send any emails that are triggered, they just get sent to the SYSTEM_EMAIL instead of the actual recipients.
# It's good for working on local so you can still see emails going out, but not accidentally spam users.
	if(!defined('ENABLE_OUTGOING_EMAIL')) define('ENABLE_OUTGOING_EMAIL', TRUE);
		
# Re-route all emails to a folder using Fakemail. 
# When this is on, it will use the user's true email address instead of cloaking it with SYSTEM_EMAIL should ENABLE_OUTGOING_EMAIL be set to false
# https://github.com/matschaffer/fakemail	
	if(!defined('FAKEMAIL')) define('FAKEMAIL', FALSE);
	
# Example settings:
# ENABLE_OUTGOING_EMAIL = TRUE, FAKEMAIL  = FALSE... email goes to user's true address - production
# ENABLE_OUTGOING_EMAIL = FALSE, FAKEMAIL = FALSE... all emails end up in SYSTEM_EMAIL - dev

# ENABLE_OUTGOING_EMAIL = TRUE, FAKEMAIL  = TRUE... email goes to fakemail with true address - dev
# ENABLE_OUTGOING_EMAIL = FALSE, FAKEMAIL = TRUE... email goes to fakemail with true address - dev
