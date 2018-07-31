<?php 
defined('BASEPATH') OR exit('no direct script access allowed');

class M_myaccount extends CI_Model{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function	get_user_detail_byUid($user_id)
	{
		$this->db->select('user_id,email,user_name,phone_no,city,locality,user_type');
		$this->db->from('tbl_user_master');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	} 
	public function get_user_total_ads($user_id)
	{
		$this->db->select('count(ad_id) as total_ads');
		$this->db->from('tbl_post_ads');
		$this->db->where('user_id',$user_id);
		$this->db->where_not_in('status_id',4); //  DELETED 
		$query = $this->db->get();
		return $query->result_array();
	}
	public function	get_active_ads($user_id)
	{
		$this->db->select('p.ad_id,p.ad_title,p.ad_type,fun_get_category_name(p.category_id) as category,fun_get_sub_category_name(p.sub_category_id) as sub_category,p.sub_category_id,p.conditions,p.price,p.negotiable,p.salary_upto,p.job_period,p.m_need,p.image,p.city,p.locality,p.status_update_date,p.ad_url,u.no_of_view');
		$this->db->from('tbl_post_ads as p');
		$this->db->join('tbl_no_of_views as u','u.ad_id=p.ad_id');
		$this->db->where('p.status_id',2);
		$this->db->where('p.user_id',$user_id);
		$this->db->order_by('p.status_update_date','desc');
		$query = $this->db->get();
		return $query->result();	
	}
	public function	get_inactive_ads($user_id)
	{
		$this->db->select('p.ad_id,p.ad_title,p.ad_type,fun_get_category_name(p.category_id) as category,fun_get_sub_category_name(p.sub_category_id) as sub_category,p.sub_category_id,p.conditions,p.price,p.negotiable,p.salary_upto,p.job_period,p.m_need,p.image,p.city,p.locality,p.status_update_date,p.ad_url,u.no_of_view,p.status_id');
		$this->db->from('tbl_post_ads as p');
		$this->db->join('tbl_no_of_views as u','u.ad_id=p.ad_id');
		$this->db->where('p.status_id',3);
		$this->db->where('p.user_id',$user_id);
		$this->db->order_by('p.status_update_date','desc');
		$query = $this->db->get();
		return $query->result();	
	}
	public function	get_deactive_ads($user_id)
	{
		$this->db->select('p.ad_id,p.ad_title,p.ad_type,fun_get_category_name(p.category_id) as category,fun_get_sub_category_name(p.sub_category_id) as sub_category,p.sub_category_id,p.conditions,p.price,p.negotiable,p.salary_upto,p.job_period,p.m_need,p.image,p.city,p.locality,p.status_update_date,p.ad_url,u.no_of_view,p.status_id');
		$this->db->from('tbl_post_ads as p');
		$this->db->join('tbl_no_of_views as u','u.ad_id=p.ad_id');
		$this->db->where('p.status_id',5);
		$this->db->where('p.user_id',$user_id);
		$this->db->order_by('p.status_update_date','desc');
		$query = $this->db->get();
		return $query->result();	
	}
	public function	get_pending_ads($user_id)
	{
		$this->db->select('p.ad_id,p.ad_title,p.ad_type,fun_get_category_name(p.category_id) as category,fun_get_sub_category_name(p.sub_category_id) as sub_category,p.sub_category_id,p.conditions,p.price,p.negotiable,p.salary_upto,p.job_period,p.m_need,p.image,p.city,p.locality,p.ent_datetime,p.ad_url,u.no_of_view');
		$this->db->from('tbl_post_ads as p');
		$this->db->join('tbl_no_of_views as u','u.ad_id=p.ad_id');
		$this->db->where('p.status_id',1);
		$this->db->where('p.user_id',$user_id);
		$this->db->order_by('p.ent_datetime','desc');
		$query = $this->db->get();
		return $query->result();	
	}

	public function update_profile($array_update_profile,$user_id)
	{

		$phone = $array_update_profile['phone_no'];

		$this->db->select('phone_no');
		$this->db->from('tbl_user_master');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		$result = $query->result_array();

		$db_phone_no = $result[0]['phone_no'];

		$this->db->where('user_id',$user_id);
		$this->db->update('tbl_user_master',$array_update_profile);

		if($phone == $db_phone_no)
		{
			return '';
		}
		else
		{
			$this->db->set('verify_mobno',0);
			$this->db->where('user_id',$user_id);
			$this->db->update('tbl_user_master');
			return 'update_phone';
		}
	}
	public function update_password($array_update_password)
	{
		$user_id = $array_update_password['user_id'];
		$old_password = md5($array_update_password['old_password']);
		$new_password = md5($array_update_password['new_password']);

		$this->db->select('password');
		$this->db->from('tbl_user_master');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		$result = $query->result_array();
		$db_password = $result[0]['password'];
		if($old_password == $db_password)
		{
			$this->db->set('password',$new_password);
			$this->db->where('user_id',$user_id);
			$this->db->update('tbl_user_master');
			return 1;
		}
		else
		{
			return 0;
		}
	}
	public function fun_deactive_ads_by_user($array_update_status)
	{
		$status_id = $array_update_status['status_id'];
		$datetime = $array_update_status['ent_datetime'];
		$ad_id = $array_update_status['ad_id'];

		$this->db->set('status_id',$status_id);
		$this->db->set('status_update_date',$datetime);
		$this->db->where('ad_id',$ad_id);
		$this->db->update('tbl_post_ads');

		$this->db->insert('tbl_ads_status_history',$array_update_status);

		return 1;
	}
	public function fun_delete_ads_by_user($array_update_status)
	{
		$status_id = $array_update_status['status_id'];
		$datetime = $array_update_status['ent_datetime'];
		$ad_id = $array_update_status['ad_id'];

		$this->db->set('status_id',$status_id);
		$this->db->set('status_update_date',$datetime);
		$this->db->where('ad_id',$ad_id);
		$this->db->update('tbl_post_ads');

		$this->db->insert('tbl_ads_status_history',$array_update_status);

		return 1;
	}
	public function delete_user_account($array_user_history)
	{
		$user_id = $array_user_history['user_id'];

		$array = array('deleted'=>1,'active'=>0,'verify_mobno'=>0);
	//	$this->db->set('deleted',1);
		$this->db->where('user_id',$user_id);
		$this->db->update('tbl_user_master',$array);

		$this->db->insert('tbl_deleted_user',$array_user_history);
		return 1;
	}
	public function get_reason($ad_id,$status_id)
	{
		$this->db->select('admin_reason,user_reason');
		$this->db->from('tbl_ads_status_history');
		$this->db->where('ad_id',$ad_id);
		$this->db->where('status_id',$status_id);
		$this->db->order_by('ads_status_history_id','desc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();
	}
}

?>