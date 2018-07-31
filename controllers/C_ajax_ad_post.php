<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_ajax_ad_post extends CI_Controller {

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


	public function fun_get_model_byCompanyId()
	{
		$this->load->model('m_ajax_ad_post');
		$v_company_id = $this->input->post('company_id'); 
		$model_id = $this->input->post('model_id'); 
		$result = $this->m_ajax_ad_post->get_model_bycompany_id($v_company_id);

		$res_company = $this->m_ajax_ad_post->get_company_byCompany_id($v_company_id);

		if($res_company != null)
		{
			if($res_company[0]['company_name'] == 'Other Brands')
			{
				echo '0';
			}
			else
			{	
			
				$output =  "<option value=''>Select Model </option>";
				if($result != null)
				{
					foreach ($result as  $value) {

							if($model_id == $value->model_id)
							{
								$output .= "<option value='".$value->model_id."' selected>".$value->model_name."</option>"; 
							}
							else
							{	
								$output .= "<option value='".$value->model_id."'>".$value->model_name."</option>";
							}


					}
					echo $output;
				}
				else
				{
					$output = "<option value=''>Select Model</option>";
					echo '1';
				}
			}
		}
	}

	public function fun_show_other_mmodel()
	{
		$this->load->model('m_ajax_ad_post');
		$v_model_id = $this->input->post('model_id'); 
		$result = $this->m_ajax_ad_post->get_model_bymodel_id($v_model_id);

		if($result != null)
		{
			if($result[0]['model_name'] == 'Others')
			{
				echo '0';
			}
			else
			{
				echo '1';
			}
		}
	}

	public function auto_search_city_locality()
	{
		$this->load->model('m_ajax_ad_post');
		$search_value = $this->input->post('search_val');
		$element_name = $this->input->post('element');
		$city_id = $this->input->post('city_id');
		
		$result = $this->m_ajax_ad_post->auto_search_city_locality($search_value,$element_name,$city_id);

			
		if($result != null && $element_name == 'city')  
		{ 
			foreach($result as $value)
			{		
				$city_name = $value->city_name;
				$city_id = $value->city_id;
				// put in bold the written text
				$c_name = str_replace($search_value, '<b>'.$search_value.'</b>', $city_name);
		
				echo '<li onclick="set_item(\''.$city_id.'\',\''.$city_name.'\',\''.$element_name.'\')" onkeydown="fun_set_item(\''.$city_id.'\',\''.$city_name.'\',\''.$element_name.'\',event)">'.$c_name.'</li>';
			
			}
		}
		else if($result != null && $element_name == 'locality')  
		{ 
			foreach($result as $value)
			{		
				$locality_name = $value->locality_name;
				$locality_id = $value->locality_id;
				// put in bold the written text
				$l_name = str_replace($search_value, '<b>'.$search_value.'</b>', $locality_name);
		
				echo '<li onclick="set_item(\''.$locality_id.'\',\''.$locality_name.'\',\''.$element_name.'\')" onkeydown="fun_set_item(\''.$locality_id.'\',\''.$locality_name.'\',\''.$element_name.'\',event)">'.$l_name.'</li>';
			
			}
		}

		else
		{
			echo '<li style="color:red">No Record Found</li>';
		}
	}
/*	public function fun_get_locality_byCityId()
	{
		$this->load->model('m_ajax_ad_post');
		$v_city_id = $this->input->post('city_id'); 
		$locality_id = '';
		$result = $this->m_ajax_ad_post->fun_get_locality_byCityId($v_city_id);

		if($result != null)
		{
				$output =  "<option value=''>Select Locality </option>";
				if($result != null)
				{
					foreach ($result as  $value) {

							if($locality_id == $value->locality_id)
							{
								$output .= "<option value='".$value->locality_id."' selected>".$value->locality_name."</option>"; 
							}
							else
							{	
								$output .= "<option value='".$value->locality_id."'>".$value->locality_name."</option>";
							}


					}
					echo $output;
				}
				else
				{
					$output = "<option value=''>Select Locality</option>";
					echo '1';
				}
			
		}	
	} */
	public function fun_ad_post_detail()
	{
		$conditions = '';
		$price = '';
		$negotiable = '';
		$company_id = '';
		$model_id = '';
		$year = '';
		$kmdriven = '';
		$fuel = '';
		$salary_upto = '';
		$job_period_id ='';
		$m_need = '';
		$m_g_selected = '';
		$m_b_selected = '';
		$m_w_selected = '';
		$new_check = '';
		$used_check = '';
		$negotiable_check = '';

		$this->load->model('m_ajax_ad_post');
		$this->load->model('m_home');
		$v_sub_category_id = $this->input->post('sub_category_id');
		$ad_id = $this->input->post('ad_id');

		$ad_detail = $this->m_home->get_edit_ad_detail_by_id($ad_id);
		if(isset($ad_detail) && $ad_detail != null)
		{
			//print_r($ad_detail);
			foreach ($ad_detail as  $value) {

				$conditions = $value->conditions;
				if($conditions == 'new') { $new_check ='checked'; }else{ $used_check ='checked';}
				$price = $value->price;
				$negotiable = $value->negotiable;
				if($negotiable == 1)
				{
					$negotiable_check = 'checked';
				}	 


				$company_id = $value->company_id;
				$model_id = $value->model_id;
				$year = $value->year;
				$kmdriven = $value->kmdriven;
				$fuel = $value->fuel;
				$salary_upto = $value->salary_upto;
				$job_period_id =$value->job_period;
			
				$m_need = $value->m_need;
			}
		}
		//echo $v_sub_category_id;
		$data = '';
		if($v_sub_category_id == 24 )
		{	
				$V_company = $this->m_ajax_ad_post->fun_get_company($v_sub_category_id);
				$V_fuel = $this->m_ajax_ad_post->get_fuel();

				$data .= '<div class="row form-group select-condition">
							<label class="col-sm-3">Condition<span class="required">*</span></label>
							<div class="col-sm-9">
								<input type="radio" name="radio_condition" value="new" id="radio_condition_new" '.$new_check.'> 
								<label for="radio_condition_new">New</label>
								<input type="radio" name="radio_condition" value="used" id="radio_condition_used" '.$used_check.'> 
								<label for="radio_condition_used">Used</label>
								<span id="err_radio_conditions" class="erro_msg"></span>
							</div>
						</div>
						<div class="row form-group select-price">
							<label class="col-sm-3 label-title">Price<span class="required">*</span></label>
							<div class="col-sm-9">
								<label>INR</label>
								<input type="text" class="form-control" id="txt_price" name="txt_price" onkeyup=fun_remove_error_message("txt_price","err_txt_price"); onkeypress="return fun_valid_price(event,this);" value="'.$price.'">
								<input type="checkbox" name="chk_negotiable" value="1" id="chk_negotiable" '.$negotiable_check.'>
								<label for="chk_negotiable">Negotiable </label>
								<span id="err_txt_price" class="erro_msg"></span>
							</div>
						</div>
						<div class="row form-group">
							<label class="col-sm-3 label-title">Brand Name<span class="required">*</span></label>
							<div class="col-sm-9">';
								  
                             $arr_data = array('class'=>'form-control','id'=>'sel_company','required'=>'required','onchange'=>'get_model_bycompany_id(this.value);');
                             $data .=  form_dropdown('sel_company',$V_company,$company_id,$arr_data);

                             $data .= '  
                            	<span id="err_sel_company" class="erro_msg"></span>	
							</div>
						</div>
						
						<div class="row form-group hide" id="div_other_brand">
							<label class="col-sm-3 label-title"><span class="required"></span></label>
							<div class="col-sm-9">								  
                            	<input type="text" class="form-control" name="txt_other_brand" id="txt_other_brand" placeholder="Enter brand name" onkeyup=fun_remove_error_message("txt_other_brand","err_txt_other_brand"); >
                            	<span id="err_txt_other_brand" class="erro_msg"></span>
							</div>
						</div>
						
						<div class="row form-group model-name" id="div_sel_model">
							<label class="col-sm-3 label-title">Model</label>
							<div class="col-sm-9" >
								<select name="sel_model" id="sel_model" class="form-control" onchange="show_other_text(this.value)">

								</select>

								<span id="err_sel_model" class="erro_msg"></span>	
							</div>
						</div>

						<div class="row form-group hide" id="div_other_model">
							<label class="col-sm-3 label-title"><span class="required"></span></label>
							<div class="col-sm-9">								  
                            	<input type="text" class="form-control" name="txt_other_model" id="txt_other_model" placeholder="Enter model name" onkeyup=fun_remove_error_message("txt_other_model","err_txt_other_model"); >
                            	<span id="err_txt_other_model" class="erro_msg"></span>
							</div>
						</div>

						<div class="row form-group brand-name">
							<label class="col-sm-3 label-title">Year</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="txt_year" id="txt_year" onkeyup=fun_remove_error_message("txt_year","err_txt_year"); onkeypress="return fun_valid_price(event,this);" value="'.$year.'">
								<span id="err_txt_year" class="erro_msg"></span>
							</div>
						</div>
						<div class="row form-group brand-name">
							<label class="col-sm-3 label-title">Fuel</label>
							<div class="col-sm-9">';
							  
							 $arr_data = array('class'=>'form-control','id'=>'txt_fuel','required'=>'required');
                             $data .=  form_dropdown('txt_fuel',$V_fuel,$fuel,$arr_data);

            				$data .='<span id="err_txt_fuel" class="erro_msg"></span>
						

							</div>
						</div>
						<div class="row form-group">
							<label class="col-sm-3 label-title">KM Driven</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="txt_kmdriven" id="txt_kmdriven" onkeyup=fun_remove_error_message("txt_kmdriven","err_txt_kmdriven"); onkeypress="return fun_valid_price(event,this);" value="'.$kmdriven.'">
								<span id="err_txt_kmdriven" class="erro_msg"></span>
							</div>
						</div>
						';
		}	
		else if($v_sub_category_id == 25 || $v_sub_category_id == 26)
		{

			$data .= '<div class="row form-group select-condition">
							<label class="col-sm-3">Condition<span class="required">*</span></label>
							<div class="col-sm-9">
								<input type="radio" name="radio_condition" value="new" id="radio_condition_new" '.$new_check.'> 
								<label for="radio_condition_new">New</label>
								<input type="radio" name="radio_condition" value="used" id="radio_condition_used" '.$used_check.'> 
								<label for="radio_condition_used">Used</label>
								<span id="err_radio_conditions" class="erro_msg"></span>
							</div>
						</div>
						<div class="row form-group select-price">
							<label class="col-sm-3 label-title">Price<span class="required">*</span></label>
							<div class="col-sm-9">
								<label>INR</label>
								<input type="text" class="form-control" id="txt_price" name="txt_price" onkeyup=fun_remove_error_message("txt_price","err_txt_price"); onkeypress="return fun_valid_price(event,this);" value="'.$price.'">
								<input type="checkbox" name="chk_negotiable" value="1" id="chk_negotiable" '.$negotiable_check.'>
								<label for="chk_negotiable">Negotiable </label>
								<span id="err_txt_price" class="erro_msg"></span>
							</div>
						</div>
					
						<div class="row form-group brand-name">
							<label class="col-sm-3 label-title">Year</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="txt_year" id="txt_year" onkeyup=fun_remove_error_message("txt_year","err_txt_year"); onkeypress="return fun_valid_price(event,this);" value="'.$year.'">
								<span id="err_txt_year" class="erro_msg"></span>
							</div>
						</div>
						
						<div class="row form-group">
							<label class="col-sm-3 label-title">KM Driven</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="txt_kmdriven" id="txt_kmdriven" onkeyup=fun_remove_error_message("txt_kmdriven","err_txt_kmdriven"); onkeypress="return fun_valid_price(event,this);" value="'.$kmdriven.'">
								<span id="err_txt_kmdriven" class="erro_msg"></span>
							</div>
						</div>
						';
		} 

		else if($v_sub_category_id == 20 || $v_sub_category_id == 21)
		{
			$V_company = $this->m_ajax_ad_post->fun_get_company($v_sub_category_id);
			$data .= '<div class="row form-group select-condition">
							<label class="col-sm-3">Condition<span class="required">*</span></label>
							<div class="col-sm-9">
								<input type="radio" name="radio_condition" value="new" id="radio_condition_new" '.$new_check.'> 
								<label for="radio_condition_new">New</label>
								<input type="radio" name="radio_condition" value="used" id="radio_condition_used" '.$used_check.'> 
								<label for="radio_condition_used">Used</label>
								<span id="err_radio_conditions" class="erro_msg"></span>
							</div>
						</div>
						<div class="row form-group select-price">
							<label class="col-sm-3 label-title">Price<span class="required">*</span></label>
							<div class="col-sm-9">
								<label>INR</label>
								<input type="text" class="form-control" id="txt_price" name="txt_price" onkeyup=fun_remove_error_message("txt_price","err_txt_price"); onkeypress="return fun_valid_price(event,this);" value="'.$price.'">
								<input type="checkbox" name="chk_negotiable" value="1" id="chk_negotiable" '.$negotiable_check.'>
								<label for="chk_negotiable">Negotiable </label>
								<span id="err_txt_price" class="erro_msg"></span>
							</div>
						</div>
						<div class="row form-group">
							<label class="col-sm-3 label-title">Brand Name<span class="required">*</span></label>
							<div class="col-sm-9">';
								  
                             $arr_data = array('class'=>'form-control','id'=>'sel_company','required'=>'required','onchange'=>'get_model_bycompany_id(this.value);');
                             $data .=  form_dropdown('sel_company',$V_company,$company_id,$arr_data);

                             $data .= '  
                             	<span id="err_sel_company" class="erro_msg"></span>
								
							</div>
						</div>
						
						
						<div class="row form-group hide" id="div_other_brand">
							<label class="col-sm-3 label-title"><span class="required"></span></label>
							<div class="col-sm-9">								  
                            	<input type="text" class="form-control" name="txt_other_brand" id="txt_other_brand" placeholder="Enter brand name" onkeyup=fun_remove_error_message("txt_other_brand","err_txt_other_brand");>
                            	<span id="err_txt_other_brand" class="erro_msg"></span>
							</div>
						</div>
						
						<div class="row form-group model-name" id="div_sel_model">
							<label class="col-sm-3 label-title">Model</label>
							<div class="col-sm-9" >
								<select name="sel_model" id="sel_model" class="form-control" onchange="show_other_text(this.value)">

								</select>
								<span id="err_sel_model" class="erro_msg"></span>
							</div>
						</div>

						<div class="row form-group hide" id="div_other_model">
							<label class="col-sm-3 label-title"><span class="required"></span></label>
							<div class="col-sm-9">								  
                            	<input type="text" class="form-control" name="txt_other_model" id="txt_other_model" placeholder="Enter model name" onkeyup=fun_remove_error_message("txt_other_brand","err_txt_other_model"); >
                            	<span id="err_txt_other_model" class="erro_msg"></span>
							</div>
						</div>

						<div class="row form-group brand-name">
							<label class="col-sm-3 label-title">Year</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="txt_year" id="txt_year" onkeyup=fun_remove_error_message("txt_year","err_txt_year"); onkeypress="return fun_valid_price(event,this);" value="'.$year.'">
								<span id="err_txt_year" class="erro_msg"></span>
							</div>
						</div>
						
						<div class="row form-group">
							<label class="col-sm-3 label-title">KM Driven</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="txt_kmdriven" id="txt_kmdriven" onkeyup=fun_remove_error_message("txt_kmdriven","err_txt_kmdriven"); onkeypress="return fun_valid_price(event,this);" value="'.$kmdriven.'">
								<span id="err_txt_kmdriven" class="erro_msg"></span>
							</div>
						</div>
						';
		}
		else if($v_sub_category_id== '1' || $v_sub_category_id == '2')
		{
			$V_company = $this->m_ajax_ad_post->fun_get_company($v_sub_category_id);
			$data .= '<div class="row form-group select-condition">
							<label class="col-sm-3">Condition<span class="required">*</span></label>
							<div class="col-sm-9">
								<input type="radio" name="radio_condition" value="new" id="radio_condition_new" '.$new_check.'> 
								<label for="radio_condition_new">New</label>
								<input type="radio" name="radio_condition" value="used" id="radio_condition_used" '.$used_check.'> 
								<label for="radio_condition_used">Used</label>
								<span id="err_radio_conditions" class="erro_msg"></span>
							</div>
						</div>
						<div class="row form-group select-price">
							<label class="col-sm-3 label-title">Price<span class="required">*</span></label>

							<div class="col-sm-9">
								<label>INR</label> 
								<input type="text" class="form-control" id="txt_price" name="txt_price" onkeyup=fun_remove_error_message("txt_price","err_txt_price"); onkeypress="return fun_valid_price(event,this);" value="'.$price.'">

								<input type="checkbox" name="chk_negotiable" value="1" id="chk_negotiable" '.$negotiable_check.'>
								<label for="chk_negotiable">Negotiable </label>
								<span id="err_txt_price" class="erro_msg"></span>
							</div>

						</div>
						<div class="row form-group">
							<label class="col-sm-3 label-title">Brand Name<span class="required">*</span></label>
							<div class="col-sm-9">';
								  
                             $arr_data = array('class'=>'form-control','id'=>'sel_company','required'=>'required','onchange'=>'get_model_bycompany_id(this.value);');
                             $data .=  form_dropdown('sel_company',$V_company,$company_id,$arr_data);

                             $data .= '  
                             	<span id="err_sel_company" class="erro_msg"></span>
								
							</div>
						</div>
						
						
						<div class="row form-group hide" id="div_other_brand">
							<label class="col-sm-3 label-title"><span class="required"></span></label>
							<div class="col-sm-9">								  
                            	<input type="text" class="form-control" name="txt_other_brand" id="txt_other_brand" placeholder="Enter brand name" onkeyup=fun_remove_error_message("txt_other_brand","err_txt_other_brand");>
                            	<span id="err_txt_other_brand" class="erro_msg"></span>
							</div>
						</div>';
		}

		else if( $v_sub_category_id == '3' || $v_sub_category_id == '4' || $v_sub_category_id == '5' || $v_sub_category_id == '6' || $v_sub_category_id == '7' || $v_sub_category_id == '8' || $v_sub_category_id == '9' || $v_sub_category_id == '10' || $v_sub_category_id == '11' || $v_sub_category_id== '12' || $v_sub_category_id == '13' || $v_sub_category_id == '22' || $v_sub_category_id == '23' || $v_sub_category_id == '27' || $v_sub_category_id == '28' || $v_sub_category_id == '29' || $v_sub_category_id == '30' || $v_sub_category_id == '31' || $v_sub_category_id == '32' || $v_sub_category_id == '33' || $v_sub_category_id == '34' || $v_sub_category_id == '35' || $v_sub_category_id == '36' || $v_sub_category_id == '38' || $v_sub_category_id == '39' || $v_sub_category_id == '40')

		{
			$data .= '<div class="row form-group select-condition">
							<label class="col-sm-3">Condition<span class="required">*</span></label>
							<div class="col-sm-9">
								<input type="radio" name="radio_condition" value="new" id="radio_condition_new" '.$new_check.'> 
								<label for="radio_condition_new">New</label>
								<input type="radio" name="radio_condition" value="used" id="radio_condition_used" '.$used_check.'> 
								<label for="radio_condition_used">Used</label>
								<span id="err_radio_conditions" class="erro_msg"></span>
							</div>
						</div>
						<div class="row form-group select-price">
							<label class="col-sm-3 label-title">Price<span class="required">*</span></label>

							<div class="col-sm-9">
								<label>INR</label> 
								<input type="text" class="form-control" id="txt_price" name="txt_price" onkeyup=fun_remove_error_message("txt_price","err_txt_price"); onkeypress="return fun_valid_price(event,this);" value="'.$price.'">

								<input type="checkbox" name="chk_negotiable" value="1" id="chk_negotiable" '.$negotiable_check.'>
								<label for="chk_negotiable">Negotiable </label>
								<span id="err_txt_price" class="erro_msg"></span>
							</div>

						</div>';
		}
	/*	else if($v_sub_category_id == 15)
		{
			$data .= '<div class="row form-group select-condition">
							<label class="col-sm-3">Upload CV:<span class="required">*</span></label>
							<div class="col-sm-9">
								<input type="file" name="resume" id="resume">
								<span id="err_resume" class="erro_msg"></span>
							</div>
						</div>';
		}*/
		else if($v_sub_category_id == 37)
		{
			if($m_need == 'Groom'){ $m_g_selected ='selected';}
			if($m_need == 'Bride'){ $m_b_selected ='selected';}
			if($m_need == 'Wedding Planner'){ $m_w_selected ='selected';}
			$data .= '<div class="row form-group select-condition">
							<label class="col-sm-3">Need :<span class="required">*</span></label>
							<div class="col-sm-9">
								 <select name="sel_matri_need" id="sel_matri_need" class="form-control">  
		                         <option value="">Select...</option>

		                         <option value="Groom" '.$m_g_selected.'>Groom</option>
		                         <option value="Bride" '.$m_b_selected.'>Bride</option>
		                         <option value="Wedding Planner" '.$m_w_selected.'>Wedding Planner</option>

		                         </select>
		                         <span id="err_sel_matri_need" class="erro_msg"></span>
	                         </div>
						</div>';
		}
		else if($v_sub_category_id == 14)
		{

			$V_job_period = $this->m_ajax_ad_post->get_job_period();
			$data .= '
						<div class="row form-group select-price">
							<label class="col-sm-3 label-title">Salary Upto :<span class="required">*</span></label>
							<div class="col-sm-9">
								<label>INR</label>
								<input type="text" class="form-control" name="txt_salaryupto" id="txt_salaryupto" onkeyup=fun_remove_error_message("txt_salaryupto","err_txt_salaryupto"); onkeypress="return fun_valid_price(event,this);" value="'.$salary_upto.'";>
								 <span id="err_txt_salaryupto" class="erro_msg"></span>
							</div>
						</div>
						<div class="row form-group">
							<label class="col-sm-3 label-title">Job Period :<span class="required">*</span></label>
							<div class="col-sm-9">';
								  
                             $arr_data = array('class'=>'form-control','id'=>'sel_jobperiod','required'=>'required');
                             $data .=  form_dropdown('sel_jobperiod',$V_job_period,$job_period_id,$arr_data);

                             $data .= '  

								 <span id="err_sel_jobperiod" class="erro_msg"></span>
							</div>
						</div>';
		}
		else
		{
			$data = '';
		}
		echo $data;	
	}


	
}
