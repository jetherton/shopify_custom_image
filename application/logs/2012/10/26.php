<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2012-10-26 20:28:14 --- EMERGENCY: Kohana_Exception [ 0 ]: A valid cookie salt is required. Please set Cookie::$salt. ~ SYSPATH/classes/Kohana/Cookie.php [ 152 ] in /var/www/user_image_superimpose/system/classes/Kohana/Cookie.php:67
2012-10-26 20:28:14 --- DEBUG: #0 /var/www/user_image_superimpose/system/classes/Kohana/Cookie.php(67): Kohana_Cookie::salt('PHPSESSID', NULL)
#1 /var/www/user_image_superimpose/system/classes/Kohana/Request.php(155): Kohana_Cookie::get('PHPSESSID')
#2 /var/www/user_image_superimpose/index.php(117): Kohana_Request::factory(true, Array, false)
#3 {main} in /var/www/user_image_superimpose/system/classes/Kohana/Cookie.php:67
2012-10-26 19:33:47 --- EMERGENCY: ErrorException [ 2 ]: Attempt to assign property of non-object ~ APPPATH/classes/Controller/Welcome.php [ 9 ] in /var/www/user_image_superimpose/application/classes/Controller/Welcome.php:9
2012-10-26 19:33:47 --- DEBUG: #0 /var/www/user_image_superimpose/application/classes/Controller/Welcome.php(9): Kohana_Core::error_handler(2, 'Attempt to assi...', '/var/www/user_i...', 9, Array)
#1 /var/www/user_image_superimpose/system/classes/Kohana/Controller.php(69): Controller_Welcome->before()
#2 [internal function]: Kohana_Controller->execute()
#3 /var/www/user_image_superimpose/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Welcome))
#4 /var/www/user_image_superimpose/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /var/www/user_image_superimpose/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/user_image_superimpose/index.php(118): Kohana_Request->execute()
#7 {main} in /var/www/user_image_superimpose/application/classes/Controller/Welcome.php:9
2012-10-26 19:34:39 --- EMERGENCY: View_Exception [ 0 ]: The requested view upload could not be found ~ SYSPATH/classes/Kohana/View.php [ 257 ] in /var/www/user_image_superimpose/system/classes/Kohana/View.php:137
2012-10-26 19:34:39 --- DEBUG: #0 /var/www/user_image_superimpose/system/classes/Kohana/View.php(137): Kohana_View->set_filename('upload')
#1 /var/www/user_image_superimpose/system/classes/Kohana/View.php(30): Kohana_View->__construct('upload', NULL)
#2 /var/www/user_image_superimpose/application/classes/Controller/Welcome.php(20): Kohana_View::factory('upload')
#3 /var/www/user_image_superimpose/system/classes/Kohana/Controller.php(84): Controller_Welcome->action_index()
#4 [internal function]: Kohana_Controller->execute()
#5 /var/www/user_image_superimpose/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Welcome))
#6 /var/www/user_image_superimpose/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /var/www/user_image_superimpose/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/user_image_superimpose/index.php(118): Kohana_Request->execute()
#9 {main} in /var/www/user_image_superimpose/system/classes/Kohana/View.php:137
2012-10-26 19:35:11 --- EMERGENCY: View_Exception [ 0 ]: The requested view upload could not be found ~ SYSPATH/classes/Kohana/View.php [ 257 ] in /var/www/user_image_superimpose/system/classes/Kohana/View.php:137
2012-10-26 19:35:11 --- DEBUG: #0 /var/www/user_image_superimpose/system/classes/Kohana/View.php(137): Kohana_View->set_filename('upload')
#1 /var/www/user_image_superimpose/system/classes/Kohana/View.php(30): Kohana_View->__construct('upload', NULL)
#2 /var/www/user_image_superimpose/application/classes/Controller/Welcome.php(21): Kohana_View::factory('upload')
#3 /var/www/user_image_superimpose/system/classes/Kohana/Controller.php(84): Controller_Welcome->action_index()
#4 [internal function]: Kohana_Controller->execute()
#5 /var/www/user_image_superimpose/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Welcome))
#6 /var/www/user_image_superimpose/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /var/www/user_image_superimpose/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/user_image_superimpose/index.php(118): Kohana_Request->execute()
#9 {main} in /var/www/user_image_superimpose/system/classes/Kohana/View.php:137
2012-10-26 19:35:12 --- EMERGENCY: View_Exception [ 0 ]: The requested view upload could not be found ~ SYSPATH/classes/Kohana/View.php [ 257 ] in /var/www/user_image_superimpose/system/classes/Kohana/View.php:137
2012-10-26 19:35:12 --- DEBUG: #0 /var/www/user_image_superimpose/system/classes/Kohana/View.php(137): Kohana_View->set_filename('upload')
#1 /var/www/user_image_superimpose/system/classes/Kohana/View.php(30): Kohana_View->__construct('upload', NULL)
#2 /var/www/user_image_superimpose/application/classes/Controller/Welcome.php(21): Kohana_View::factory('upload')
#3 /var/www/user_image_superimpose/system/classes/Kohana/Controller.php(84): Controller_Welcome->action_index()
#4 [internal function]: Kohana_Controller->execute()
#5 /var/www/user_image_superimpose/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Welcome))
#6 /var/www/user_image_superimpose/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /var/www/user_image_superimpose/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/user_image_superimpose/index.php(118): Kohana_Request->execute()
#9 {main} in /var/www/user_image_superimpose/system/classes/Kohana/View.php:137
2012-10-26 19:43:12 --- EMERGENCY: ErrorException [ 1 ]: Class 'url' not found ~ APPPATH/views/upload.php [ 10 ] in :
2012-10-26 19:43:12 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2012-10-26 19:44:20 --- EMERGENCY: ErrorException [ 1 ]: Class 'url' not found ~ APPPATH/views/manipulate.php [ 5 ] in :
2012-10-26 19:44:20 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2012-10-26 19:53:42 --- EMERGENCY: ErrorException [ 2 ]: move_uploaded_file(/var/www/user_image_superimpose/uploads/1351302822_john.png): failed to open stream: No such file or directory ~ APPPATH/classes/Controller/Welcome.php [ 22 ] in :
2012-10-26 19:53:42 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'move_uploaded_f...', '/var/www/user_i...', 22, Array)
#1 /var/www/user_image_superimpose/application/classes/Controller/Welcome.php(22): move_uploaded_file('/tmp/phpWYb3w5', '/var/www/user_i...')
#2 /var/www/user_image_superimpose/system/classes/Kohana/Controller.php(84): Controller_Welcome->action_index()
#3 [internal function]: Kohana_Controller->execute()
#4 /var/www/user_image_superimpose/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Welcome))
#5 /var/www/user_image_superimpose/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /var/www/user_image_superimpose/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/user_image_superimpose/index.php(118): Kohana_Request->execute()
#8 {main} in :