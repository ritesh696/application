<?php 


$ad_id = '';

$category_id = '';
$category_name = '';
$category_image = '';
$sub_category_id = '';
$sub_category_name = '';

$v_phone_no = '';
$v_name = '';
$v_city ='';
$v_locality = '';
$v_u_type_check = '';
$d_check= '';
$i_check ='';
$r_check = '';
$m_check = '';
$disabled= ''; 

$ad_title = '';
$ad_description= '';
$ad_type = '';
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
$ad_images = array();


$sell_check = '';
$buy_check = '';
$new_check = '';
$used_check = '';

if(isset($cat_subcat_value) &&  $cat_subcat_value !=null)
{
	foreach ($cat_subcat_value as  $value) {
		$category_id = $value->category_id;
		$category_name = $value->category_name;
		$category_image = base_url('assets/images/Cat_Subcat/').$value->category_image;
		$sub_category_id = $value->sub_category_id;
		$sub_category_name = $value->sub_category_name;
	}
}
if(isset($user_detail) && $user_detail != null)
{
	foreach ($user_detail as  $value) {


		$v_name = $value->user_name;
		$v_phone_no = $value->phone_no;
		$v_city = $value->city;
		$v_locality = $value->locality;
		$v_u_type_check = $value->user_type;
		$disabled = 'disabled';
		if($v_u_type_check == 'dealer')
		{
			$d_check = 'checked';
			$i_check = '';
			$r_check = '';
			$m_check = '';
		}
		else if($v_u_type_check == 'individual')
		{
			$d_check = '';
			$i_check = 'checked';
			$r_check = '';
			$m_check = '';
		}
		else if($v_u_type_check == 'reseller')
		{
			$d_check = '';
			$i_check = '';
			$r_check = 'checked';
			$m_check = '';
		}
		else
		{
			$d_check = '';
			$i_check = '';
			$r_check = '';
			$m_check = 'checked';
		}
	}
}
if(isset($ad_detail) && $ad_detail != null)
{
	//print_r($ad_detail);
	foreach ($ad_detail as  $value) {

		$category_id = $value->category_id;
		$category_name = $value->category_name;
		$category_image = base_url('assets/images/Cat_Subcat/').$value->category_image;
		$sub_category_id = $value->sub_category_id;
		$sub_category_name = $value->sub_category_name;

		$ad_id = $value->ad_id;
		$ad_title = $value->ad_title;
		$ad_description= $value->description;
		$company_id = $value->company_id;
		$model_id = $value->model_id;
		if($value->ad_type == 'buy')
            {
                $buy_check = "checked";
            }	
            else
            {
            	$sell_check = "checked";
            }

		
		    
		$ad_images = explode(",", $value->image);


		$v_name = $value->user_name;
		$v_phone_no = $value->phone_no;
		$v_city = $value->city;
		$v_locality = $value->locality;
		$v_u_type_check = $value->user_type;
		$disabled = 'disabled';
		if($v_u_type_check == 'dealer')
		{
			$d_check = 'checked';
			$i_check = '';
			$r_check = '';
			$m_check = '';
		}
		else if($v_u_type_check == 'individual')
		{
			$d_check = '';
			$i_check = 'checked';
			$r_check = '';
			$m_check = '';
		}
		else if($v_u_type_check == 'reseller')
		{
			$d_check = '';
			$i_check = '';
			$r_check = 'checked';
			$m_check = '';
		}
		else
		{
			$d_check = '';
			$i_check = '';
			$r_check = '';
			$m_check = 'checked';
		}
	}
}
?>


<!DOCTYPE html>
<html lang="en">
  

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Theme Region">
   	<meta name="description" content="">

    <title>Swapiee</title>

   <!-- CSS -->
    <?= link_tag('assets/css/bootstrap.min.css');?>
    <?= link_tag('assets/css/font-awesome.min.css');?>
	<?= link_tag('assets/css/icofont.css');?>
    <?= link_tag('assets/css/owl.carousel.css');?>  
    <?= link_tag('assets/css/slidr.css');?>
    <?= link_tag('assets/css/main.css');?>
	<?= link_tag('assets/css/presets/preset1.css');?>
    <?= link_tag('assets/css/responsive.css');?>
    
	<!-- font -->
	<?= link_tag('assets/css/ff.css');?>
	<?= link_tag('assets/css/gg.css');?>

	<!-- icons -->
	<link rel="icon" href="<?= base_url('assets/images/ico/favicon.ico');?>">	
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=  base_url('assets/images/ico/apple-touch-icon-144-precomposed.png');?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=  base_url('assets/images/ico/apple-touch-icon-114-precomposed.png');?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url('assets/images/ico/apple-touch-icon-72-precomposed.html');?>">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?= base_url('assets/images/ico/apple-touch-icon-57-precomposed.png');?>">
    <!-- icons -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Template Developed By LAboO -->
  </head>
  <body>
	<!-- header -->
	<?php include_once('inc/header.php'); ?>
	<!-- header -->

	<!-- main -->
	<section id="main" class="clearfix ad-details-page">
		<div class="container">
		
			<div class="breadcrumb-section">
				<!-- breadcrumb -->
				<!-- breadcrumb -->						
				<h2 class="title">Category - Sub Category</h2>
			</div><!-- banner -->

			<div class="adpost-details">
				<div class="row">	
					<div class="col-md-8">
						
						<?= form_open(base_url().'c_ajax_site_home/ad_post',['id'=>'frm_ad_post_detail','name'=>'frm_ad_post_detail']) ?>	
							<fieldset>
								<div class="section postdetails">
									<h4>Sell an item or service <span class="pull-right">* Mandatory Fields</span></h4>
									<div class="form-group selected-product">
										<ul class="select-category list-inline">
											<li>
												<a href="#">
													<span class="select">
														<img src="<?= $category_image;?>" alt="Images" class="img-responsive">
													</span>
													<?= $category_name; ?>
												</a>
											</li>

											<li class="active">
												<a href="javascript:void(0);"><?= $sub_category_name; ?></a>
											</li>
										</ul>
										
										<input type="hidden" name="txt_ad_id" id="txt_ad_id" value="<?= $ad_id; ?>">
										<input type="hidden" name="txt_category_id" id="txt_category_id" value="<?= $category_id; ?>">
										<input type="hidden" name="txt_sub_category_id" id="txt_sub_category_id" value="<?= $sub_category_id; ?>">
									<?php if($ad_id == ''){ ?>
										<a class="edit" href="<?= base_url('ad-post/'.$category_id); ?>"><i class="fa fa-pencil"></i>Edit</a>
									<?php } ?>
									</div>
									<?php if($sub_category_id != 37 ){ ?>	
									<div class="row form-group">
										<label class="col-sm-3">Type of ad<span class="required">*</span></label>
										<div class="col-sm-9 user-type">
											<input type="radio" name="radio_sellType" value="sell" id="radio_sellType_sell" <?= $sell_check; ?> > 
											<label for="radio_sellType_sell"onclick="fun_remove_error_message('','err_radio_sellType');">I want to sell </label>
											<input type="radio" name="radio_sellType" value="buy" id="radio_sellType_buy" <?= $buy_check; ?> > 
											<label for="radio_sellType_buy" onclick="fun_remove_error_message('','err_radio_sellType');">want to buy</label>	<span id="err_radio_sellType" class="erro_msg"></span>
										</div>
									</div>
									<?php } ?>	
									<div class="row form-group add-title">
										<label class="col-sm-3 label-title">Title for your Ad<span class="required">*</span></label>
										<div class="col-sm-9">
										<?php if($ad_id != ''){ ?>

											<input type="hidden" class="form-control" id="txt_title" name="txt_title" placeholder="ex, Sony Xperia dual sim 100% brand new " value="<?= $ad_title; ?>"> 

											<input type="text" disabled="disabled" class="form-control" value="<?= $ad_title; ?>"> 

										<?php }else{ ?>	
											<input type="text" class="form-control" autofocus="on" id="txt_title" name="txt_title" placeholder="ex, Sony Xperia dual sim 100% brand new " onkeyup="textlimit_adtitle()" onkeypress="user_name_validate(event,this,'err_txt_title','txt_title')"  maxlength="90" value="<?= $ad_title; ?>"> 
										<?php } ?>	
											<span id="err_txt_title" class="erro_msg"></span>
										
										</div>
									</div>
									<div class="row form-group add-image">
										<label class="col-sm-3 label-title">Photos for your ad <span>(This will be your cover photo )</span> </label>
										<div class="col-sm-9">
											<h5><i class="fa fa-upload" aria-hidden="true"></i>Select Files to Upload / Drag and Drop Files <span>You can add multiple images.</span></h5>
											<div class="upload-section">
												<?php 
												$default_image = '';// base_url().'assets/images/loading.png';
												 $img1 = '';
												 $img2 = '';
												 $img3 = '';
												 $img4 = '';

							                    if($ad_id != ''){
							                       
							                          for($i=0;$i<count($ad_images);$i++)
							                           {
							                           		if($i == 0)
							                           			{ $img1 = base_url('assets/images/ads_images/').$ad_images[$i];	 }
							                           		if($i == 1) { $img2 = base_url('assets/images/ads_images/').$ad_images[$i];	  }
							                           		if($i == 2) { $img3 = base_url('assets/images/ads_images/').$ad_images[$i];	  }
							                           		if($i == 3) { $img4 = base_url('assets/images/ads_images/').$ad_images[$i];	  }
							                              ?>
							                            	 <input type="text" hidden="hidden"  id="db<?php echo $i+1;?>" name="db<?php echo $i+1;?>" value="<?php echo $ad_images[$i];?>" />  
							                              <?php
							                            }
							                        } 

												?>
												<label class="upload-image" for="file1" id="lbl_file1"><img id="img1" src=" <?= $img1; ?>" onerror="if (this.src != '<?= $default_image ?>') this.src = '<?= $default_image ?>';"  >
														<input type="file" hidden="hidden" id="file1" name="file[]">
												</label> 	
																									

												<label class="upload-image" for="file2"> <img id="img2" src="<?= $img2; ?>" onerror="if (this.src != '<?= $default_image ?>') this.src = '<?= $default_image ?>';" >
													<input type="file" id="file2" name="file[]">
												</label>											
												<label class="upload-image" for="file3"><img id="img3" src="<?= $img3; ?>" onerror="if (this.src != '<?= $default_image ?>') this.src = '<?= $default_image ?>';">
													<input type="file" id="file3" name="file[]">
												</label>										

												<label class="upload-image" for="file4"><img id="img4" src="<?= $img4; ?>" onerror="if (this.src != '<?= $default_image ?>') this.src = '<?= $default_image ?>';">
													<input type="file" id="file4" name="file[]">
												</label>

												 <input id="txt_img1" name="txt_img[]" hidden="hidden"  type="text" >
								                 <input id="txt_img2" name="txt_img[]" hidden="hidden"  type="text" >
								                 <input id="txt_img3" name="txt_img[]"  hidden="hidden" type="text" >
								                 <input id="txt_img4" name="txt_img[]" hidden="hidden" type="text" >
										
												
											</div> <span id="err_file" class="erro_msg"></span>		
										</div>
									</div>
								

								<div id="div_show_detail">	

								<!--	<div class="row form-group select-condition">
										<label class="col-sm-3">Condition<span class="required">*</span></label>
										<div class="col-sm-9">
											<input type="radio" name="itemCon" value="new" id="new"> 
											<label for="new">New</label>
											<input type="radio" name="itemCon" value="used" id="used"> 
											<label for="used">Used</label>
										</div>
									</div>
									<div class="row form-group select-price">
										<label class="col-sm-3 label-title">Price<span class="required">*</span></label>
										<div class="col-sm-9">
											<label>INR</label>
											<input type="text" class="form-control" id="text1">
											<input type="checkbox" name="price" value="negotiable" id="negotiable">
											<label for="negotiable">Negotiable </label>
										</div>
									</div>
									<div class="row form-group brand-name">
										<label class="col-sm-3 label-title">Brand Name<span class="required">*</span></label>
										<div class="col-sm-9">
											<input type="text" class="form-control" placeholder="ex, Sony Xperia">
										</div>
									</div>
									
									
									<div class="row form-group model-name">
										<label class="col-sm-3 label-title">Model</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="model" placeholder="ex, Sony Xperia dual sim 100% brand new ">	
										</div>
									</div>
								-->
									
								</div>	



									<div class="row form-group item-description">
										<label class="col-sm-3 label-title">Description<span class="required">*</span></label>
										<div class="col-sm-9">
											<textarea class="form-control" id="txa_description" name="txa_description" placeholder="Write few lines about your products" rows="8" onkeyup="textcounter(this,'counter',1000)" maxlength="1000"><?= $ad_description; ?></textarea>	
											<span id="err_txa_description" class="pull-right erro_msg"></span>	
										</div>
									</div>
									<div class="row">
										<div class="col-sm-9 col-sm-offset-3">
											<p> <span id="counter"> 1000</span> characters left</p>
 									</div>
									</div>								
								</div><!-- section -->
								
								<div class="section seller-info">
									<h4>Seller Information</h4>
									<div class="row form-group">
										<label class="col-sm-3 label-title">Condition<span class="required">*</span></label>
										<div class="col-sm-9">
											<input type="radio" name="radio_sellerType" value="individual" id="radio_sellerType_individual" <?= $i_check;?>>
											<label for="radio_sellerType_individual">Individual</label>
											
											<input type="radio" name="radio_sellerType" value="dealer" id="radio_sellerType_dealer" <?= $d_check;?>> 
											<label for="radio_sellerType_dealer">Dealer</label>

											<input type="radio" name="radio_sellerType" value="reseller" id="radio_sellerType_reseller" <?= $r_check;?>> 
											<label for="radio_sellerType_reseller">Reseller</label>

											<input type="radio" name="radio_sellerType" value="manufacturer" id="radio_sellerType_manufacturer" <?= $m_check;?>> 
											<label for="radio_sellerType_manufacturer">Manufacturer</label>
											
											<span id="err_radio_sellerType" class="erro_msg"></span>
										</div>
									</div>
									<div class="row form-group">
										<label class="col-sm-3 label-title">Your Name<span class="required">*</span></label>
										<div class="col-sm-9">
											<input type="text" name="txt_name" id="txt_name" class="form-control" placeholder="ex, Jhon Doe" onkeypress="user_name_validate(event,this,'err_txt_name','txt_name')" value="<?= $v_name; ?>">
											<span id="err_txt_name" class="erro_msg"></span>
										</div>
									</div>
									
									<div class="row form-group">
										<label class="col-sm-3 label-title">Mobile Number<span class="required">*</span></label>
										<div class="col-sm-9">
										<?php if($v_phone_no != '' ){ ?>	
											<input type="text" <?= $disabled;?> autocomplete="off" class="form-control" placeholder="ex, +912457895" value="<?= $v_phone_no;?>">
											<input type="hidden" name="txt_mobno" id="txt_mobno" class="form-control" value="<?= $v_phone_no;?>">
										<?php }else{ ?>
												<input type="text" name="txt_mobno" autocomplete="off" id="txt_mobno" class="form-control" placeholder="ex, +912457895" onkeypress="return fun_valid_price(event,this);" value="<?= $v_phone_no;?>">
										<?php } ?>	
											<span id="err_txt_mobno" class="erro_msg"></span>
										</div>
									</div>
									<div class="row form-group">
										<label class="col-sm-3 label-title">City<span class="required">*</span></label>
										<div class="col-sm-9">
										<input type="hidden" name="txt_city" id="txt_city">
										<input type="text" name="txt_search_city" autocomplete="off" id="txt_search_city" class="form-control" autocomplete="off" placeholder="" onkeyup="fun_remove_error_message('txt_search_city','err_txt_city');" value="<?= $v_city; ?>" onkeydown="return fun_setfocus(event,'search_list_city');" onkeypress="search_autofill('city');"/>
											<ul class="ui-widget" id="search_list_city">
											
											</ul>
											<span id="err_txt_city" class="erro_msg"></span>
										

										</div>
									</div>
									<div class="row form-group">
										<label class="col-sm-3 label-title">Locality<span class="required">*</span></label>
										<div class="col-sm-9">
											<input type="hidden" name="txt_locality" id="txt_locality">
											 <input type="text" name="txt_search_locality" autocomplete="off" id="txt_search_locality" class="form-control" autocomplete="off" placeholder="" onkeyup="fun_remove_error_message('txt_search_locality','err_txt_locality');" value="<?= $v_locality; ?>"onkeydown="return fun_setfocus(event,'search_list_locality');" onkeypress="search_autofill('locality');"/>
											<ul class="ui-widget" id="search_list_locality">
											
											</ul>
											<span id="err_txt_locality" class="erro_msg"></span>
										</div>
									</div>
								</div><!-- section -->
								
								
								
								<div class="checkbox section agreement"> <span id="err_chk_send" class="erro_msg"></span>
									<label for="chk_send"> 
										<input type="checkbox" name="chk_send" id="chk_send" value="1"> 
										Send me Trade Email/SMS Alerts for people looking to buy mobile handsets in www By clicking "Post", you agree to our <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a> and acknowledge that you are the rightful owner of this item and using Trade to find a genuine buyer.
									</label>
									 <input type="hidden" name="city" id="city" />
				                     <input type="hidden" name="state" id="state" />
				                     <input type="hidden" name="country" id="country" />   



									<button type="button" class="btn btn-primary" id="btn_post_ad">Post Your Ad <i id="loader_ad_post" class="fa fa-spinner fa-spin hide"></i></button>
								</div><!-- section -->
								
							</fieldset>
						<?= form_close(); ?><!-- form -->	
					</div>
				

					<!-- quick-rules -->	
					<div class="col-md-4">
						<div class="section quick-rules">
							<h4>Quick rules</h4>
							<p class="lead">Posting an ad on <a href="#">Trade.com</a> is free! However, all ads must follow our rules:</p>

							<ul>
								<li>Make sure you post in the correct category.</li>
								<li>Do not post the same ad more than once or repost an ad within 48 hours.</li>
								<li>Do not upload pictures with watermarks.</li>
								<li>Do not post ads containing multiple items unless it's a package deal.</li>
								<li>Do not put your email or phone numbers in the title or description.</li>
								
							</ul>
						</div>
					</div><!-- quick-rules -->	
				</div><!-- photos-ad -->				
			</div>	
		</div><!-- container -->
	</section><!-- main -->
	
	<!-- footer -->
	<?php include('inc/footer.php'); ?>
	<!-- footer -->

	<!--/Preset Style Chooser--> 
	
	<!--/End:Preset Style Chooser-->
	
    <!-- JS -->
    <script src="<?= base_url('assets/js/jquery.min.js');?>"></script>
    <script src="<?= base_url('assets/js/modernizr.min.js');?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js');?>"></script>
	<!-- <script src="http://maps.google.com/maps/api/js?sensor=true"></script> -->
	<!-- <script src="<?= base_url('assets/js/gmaps.min.js');?>"></script> -->
    <script src="<?= base_url('assets/js/owl.carousel.min.js');?>"></script>
    <script src="<?= base_url('assets/js/smoothscroll.min.js');?>"></script>
    <script src="<?= base_url('assets/js/scrollup.min.js');?>"></script>
    <script src="<?= base_url();?>assets/js/price-range.js"></script>
    <script src="<?= base_url('assets/js/jquery.countdown.js');?>"></script>    
    <script src="<?= base_url('assets/js/custom.js');?>"></script>
	<script src="<?= base_url('assets/js/switcher.js');?>"></script>
<!-- CUCSTOM JS -->
	<script src="<?= base_url('assets/js/common.js');?>"></script>
        <!-- Dropdown with search -->


	<!----<script>  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','../../www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-73239902-1', 'auto');
	  ga('send', 'pageview');             </script>---->
  


<script type="text/javascript">

// $("#txt_city").chosen();
// $("#txt_locality").chosen();

	$(document).ready(function(){

		var sub_category_id = '<?= $sub_category_id; ?>';
		var ad_id = '<?= $ad_id; ?>';
		var company_id = '<?= $company_id; ?>';
		var model_id = '<?= $model_id; ?>';

		if(sub_category_id != '')
		{
			$.ajax({
				type:'POST',
				url:"<?= base_url('c_ajax_ad_post/fun_ad_post_detail'); ?>",
				data:{sub_category_id:sub_category_id,
						ad_id:ad_id},
				success:function(data)
				{
					//alert(data);
					$("#div_show_detail").html('');
					$("#div_show_detail").append(data);
				}
			});
		}


		get_model_bycompany_id(company_id,model_id);


        $('input[name="radio_condition"]').click(function(){
           $("#err_radio_conditions").text('');
        }); 


      /*  $("#txt_search_city").focus(function(){
        	//$("#search_list_city").hide();
        	$("#search_list_locality").hide();
        	$("#txt_search_locality").val('');
        	$("#txt_locality").val('');
        });	*/	

        $("#txt_search_locality").focusout(function(){
        	//$("#search_list_locality").hide();
        });		

	});

function get_model_bycompany_id(company_id,model_id)
{

	//alert(company_id);
	 $("#err_sel_company").text('');
	if(company_id != '')
	{
		
			$.ajax({
				type:'POST',
				url:"<?= base_url('c_ajax_ad_post/fun_get_model_byCompanyId'); ?>",
				data:{company_id:company_id,
						model_id:model_id},
				success:function(data)
				{
					//alert(data);
					if(data == 0)	
					{
						$("#div_other_brand").removeClass('hide');
						$("#div_sel_model").addClass('hide');
						$("#div_other_model").removeClass('hide');
					}	
					else
					{		
						$("#div_other_brand").addClass('hide');
						$("#div_sel_model").removeClass('hide');
						$("#div_other_model").addClass('hide');

						$("#sel_model").html('');
						$("#sel_model").html(data);

					}
				}
			});
		}


}
/*function get_locality(city_id)
{
		 $("#err_txt_city").text('');
		if(city_id != '')
		{
		
			$.ajax({
				type:'POST',
				url:"<?= base_url('c_ajax_ad_post/fun_get_locality_byCityId'); ?>",
				data:{city_id:city_id},
				success:function(data)
				{
					//alert(data);
					if(data == 0)	
					{
						//$("#div_sel_model").addClass('hide');
					}	
					else
					{	
						//$("#txt_locality").html('');
						$("#txt_locality").html(data);

					}
				}
			});
		}
}*/
function show_other_text(str)
{
		 $("#err_sel_model").text('');
	
		$.ajax({
				type:'POST',
				url:"<?= base_url('c_ajax_ad_post/fun_show_other_mmodel'); ?>",
				data:{model_id:str},
				success:function(data)
				{

					if(data == 1)
					{
						$("#div_other_model").addClass('hide');
					}
					else
					{
						$("#div_other_model").removeClass('hide');
					}
				}
			});
}


</script>		  




  </body>

<!-- Mirrored from demo.LAboO.com/trade/ad-post-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 14 Feb 2018 18:19:18 GMT -->
</html>