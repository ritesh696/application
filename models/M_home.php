<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	    $this->tableName = 'tbl_user_master';
        $this->primaryKey = 'user_id';
	}
	public function update_database()
	{
		/*$this->db->select('ad_id,ent_datetime');
		$this->db->from('tbl_post_ads');
		$this->db->where('status_id',5);
		$this->db->where('status_update_date','null');
		$query = $this->db->get();
		$result = $query->result();
		
		foreach ($result as  $value) {
			$ad_id = $value->ad_id;

			//$status_id = $value->status_id;
			$date = $value->ent_datetime;


			//$array = array('status_id'=>$status_id,'status_update_date'=>$date);
			$this->db->set('status_update_date',$date);
			$this->db->where('status_id',5);
			$this->db->where('ad_id',$ad_id);
			$this->db->update('tbl_post_ads');


			$this->db->set('ent_datetime',$date);
			$this->db->where('status_id',5);
			$this->db->where('ad_id',$ad_id);
			$this->db->update('tbl_ads_status_history');*/

		//}

		//echo "Success";
		//return $company_id;
	}
	public function get_category()
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
	}
 	public function checkUser($data = array())
	{
       // $this->load->database();
        $this->db->select($this->primaryKey);
        $this->db->from($this->tableName);
        $this->db->where(array('oauth_provider'=>$data['oauth_provider'],'oauth_uid'=>$data['oauth_uid']));
        $query = $this->db->get();
        $check = $query->num_rows();
        
        if($check > 0){
            $result = $query->row_array();
            $data['ent_datetime'] = date("Y-m-d H:i:s");
            $update = $this->db->update($this->tableName,$data);
            $user_ID = $result['id'];
        }else{
            $data['ent_datetime'] = date("Y-m-d H:i:s");
            //$data['modified']= date("Y-m-d H:i:s");
            $insert = $this->db->insert($this->tableName,$data);
            $user_ID = $this->db->insert_id();
        }

   		 return $userID?$userID:false;
	}
	public function signup_user($array_signup)
	{
		$phone_no = $array_signup['phone_no'];
		$date = date('Y-m-d H:i:s');
		$this->db->select('phone_no');
		$this->db->from('tbl_user_master');
		$this->db->where('phone_no',$phone_no);
		$this->db->where('deleted',1);
		$query =  $this->db->get();
		$result = $query->result();
		if($result != null)
		{
			$array =array('deleted'=>0,'ent_datetime'=>$date);
			$array_signup = array_merge($array_signup,$array);
			$this->db->where('phone_no',$phone_no);
			$this->db->update('tbl_user_master',$array_signup);

		}
		else
		{	
			$this->db->insert('tbl_user_master',$array_signup);
			
		}
		return 1;
	}
	public function get_cat_sub_cat_value_BysubcatID($sub_cat_id)  // use in ad-post-details page
	{
		$this->db->select('c.category_id,c.category_name,c.category_image,s.sub_category_id,s.sub_category_id,s.sub_category_name');
		$this->db->from('tbl_category as c');
		$this->db->join('tbl_sub_category as s','c.category_id=s.category_id');
		$this->db->where('s.sub_category_id',$sub_cat_id);
		$this->db->where('s.status',1);
		$query = $this->db->get();
		return $query->result();
	}

	public function update_user_login_history($user_id,$user_history_id)
	{
		$this->load->database();


		$this->db->set('login_status',0);
		$this->db->where('user_id',$user_id);
		$this->db->where('login_status',1);
		$this->db->update('tbl_user_master');



		$datetime = date('Y-m-d H:i:s');
		$this->db->set('logout_time',$datetime);
		$this->db->where('user_id',$user_id);
		$this->db->where('user_history_id',$user_history_id);
		$this->db->update('tbl_user_login_history');
/*
		$this->db->select('email');
		$this->db->from('tbl_user_master');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;*/

	}
	public function check_mobile_no($v_mob_no)
	{
		$this->db->select('user_id');
		$this->db->from('tbl_user_master');
		$this->db->where('phone_no',$v_mob_no);
		$this->db->where('deleted',0);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_user_detail_byID($user_id)
	{
		$this->db->select('email,user_name,phone_no,city,locality,user_type');
		$this->db->from('tbl_user_master');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	public function get_ad_detail_by_id($ad_id)
	{


		$this->db->select('p.ad_id,p.category_id,p.sub_category_id,p.ad_title,p.ad_type,p.conditions,p.price,p.negotiable, fun_get_company_name(p.company_id) as company,fun_get_model_name(p.model_id) as model,p.year,p.kmdriven,p.fuel,p.m_need,p.salary_upto, fun_get_job_period(p.job_period) as job_period,p.description,p.image,p.status_update_date,p.city,p.locality,u.user_name,u.user_id,u.phone_no,u.user_type,u.login_status');
		$this->db->from('tbl_post_ads as p');
		$this->db->join('tbl_user_master as u','u.user_id=p.user_id');
		$this->db->where('p.ad_id',$ad_id);
		$this->db->where('p.status_id',2); // Status Acrive
		$this->db->where('u.deleted',0);
		$this->db->where('p.user_confirm',1); // Status Acrive
		$query = $this->db->get();
		return $query->result();
	}
	public function get_edit_ad_detail_by_id($ad_id)
	{


		$this->db->select('p.ad_id,p.category_id,p.sub_category_id,fun_get_category_name(p.category_id) as category_name,fun_get_sub_category_name(p.sub_category_id) as sub_category_name,p.ad_title,p.ad_type,p.conditions,p.price,p.negotiable,p.company_id,p.model_id,p.year,p.kmdriven,p.fuel,p.m_need,p.salary_upto,p.job_period,p.description,p.image,p.city,p.locality,u.user_name,u.user_id,u.phone_no,u.user_type,c.category_image');
		$this->db->from('tbl_post_ads as p');
		$this->db->join('tbl_user_master as u','u.user_id=p.user_id');
		$this->db->join('tbl_category as c','c.category_id=p.category_id');

		$this->db->where('p.ad_id',$ad_id);
	/*	$this->db->where('p.status_id',2); // Status Acrive
		$this->db->where('p.user_confirm',1); // Status Acrive
	*/	$query = $this->db->get();
		return $query->result();
	}
	public function	no_of_view_count($ad_id)
	{

		$this->db->select('no_of_view');
		$this->db->from('tbl_no_of_views');
		$this->db->where('ad_id',$ad_id);
		$query = $this->db->get();
		$result	= $query->result();
		if($result != null)
		{
			foreach ($result as  $value) {
				$view_count = $value->no_of_view;	
			}
			$view_count++;

			$this->db->set('no_of_view',$view_count);
			$this->db->where('ad_id',$ad_id);
			$this->db->update('tbl_no_of_views');
		}	


	}
	public function get_all_city()
	{
		$this->db->order_by('city_name','asc');
		$query = $this->db->get('tbl_city');	
		return $query->result();
	}	
}

?>