<?php defined('SYSPATH') or die('No direct script access.');
/***********************************************************
* Orders.php - Controller
* This software is copy righted by Etherton Technologies Ltd. 2011
* Writen by John Etherton <john@ethertontech.com>
* Started on 12/06/2011
*************************************************************/

class Controller_Orders extends Controller_Admin {


  	/**
	 * the function for editing a form
	 * super exciting
	 */
	 public function action_index()
	 {
	 			
		$view = View::factory('order_detail');
		$view->error = null;
		 
		/*** Make sure we have the right form ***/		
		//first order of business, get that id, if there is one
		$guid = isset($_GET['g']) ? intval($_GET['g']) : 0;
		
		if($guid === 0)
		{
			$view->order = null;
			$view->error = __('Not a valid order ID');
			return;			
		}		
		
		$order = ORM::factory('Order')
			->where('GUID', '=', $guid)
			->find();

		if(!$order->loaded())
		{
			$view->order = null;
			$view->error = __('The given order can not be found');
			return;
		}
		
		$product = ORM::factory('Product', $order->product_id);
		
		//so now that we have an order, lets see if the given user can view it
		//if they aren't an admin we have to check if they are part of the given company
		if($this->role->name != 'admin')
		{
			if($this->user->company_id != $product->company_id)
			{
				HTTP::redirect('companies/edit?id='.$this->user->company_id);
			}
		}
		
		$view->order = $order;
		$view->product = $product;
		$this->template->content = $view;
	 }
}//end of class
