<?php 
defined('BASEPATH') OR exit ('No direct script access alloed');

class M_ajax_ad_post extends CI_model
{
	function __construct()
	{
		$this->load->database();
	}
	public function fun_get_company($v_sub_category_id=0)
	{
		
		$this->db->select('company_id,company_name');
		$this->db->from('tbl_cat_company');
		$this->db->where('sub_category_id',$v_sub_category_id);
		$query = $this->db->get();
		$result = $query->result();
		$company_id = array('');
		$company_name = array('--Select Brand--');
		foreach ($result as $value) {
			array_push($company_id,$value->company_id);
			array_push($company_name,$value->company_name);		
		}
		return array_combine($company_id, $company_name);
		
		
	}
	public function get_model_bycompany_id($v_company_id)
	{
		$this->db->select('model_id,model_name');
		$this->db->from('tbl_company_model');
		$this->db->where('company_id',$v_company_id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	public function get_job_period()
	{
		$this->db->select('*');
		$this->db->from('tbl_job_period');
		$query = $this->db->get();
		$result = $query->result();
		$job_period_id = array('');
		$job_period = array('Select...');
		foreach ($result as $value) {
			array_push($job_period_id,$value->job_period_id);
			array_push($job_period, $value->job_period_name);
		}
		return array_combine($job_period_id,$job_period);
	}
	public function get_model_bymodel_id($v_model_id)
	{
		$this->db->select('model_id,model_name');
		$this->db->from('tbl_company_model');
		$this->db->where('model_id',$v_model_id);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function get_company_byCompany_id($v_company_id)
	{
		$this->db->select('company_id,company_name');
		$this->db->from('tbl_cat_company');
		$this->db->where('company_id',$v_company_id);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;	
	}
	public function get_fuel()
	{
		$this->db->select('*');
		$this->db->from('tbl_fuel');
		$query = $this->db->get();
		$result = $query->result();
		$fuel_id = array('');
		$fuel = array('Select...');
		foreach ($result as $value) {
			array_push($fuel_id,$value->fuel_name);
			array_push($fuel, $value->fuel_name);
		}
		return array_combine($fuel_id,$fuel);
	}
	/*public function fun_get_locality_byCityId($v_city_id)
	{
		$this->db->select('locality_id,locality_name');
		$this->db->from('tbl_locality');
		$this->db->where('city_id',$v_city_id);
		$this->db->order_by('locality_name','asc');
		$query = $this->db->get();
		return $query->result();
	}*/
	public  function auto_search_city_locality($search_value=0,$element_name=0,$city_id=0)
	{
		if($element_name == 'city')
		{	
		
			$this->db->select('city_id,city_name');
			$this->db->from('tbl_city ');
			$this->db->like('city_name',$search_value,'after');
			$this->db->order_by('city_name','asc');
			//$this->db->where('status','y');
			$query = $this->db->get();
			$result = $query->result();
			return $result;
		}
		if($element_name == 'locality')
		{	
		
			$this->db->select('locality_id,locality_name');
			$this->db->from('tbl_locality ');
			$this->db->like('locality_name',$search_value,'after');
			$this->db->order_by('locality_name','asc');
			$this->db->where('city_id',$city_id);
			//$this->db->where('status','y');
			$query = $this->db->get();
			$result = $query->result();
			return $result;
		}
	}


}
?>