<?php defined('SYSPATH') or die('No direct script access.');
/***********************************************************
* home.php - Controller
* This software is copy righted by Etherton Technologies Ltd. 2011
* Writen by John Etherton <john@ethertontech.com>
* Started on 8/20/2011
*************************************************************/

class Controller_Admin extends Controller_Main {

	/**
	Set stuff up
	*/
	public function before()
	{
		parent::before();

		$this->auth = Auth::instance();
		//is the user logged in?
		if(($this->auth->logged_in() || $this->auth->auto_login()))
		{
			$this->user = ORM::factory('user',$this->auth->get_user());
			//have we verified this user's email?
			/*
			if(intval($this->user->email_verified) == 0)
			{
				//record where the user was trying to go
				$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
				Session::instance()->set('returnUrl',$url);
				HTTP::redirect('register/verify');
			}
			*/
		}
		//if not send them to the login page
		else
		{
			//record where the user was trying to go
			$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
			Session::instance()->set('returnUrl',$url);			
			HTTP::redirect('login');
		}
		
	}
	
	
  	
	/**
	where users go to sign up
	*/
	public function action_index()
	{
		
	
		$this->template->html_head->title = __("home");
		$this->template->header->menu_page = "home";
		$this->template->content = "hi you're an admin";
		
	
	
	}
	
	
} // End Welcome
