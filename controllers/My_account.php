<?php 
defined('BASEPATH') OR exit('No Direct script access allowed');
class My_account extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->datetime = date('Y-m-d H:i:s');
		$this->load->model('m_myaccount');

		$this->user_id = $this->session->userdata['user_logged_in']['user_id'];

		 function generatePIN($digits = 4)
		 {
                $i = 0; //counter
                $pin = ""; //our default pin is blank.
                while($i < $digits){
                    //generate a random number between 0 and 9.
                    $pin .= mt_rand(0, 9);
                    $i++;
                }
                return $pin;
        }

        $this->load->library('user_agent');
		$this->ip = $_SERVER['REMOTE_ADDR'];
		//$mac_address = $this->getMAC();

		$this->device = 'computer';
		$this->browser = '';
		
			if ($this->agent->is_browser())
			{
			        $this->browser = $this->agent->browser().' '.$this->agent->version();
			}
			if ($this->agent->is_mobile())
			{
			        $this->device = $this->agent->mobile();
			}


	}
	public function pagename($page)
	{
		
		if(isset($this->session->userdata['user_logged_in']))
		{	
			$page['user_detail'] = $this->m_myaccount->get_user_detail_byUid($this->user_id);	
			$page['total_ads']	= $this->m_myaccount->get_user_total_ads($this->user_id);	
			$this->load->view('my_account/'.$page['page_name'],$page);
		}
		else
		{
			redirect(base_url());
		}
	}
	public function index()
	{
		
		$array['page_name'] = 'active-ads';
		
		$array['active_ads'] = $this->m_myaccount->get_active_ads($this->user_id);		
		$this->pagename($array);
	}
	public function active_ads()
	{
		//$array['page_name'] = 'active-ads';

		$this->index();
	}
	public function profile()
	{
		$array['page_name'] = 'my-profile';
		
		$this->pagename($array);
	}
	public function pending_ads()
	{
		$array['page_name'] = 'pending-ads';
		$array['pending_ads'] = $this->m_myaccount->get_pending_ads($this->user_id);		
		$this->pagename($array);
	}
	public function deactive_ads()
	{
		$array['page_name'] = 'inactive-ads';
		$array['inactive_ads'] = $this->m_myaccount->get_inactive_ads($this->user_id);		
		$this->pagename($array);
	}
	public function deactiveted_ads()
	{
		$array['page_name'] = 'deactiveted-ads';
		$array['deactive_ads'] = $this->m_myaccount->get_deactive_ads($this->user_id);		
		$this->pagename($array);
	}
	public function delete_account()
	{
		$array['page_name'] = 'delete-account';
		$this->pagename($array);
	}
	public function update_profile()
	{
		$this->load->model('m_myaccount');
		$user_id = $this->user_id;//$this->input->post('txt_user_id');
		$name = $this->input->post('txt_username');
		$phone = $this->input->post('txt_phone_no');
		$city = $this->input->post('txt_search_city');
		$locality = $this->input->post('txt_search_locality');
		$user_type = $this->input->post('sel_user_type');
		
		if($user_id && $name && $phone)
		{
			$array_update_profile = array(
											'user_type'=>$user_type,
											'user_name'=>$name,
											'phone_no'=>$phone,
											'city'=>$city,
											'locality'=>$locality
											);
			$result = $this->m_myaccount->update_profile($array_update_profile,$user_id);

			if($result == 'update_phone')
			{
				$this->load->library('sms');
                $otp = generatePIN();

                $this->session->set_userdata('session_OTP',array('OTP'=>$otp,'update_profile'=>'update_profile'));

                $sendOTP = $this->sms->send_otp($phone,$otp);

				$response['STATUS'] = 'OTP';
				$response['mob_no'] = $phone;
			}
			else
			{
				$response['STATUS'] = 1;
				$response['message'] = 'Profile updated successfully...';
			}
		}
		else
		{
			$response['STATUS'] = 101;
			$response['message'] = '';
		}

		echo json_encode($response);

	}
	public function change_password()
	{
		$this->load->model('m_myaccount');
		$user_id = $this->user_id;//$this->input->post('txt_user_id_pass');
		$old_password = $this->input->post('txt_old_password');
		$new_password = $this->input->post('txt_new_password');

		if($old_password && $new_password)
		{
			$array_update_password = array(
											'old_password'=>$old_password,
											'new_password'=>$new_password,
											'user_id'=>$user_id
											);
			$result = $this->m_myaccount->update_password($array_update_password);
			if($result == 1)
			{
				$response['STATUS'] = 1;
				$response['message'] = 'Password updated successfully.';
 			}
 			else
 			{
 				$response['STATUS'] = 0;
 				$response['message'] = 'Old password do not match.';
 			}
		}
		else
		{
			$response['STATUS'] = 101;
			$response['message'] = '';
		}

		echo json_encode($response);
	}
	public function fun_deactive_ads_by_user()
	{
		$this->load->model('m_myaccount');
		$ad_id = $this->input->post('ad_id');
		$reason = $this->input->post('radio_reason');
		$status_id = $this->input->post('status');
		$city = $this->input->post('city');
		$state = $this->input->post('state');
		$country = $this->input->post('country');
		$datetime = $this->datetime;
		$user_id = $this->user_id;
		$ip = $this->ip;

		if($ad_id && $reason && $status_id)
		{
			$array_update_status = array(
										'ad_id'=>$ad_id,
										'user_id'=>$user_id,
										'status_id'=>$status_id,
										'user_reason'=>$reason,
										'ent_datetime'=>$datetime,
										'ip'=>$ip,
										'city'=>$city,
										'state'=>$state,
										'country'=>$country
											);

			$result = $this->m_myaccount->fun_deactive_ads_by_user($array_update_status);
			if($result == 1)
			{		
				$response['STATUS'] = 1;
				$response['message'] = 'Deactived successfully.';
			}
			else
			{
				$response['STATUS'] = 0;
				$response['message'] = '';
			}
		}
		else
		{
			$response['STATUS'] = 101;
			$response['message'] = '';
		}

		echo json_encode($response);

	}
	public function fun_delete_ads_by_user()
	{
		$this->load->model('m_myaccount');
		$ad_id = $this->input->post('ad_id');
		$status_id = $this->input->post('status');
		$city = $this->input->post('city');
		$state = $this->input->post('state');
		$country = $this->input->post('country');
		$datetime = $this->datetime;
		$user_id = $this->user_id;
		$ip = $this->ip;

		if($ad_id  && $status_id)
		{
			$array_update_status = array(
										'ad_id'=>$ad_id,
										'user_id'=>$user_id,
										'status_id'=>$status_id,
										'ent_datetime'=>$datetime,
										'ip'=>$ip,
										'city'=>$city,
										'state'=>$state,
										'country'=>$country
											);

			$result = $this->m_myaccount->fun_delete_ads_by_user($array_update_status);
			if($result == 1)
			{		
				$response['STATUS'] = 1;
				$response['message'] = 'Ad deleted successfully.';
			}
			else
			{
				$response['STATUS'] = 0;
				$response['message'] = '';
			}
		}
		else
		{
			$response['STATUS'] = 101;
			$response['message'] = '';
		}

		echo json_encode($response);

	}
	public function delete_user_account()
	{
		$user_id = $this->user_id;
		$datetime = $this->datetime;
		$delete_reason = $this->input->post('delete_reason');
		$ip = $this->ip;
		$city = $this->input->post('city');
		$state = $this->input->post('state');
		$country = $this->input->post('country');
		$this->load->model('m_myaccount');
		
		if($delete_reason  != '')
		{
			$array_user_history = array(
										'user_id'=>$user_id,
										'reason'=>$delete_reason,
										'datetime'=>$datetime,
										'ip'=>$ip,
										'city'=>$city,
										'state'=>$state,
										'country'=>$country
										);
			$result = $this->m_myaccount->delete_user_account($array_user_history);

			$this->session->set_flashdata('user_delete','Your account deleted successfully.');	

			$response['STATUS'] = 1;
			$response['message'] = 'success';	

			$this->load->model('m_home');
	       // $user_id = $this->session->userdata['user_logged_in']['user_id'];     // pick form session 
	        $user_history_id = $this->session->userdata['user_logged_in']['user_history_id'] ; // pick form session 
	        $result = $this->m_home->update_user_login_history($user_id,$user_history_id);
	        $this->session->unset_userdata('user_logged_in');

			//redirect(base_url());
		}		
		else
		{
			$response['STATUS'] = 101;
			$response['message'] = '';
 		}

 		echo json_encode($response);
	}
}


?>