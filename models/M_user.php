<?php 
defined('BASEPATH') OR exit ('No direct script access alloed');

class M_user extends CI_model
{
	function __construct()
	{
		$this->load->database();
	}
	/*public function get_category()
	{
		
		$this->db->select('*');
		$this->db->from('tbl_category');
		$this->db->where('status',1);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	public function get_category_sub_category() // use in ad-post and category page
	{
		$this->db->select('*');
		$this->db->from('tbl_category as c');
		$this->db->join('tbl_sub_category as s','c.category_id=s.category_id');
		$this->db->where('c.status',1);
		$this->db->where('s.status',1);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}*/
	/*public function get_city()
	{
		$this->db->select('city_id,city_name');
		$this->db->from('tbl_city');
		$query = $this->db->get();
		$result = $query->result();
		$city_id = array('');
		$city_name = array('-- select city --');
		foreach ($result as  $value) {
			array_push($city_id, $value->city_id);
			array_push($city_name, $value->city_name);
		}
		return array_combine($city_id,$city_name);

	}*/
	
	



}
?>