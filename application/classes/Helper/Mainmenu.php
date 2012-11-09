<?php defined('SYSPATH') or die('No direct access allowed.');

class Helper_Mainmenu
{
	public static function make_menu($page, $user)
	{
		$end_div = false;
		echo '<ul>';
		
		//Don't show the register link if the user is logged in
		if($user == null)
		{
			//register page
			if($page == "register")
			{
				echo '<li class="selected">';
			}
			else
			{
				echo '<li>';
			}
			echo '<a href="'.url::base().'register">'.__("register").'</a></li>';
		}
		
		//if the user is logged in
		if($user != null)
		{
			$login_role = ORM::factory('Role')->where("name", "=", "login")->find();

			if($user->has('roles', $login_role))
			{
				
				// home page
				if($page == "home")
				{
					echo '<li class="selected">';
				}
				else
				{
					echo '<li>';
				}
				echo '<a href="'.url::base().'main">'.__("home").'</a></li>';
			}
		
		
		
			
			//see if the given user is an admin, if so they can do super cool stuff
			$admin_role = ORM::factory('Role')->where("name", "=", "admin")->find();
			if($user->has('roles', $admin_role))
			{
				$end_div = false;
				if($page == "companies")
				{
					echo '<li class="adminmenu selected">';
				}
				else
				{
					echo '<li class="adminmenu">';
				}
				echo '<a href="'.url::base().'companies">'.__("companies").'</a></li>';
				
			}
		}//end is logged in
		
		echo '</ul>';
		echo '<p style="clear:both;"></p>';
		if($end_div)
		{
			echo '</div>';
		}
		
		
	}//end function
}//end class
