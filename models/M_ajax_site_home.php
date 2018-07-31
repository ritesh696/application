<?php 
defined('BASEPATH') OR exit ('No direct script access alloed');

class M_ajax_site_home extends CI_model
{
	function __construct()
	{
		$this->load->database();
	}
	public function get_category_sub_category()
	{
		$this->db->select('*');
		$this->db->from('tbl_category as c');
		$this->db->join('tbl_sub_category as s','c.category_id=s.category_id');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function phone_validate($mob_no,$user_id=0)
	{
		$this->db->select('phone_no');
		$this->db->from('tbl_user_master');
		$this->db->where('phone_no',$mob_no);
		$this->db->where('deleted',0);
		if($user_id != '')
		{
			$this->db->where_not_in('user_id',$user_id);	
		}
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	public function verify_otp_register($mob_no,$ad_id=0,$user_id=0)
	{
		$array = array('active'=>1,'verify_mobno'=>1);
		$this->db->where('phone_no',$mob_no);
		if($user_id != 0)
		{
			$this->db->where('user_id',$user_id);
		}
		$this->db->where('verify_mobno',0);
		$this->db->update('tbl_user_master',$array);

		if($ad_id != 0)
		{
			$this->db->set('user_confirm',1);
			$this->db->where('ad_id',$ad_id);
			$this->db->update('tbl_post_ads');
		}


		$this->db->select('user_id,user_name');
		$this->db->from('tbl_user_master');
		$this->db->where('phone_no',$mob_no);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	public function signin($v_mob_no,$v_password)
	{
    	$v_password = md5($v_password);
		$this->load->database();
    	$this->db->select('email,phone_no');
		$this->db->from('tbl_user_master');
		//$this->db->where("(email = '$v_mob_no' OR phone = '$username')");
		$this->db->or_where('phone_no',$v_mob_no);
		$query = $this->db->get();
		if($query->result() != null)
		{


			$this->db->select('email,phone_no');
			$this->db->from('tbl_user_master');
			//$this->db->where("(email = '$username' OR phone = '$username')");
			$this->db->or_where('phone_no',$v_mob_no);
			//$this->db->where('active','0');
			$this->db->where('deleted','0');
			$query = $this->db->get();
			if($query->result() != null )
			{

					$this->db->select('email,phone_no');
					$this->db->from('tbl_user_master');
					//$this->db->where("(email = '$username' OR phone = '$username')");
					$this->db->or_where('phone_no',$v_mob_no);
					$this->db->where('active','1');
					$query = $this->db->get();
					if($query->result() != null )
					{
							$this->db->select('user_id,user_name');
							$this->db->from('tbl_user_master');
							//$this->db->where("(email = '$v_mob_no' OR phone = '$v_mob_no')");
							$this->db->or_where('phone_no',$v_mob_no);
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
	public function insert_user_history($array_insert_user_history)
	{
		$user_id = $array_insert_user_history['user_id'];

		$this->db->set('login_status',1);
		$this->db->where('user_id',$user_id);
		$this->db->where('login_status',0);
		$this->db->update('tbl_user_master');


		$this->db->insert('tbl_user_login_history',$array_insert_user_history);
		return $this->db->insert_id();
	}

	public function insert_company_model($array_insert_company,$v_other_model)
	{
		$model_id = '';
		$this->db->insert('tbl_cat_company',$array_insert_company);
		$company_id = $this->db->insert_id();

		if($v_other_model != '')
		{
			$array_insert_model = array(
										'category_id'=>$array_insert_company['category_id'],
										'sub_category_id'=>$array_insert_company['sub_category_id'],
										'company_id'=>$company_id,
										'model_name'=>$v_other_model
										);
			$this->db->insert('tbl_company_model',$array_insert_model);
			$model_id = $this->db->insert_id();
		}

		return array('company_id'=>$company_id,'model_id'=>$model_id);
	}
	public function insert_model($array_insert_model)
	{
		$this->db->insert('tbl_company_model',$array_insert_model);
		$model_id = $this->db->insert_id();
		return $model_id;
	}
	public function insert_user($array_insert_user)
	{
		$mob_no = $array_insert_user['phone_no'];
		$this->db->select('user_id');
		$this->db->from('tbl_user_master');
		$this->db->where('phone_no',$mob_no);
		$query = $this->db->get();
		$result = $query->result();
		if($result == null)
		{
			$this->db->insert('tbl_user_master',$array_insert_user);
			$user_id = $this->db->insert_id();
		}
		else
		{
			foreach ($result as  $value) {
				$user_id = $value->user_id;
			}
			 $array_update_user = array(
                                        'user_type'=>$array_insert_user['user_type'],
                                        'user_name'=>$array_insert_user['user_name'],
                                        'city'=>$array_insert_user['city'],
                                        'locality'=>$array_insert_user['locality']
                                       // 'phone_no'=>$v_mobno,
                                        );
			 $this->db->where('user_id',$user_id);
			$this->db->update('tbl_user_master',$array_update_user);
			
		
		}

		return $user_id;
	}
	public function insert_ads($array_insert_ads)
	{
		$this->db->insert('tbl_post_ads',$array_insert_ads);
		$post_ad_id = $this->db->insert_id();
		return $post_ad_id;
	}
	public function update_ads($array_insert_ads,$ad_id=0,$array_insert_ads_status)
	{
		$this->db->where('ad_id',$ad_id);		
		$this->db->update('tbl_post_ads',$array_insert_ads);
		

		$this->db->insert('tbl_ads_status_history',$array_insert_ads_status);    

		$array_update_history = array(
										'ad_id'=>$array_insert_ads_status['ad_id'],
										'user_id'=>$array_insert_ads_status['user_id'],
										'ent_datetime'=>$array_insert_ads_status['ent_datetime'],
										'ip'=>$array_insert_ads_status['ip'],
										'city'=>$array_insert_ads_status['city'],
										'state'=>$array_insert_ads_status['state'],
										'country'=>$array_insert_ads_status['country']
										);
		$this->db->insert('tbl_post_ads_update_history',$array_update_history);
		
	}
	

	public function array_insert_no_of_views_status_history($array_insert_no_of_views,$array_insert_ads_status)
	{
       $this->db->insert('tbl_no_of_views',$array_insert_no_of_views);

        $this->db->insert('tbl_ads_status_history',$array_insert_ads_status);    
	}
	public function update_user_detail($array_update_user,$user_id)
	{

		$this->db->where('user_id',$user_id);
		$this->db->update('tbl_user_master',$array_update_user);

		/*$this->db->select('phone_no');
		$this->db->from('tbl_user_master');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;*/
	}
	public function get_category_sub_category_by_SID($sub_category_id)
	{
		$this->db->select('sub_category_name, fun_get_category_name(category_id) as category_name');
		$this->db->from('tbl_sub_category');
		$this->db->where('sub_category_id',$sub_category_id);
		$query = $this->db->get();
		return $query->result();
	}
	public function filter_item($search_val=0,$city=0,$user_id=0,$sub_category_id=0,$arr_price=0,$arr_conditions=0,$price_from=0,$price_to=0,$offset=0,$per_page=0)
	{

		$this->db->select('p.ad_id,p.ad_title,p.ad_type,fun_get_category_name(p.category_id) as category,fun_get_sub_category_name(p.sub_category_id) as sub_category,p.conditions,p.price,p.negotiable,p.salary_upto,p.job_period,p.m_need,p.image,p.city,p.locality,p.status_update_date,p.ad_url,u.user_type,u.login_status');
		$this->db->from('tbl_post_ads as p');
		$this->db->join('tbl_user_master as u','u.user_id=p.user_id');
		$this->db->where('p.status_id',2);
		$this->db->where('u.deleted',0);
		$this->db->where('p.user_confirm',1);
		if($city != '')
		{
			$this->db->like('p.city',$city);
		}
		if($search_val != '')
		{

			$arr = explode(' ',trim($search_val));
	      /*  usort($arr, function($a, $b)
	         {
	             return strlen($b) - strlen($a); 
	         });*/
	        /*$vv = implode($arr);
	        echo $vv."</br>".$search_val;*/
	        $conditions = "p.ad_title LIKE '%".$search_val."%' OR ";
	       // $this->db->like('p.ad_title',$search_val);
	        for($i = 0 ;$i<count($arr) ;$i++)
	        {
	        	if(count($arr) - 1 == $i)
				{
					$or = '';
				}
				else
				{
					$or = "OR";	
				}
				
				$conditions .= "p.ad_title LIKE '%".$arr[$i]."%' ".$or." ";
	          // $this->db->like('p.ad_title',$arr[$i]); 
	        }
	        $this->db->where("(".$conditions.")");
			
		}
		if($sub_category_id != '')
		{	
			$this->db->where('p.sub_category_id',$sub_category_id);
		}
		if($user_id != '')
		{
			$this->db->where('p.user_id',$user_id);
		}	
		if($price_from != '' || $price_to != '')
		{
			$this->db->where('p.price >=',$price_from);
			$this->db->where('p.price <=',$price_to);
		}
		
		if($arr_price != '')
		{
			// One value
			if(in_array("<1000", $arr_price) == true && in_array("1000to5000", $arr_price) == false && in_array("5000to10000", $arr_price) == false && in_array("10000to25000", $arr_price) == false)
			{
				$this->db->where('p.price <',1000);		
			}
			if(in_array("<1000", $arr_price) == false && in_array("1000to5000", $arr_price) == true && in_array("5000to10000", $arr_price) == false && in_array("10000to25000", $arr_price) == false)
			{
				$this->db->where("(p.price >= '1000' AND p.price <= '5000')");
				//$this->db->or_where('p.price <=',1000);		
			}
			if(in_array("<1000", $arr_price) == false && in_array("1000to5000", $arr_price) == false && in_array("5000to10000", $arr_price) == true && in_array("10000to25000", $arr_price) == false)
			{
				$this->db->where("(p.price >= '5000' AND p.price <= '10000')"); 
				//$this->db->or_where('p.price <=',5000);		
			}
			if(in_array("<1000", $arr_price) == false && in_array("1000to5000", $arr_price) == false && in_array("5000to10000", $arr_price) == false && in_array("10000to25000", $arr_price) == true)
			{
				$this->db->where("(p.price >= '10000' AND p.price <= '25000')"); 
				//$this->db->or_where('p.price <=',5000);		
			}
		// TWO value	
			if(in_array("<1000", $arr_price) == true && in_array("1000to5000", $arr_price) == true && in_array("5000to10000", $arr_price) == false && in_array("10000to25000", $arr_price) == false)
			{
				$this->db->where("(p.price < '1000' OR (p.price >= '1000'  AND p.price <= '5000'))");		
			}
			if(in_array("<1000", $arr_price) == true && in_array("1000to5000", $arr_price) == false && in_array("5000to10000", $arr_price) == true && in_array("10000to25000", $arr_price) == false)
			{
				$this->db->where("(p.price < '1000' OR (p.price >= '5000'  AND p.price <= '10000'))");		
			}
			if(in_array("<1000", $arr_price) == true && in_array("1000to5000", $arr_price) == false && in_array("5000to10000", $arr_price) == false && in_array("10000to25000", $arr_price) == true)
			{
				$this->db->where("(p.price < '1000' OR (p.price >= '10000' AND p.price <= '25000'))");
			}
			if(in_array("<1000", $arr_price) == false && in_array("1000to5000", $arr_price) == true && in_array("5000to10000", $arr_price) == true && in_array("10000to25000", $arr_price) == false)
			{
				$this->db->where("((p.price >= '1000'  AND p.price <= '5000') OR (p.price >= '5000'  AND p.price <= '10000'))");		
			}
			if(in_array("<1000", $arr_price) == false && in_array("1000to5000", $arr_price) == true && in_array("5000to10000", $arr_price) == false && in_array("10000to25000", $arr_price) == true)
			{
				$this->db->where("((p.price >= '1000'  AND p.price <= '5000') OR (p.price >= '10000'  AND p.price <= '25000'))");		
			}
			if(in_array("<1000", $arr_price) == false && in_array("1000to5000", $arr_price) == false && in_array("5000to10000", $arr_price) == true && in_array("10000to25000", $arr_price) == true)
			{
				$this->db->where("((p.price >= '5000'  AND p.price <= '10000') OR (p.price >= '10000'  AND p.price <= '25000'))");		
			}

		// THREE value	
			if(in_array("<1000", $arr_price) == true && in_array("1000to5000", $arr_price) == true && in_array("5000to10000", $arr_price) == true && in_array("10000to25000", $arr_price) == false)
			{
				$this->db->where("(p.price < '1000' OR (p.price >= '1000'  AND p.price <= '5000') OR (p.price >= '5000'  AND p.price <= '10000'))");	
			}
			if(in_array("<1000", $arr_price) == true && in_array("1000to5000", $arr_price) == true && in_array("5000to10000", $arr_price) ==false && in_array("10000to25000", $arr_price) == true)
			{
				$this->db->where("(p.price < '1000' OR (p.price >= '1000'  AND p.price <= '5000') OR (p.price >= '10000'  AND p.price <= '25000'))");	
			}
			if(in_array("<1000", $arr_price) == true && in_array("1000to5000", $arr_price) == false && in_array("5000to10000", $arr_price) == true && in_array("10000to25000", $arr_price) == true)
			{
				$this->db->where("(p.price < '1000' OR (p.price >= '5000'  AND p.price <= '10000') OR (p.price >= '10000'  AND p.price <= '25000'))");	
			}
			if(in_array("<1000", $arr_price) == false && in_array("1000to5000", $arr_price) == true && in_array("5000to10000", $arr_price) == true && in_array("10000to25000", $arr_price) == true)
			{
				$this->db->where("((p.price >= '1000'  AND p.price <= '5000') OR (p.price >= '5000'  AND p.price <= '10000') OR (p.price >= '10000'  AND p.price <= '25000'))");	
			}
		// FOUR value
			if(in_array("<1000", $arr_price) == true && in_array("1000to5000", $arr_price) == true && in_array("5000to10000", $arr_price) == true && in_array("10000to25000", $arr_price) == true)
			{
				$this->db->where("(p.price < '1000' OR (p.price >= '1000'  AND p.price <= '5000') OR (p.price >= '5000'  AND p.price <= '10000') OR (p.price >= '10000'  AND p.price <= '25000'))");	
			}
		}
		if($arr_conditions != '')
		{
			// One value
			if(in_array("new", $arr_conditions) == true && in_array("used", $arr_conditions) == false)
			{
				$this->db->where('p.conditions', 'new');		
			}
			if(in_array("new", $arr_conditions) == false && in_array("used", $arr_conditions) == true)
			{
				$this->db->where('p.conditions', 'used');		
			}
	/*		if(in_array("new", $arr_conditions) == true && in_array("used", $arr_conditions) == true)
			{
				$this->db->where('p.conditions', 'new');
				$this->db->or_where('p.conditions', 'used');		
			}*/		
		}


		$this->db->order_by('p.status_update_date','desc');
		$this->db->limit($per_page,$offset);
		//return $this->db->get_compiled_select();

		$query = $this->db->get();
		return $query->result();
	}

}
?>