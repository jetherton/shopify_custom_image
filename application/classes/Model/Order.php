<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Order extends ORM {

	
	/**
	 * Set the name of the table
	 */
	protected  $_table_name = 'purchases';
	
		
	
	/**
	 * Rules function
	 * @see Kohana_ORM::rules()
	 */
	public function rules()
	{
		return array(
				'product_id' => array(
						array('not_empty'),
				),
				'image' => array(
						array('max_length', array(':value', 254)),
						array('min_length', array(':value', 1)),
						array('not_empty'),
				),
				'x_offset' => array(
						array('not_empty'),
				),
				'y_offset' => array(
						array('not_empty'),
				),
				'width' => array(
						array('not_empty'),
				),
				'height' => array(
						array('not_empty'),
				),
				'note' => array(
						array('not_empty'),
				),
				'date' => array(
						array('not_empty'),
				),
				'GUID'=> array(
						array('max_length', array(':value', 254)),
						array('min_length', array(':value', 1)),
						array('not_empty'),
				),
		);
	}//end function
	
	
	/**
	 * Update an existing product
	 *
	 * Example usage:
	 * ~~~
	 * $form = ORM::factory('product', $id)->update_product($_POST);
	 * ~~~
	 *
	 * @param array $values
	 * @throws ORM_Validation_Exception
	 */
	public function update_order($values)
	{
	
		$expected = array('product_id', 'image', 'x_offset', 'y_offset', 'width', 'height', 'note', 'date', 'GUID');
	
		$this->values($values, $expected);
		$this->check();
		$this->save();
	}//end function
	
	
	/**
	 * Delete a company and keep the ordering in tact
	 *
	 * Model_Form::delete($id);
	 *
	 * @param id $id - the ID of the company you want to delete
	 * */
	public static function delete_order($id)
	{
		$order = ORM::factory('Order', $id);
		$directory = DOCROOT.'uploads/';
		if(file_exists($directory.$order->image))
		{
			unlink($directory.$order->image);
		}
		$order->delete();
	}//end function
	
} // End User Model