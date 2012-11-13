<?php defined('SYSPATH') or die('No direct script access.');
/***********************************************************
* forms.php - Controller
* This software is copy righted by Etherton Technologies Ltd. 2011
* Writen by John Etherton <john@ethertontech.com>
* Started on 12/06/2011
*************************************************************/

class Controller_Products extends Controller_Admin {


  	/**
	 * the function for editing a form
	 * super exciting
	 */
	 public function action_index()
	 {
		//initialize data
		$data = array(
			'id'=>'0',
			'title'=>'',
			'description'=>'',
			'company_id'=>'',
			'image'=>'',
			'x_offset'=>'',
			'y_offset'=>'',
			'width'=>'',
			'height'=>'',
			'variant_id'=>'',
			'iframe_CSS'=>'',
			'parent_CSS'=>'',
			'order_id'=>0,
			);
			
		
		
		 
		/*** Make sure we have the right form ***/		
		//first order of business, get that id, if there is one
		$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
		$company_id = isset($_GET['company']) ? intval($_GET['company']) : 0;

		//if it's 0 then we're adding a product, there better be a company id
		if($id == 0)
		{
			$product = null;
			$is_add = "true";
			if($company_id == 0)
			{
				HTTP::redirect('companies');
			}
			$data['company_id'] = $company_id;
			//is the user part of this company or an admin
			if($this->role->name != 'admin' AND $this->user->company_id != $company_id)
			{
				HTTP::redirect('companies/edit?id='.$company_id);
			}
		}
		else
		{
			$is_add = "false";
			//get the form
			$product = ORM::factory('Product', $id);

			//does the form exist?
			if(!$product->loaded())
			{
				HTTP::redirect('companies');
			}
			
			if($this->role->name != 'admin' AND $this->user->company_id != $product->company_id)
			{
				HTTP::redirect('companies/edit?id='.$product->company_id);
			}
		
		}
		
		/***Now that we have the form, lets initialize the UI***/
		//The title to show on the browser
		$header = $product ? __("Edit Product") . ' :: '. $product->title : __("Add Product") ;
		$this->template->html_head->title = $header;		
		//make messages roll up when done
		$this->template->html_head->messages_roll_up = true;
		//the name in the menu
		$this->template->header->menu_page = "companies";
		$this->template->content = view::factory("products_edit");
		$this->template->content->errors = array();
		$this->template->content->messages = array();
		$this->template->content->header = $header;
		//set the JS
		$js = view::factory('products_edit_js');
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
						$_POST['image'] = $_FILES['image']['name'];
						$product = ORM::factory('Product');
					}
					else
					{
						$product = ORM::factory('Product', $id);
					}					
					$product->update_product($_POST);
					//handle the image
					$filename = $this->_save_image($_FILES['image'], $product);
					if ( ! $filename)
					{
						$this->template->content->errors[] = 'There was a problem while uploading the image.
						Make sure it is uploaded and must be JPG/PNG/GIF file.';
					}
					else
					{
						
						$product->image = basename($filename);
						$product->save();
					}
				}
				
				else if($_POST['action'] == 'delete_order')
				{
					Model_Order::delete_order($_POST['order_id']);
				}
				
				else if($_POST['action'] == 'delete_order')
				{
					Model_Order::delete_order($_POST['order_id']);
				}
				
				HTTP::redirect('products?id='.$product->id.'&status=saved');
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
		
		if($id != 0)
		{
			$data['id'] = $product->id;
			$data['title'] = $product->title;
			$data['description'] = $product->description;
			$data['company_id'] = $product->company_id;
			$data['image'] = $product->image;
			$data['x_offset'] = $product->x_offset;
			$data['y_offset'] = $product->y_offset;
			$data['width'] = $product->width;
			$data['height'] = $product->height;
			$data['variant_id'] = $product->variant_id;
			$data['iframe_CSS'] = $product->iframe_CSS;
			$data['parent_CSS'] = $product->parent_CSS;
		}
		
		
		/**** Finish setting things up ****/
		
		
		//form fields
		$orders = ORM::factory('Order')->
			where('product_id', '=', $id)->
			order_by('date', 'ASC')->
			find_all();
		$this->template->content->orders = $orders;
		
		
		
		
		$this->template->content->data = $data;
		
		 
	 }//end action_edit
	 
	 
	 
	 protected function _save_image($image, $product)
	 {
	 	if (
	 			! Upload::valid($image) OR
	 			! Upload::not_empty($image) OR
	 			! Upload::type($image, array('jpg', 'jpeg', 'png', 'gif')))
	 	{
	 		return FALSE;
	 	}
	 
	 	$directory = DOCROOT.'uploads/';
	 
	 	if ($file = Upload::save($image, NULL, $directory))
	 	{
	 		$filename = $product->company_id.'-'.$product->id.'.png';
	 		
	 		if(file_exists($directory.$filename))
	 		{
	 			unlink($directory.$filename);
	 		}
	 
	 		Image::factory($file)
	 		->save($directory.$filename);
	 
	 		// Delete the temporary file
	 		unlink($file);
	 
	 		return $filename;
	 	}
	 
	 	return FALSE;
	 }
	
	
}//end of class
