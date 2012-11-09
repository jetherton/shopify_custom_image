<?php defined('SYSPATH') or die('No direct script access.');
/***********************************************************
* forms.php - Controller
* This software is copy righted by Etherton Technologies Ltd. 2011
* Writen by John Etherton <john@ethertontech.com>
* Started on 12/06/2011
*************************************************************/

class Controller_Companies extends Controller_Admin {


  	
	/**
	where users go to change their profiel
	*/
	public function action_index()
	{
		/***** initialize stuff****/
		//The title to show on the browser
		$this->template->html_head->title = __("Companies");
		//make messages roll up when done
		$this->template->html_head->messages_roll_up = true;
		//the name in the menu
		$this->template->header->menu_page = "companies";
		$this->template->content = view::factory("companies");
		$this->template->content->errors = array();
		$this->template->content->messages = array();
		//set the JS
		$js = view::factory('/companies_js');
		$this->template->html_head->script_views[] = $js;
		$this->template->html_head->script_views[] = view::factory('js/messages');
		
		/********Check if we're supposed to do something ******/
		if(!empty($_POST)) // They've submitted the form to update his/her wish
		{
			try
			{	
				if($_POST['action'] == 'delete')
				{
					Model_Company::delete_company($_POST['company_id']);
					$this->template->content->messages[] = __('form deleted');
				}
			}
			catch (ORM_Validation_Exception $e)
			{
				$errors_temp = $e->errors('register');
				if(isset($errors_temp["_external"]))
				{
					$this->template->content->errors = array_merge($errors_temp["_external"], $this->template->content->errors);
				}				
				else
				{
					foreach($errors_temp as $error)
					{
						if(is_string($error))
						{
							$this->template->content->errors[] = $error;							
						}
					}
				}
			}	
		}
		
				
		/*****Render the forms****/
		
		//get all the companies
		$companies = ORM::factory("Company")
			->order_by('name', 'ASC')
			->find_all();
		
		
		$this->template->content->companies = $companies;
		
		
	}//end action_index
	
	
	
	/**
	 * the function for editing a form
	 * super exciting
	 */
	 public function action_edit()
	 {
		//initialize data
		$data = array(
			'id'=>'0',
			'name'=>'',
			'description'=>'',
			);
			
		
		
		 
		/*** Make sure we have the right form ***/		
		//first order of business, get that id, if there is one
		$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

		//if it's 0 then we're adding a form
		if($id == 0)
		{
			$company = null;
			$is_add = "true";
		}
		else
		{
			$is_add = "false";
			//get the form
			$company = ORM::factory('Company', $id);

			//does the form exist?
			if(!$company->loaded())
			{
			 HTTP::redirect('companies');
			}
			$data['id'] = $company->id;
			$data['name'] = $company->name;
			$data['description'] = $company->description;
		}
		
		/***Now that we have the form, lets initialize the UI***/
		//The title to show on the browser
		$header = $company ? __("Edit Company") . ' :: '. $company->name : __("Add Company") ;
		$this->template->html_head->title = $header;		
		//make messages roll up when done
		$this->template->html_head->messages_roll_up = true;
		//the name in the menu
		$this->template->header->menu_page = "companies";
		$this->template->content = view::factory("company_edit");
		$this->template->content->errors = array();
		$this->template->content->messages = array();
		$this->template->content->header = $header;
		//set the JS
		$js = view::factory('company_edit_js');
		$js->is_add = $is_add;
		$this->template->html_head->script_views[] = $js;
		$this->template->html_head->script_views[] = view::factory('js/messages');
		
		//get the status
		$status = isset($_GET['status']) ? $_GET['status'] : null;
		if($status == 'saved')
		{
				$this->template->content->messages[] = __('changes saved');
		}
		
		/******* Handle incoming data*****/
		if(!empty($_POST)) // They've submitted the form to update his/her wish
		{
			try
			{
				//if we're editing things
				if($_POST['action'] == 'edit')
				{
					//new cat or existing cat?
					if($id == 0)
					{
						$company = ORM::factory('Company');
					}
					else
					{
						$company = ORM::factory('Company', $id);
					}
					
					$company->update_company($_POST);
				}
				
				else if($_POST['action'] == 'delete')
				{
					Model_Company::delete_form($_POST['company_id']);
				}
				
				else if($_POST['action'] == 'delete_product')
				{
					Model_Formfields::delete_formfield($_POST['form_id']);
				}
				
				HTTP::redirect('companies/edit?id='.$company->id.'&status=saved');
			}
			catch (ORM_Validation_Exception $e)
			{
				$errors_temp = $e->errors('register');
				if(isset($errors_temp["_external"]))
				{
					$this->template->content->errors = array_merge($errors_temp["_external"], $this->template->content->errors);
				}				
				else
				{
					foreach($errors_temp as $error)
					{
						if(is_string($error))
						{
							$this->template->content->errors[] = $error;							
						}
					}
				}
			}	
		}
		
		
		
		/**** Finish setting things up ****/
		
		
		//form fields
		$products = ORM::factory('Product')->
			where('company_id', '=', $id)->
			find_all();
		$this->template->content->products = $products;
		
		
		
		
		$this->template->content->data = $data;
		
		 
	 }//end action_edit
	
	
}//end of class
