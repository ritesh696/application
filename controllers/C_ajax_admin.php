<?php 
defined('BASEPATH') OR exit('No Direct Script access allowed');

/**
 * 
 */
class C_ajax_admin extends CI_Controller
{
	
	function __construct()
	{
		        parent::__construct();
        $this->load->library('user_agent');
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->datetime = date('Y-m-d H:i:s');

        if(isset($this->session->userdata['admin_logged_in']['admin_id']))
        {    
            $this->admin_id = $this->session->userdata['admin_logged_in']['admin_id'];
        }
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

	}
	public function admin_login()
	{
		 $this->load->model('m_ajax_admin');
        $v_mob_no = $this->input->post('txt_mobno');
        $v_password = $this->input->post('txt_password');


        $city = $this->input->post('city');
        $state = $this->input->post('state');
        $country = $this->input->post('country');

        if($v_mob_no && $v_password)
        {
            $result = $this->m_ajax_admin->admin_login($v_mob_no,$v_password);
            if($result == 1)
            {
                echo 'Invalid username.';
            }
            else if($result == 2)
            {
                echo "your account is not active.";
            }
            else if($result == 3)
            {
                echo "Invalid password.";
            }
            else if($result == 4)
            {
                echo "Account Deleted.";
            }
            else
            {

                  
                    $ip = $this->ip;
                    $date = $this->datetime;
                    $device = $this->device;
                    $browser = $this->browser;
                    $platform = $this->platform;

                    $admin_id = $result[0]['admin_id'];
            
                    $array_insert_admin_history = array(
                                                    'admin_id'=>$admin_id,
                                                    'login_time'=>$date,
                                                    'ip_address'=>$ip,
                                                    'city'=>$city,
                                                    'state'=>$state,
                                                    'country'=>$country,
                                                    'os'=>$platform,
                                                    'browser'=>$browser,
                                                    'device'=>$device
                                                    );  
                                    
                $admin_history_id =  $this->m_ajax_admin->insert_admin_history($array_insert_admin_history); // submit admin login history

                $array_admin_session_data = array('admin_name'=>$result[0]['first_name'],
                                        'admin_id'=>$result[0]['admin_id'],
                                        'admin_history_id'=>$admin_history_id
                                     
                                        );


                $this->session->set_userdata('admin_logged_in',$array_admin_session_data);  
                 echo '1';
            }
        }
        else
        {
            echo 'Something wrong.';
        }


	}
    public function update_admin_profile()
    {
        $this->load->model('m_ajax_admin');
        $admin_id = $this->admin_id;//$this->input->post('txt_user_id');
        $name = $this->input->post('txt_username');
        $phone = $this->input->post('txt_phone_no');
        $city = $this->input->post('txt_search_city');
        $state = $this->input->post('txt_state');
        
        if($admin_id && $name && $phone)
        {
            $array_update_profile = array(
                                           // 'user_type'=>$user_type,
                                            'first_name'=>$name,
                                            'phone'=>$phone,
                                            'city'=>$city,
                                            'state'=>$state
                                            );
            $result = $this->m_ajax_admin->update_admin_profile($array_update_profile,$admin_id);

            if($result == 'update_phone')
            {
               /* $this->load->library('sms');
                $otp = generatePIN();

                $this->session->set_userdata('session_OTP',array('OTP'=>$otp,'update_profile'=>'update_profile'));

                $sendOTP = $this->sms->send_otp($phone,$otp);*/

                $response['STATUS'] = 'OTP';
                $response['mob_no'] = $phone;
                 $response['message'] = 'Profile updated successfully...';
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
        $this->load->model('m_ajax_admin');
        $admin_id = $this->admin_id;//$this->input->post('txt_user_id_pass');
        $old_password = $this->input->post('txt_old_password');
        $new_password = $this->input->post('txt_new_password');

        if($old_password && $new_password)
        {
            $array_update_password = array(
                                            'old_password'=>$old_password,
                                            'new_password'=>$new_password,
                                            'admin_id'=>$admin_id
                                            );
            $result = $this->m_ajax_admin->update_password($array_update_password);
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

    public function phone_validate()
    {
        $this->load->model('m_ajax_admin');
        $mob_no = $this->input->post('phone');
        $admin_id = $this->input->post('admin_id');
        $result = $this->m_ajax_admin->phone_validate($mob_no,$admin_id);
        if($result != null)
         {
            echo '1';
         } 
         else
         {
            echo '0';
         }  
    }

    public function fun_deactive_ads_by_admin()
    {
        $this->load->model('m_ajax_admin');
        $ad_id = $this->input->post('ad_id');
        $reason = $this->input->post('radio_reason');
        $status_id = $this->input->post('status');
        $city = $this->input->post('city');
        $state = $this->input->post('state');
        $country = $this->input->post('country');
        $datetime = $this->datetime;
        $user_id = $this->input->post('user_id');
        $ip = $this->ip;

        if($ad_id && $reason && $status_id)
        {
            $array_update_status = array(
                                        'ad_id'=>$ad_id,
                                        'user_id'=>$user_id,
                                        'status_id'=>$status_id,
                                        'admin_reason'=>$reason,
                                        'ent_datetime'=>$datetime,
                                        'ip'=>$ip,
                                        'city'=>$city,
                                        'state'=>$state,
                                        'country'=>$country
                                            );

            $result = $this->m_ajax_admin->fun_deactive_ads_by_admin($array_update_status);
            if($result == 1)
            {       
                $result_array = $this->m_ajax_admin->get_ad_user_detail($ad_id,$user_id);
                $v_mob_no = '';
                $v_emial = '';
                $v_ad_title = '';
                foreach ($result_array as  $value) {
                    $v_mob_no = $value->phone_no;
                    $v_emial = $value->email;
                    $v_ad_title = $value->ad_title;
                }
                $TemplateName="sms_template_deactive_N";
                $this->load->library('sms');
                $send_sms = $this->sms->send_sms($v_mob_no,$TemplateName,$v_ad_title,$reason); 
    


               /* $response['STATUS'] = 1;
                $response['message'] = 'Deactived successfully.';*/
            }
            else
            {
                $response['STATUS'] = 0;
                $response['message'] = '';
                echo json_encode($response);
            }
        }
        else
        {
            $response['STATUS'] = 101;
            $response['message'] = '';
            echo json_encode($response);
        }

        

    }
      public function fun_active_ads_by_admin()
    {
        $this->load->model('m_ajax_admin');
        $ad_id = $this->input->post('ad_id');
      
        $status_id = $this->input->post('status');
        $city = $this->input->post('city');
        $state = $this->input->post('state');
        $country = $this->input->post('country');
        $datetime = $this->datetime;
        $user_id = $this->input->post('user_id');
        $ip = $this->ip;

        if($ad_id && $status_id)
        {
            $array_update_status = array(
                                        'ad_id'=>$ad_id,
                                        'user_id'=>$user_id,
                                        'status_id'=>$status_id,
                                       // 'user_reason'=>$reason,
                                        'ent_datetime'=>$datetime,
                                        'ip'=>$ip,
                                        'city'=>$city,
                                        'state'=>$state,
                                        'country'=>$country
                                            );

            $result = $this->m_ajax_admin->fun_deactive_ads_by_admin($array_update_status);
            if($result == 1)
            {   
                $result_array = $this->m_ajax_admin->get_ad_user_detail($ad_id,$user_id);
                $v_mob_no = '';
                $v_emial = '';
                $v_ad_title = '';
                foreach ($result_array as  $value) {
                    $v_mob_no = $value->phone_no;
                    $v_emial = $value->email;
                    $v_ad_title = $value->ad_title;
                }
                $TemplateName="sms_template_active";
                $this->load->library('sms');
                $send_sms = $this->sms->send_sms($v_mob_no,$TemplateName,$v_ad_title); 

               /* $response['STATUS'] = 1;
                $response['message'] = 'Actived successfully.';*/
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



}


?>