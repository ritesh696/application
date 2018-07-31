<?php 
defined('BASEPATH') OR exit('NO direct script access allowed');

/**
 * 
 */
class M_admin extends CI_model
{
	
	function __construct()
	{
		$this->load->database();	
	}

	public function update_admin_login_history($admin_id,$admin_history_id)
	{

		$this->db->set('login_status',0);
		$this->db->where('admin_id',$admin_id);
		$this->db->where('login_status',1);
		$this->db->update('tbl_admin_master');

		$datetime = date('Y-m-d H:i:s');
		$this->db->set('logout_time',$datetime);
		$this->db->where('admin_id',$admin_id);
		$this->db->where('admin_history_id',$admin_history_id);
		$this->db->update('tbl_admin_login_history');

	}

	public function	get_admin_detail_byAid($admin_id)
	{
		$this->db->select('admin_id,email,first_name,last_name,phone,city,state');
		$this->db->from('tbl_admin_master');
		$this->db->where('admin_id',$admin_id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	} 
	public function get_total_ads()
	{
		$this->db->select('count(ad_id) as total_ads');
		$this->db->from('tbl_post_ads');
		$this->db->where_not_in('status_id',4);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function	get_active_ads()
	{
		$this->db->select('p.ad_id,p.user_id,p.ad_title,p.ad_type,fun_get_category_name(p.category_id) as category,fun_get_sub_category_name(p.sub_category_id) as sub_category,p.sub_category_id,p.conditions,p.price,p.negotiable,p.salary_upto,p.job_period,p.m_need,p.image,p.city,p.locality,p.status_update_date,p.ad_url,u.no_of_view');
		$this->db->from('tbl_post_ads as p');
		$this->db->join('tbl_no_of_views as u','u.ad_id=p.ad_id');
		$this->db->where('p.status_id',2);
		$this->db->order_by('p.status_update_date','desc');
		$query = $this->db->get();
		return $query->result();	
	}
	public function	get_inactive_ads() // inactive by user
	{
		$this->db->select('p.ad_id,p.user_id,p.ad_title,p.ad_type,fun_get_category_name(p.category_id) as category,fun_get_sub_category_name(p.sub_category_id) as sub_category,p.sub_category_id,p.conditions,p.price,p.negotiable,p.salary_upto,p.job_period,p.m_need,p.image,p.city,p.locality,p.status_update_date,p.ad_url,u.no_of_view,p.status_id');
		$this->db->from('tbl_post_ads as p');
		$this->db->join('tbl_no_of_views as u','u.ad_id=p.ad_id');
		$this->db->where('p.status_id',3);
		$this->db->order_by('p.status_update_date','desc');
		$query = $this->db->get();
		return $query->result();	
	}
	public function	get_deactive_ads() // inactive By admin
	{
		$this->db->select('p.ad_id,p.user_id,p.ad_title,p.ad_type,fun_get_category_name(p.category_id) as category,fun_get_sub_category_name(p.sub_category_id) as sub_category,p.sub_category_id,p.conditions,p.price,p.negotiable,p.salary_upto,p.job_period,p.m_need,p.image,p.city,p.locality,p.status_update_date,p.ad_url,u.no_of_view,p.status_id');
		$this->db->from('tbl_post_ads as p');
		$this->db->join('tbl_no_of_views as u','u.ad_id=p.ad_id');
		$this->db->where('p.status_id',5);
		$this->db->order_by('p.status_update_date','desc');
		$query = $this->db->get();
	//	echo $this->db->last_query();
	//	exit;
		return $query->result();	
	}
	public function	get_pending_ads()
	{
		$this->db->select('p.ad_id,p.user_id,p.ad_title,p.ad_type,fun_get_category_name(p.category_id) as category,fun_get_sub_category_name(p.sub_category_id) as sub_category,p.sub_category_id,p.conditions,p.price,p.negotiable,p.salary_upto,p.job_period,p.m_need,p.image,p.city,p.locality,p.ent_datetime,p.ad_url,u.no_of_view');
		$this->db->from('tbl_post_ads as p');
		$this->db->join('tbl_no_of_views as u','u.ad_id=p.ad_id');
		$this->db->where('p.status_id',1);
		$this->db->order_by('p.ent_datetime','desc');
		$query = $this->db->get();
		return $query->result();	
	}
	public function get_ad_detail_by_id($ad_id)
	{


		$this->db->select('p.ad_id,p.category_id,p.sub_category_id,p.ad_title,p.ad_type,p.conditions,p.price,p.negotiable, fun_get_company_name(p.company_id) as company,fun_get_model_name(p.model_id) as model,p.year,p.kmdriven,p.fuel,p.m_need,p.salary_upto, fun_get_job_period(p.job_period) as job_period,p.description,p.image,p.status_update_date,p.city,p.locality,u.user_name,u.user_id,u.phone_no,u.user_type,u.login_status');
		$this->db->from('tbl_post_ads as p');
		$this->db->join('tbl_user_master as u','u.user_id=p.user_id');
		$this->db->where('p.ad_id',$ad_id);
	//	$this->db->where('p.status_id',2); // Status Acrive
	//	$this->db->where('p.user_confirm',1); // Status Acrive
		$query = $this->db->get();
		return $query->result();
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