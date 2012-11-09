<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Company extends ORM {

	
	/**
	 * Set the name of the table
	 */
	protected  $_table_name = 'companies';
	
	/**
	 * A user has many tokens and roles
	 *
	 * @var array Relationhips
	 */
	protected $_has_many =  array(
		'products' => array('model' => 'products'),
	);
	
	
	/**
	 * Rules function
	 * @see Kohana_ORM::rules()
	 */
	public function rules()
	{
		return array(
				'name' => array(
						array('not_empty'),
						array('max_length', array(':value', 254)),
						array('min_length', array(':value', 1))
				),				
				'description' => array(
						array('max_length', array(':value', 65533)),
						array('min_length', array(':value', 1))
				),
		);
	}//end function
	
	
	/**
	 * Update an existing company
	 *
	 * Example usage:
	 * ~~~
	 * $form = ORM::factory('company', $id)->update_company($_POST);
	 * ~~~
	 *
	 * @param array $values
	 * @throws ORM_Validation_Exception
	 */
	public function update_company($values)
	{
	
		$expected = array('name', 'description');
	
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
	public static function delete_company($id)
	{
		$company = ORM::factory('company', $id);
		$company->delete();
	}//end function
	
} // End User Model