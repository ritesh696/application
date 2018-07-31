<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_home extends CI_Controller {

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
		$this->load->library('google');
		 $this->load->library('user_agent');
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->datetime = date('Y-m-d H:i:s');

        //$mac_address = $this->getMAC();

        $this->device = 'computer';
        $this->browser = '';
        $this->platform =  $this->agent->platform();
        
            if ($this->agent->is_browser())
            {
                    $this->browser = $this->agent->browser().' '.$this->agent->version();
            }
            if ($this->agent->is_mobile())
            {
                    $this->device = $this->agent->mobile();
            }
		
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


	}
	public function pagename($page)
	{
		$this->load->view($page['page_name'],$page);
	}
	public function index()
	{
		$this->load->model('m_home');
		$array['page_name'] = 'index';
		$array['category_list'] = $this->m_home->get_category();
		//$array['old_ads'] = $this->m_home->update_database();
 		$this->pagename($array);
	}	
	public function sign_in()
	{
		$this->load->model('m_ajax_site_home');
		if(isset($_GET['code']))
        {
            //authenticate user
            $this->google->getAuthenticate();
            
            //get user info from google
            $gpInfo = $this->google->getUserInfo();
            
            //preparing data for database insertion
            $userData['oauth_provider'] = 'google';
            $userData['oauth_uid']      = $gpInfo['id'];
            $userData['first_name']     = $gpInfo['given_name'];
           // $userData['last_name']      = $gpInfo['family_name'];
            $userData['email']          = $gpInfo['email'];
           // $userData['gender']         = !empty($gpInfo['gender'])?$gpInfo['gender']:'';
           // $userData['locale']         = !empty($gpInfo['locale'])?$gpInfo['locale']:'';
         //  $userData['profile_url']    = !empty($gpInfo['link'])?$gpInfo['link']:'';
           // $userData['picture_url']    = !empty($gpInfo['picture'])?$gpInfo['picture']:'';
            
            //insert or update user data to the database
            $user_name = $userData['first_name'];
            $user_id = $this->m_home->checkUser($userData);
           	
       	 			$ip = $this->ip;
                    $date = $this->datetime;
                    $device = $this->device;
                    $browser = $this->browser;
                    $platform = $this->platform;

                    $user_id = $result[0]['user_id'];
            
                    $array_insert_user_history = array(
                                                    'user_id'=>$user_id,
                                                    'login_time'=>$date,
                                                    'ip_address'=>$ip,
                                                   /* 'city'=>$city,
                                                    'state'=>$state,
                                                    'country'=>$country,*/
                                                    'os'=>$platform,
                                                    'browser'=>$browser,
                                                    'device'=>$device
                                                    );  
                                    
                $user_history_id =  $this->m_ajax_site_home->insert_user_history($array_insert_user_history); // subimit admin login history

                $array_user_session_data = array('user_name'=>$user_name,
                                        'user_id'=>$user_id,
                                        'user_history_id'=>$user_history_id
                                     
                                        );

				$this->session->set_userdata('user_logged_in',$array_user_session_data);  

            
            redirect(base_url());
        } 
        
        //google login url
        $array['loginURL'] = $this->google->loginURL();
        



		$array['page_name'] = 'signin';
		$this->pagename($array);
	}
	public function sign_up()
	{
		$this->load->library('form_validation');
		$this->load->model('m_home');
		$this->load->library('sms');

		$this->form_validation->set_rules('txt_user_name','','required|regex_match[/^[a-zA-Z0-9\ ]*$/]',array('required'=>'Please enter your name','regex_match'=>'Please enter only characters.'));
		$this->form_validation->set_rules('txt_password','','required|min_length[5]|max_length[25]',array('required'=>'Please enter pasword.'));
		$this->form_validation->set_rules('txt_c_password','','required|matches[txt_password]',array('required'=>'Please enter confirm password','matches'=>'Passwords does not match!.'));
		$this->form_validation->set_rules('txt_mob_no','','required|regex_match[/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/]|callback_checkPhone',array('required'=>'Please enter Mobile no.','regex_match'=>'Please Enter Valid Mobile no.'));	

		if($this->form_validation->run())
		{

			$v_user_name = $this->input->post('txt_user_name');
			$v_password = $this->input->post('txt_password');
			$v_mob_no = $this->input->post('txt_mob_no');

			$ip = $this->ip;
            $date = $this->datetime;
            $device = $this->device;
            $browser = $this->browser;
            $platform = $this->platform;

			$array_signup = array(	
									'user_name'=>$v_user_name,
									'password'=>md5($v_password),
									'phone_no'=>$v_mob_no,
									'ent_datetime'=>$this->datetime,
									'ip'=>$ip,
                                    'device'=>$device,
                                    'browser'=>$browser,
                                    'os'=>$platform,
									);
			$this->form_validation->resetpostdata();						
			$result = $this->m_home->signup_user(html_escape($array_signup));
			
		
			if($result == 1)
			{

				$otp = generatePIN();

				$this->session->set_userdata('session_OTP',array('OTP'=>$otp,'msg_otp'=>'register'));

				$sendOTP = $this->sms->send_otp($v_mob_no,$otp);

				//$this->session->set_flashdata('success','Regestration successfully.');
				redirect(base_url('verify-otp/'.$v_mob_no));


				//$array['mobile_no'] = $v_mob_no;
				//$this->load->view('verify-otp',$array);
			}
			else
			{
				$array['fail'] = '';
			}

			$array['page_name'] = 'signup';

		}	
		else
		{
			$array['page_name'] = 'signup';
				
		}

		$this->pagename($array);
				
	}
	public function checkPhone($str) // callback method for phone no. check is exists or not
	{
		$this->load->model('m_ajax_site_home');
		if($this->m_ajax_site_home->phone_validate($str))
		{
			$this->form_validation->set_message('checkPhone','Phone no. already exists.');
			return false;
		}
		else
		{
			return true;
		}
	}

	public function verify_otp($mobile_no=0)
	{
		if($mobile_no != 0)
		{	
			$array['mobile_no'] = $mobile_no;
			$array['page_name'] = 'verify-otp';
			$this->pagename($array);
		}
		else
		{
			redirect(base_url('sign-in'));
		}
	}
	public function login_with_otp()
	{
		$this->load->library('form_validation');
		$this->load->model('m_home');
		$this->load->library('sms');
		$this->form_validation->set_rules('txt_mobile_no','','required|regex_match[/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/]',array('required'=>'Please enter Mobile no.','regex_match'=>'Please Enter Valid Mobile no.'));	

		if($this->form_validation->run())
		{

			$v_mob_no = $this->input->post('txt_mobile_no');
			$this->form_validation->resetpostdata();
			$result = $this->m_home->check_mobile_no($v_mob_no);
			
		
			if($result != null)
			{

				$otp = generatePIN();

				$this->session->set_userdata('session_OTP',array('OTP'=>$otp,'msg_otp'=>'login'));

				$sendOTP = $this->sms->send_otp($v_mob_no,$otp);

				//$this->session->set_flashdata('success','Regestration successfully.');
				redirect(base_url('verify-otp/'.$v_mob_no));


				//$array['mobile_no'] = $v_mob_no;
				//$this->load->view('verify-otp',$array);
			}
			else
			{
				$array['error'] = 'Entered mobile no. is not registered.';
			}

			//$array['page_name'] = 'signup';

		}	
		else
		{
			//$array['page_name'] = 'signup';
				
		}

		//$this->pagename($array);
		$array['page_name'] = 'login-with-otp';
		$this->pagename($array);
 	}
	public function ad_post($cat_id = 0)
	{

		$this->load->model('m_home');
		if($cat_id != 0)
		{
			$array['category_id'] = $cat_id;
		}
		$array['page_name'] = 'ad-post';
		$array['category_list'] = $this->m_home->get_category_sub_category();
		$this->pagename($array);
	}
	public function category($cat_id=0)
	{
		$this->load->model('m_home');
		$array['page_name'] = 'sub-categories';
		$array['category_id'] = $cat_id;
		$array['category_list'] = $this->m_home->get_category_sub_category();
		$this->pagename($array);
	}
	public function searchbar($sub_category_name=0,$sub_cat_id=0,$search_val=null,$icity=null)
	{	
		$this->load->model('m_home');
		$array['sub_category_name'] = $sub_category_name;
		$array['sub_cat_id'] = $sub_cat_id;
		if($search_val != null)
		{
			$array['search_value'] = $search_val;
		}
		if($icity != null)
		{	
			$array['icity'] = $icity;
		}
		$array['page_name'] = 'searchbar';
		$array['get_city'] = $this->m_home->get_all_city();
		$this->pagename($array);
	}
	public function searchbar_v1($sub_category_name=0,$sub_cat_id=0,$icity=null)
	{	
		$this->load->model('m_home');
		$array['sub_category_name'] = $sub_category_name;
		$array['sub_cat_id'] = $sub_cat_id;
		
		if($icity != null)
		{	
			$array['icity'] = $icity;
		}
		$array['page_name'] = 'searchbar';
		$array['get_city'] = $this->m_home->get_all_city();
		$this->pagename($array);
	}
	public function search_user($user_id=0)
	{	
		$this->load->model('m_home');
		$array['userid'] = $user_id;
		$array['page_name'] = 'searchbar';
		$array['get_city'] = $this->m_home->get_all_city();
		$this->pagename($array);
	}
	public function search_value($search_val=0,$icity=null) // All Result
	{	
		$this->load->model('m_home');
		$array['search_value'] = $search_val;
		if($icity != null)
		{
			$array['icity'] = $icity;
		}
		
		

		$array['page_name'] = 'searchbar';
		$array['get_city'] = $this->m_home->get_all_city();
		$this->pagename($array);
	}
	public function search_city($icity=0) // All Result
	{	
		$this->load->model('m_home');
		//$array['search_value'] = $search_val;
		$array['icity'] = $icity;
		$array['page_name'] = 'searchbar';
		$array['get_city'] = $this->m_home->get_all_city();
		$this->pagename($array);
	}
	public function product($pname)
	{
		$array['page_name'] = 'product-details';
		$this->pagename($array);
	}
	public function contact_us()
	{
		$array['page_name'] = 'contact-us';
		$this->pagename($array);
	}
	public function about_us()
	{
		$array['page_name'] = 'about-us';
		$this->pagename($array);
	}
	public function help_support()
	{
		$array['page_name'] = 'help-support';
		$this->pagename($array);
	}
	public function ad_post_details($sub_cat_id=0)
	{
		$this->load->model('m_home');
		if($sub_cat_id != 0)
		{
			if(isset($this->session->userdata['user_logged_in']))
			{
				$user_id = $this->session->userdata['user_logged_in']['user_id'];
				$array['user_detail'] = $this->m_home->get_user_detail_byID($user_id);
			}

			
 			$array['cat_subcat_value'] = $this->m_home->get_cat_sub_cat_value_BysubcatID($sub_cat_id);
			$array['page_name'] = 'ad-post-details';	
		}	
		else
		{
			redirect(base_url().'ad-post');
		}
		$this->pagename($array);
	}
	public function edit_post_details($ad_id=0)
	{
		$this->load->model('m_home');
		if($ad_id != 0)
		{
			if(isset($this->session->userdata['user_logged_in']))
			{
				$user_id = $this->session->userdata['user_logged_in']['user_id'];
				//$array['user_detail'] = $this->m_home->get_user_detail_byID($user_id);
			}

			$array['ad_detail'] = $this->m_home->get_edit_ad_detail_by_id($ad_id);
 			//$array['cat_subcat_value'] = $this->m_home->get_cat_sub_cat_value_BysubcatID($sub_cat_id);
			$array['page_name'] = 'ad-post-details';	
		}	
		else
		{
			redirect(base_url().'ad-post');
		}
		$this->pagename($array);
	}


	public function post_done()
	{
		$array['page_name'] = 'post-done';
		$this->pagename($array);
	}
	public function product_details($ad_url=0,$ad_id=0)
	{
		$this->load->model('m_home');
		$array['page_name'] = 'product-details';
		$this->m_home->no_of_view_count($ad_id);
		$array['ad_detail'] = $this->m_home->get_ad_detail_by_id($ad_id);
		$this->pagename($array);
	}
	public function logout()
    {
        $this->load->model('m_home');
        $user_id = $this->session->userdata['user_logged_in']['user_id'];     // pick form session 
        $user_history_id = $this->session->userdata['user_logged_in']['user_history_id'] ; // pick form session 
        $result = $this->m_home->update_user_login_history($user_id,$user_history_id);
        $this->session->unset_userdata('user_logged_in');
        redirect(base_url());
    }

    public function OTP_expired()
    {
    	$mob_no = $this->input->post('mobno');
    	
    	if(isset($mob_no))
    	{
    		//$array = array('OTP');
    		$this->session->unset_userdata('session_OTP');//,array('OTP'=>''));
    	}	
    	else
    	{
    		redirect(base_url());
    	}
    }
    public function resend_otp()
    {
    	$this->load->library('sms');
		$mob_no = $this->input->post('mobno');
		$register_msg = $this->input->post('register_msg');
		$ad_id = $this->input->post('ad_id');
    	$update_profile = $this->input->post('update_profile');
    	$otp = generatePIN();

    	$array = array(
    					'OTP'=>$otp,
    					'msg_otp'=>$register_msg,
    					'ad_id'=>$ad_id,
    					'update_profile'=>$update_profile
    					);

        $this->session->set_userdata('session_OTP',$array);//,'msg_otp'=>$register_msg,'ad_id'=>$ad_id));//'ad_id'=>$post_ad_id));

        $sendOTP = $this->sms->send_otp($v_mobno,$otp);


    }
	
}
