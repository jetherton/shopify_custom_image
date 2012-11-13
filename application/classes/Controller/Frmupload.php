<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frmupload extends Controller_Main {

	public $template = 'main';
	
	public function before()
	{
		
		parent::before();
		$this->template->html_head = "";
		$this->template->header = "";
		$this->template->footer = "";
	}
	
	public function action_index()
	{
		
		$order = null;
		$company_id = intval($_GET['c']);
		$product_id = isset($_GET['p']) ? $_GET['p']: 0;
		$shopify_product_id = isset($_GET['sp']) ? $_GET['sp']: 0;
		
		$order_id = isset($_POST['order_id']) ? intval($_POST['order_id']): 0;
		$guid = isset($_GET['g']) ? $_GET['g']: 0;

		if($guid === 0)
		{
			$guid = isset($_POST['GUID']) ? $_POST['GUID']: 0;
			if($guid === 0)
			{
				echo "no GUID";
				exit;
			}
		}
		
		if($product_id !== 0)
		{
			$product = ORM::factory('Product', $product_id);
			$shopify_product_id = $product->variant_id;
		}
		else
		{
			$product = ORM::factory('Product')
				->where('variant_id', '=', $shopify_product_id)
				->find();
			$product_id = $product->id;
		}
		
		if(!$product->loaded())
		{
			exit;
		}

		if($_POST)
		{
			//create or grab the order
			if($order_id == 0 )
			{
				$order = ORM::factory('Order');
				$data = array('product_id' => $product_id,
					'image' => 'xx',
					'x_offset' => $product->x_offset,
					'y_offset' => $product->y_offset,
					'height' => $product->height,
					'width' => $product->width,
					'note' => 'xx',
					'date' => date('Y-m-d G:i'),			
					'GUID' => $guid, 					
				);
				$order->update_order($data);
			}
			else
			{
				$order = ORM::factory('Order', $order_id);
			}

			
			//save the newly uploaded file
			$file_name = $this->_save_image($_FILES["image"], $order, $product);
			$order->image = $file_name;
			$order->save();			
			
			
			
		}
		
			$css_view = View::factory('css_view');
			$css_view->css = $product->iframe_CSS;
			$this->template->html_head = $css_view;
			$this->template->html_head .= '<link rel="stylesheet" type="text/css" href="'.URL::base().'media/css/iframe.css">';
			if($order != null)
			{
				$this->template->html_head .= '<script type="text/javascript" src="'.URL::base().'media/js/jquery.min.js"></script>';
				$js_view = View::factory('upload_js');
				$js_view->order_id = $order->id;
				$js_view->guid = $guid;
				$this->template->html_head .= $js_view;
			} 
			
			$this->template->content = View::factory('upload');
			$this->template->content->order = $order;
			$this->template->content->guid = $guid;
			$this->template->content->product_id = $product_id;
			$this->template->content->company_id = $company_id;
			$this->template->content->product = $product;
		
	}
	
	
	
	
	public function action_user_view()
	{
	
		$order = null;
	

		$guid = isset($_GET['g']) ? $_GET['g']: 0;
	
		if($guid === 0)
		{
			echo "no GUID";
			exit;
		}

		$order = ORM::factory('Order')
			->where('GUID', '=', $guid)
			->find();
	
		if(!$order->loaded())
		{
			exit;
		}
	
		$product = ORM::factory('Product', $order->product_id);
		
			
		$this->template->content = View::factory('user_order_view');
		$this->template->content->order = $order;
		$this->template->content->guid = $guid;
		$this->template->content->product = $product;
	
	}
	
	
	
	public function action_css()
	{
		//set the header
		Request::current()->headers('Content-type', 'text/css');
		header("Content-type: text/css");
		
		//we'll render out selves
		$this->template = '';
		$this->auto_render = FALSE;
		
		$company_id = intval($_GET['c']);
		$product_id = isset($_GET['p']) ? $_GET['p']: 0;
		$shopify_product_id = isset($_GET['sp']) ? $_GET['sp']: 0;
		if($product_id !== 0)
		{
			$product = ORM::factory('Product', $product_id);
		}
		else
		{
			$product = ORM::factory('Product')
				->where('variant_id', '=',$shopify_product_id)
				->find();
		}
		
		
		
		echo $product->parent_CSS;
		exit;
		
	}
	
	
	public function action_position()
	{
		
	
		//we'll render out selves
		$this->template = '';
		$this->auto_render = FALSE;
	
		
		$order_id = isset($_GET['o']) ? $_GET['o']: 0;
		$position = isset($_GET['p']) ? $_GET['p']: null;
		$direction = isset($_GET['d']) ? $_GET['d']: null;
		
		if($order_id !== 0 AND $position != null AND $direction != null)
		{
			$order = ORM::factory('Order', $order_id);
			if($direction == "left")
			{
				$order->x_offset = $position;				
			}
			else
			{
				$order->y_offset = $position;
			}
			$order->save();
			echo "success";
			exit;
		}
		
	
	
	
		echo "invalid input";
		exit;
	
	}
	
	
	protected function _save_image($image, $order, $product)
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
			$filename = 'order-'.$order->GUID.'.png';
	
			if(file_exists($directory.$filename))
			{
				unlink($directory.$filename);
			}
	
			$pic = Image::factory($file);
			$pic->save($directory.$filename);
			
			//now we're going to make sure things are resized correctly
			$width = $pic->width;
			$height = $pic->height;
			
			//figure out what to resize
			$what_to_resize = 0;
			if($width > $product->width)
			{
				$what_to_resize += 1;
			}
			if($height > $product->height)
			{
				$what_to_resize += 2;
			}
			switch($what_to_resize)
			{
				case 0: //smaller
					$order->width = $width;
					$order->height = $height;
					break; 
				case 1: //width
					$order->width = $product->width;
					$order->height = intval((floatval($height)/floatval($width)) * floatval($product->width));
					break;
				case 2: //height
					$order->height = $product->height;
					$order->width = intval((floatval($width)/floatval($height)) * floatval($product->height));
					break;
				case 3: //both
					if($width > $height)
					{ //width
						$order->width = $product->width;
						$order->height = intval((floatval($height)/floatval($width)) * floatval($product->width));
					}
					else
					{ //height
						$order->height = $product->height;
						$order->width = intval((floatval($width)/floatval($height)) * floatval($product->height));
					}
					break;
					$order->save();
			}
	
			// Delete the temporary file
			unlink($file);
	
			return $filename;
		}
	
		return FALSE;
	}

} // End Welcome
