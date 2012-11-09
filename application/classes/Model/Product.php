<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Product extends ORM {

	
	/**
	 * Set the name of the table
	 */
	protected  $_table_name = 'products';
	
	/**
	 * A user has many tokens and roles
	 *
	 * @var array Relationhips
	 */
	protected $_has_one =  array(
		'company' => array('model' => 'companies'),
	);
	
	
	/**
	 * Rules function
	 * @see Kohana_ORM::rules()
	 */
	public function rules()
	{
		return array(
				'title' => array(
						array('not_empty'),
						array('max_length', array(':value', 254)),
						array('min_length', array(':value', 1))
				),				
				'description' => array(
						array('max_length', array(':value', 65533)),
						array('min_length', array(':value', 1))
				),
				'iframe_CSS' => array(
						array('max_length', array(':value', 65533)),
						array('min_length', array(':value', 1))
				),
				'parent_CSS' => array(
						array('max_length', array(':value', 65533)),
						array('min_length', array(':value', 1))
				),
				'company_id' => array(
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
				'variant_id' => array(
						array('not_empty'),
						array('max_length', array(':value', 254)),
						array('min_length', array(':value', 1))
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
	public function update_product($values)
	{
	
		$expected = array('title', 'description', 'company_id', 'image', 
				'x_offset', 'y_offset', 'width', 'height', 'variant_id', 'iframe_CSS', 'parent_CSS');
	
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
	public static function delete_product($id)
	{
		$product = ORM::factory('Product', $id);
		$product->delete();
	}//end function
	
} // End User Model