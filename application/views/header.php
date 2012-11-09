<div id="header">
	<div id="login_logout">
		<?php
			$user = null;
			$auth = Auth::instance();
			$logged_in = ($auth->logged_in() OR $auth->auto_login());
			if($logged_in)
			{
				$user = ORM::factory('user',$auth->get_user());
				$user_name = $user->first_name. ' ' . $user->last_name;
				echo '<span class="user_info">'.__('welcome');
				echo ' <a href="'.URL::base().'profile">'.$user_name .'</a></span> ' ;
				echo '<span class="user_action"><a href="'.URL::base().'logout">'.__('logout').'</a></span>';
			}
			else
			{
				echo '<span class="user_action">';
				echo '<a href="'.URL::base().'login">'.__('login').'</a>';
				echo ' '.__("or"). ' ';
				echo '<a href="'.URL::base().'register">'.__('register').'</a>';
				echo '</span>';
			}			
		?>
	</div>
	<!--
	<h1>
		<a href="<?php echo url::base(); ?>">
			<?php echo __('site name'); ?>
		</a>
	</h1>
	<p>
		<a href="<?php //echo url::base(); ?>">
			<?php //echo __('tagline'); ?>
		</a>
	</p>
	-->
</div>
<div id="mainMenu"><?php echo Helper_Mainmenu::make_menu($menu_page, $user);?></div>
