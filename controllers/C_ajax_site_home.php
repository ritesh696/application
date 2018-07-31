<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_ajax_site_home extends CI_Controller {

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
    function __construct()
    {
    
        parent::__construct();
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

   public function sign_in()
    {
        $this->load->model('m_ajax_site_home');
        $v_mob_no = $this->input->post('txt_mobno');
        $v_password = $this->input->post('txt_password');


        $city = $this->input->post('city');
        $state = $this->input->post('state');
        $country = $this->input->post('country');

        if($v_mob_no && $v_password)
        {
            $result = $this->m_ajax_site_home->signin($v_mob_no,$v_password);
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

                    $user_id = $result[0]['user_id'];
            
                    $array_insert_user_history = array(
                                                    'user_id'=>$user_id,
                                                    'login_time'=>$date,
                                                    'ip_address'=>$ip,
                                                    'city'=>$city,
                                                    'state'=>$state,
                                                    'country'=>$country,
                                                    'os'=>$platform,
                                                    'browser'=>$browser,
                                                    'device'=>$device
                                                    );  
                                    
                $user_history_id =  $this->m_ajax_site_home->insert_user_history($array_insert_user_history); // subimit user login history

                $array_user_session_data = array('user_name'=>$result[0]['user_name'],
                                        'user_id'=>$result[0]['user_id'],
                                        'user_history_id'=>$user_history_id
                                     
                                        );


                $this->session->set_userdata('user_logged_in',$array_user_session_data);  
                 echo '1';
            }
        }
        else
        {
            echo 'Something wrong.';
        }


    }
    
	public function phone_validate()
    {
        $this->load->model('m_ajax_site_home');
        $mob_no = $this->input->post('phone');
        $user_id = $this->input->post('user_id');
        $result = $this->m_ajax_site_home->phone_validate($mob_no,$user_id);
        if($result != null)
         {
            echo '1';
         } 
         else
         {
            echo '0';
         }  
    }
    public function verify_otp()
    {
    	$this->load->model('m_ajax_site_home');
    	$session_otp =  '';
		$register_msg =  '';
		$user_id = '';
		$user_name = '';
        $ad_id = '';
        $session_message = '';
        $action = '';
        $update_profile = '';
		$response = array();
    	if($this->session->userdata('session_OTP') != null)
		{
			$session_otp =  $this->session->userdata['session_OTP']['OTP'];
			
		}
        if(isset($this->session->userdata['session_OTP']['msg_otp']))
        {
            $session_message =  $this->session->userdata['session_OTP']['msg_otp'];
            
        }
        if(isset($this->session->userdata['session_OTP']['ad_id']))
        {
            $ad_id =  $this->session->userdata['session_OTP']['ad_id'];
            
        }
        if(isset($this->session->userdata['session_OTP']['update_profile']))
        {
            $update_profile =  $this->session->userdata['session_OTP']['update_profile'];
            
        }

    	$mob_no = $this->input->post('txt_mobile_no');
    	$otp = $this->input->post('txt_otp');
        $city = $this->input->post('city');
        $state = $this->input->post('state');
        $country = $this->input->post('country');




    	if($session_otp != $otp )
    	{
    		$response['STATUS'] = 101;
    		$response['message'] = 'You enter OTP password is not match...';//</br> Please Resend OTP..';

    	}
    	else
    	{
    		
    		if($session_message == 'register' || $session_message == 'login' || $ad_id != '' || $update_profile != '')
    		{

                if($session_message == 'register')
                {
                    $message = 'Your Mobile no. is verify successfully.';
                    $action = '';

                }
                if($session_message == 'login')
                {
                    $message = 'Login successfully...';
                    $action = '';
                }
                if($ad_id != '')
                {
                   $message = "ad_post";
                   $action = 'ad_post';
                }
                if($update_profile != '')
                {
                    $message = "Profile updated successfully...";
                    $this->session->set_userdata('update_profile',$message);
                   
                   $action = 'my-account/profile';
                }

                if(isset($this->session->userdata['user_logged_in']['user_id']))
                {                
                    $user_id = $this->session->userdata['user_logged_in']['user_id'];
                }

    			$result = $this->m_ajax_site_home->verify_otp_register($mob_no,$ad_id,$user_id);
    			
                if($user_id == '')
                {    
        			foreach ($result as $key)
                    {
        				$user_id = $key->user_id;
        				$user_name = $key->user_name;
        			}

            			    $ip = $this->ip;
                            $date = $this->datetime;
                            $device = $this->device;
                            $browser = $this->browser;
                            $platform = $this->platform;

                            //  $user_id = $result[0]['user_id'];
                    
                            $array_insert_user_history = array(
                                                            'user_id'=>$user_id,
                                                            'login_time'=>$date,
                                                            'ip_address'=>$ip,
                                                            'city'=>$city,
                                                            'state'=>$state,
                                                            'country'=>$country,
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
            	}	

                $this->session->set_flashdata('message',$message);
		 		$response['STATUS'] = 1;	
		 		$response['action_page'] = $action;	
            }
           
    		
 	    }

    	echo json_encode($response);
    }
    public function ad_post()
    {
        $this->load->model('m_ajax_site_home');
        
        $ad_id = $this->input->post('txt_ad_id');


        $v_category_id = $this->input->post('txt_category_id');
        $v_sub_category_id = $this->input->post('txt_sub_category_id');
        $v_sellType = $this->input->post('radio_sellType');
        $v_title = trim($this->input->post('txt_title'));
        $v_title = preg_replace('/\\s+/',' ',$v_title);
        $image_url_a = strtolower(preg_replace('/[^a-zA-Z0-9\.]/',' ', $v_title));
        $image_url = preg_replace('/\\s+/','_',$image_url_a);
        $product_url = preg_replace('/\\s+/','-',$image_url_a);

        $v_description = trim($this->input->post('txa_description'));
        $v_description = preg_replace('/\\s+/',' ',$v_description);

        $v_sellerType = $this->input->post('radio_sellerType');
        $v_name = preg_replace('/\\s+/',' ',trim($this->input->post('txt_name')));
        $v_mobno = $this->input->post('txt_mobno');

        $v_city = preg_replace('/\\s+/',' ',trim($this->input->post('txt_search_city')));
        $v_locality = preg_replace('/\\s+/',' ',trim($this->input->post('txt_search_locality')));
        $v_terms = $this->input->post('chk_send');
        

        $v_condition = $this->input->post('radio_condition');
        $v_price = $this->input->post('txt_price');
        $v_chk_negotiable = $this->input->post('chk_negotiable');

       
        $v_company = $this->input->post('sel_company');

        $v_other_company = preg_replace('/\\s+/',' ',trim($this->input->post('txt_other_brand')));
        
        $v_model = $this->input->post('sel_model');
        $v_other_model = preg_replace('/\\s+/',' ',trim($this->input->post('txt_other_model')));
        

        if($v_other_company != '')
        {
            $array_insert_company = array('category_id'=>$v_category_id,
                                            'sub_category_id'=>$v_sub_category_id,
                                            'company_name'=>$v_other_company 
                                          );  
            $result_company = $this->m_ajax_site_home->insert_company_model($array_insert_company,$v_other_model);

            $v_company = $result_company['company_id'];
            $v_model = $result_company['model_id'];

        }
        if($v_other_model != '')
        {
             $array_insert_model = array('category_id'=>$v_category_id,
                                            'sub_category_id'=>$v_sub_category_id,
                                            'company_id'=>$v_company,
                                            'model_name'=>$v_other_model 
                                          );  
            $result_model = $this->m_ajax_site_home->insert_model($array_insert_model);

           
            $v_model = $result_model;

        }
        
        
        $v_year = preg_replace('/\\s+/',' ',trim($this->input->post('txt_year')));
        $v_fuel = preg_replace('/\\s+/',' ',trim($this->input->post('txt_fuel')));
        $v_kmdriven = preg_replace('/\\s+/',' ',trim($this->input->post('txt_kmdriven')));
   
        $v_matri_need = $this->input->post('sel_matri_need');
        $v_salaryupto = preg_replace('/\\s+/',' ',trim($this->input->post('txt_salaryupto')));
        $v_jobperiod = $this->input->post('sel_jobperiod');


        $img = $this->input->post('txt_img');


        $city = $this->input->post('city');
        $state = $this->input->post('state');
        $country = $this->input->post('country');

        $ip =$this->ip;
        $os = $this->platform;
        $browser = $this->browser;
        $device = $this->device;
        $date = $this->datetime;
        $user_id = '';
        $v_status_id = 1;// Pending ----------------------------------
        $db_mob_no = '';
        if($v_title && $v_sellType && $v_description && $v_category_id && $v_sub_category_id && $v_mobno && $v_name)
        {

                 if(isset($this->session->userdata['user_logged_in']))
                {   
                   $user_id = $this->session->userdata['user_logged_in']['user_id'];
                  $array_update_user = array(
                                                'user_type'=>$v_sellerType,
                                                'user_name'=>$v_name,
                                                'city'=>$v_city,
                                                'locality'=>$v_locality
                                               // 'phone_no'=>$v_mobno,
                                                );
                     
                   $result_user = $this->m_ajax_site_home->update_user_detail($array_update_user,$user_id);

                   /* foreach ($result_user as  $value) {
                            $db_mob_no = $value->phone_no;
                        }*/
                        

                   $v_user_confirm = 1;
                }  
                else
                {
                    $array_insert_user = array(
                                                'user_type'=>$v_sellerType,
                                                'user_name'=>$v_name,
                                                'city'=>$v_city,
                                                'locality'=>$v_locality,
                                                'phone_no'=>$v_mobno,
                                                'ent_datetime'=>$date,
                                                'ip'=>$ip,
                                                'device'=>$device,
                                                'browser'=>$browser,
                                                'os'=>$os
                                                );
                    $user_id = $this->m_ajax_site_home->insert_user($array_insert_user); 
                    $v_user_confirm = 0;

                }

              //  $this->load->library('upload');    
                $p='';
                $j=0;
                $datetime = strtotime($this->datetime);
                for($i = 0;$i<sizeof($img);$i++)
                {
                    $j++;          
                    $db_image = $this->input->post('db'.$j);

                    if(!empty($img[$i]))
                    {    
                           // $img[] =  $img_array[$i];
                            if (strpos($img[$i], 'data:image/jpeg;base64,') === 0) 
                            {
                                  $img[$i] = str_replace('data:image/jpeg;base64,', '', $img[$i]);  
                                  $ext = '.jpg';
                            }
                            if (strpos($img[$i], 'data:image/png;base64,') === 0) 
                            {
                                  $img[$i] = str_replace('data:image/png;base64,', '', $img[$i]); 
                                  $ext = '.png';
                            }
                              $img[$i] = str_replace(' ', '+', $img[$i]);
                              $data = base64_decode($img[$i]);
                              $x = $i+1;

                          /*  $config['upload_path'] = './assets/images/product/';  
                            $config['allowed_types'] = 'jpeg|jpg|png';
                            $config['file_name'] = 'ads_images/'.$image_url.'_'.$x.$ext;
        */

                              $file = 'assets/images/ads_images/'.$image_url.'_'.$datetime.'_'.$x.$ext;
                              $file_name = $image_url.'_'.$datetime.'_'.$x.$ext;
                             if($data != '')
                             {
                                /*$this->upload->initialize($config);
                                $this->upload->do_upload($data);
                                
                                $upload_data = $this->upload->data();
                                $img_name[] = $upload_data['file_name'];*/
                                 //  $filename = compress_image($data,$file,90);
                                  if (file_put_contents($file, $data)) 
                                  {
                                       $img_name[] = $file_name;  
                                     // echo "<p>The image was saved as $i >> $file.</p>";
                                  } else {
                                    //  echo "<p>The image could not be saved.</p>";
                                  }
                             }
                    }
                    else if(!empty($db_image))
                    {
                        $img_name[] = $db_image;
                    }
                } 
                $image_path = array();
                $image_path = implode(",",$img_name);


                $array_insert_ads = array(
                                            'user_id'=>$user_id,
                                            'ad_title'=>$v_title,
                                            'ad_type'=>$v_sellType,
                                            'category_id'=>$v_category_id,
                                            'sub_category_id'=>$v_sub_category_id,
                                            'conditions'=>$v_condition,
                                            'price'=>$v_price,
                                            'negotiable'=>$v_chk_negotiable,
                                            'company_id'=>$v_company,
                                            'model_id'=>$v_model,
                                            'year'=>$v_year,
                                            'kmdriven'=>$v_kmdriven,
                                            'fuel'=>$v_fuel,
                                            'm_need'=>$v_matri_need,
                                            'salary_upto'=>$v_salaryupto,
                                            'job_period'=>$v_jobperiod,
                                            'description'=>$v_description,
                                            'image'=>$image_path,
                                            'city'=>$v_city,
                                            'locality'=>$v_locality,
                                            'status_id'=>$v_status_id,
                                            'ent_datetime'=>$date,
                                            'user_confirm'=>$v_user_confirm,
                                            'ad_url'=>$product_url
                                            );

            
                if($ad_id != '')
                {

                    $array_insert_ads_status = array(
                                                'ad_id'=>$ad_id,
                                                'user_id'=>$user_id,
                                                'status_id'=>$v_status_id,
                                                'ent_datetime'=>$date,
                                                'ip'=>$ip,
                                                'city'=>$city,
                                                'state'=>$state,
                                                'country'=>$country
                                                );
                    $this->m_ajax_site_home->update_ads($array_insert_ads,$ad_id,$array_insert_ads_status);
                }             
                else
                {
                    $post_ad_id = $this->m_ajax_site_home->insert_ads($array_insert_ads);
                    $array_insert_no_of_views = array(                             
                                                    'ad_id'=>$post_ad_id, 
                                                    'user_id'=>$user_id
                                                    );

                    $array_insert_ads_status = array(
                                                'ad_id'=>$post_ad_id,
                                                'user_id'=>$user_id,
                                                'status_id'=>$v_status_id,
                                                'ent_datetime'=>$date,
                                                'ip'=>$ip,
                                                'city'=>$city,
                                                'state'=>$state,
                                                'country'=>$country
                                                );

                     $this->m_ajax_site_home->array_insert_no_of_views_status_history($array_insert_no_of_views,$array_insert_ads_status); 
                }
           /* if($db_mob_no != $v_mobno)
            {
                $this->load->library('sms');
                $otp = generatePIN();

                $this->session->set_userdata('session_OTP',array('OTP'=>$otp,'ad_id'=>$post_ad_id));

                $sendOTP = $this->sms->send_otp($v_mobno,$otp);
                $array['STATUS'] = 'OTP';
                $array['mob_no'] = $v_mobno ; 
                   
            }*/
            if($v_user_confirm == 0)
            {
                $this->load->library('sms');
                $otp = generatePIN();

                $this->session->set_userdata('session_OTP',array('OTP'=>$otp,'ad_id'=>$post_ad_id));

                $sendOTP = $this->sms->send_otp($v_mobno,$otp);
                $array['STATUS'] = 'OTP';
                $array['mob_no'] = $v_mobno ; 
                //$this->session->set_flashdata('success','Regestration successfully.');
               // redirect(base_url('verify-otp/'.$v_mobno));
                //exit;
            }
            else if($ad_id != '')
            {
                $array['STATUS'] = 'update';
            }
            else
            {
                 $array['STATUS'] = 1;         
            }

           


        }
        else
        {
            $array['STATUS'] = 101;
        }



        

       echo json_encode($array);
        exit;

    }
    public function filter_item()
    {
        $this->load->model('m_ajax_site_home');
        $this->load->model('m_home');
        $search_val = trim($this->input->post('search_val'));
        $user_id = $this->input->post('user_id');
        $city = $this->input->post('city');

       // $this->session->set_userdata('city',$city);

        if($this->session->userdata('city') != '')
        {   
           $city = $this->session->userdata('city');
        }



        $sub_category_id = $this->input->post('sub_category_id');

      
/*        $arr = explode(' ',trim($search_val));
        usort($arr, function($a, $b)
         {
             return strlen($b) - strlen($a); 
         });
      //  $vv = implode($arr);
        //echo $vv."</br>".$search_val;
        for($i = 0 ;$i<count($arr) ;$i++)
        {
              echo $arr[$i]."</br>"; 
         }

         //print_r($arr);
         exit;
*/


        $arr_price = $this->input->post('arr_price');
        $arr_conditions = $this->input->post('arr_conditions');
        $price_from = $this->input->post('price_from');
        $price_to = $this->input->post('price_to');


        $start = $this->input->post('offset');
        $perpage = 15;//$this->input->post('perpage');
        if($start == '')
        {
            $start = 0;
        }

      
          
        $result_display_search_val = $this->m_ajax_site_home->get_category_sub_category_by_SID($sub_category_id);


        $total_records = count($this->m_ajax_site_home->filter_item($search_val,$city,$user_id,$sub_category_id,$arr_price,$arr_conditions,$price_from,$price_to, 0));
        $result = $this->m_ajax_site_home->filter_item($search_val,$city,$user_id,$sub_category_id,$arr_price,$arr_conditions,$price_from,$price_to,$start,$perpage);
     



        $category_name = '';
        $sub_category_name = '';
        $search_result = '';
        $data_price = '';
        $data_salary = '';

        if(isset($result_display_search_val)){
             foreach ($result_display_search_val as  $value) {

                $category_name = $value->category_name;
                $sub_category_name = $value->sub_category_name;

                $search_result = $category_name.' / '.$sub_category_name;
             }
        }    
        if($search_val != '' )
        {
            $search_result = $search_val;
        }
        if($user_id != '')
         {   
            $result_user_name =  $this->m_home->get_user_detail_byID($user_id);
              if(isset($result_user_name))
                {
                    foreach ($result_user_name as $row) {
                        $user_name = $row->user_name;
                        $search_result = $user_name;
                    }
                }
          }

        $data = '';
        $pagination = '';
        
        $cat_url = preg_replace('/\\s+/',' ', $category_name);
        $cat_url = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/',' ', $cat_url));
        $cat_url = preg_replace('/\\s+/', '-', $cat_url);

        $sub_cat_url = preg_replace('/\\s+/',' ', $sub_category_name);
        $sub_cat_url = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/',' ', $sub_cat_url));
        $sub_cat_url = preg_replace('/\\s+/', '-', $sub_cat_url);

        $data .= '<input type="hidden" name="txt_hidden_category_name" id="txt_hidden_category_name" value="'.$cat_url.'" />';
        $data .= '<input type="hidden" name="txt_hidden_sub_category_name" id="txt_hidden_sub_category_name" value="'.$sub_cat_url.'" />';

        $data .= '<div class="featured-top">';
            if($search_result != ''){
              $data .= ' <h4>Showing results for "'.$search_result.'"</h4>';
            }
            
        $data .=  '<div class="dropdown pull-right">
                       '.$total_records.' No. of Records 
                    <!-- category-change -->
                    <!-- category-change -->                                                        
                    </div>                          
                </div>';

        if(isset($result) && $result != null)        
        {  
            foreach ($result as  $value) {
                
                $ad_id = $value->ad_id;
                $ad_title = $value->ad_title;
                $image = explode(",",$value->image);
                $image_url = base_url().'assets/images/ads_images/'.$image[0];
                $url = base_url().'item/'.$value->ad_url.'/'.$ad_id;
                $login_status = $value->login_status;
                $price = $value->price;
                if($price != '' && $price != 0){ $data_price = '&#8377; '.$price;}
                $salary_upto = $value->salary_upto; 
                if($salary_upto != '' && $salary_upto != 0){ $data_salary = '&#8377; '.$salary_upto;}



                $negotiable = '';
                if($value->negotiable == 1)
                {
                    $negotiable = '(Negotiable)';
                }
                $ad_type = '';
                if($value->ad_type == 'buy')
                {
                    $ad_type = "Buy";
                }

                if($login_status == 1)
                {
                    $l_class = 'online';    
                }else{ $l_class = ''; }
             
                $date =strtotime($value->status_update_date);
                $dateformate = date ("D, d M, Y H:i:s A", strtotime($value->status_update_date));
                $time = date("g:i A",$date);
                $publish_date = date('Y-m-d',strtotime($value->status_update_date));
                $today = date('Y-m-d');

                $data .= '     <div class="ad-item row">
                                    <div class="item-image-box col-sm-4">
                                        <div class="item-image">
                                            <a href="'.$url.'"><img src="'.$image_url.'" alt="'.$ad_title.'" class="img-responsive"></a>
                                        </div>
                                    </div>
                                    
                                    <div class="item-info col-sm-8">
                                        <div class="ad-info">';

                                        if($data_price != ''){
                                        $data .=  '<h3 class="item-price"> '.$data_price.'';
                                        }
                                        $data .= '<span>'.$negotiable.'</span>
                                                <span style="color:blue"> '.$ad_type.'</span>
                                            </h3>
                                             
                                            <h4 class="item-title"><a href="'.$url.'">'.$ad_title.'</a></h4>
                                            <div class="item-cat">
                                                <span><a href="#">'.$value->category.'</a></span> /
                                                <span><a href="#">'.$value->sub_category.'</a></span>';
                                            if($data_salary != ''){
                                                $data .= '<span><a href="#"> Salary Upto'.$data_salary.'</a></span>';
                                            }
                                          $data .= ' </div>                                      
                                        </div>

                                        <div class="ad-meta">
                                            <div class="meta-content">';
                                            if($today == $publish_date)
                                            {
                                               $data .= '<span class="dated"><a> Today '.$time.' </a></span>';
                                            }
                                            else
                                            {
                                                $data .= '<span class="dated"><a> '.$dateformate.' </a></span>';   
                                            }
                                            
                                        $data .=' <a href="#" class="tag"><i class="fa fa-tags"></i> '.$value->conditions.'</a>
                                            </div>                                      
                                            <!-- item-info-right -->
                                            <div class="user-option pull-right">
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="'.$value->city.', '.$value->locality.'"><i class="fa fa-map-marker"></i> </a>
                                                <a class="'.$l_class.'" href="#" data-toggle="tooltip" data-placement="top" title="'.$value->user_type.'"><i class="fa fa-user"></i> </a>                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ';
           }
        }
        else
        {
             $data .= '     <div class="ad-item row">
                                    <div class="item-image-box col-sm-4">
                                       
                                    </div>
                                    
                                    <div class="item-info col-sm-8">
                                        <div class="ad-info">

                                            <h3 class="item-price">

                                                No Result Found

                                            </h3>
                                        
                                            <h4 class="item-title"> </h4>
                                            <div></br> </div>
                                            <div class="item-cat">
                                              <button class="btn"> <a href="'.base_url().'" class="btn">Find More Item</a></button>
                                            </div>                                      
                                        </div>
                                    </div>
                                </div>';
        }



       if($total_records > $perpage) 
        {
              $pagination .=   '<ul class="pagination" >';
                
                $pages = ceil($total_records/$perpage);
                $current_page = ($start/$perpage) + 1;
                //echo $current_page;
                    if($start == 0)
                    {
                         $pagination .= ' <li class="disabled"><a href="#"><i class="fa fa-chevron-left"></i></a></li>';
                   
                    }
                    else
                    {
                        $p_t = $start - $perpage;
                         $pagination .= ' <li onclick="next_page('.$p_t.')" ><a href="#"><i class="fa fa-chevron-left"></i> </a> </li>';
                        
                        //echo '<a href='."./searchbar.php?id=" . ($start - $perpage) . '> <li class="nextbuttons1">'." Previous  ".'</li></a>';
               
                    }
                
               // $pagination .= '<li></li>';
                
                if($pages <= 10)
                {
                    for($i = 0; $i<$pages;$i++)
                    {
                        if($i == ($start/$perpage))
                        {
                             $pagination .= '<li class="active disabled" ><a href="#">'.($i+1).'</a></li>';
                        
                        }   
                        else
                        {                               
                            $pagination .= '<li  onclick="next_page('. $i*$perpage.')"><a href="#">'.($i+1).'</a> </li>';
                        }
                    }
                }
                else if(($pages > 10) && ($current_page > 4) && ($current_page < $pages - 3))
                {
                    for($j=1;$j<3;$j++)
                    {
                        if($j == ($start/$perpage))
                        {
                     $pagination .= '<li class="active disabled"> <a href="#">'. $j.'</a> </li>';
                        
                        }   
                        else
                        {                               
                        
                        $pagination .= '<li onclick="next_page('. $j*$perpage.')"><a href="#"> '. $j.'</a> </li>';
                        
                        }
                    }
                   $pagination .=  '<li class="pagination_dot"><a>...</a></li>';
                    if($current_page - 1 > 0)
                    {
                        $x = $current_page - 2;
                        //echo $x;
                    
                        $pagination .= '    <li onclick="next_page('. $x*$perpage.')"><a href="#"> '. ($x+1).'</a> </li> ';
                    
                    }
                    
                    $pagination .=  '<li class="active disabled"> <a href="#">'.$current_page.'</a> </li>';
                    
                    
                    if($current_page + 1 < $pages)
                    {
                        $xd= $current_page;
                        //echo $xd;
                    
                        $pagination .=  '<li onclick="next_page('. $xd*$perpage.')"><a href="#">'. ($current_page+1).'</a></li>';
                    
                    
                    }
                   $pagination .=  '<li class="pagination_dot"><a>...</a></li>';
                    for($y=$pages-2;$y<$pages;$y++)
                    {
                        if($y == ($start/$perpage))
                        {
                            
                        $pagination .= '<li class="active disabled" ><a href="#"> '. ($y+1).'</a> </li>';
                       
                        }   
                        else
                        {                               
                        $pagination .=  '<li onclick="next_page('. $y*$perpage.')" ><a href="#"> ' .($y+1).'</a> </li>';
                        
                        }
                    }
                }
                else
                {
                    for($y=0;$y<4;$y++)
                    {
                        if($y == ($start/$perpage))
                        {
                        $pagination .= '<li class="active disabled" ><a href="#"> ' .($y+1). '</a></li>';
                        
                        }   
                        else
                        {                               
                        $pagination .= '<li onclick="next_page('. $y*$perpage.')" ><a href="#">' . ($y+1). '</a></li>';
                        
                        }
                    }
                    $pagination .=  '<li><a>...</a></li>';
                    for($xz=$pages-4;$xz<$pages;$xz++)
                    {
                        if($xz == ($start/$perpage))
                        {
                    
                         $pagination .= '<li class="active disabled"> <a href="#">'. ($xz+1).'</a> </li>';
                        
                        }   
                        else
                        {                               
                            $pagination .= '<li onclick="next_page('.$xz*$perpage.')"><a href="#">'.($xz+1).'</a> </li>';
                        
                        }
                    }
                    
                }
                
                if($start + $perpage >= $total_records)
                {
                     $pagination .=  ' <li class="disabled"><a href="#"><i class="fa fa-chevron-right"></i>  </a></li>';
                
                }
                else
                {   
                    $n_t = $start + $perpage;
                  $pagination .=  '<li onclick="next_page('.$n_t.')" > <a href="#"><i class="fa fa-chevron-right"></i></a> </li>';
                                           
                  //  echo '<a href='."./searchbar.php?id=" . ($start + $perpage) . '> <li class="nextbuttons1">'."   next".'</li></a>';
                }
           
                 $pagination .= ' </ul>';
          
            }  


        
                        
                        
        $array_filter_record  = array("records"=>$data,"pagination"=>$pagination,"total_records"=>$total_records);

        echo json_encode($array_filter_record); 

       


    }

	
}
