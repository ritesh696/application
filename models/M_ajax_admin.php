<?php 
defined("BASEPATH") OR exit('NO direct script access allowed');

/**
 * 
 */
class M_ajax_admin extends CI_Model
{
	
	function __construct()
	{
		$this->load->database();
	}

	public function admin_login($v_mob_no,$v_password)
	{
    	$v_password = md5($v_password);
		$this->load->database();
    	$this->db->select('email,phone');
		$this->db->from('tbl_admin_master');
		//$this->db->where("(email = '$v_mob_no' OR phone = '$username')");
		$this->db->or_where('phone',$v_mob_no);
		$query = $this->db->get();
		if($query->result() != null)
		{


			$this->db->select('email,phone');
			$this->db->from('tbl_admin_master');
			//$this->db->where("(email = '$username' OR phone = '$username')");
			$this->db->or_where('phone',$v_mob_no);
			//$this->db->where('active','0');
			$this->db->where('deleted','0');
			$query = $this->db->get();
			if($query->result() != null )
			{

					$this->db->select('email,phone');
					$this->db->from('tbl_admin_master');
					//$this->db->where("(email = '$username' OR phone = '$username')");
					$this->db->or_where('phone',$v_mob_no);
					$this->db->where('status','y');
					$query = $this->db->get();
					if($query->result() != null )
					{
							$this->db->select('admin_id,first_name');
							$this->db->from('tbl_admin_master');
							//$this->db->where("(email = '$v_mob_no' OR phone = '$v_mob_no')");
							$this->db->or_where('phone',$v_mob_no);
							$this->db->where('password',$v_password);
							
							$query = $this->db->get();
							$result = $query->result_array();
							if($result != null)
							{
								return $result; 
							}
							else
							{
								return 3;// invalid password
							}
					}	
					else
					{
						return 2; // user account not active
					}	
			}
			else
			{
				return 4; // Deleted account 
			}
		}
		else
		{
			return 1; // invalid user name
		}

	}
	public function insert_admin_history($array_insert_admin_history)
	{
		$admin_id = $array_insert_admin_history['admin_id'];

		$this->db->set('login_status',1);
		$this->db->where('admin_id',$admin_id);
		$this->db->where('login_status',0);
		$this->db->update('tbl_admin_master');


		$this->db->insert('tbl_admin_login_history',$array_insert_admin_history);
		return $this->db->insert_id();
	}

	public function update_admin_profile($array_update_profile,$admin_id)
	{

		$phone = $array_update_profile['phone'];

		$this->db->select('phone');
		$this->db->from('tbl_admin_master');
		$this->db->where('admin_id',$admin_id);
		$query = $this->db->get();
		$result = $query->result_array();

		$db_phone_no = $result[0]['phone'];

		$this->db->where('admin_id',$admin_id);
		$this->db->update('tbl_admin_master',$array_update_profile);

		if($phone == $db_phone_no)
		{
			return '';
		}
		else
		{
			return 'update_phone';
		}
	}
	public function update_password($array_update_password)
	{
		$admin_id = $array_update_password['admin_id'];
		$old_password = md5($array_update_password['old_password']);
		$new_password = md5($array_update_password['new_password']);

		$this->db->select('password');
		$this->db->from('tbl_admin_master');
		$this->db->where('admin_id',$admin_id);
		$query = $this->db->get();
		$result = $query->result_array();
		$db_password = $result[0]['password'];
		if($old_password == $db_password)
		{
			$this->db->set('password',$new_password);
			$this->db->where('admin_id',$admin_id);
			$this->db->update('tbl_admin_master');
			return 1;
		}
		else
		{
			return 0;
		}
	}
	public function phone_validate($mob_no,$admin_id=0)
	{
		$this->db->select('phone');
		$this->db->from('tbl_admin_master');
		$this->db->where('phone',$mob_no);
		$this->db->where('deleted',0);
		if($admin_id != '')
		{
			$this->db->where_not_in('admin_id',$admin_id);	
		}
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	public function fun_deactive_ads_by_admin($array_update_status)
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
	public function get_ad_user_detail($ad_id,$user_id)
	{
		$this->db->select('u.phone_no,u.email,p.ad_title');
		$this->db->from('tbl_post_ads as p');
		$this->db->join('tbl_user_master as u','u.user_id=p.user_id');
		$this->db->where('p.ad_id',$ad_id);
		$query = $this->db->get();
		return $query->result();
	}
}

?>