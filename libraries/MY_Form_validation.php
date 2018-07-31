<?php 
defined('BASEPATH') OR exit('NO direct script access allowed');

class MY_form_validation extends CI_Form_validation
{
	public function resetpostdata()
	{
		$obj =& _get_validation_object();
		foreach ($obj->_field_data as $key) {
			
			$this->_field_data[$key['field']]['postdata'] = null;
		}
		return true;
	}
}

?>