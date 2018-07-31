<?php 


$total_no_of_ads = 0 ;
$first_name = '';
$admin_id = '';
$phone = '';
$city = '';
$state = '';
//$user_detail = array();
foreach ($user_detail as $value) {

	$admin_id =$value->admin_id;
	$user_name = $value->first_name;	
	$phone_no = $value->phone;
	$city = $value->city;
	$state = $value->state;

}
if(isset($total_ads))
{	
	$total_no_of_ads = $total_ads[0]['total_ads'];			
}

$msg = '';
if(($this->session->userdata('update_profile') != ''))
{
	$msg = $this->session->userdata('update_profile');
}
$this->session->unset_userdata('update_profile');

?>

<!DOCTYPE html>
<html lang="en">
  

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Theme Region">
   	<meta name="description" content="">

    <title>Admin wapiee</title>

   <!-- CSS -->
    <?= link_tag('assets/css/bootstrap.min.css');?>
    <?= link_tag('assets/css/font-awesome.min.css');?>
    <?= link_tag('assets/css/main.css');?>
    <?= link_tag('assets/css/responsive.css');?>
	
	<!-- font -->
	<?= link_tag('assets/css/ff.css');?>
	<?= link_tag('assets/css/gg.css');?>
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

	<!-- ad-profile-page -->
	<section id="main" class="clearfix  ad-profile-page">
		<div class="container">
		
			<div class="breadcrumb-section">
				<!-- breadcrumb -->
				<!-- breadcrumb -->						
				<h2 class="title">My Profile</h2>
			</div><!-- banner -->
			
			<div class="ad-profile section">	
				<div class="user-profile">
					<div class="user-images">
						<img src="<?= base_url(); ?>assets/images/user.jpg" alt="User Images" class="img-responsive">
					</div>
					<div class="user">
							<h2>Hello, <a href="javascript:void(0);"><?= $user_name; ?></a></h2>
						</div>

						<div class="favorites-user">
							<div class="my-ads">
								<a href="javascript:void(0);"><?= $total_no_of_ads; ?><small>My ADS</small></a>
							</div>
						
						
						</div>								
				</div><!-- user-profile -->
						
				<ul class="user-menu">
						<li class="active"><a href="<?= base_url('siteadmin/profile');?>">Profile</a></li>
						<li><a href="<?= base_url('siteadmin/pending-ads');?>">Pending approval</a></li>
						<li><a href="<?= base_url('siteadmin/active-ads');?>">Active ads</a></li>
						<li><a href="<?= base_url('siteadmin/deactive-ads');?>">Deactive ads</a></li>
						<li><a href="<?= base_url('siteadmin/deactiveted-ads');?>">Deactive by Admin</a></li>
				</ul>
			</div><!-- ad-profile -->	

			<div class="profile">
				<div class="row">
					<div class="col-sm-8">
						<div class="user-pro-section">
							<!-- profile-details -->
						<?= form_open('#',['name'=>'frm_updateprofile','id'=>'frm_updateprofile']); ?>	
							<div class="profile-details section">

								 <span id="" class="mygreen"><?= $msg; ?></span>

								<input type="hidden" name="txt_user_id" id="txt_user_id" value="<?= $admin_id; ?>">
								<h2>Profile Details</h2>
								<!-- form -->
								
								<div class="form-group">
									<label>Username</label>
									<span id="err_txt_username" class="erro_msg"></span>
									<input type="text" name="txt_username" id="txt_username" class="form-control" placeholder="" value="<?= $user_name; ?>" onkeypress="user_name_validate(event,this,'err_txt_username','txt_username');">
									
								</div>

								<div class="form-group">
									<label for="name-three">Mobile</label>
									<span id="err_txt_mobno" class="erro_msg"></span>
									<input type="text" name="txt_phone_no" id="txt_phone_no" class="form-control" placeholder="" value="<?= $phone_no; ?>" onkeypress="return fun_valid_price(event,this);" onblur="fun_ValidatePhoneno(event,this,'err_txt_mobno','<?= $admin_id; ?>');" onkeyup="fun_remove_error_message('txt_phone_no','err_txt_mobno');" > 
									
								</div>

								<div class="form-group">
										<label>Your City</label>
										<span id="err_txt_city" class="erro_msg"></span>
										<input type="text" name="txt_search_city" id="txt_search_city" class="form-control" autocomplete="off" placeholder="" onkeyup="fun_remove_error_message('txt_search_city','err_txt_city');" value="<?= $city; ?>"/>
										<!-- </div> -->
											
								</div>	

								<div class="form-group">
									<label>Your State</label>
										<span id="err_txt_state" class="erro_msg"></span>
										<input type="hidden" name="txt_locality" id="txt_locality">
											 <input type="text" name="txt_state" id="txt_state" class="form-control" autocomplete="off" placeholder="" onkeyup="fun_remove_error_message('txt_state','err_txt_state');" value="<?= $state; ?>"/>
										
											
								</div>	

								
								
								<div>
									<span id="div_success_msg" class="mygreen push-right"></span>	
								</div>
								<a href="javascript:void(0);" class="btn" id="btn_update_profile">Update Profile  <i id="loader_profile" class="fa fa-spinner fa-spin hide"></i></a>
								<a href="<?= base_url('my-account/active-ads'); ?>" class="btn cancle" >Cancle</a>
								 
								
							</div><!-- profile-details -->

						<?= form_close(); ?>
						
						<?= form_open('',['id'=>'frm_changepassword','name'=>'frm_changepassword']);?>
							<!-- change-password -->
							<input type="hidden" name="txt_user_id_pass" id="txt_user_id_pass" value="<?= $admin_id; ?>">
							<div class="change-password section">
								<h2>Change password</h2>
								<!-- form -->
								<div class="form-group">
									<label>Old Password</label> <span id="err_txt_old_password" class="erro_msg"></span>
									<input type="password" class="form-control" name="txt_old_password" id="txt_old_password" onkeypress="fun_remove_error_message('txt_old_password','err_txt_old_password');">
								</div>
								
								<div class="form-group"> <span id="err_txt_new_password" class="erro_msg"></span>
									<label>New Password</label>
									<input type="password" class="form-control" name="txt_new_password" id="txt_new_password" placeholder="" onblur="password_validate('txt_new_password','err_txt_new_password');" onkeypress="fun_remove_error_message('txt_new_password','err_txt__new_password');">
								</div>

								<div class="form-group"> <span id="err_txt_c_password" class="erro_msg"></span>
									<label>Confirm Password</label>
									<input type="password" class="form-control" name="txt_c_password" id="txt_c_password" placeholder=""  onkeypress="fun_remove_error_message('txt_c_password','err_txt_c_password');"	>
								</div>															
							
							
							<!-- preferences-settings -->
							<!-- preferences-settings -->
							<div>
								<span id="div_success_msg_pass" class="mygreen push-right"></span>	
							</div>
							<a href="javascript:void(0);" class="btn" id="btn_update_password" >Update Password <i id="loader_password" class="fa fa-spinner fa-spin hide"></i></a>
							<a href="<?= base_url('my-account/active-ads'); ?>" class="btn cancle">Cancle</a>

						</div><!-- change-password -->	

						<?= form_close(); ?>	
						</div><!-- user-pro-edit -->
					</div><!-- profile -->

					<!-- recommended-cta-->
				</div><!-- row -->	
			</div>				
		</div><!-- container -->
	</section><!-- ad-profile-page -->
	
	<!-- footer -->
	<?php //include_once('inc/footer.php'); ?>
	<!-- footer -->

   	<!--/Preset Style Chooser--> 
	
	<!--/End:Preset Style Chooser-->
	
    <!-- JS -->
    <script src="<?= base_url('assets/js/jquery.min.js');?>"></script>
    <script src="<?= base_url('assets/js/modernizr.min.js');?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js');?>"></script>
	<!-- CUCSTOM JS -->
	<script src="<?= base_url('assets/js/admin_common.js');?>"></script>
   
	<!----<script>  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','../../www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-73239902-1', 'auto');
	  ga('send', 'pageview');             </script>---->
  </body>
<script type="text/javascript">
	
$(document).ready(function(){

	$("#btn_update_profile").click(function(e){
		update_profile(e);
	});

	$("#btn_update_password").click(function(e){
		update_password(e);
	});
	$("#txt_c_password").keydown(function(e){
		if(e.keyCode == 13)
		{
			update_password(e);
		}
	});

});	

function update_profile(e)
{
	var name = $("#txt_username").val();
	var phone = $("#txt_phone_no").val();
	var city = $("#txt_search_city").val();
	var state = $("#txt_state").val();
	var m_no=/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
    
	if(name.trim() == '')
    {
       $("#err_txt_username").text(" *Please Enter the Name ...");
        $("#txt_username").focus();
        return false;
    } 
    if(phone.trim() == '')
    {
       document.getElementById("err_txt_mobno").innerHTML = "please Enter the Phone No.";
        $("#txt_phone_no").focus();
        return false;
    }
     if(!m_no.test(phone))
     {                      
          document.getElementById("err_txt_mobno").innerHTML = "Enter The Valid Mobile No....";
           $("#txt_phone_no").focus();
           $("#txt_phone_no").val('');
          return false;
     }
  	var mNo = document.getElementById('txt_phone_no');
    if(fun_ValidatePhoneno(e,mNo,'err_txt_mobno','<?= $admin_id; ?>') != '')
    {
      return false;
    }
    if(city.trim() == '')
   
    {
        document.getElementById("err_txt_city").innerHTML = "Please Select The CITY...";
        $("#txt_search_city").focus();
        return false;
    }
    if(state.trim() == '')
    {
        document.getElementById("err_txt_state").innerHTML = "please Enter the State..";
        $("#txt_state").focus();
        return false;
    }
    else
    {
    	var form = document.getElementById('frm_updateprofile');
    	var form_data = new FormData(form);

    	$("#loader_profile").removeClass('hide');
      	$("#btn_update_profile").attr('disabled',true);
    	$.ajax({
    			url:'<?=base_url();?>c_ajax_admin/update_admin_profile',
    			data:form_data,
    			type:'POST',
    			contentType:false,
    			processData:false,
    			cache:false,
    			datatype:'JSON',
    			success:function(data)
    			{
    				//alert(data);
    				$("#loader_profile").addClass('hide');
      				$("#btn_update_profile").attr('disabled',false);
    				var jsonObj = JSON.parse(data);
    				if(jsonObj['STATUS'] == 1)
    				{
    					$("#div_success_msg").fadeIn();
    					$("#div_success_msg").text(jsonObj['message']);
    					$("#div_success_msg").fadeOut(2000);
    				}
    				if(jsonObj['STATUS'] == 'OTP')
    				{
    					$("#div_success_msg").fadeIn();
    					$("#div_success_msg").text(jsonObj['message']);
    					$("#div_success_msg").fadeOut(2000);
    					//window.location = base_url+'verify-otp/'+jsonObj['mob_no'];
    				}
    				else
    				{
    					console.log('error');
    				}
    			}

    	});
    }

}
function update_password(e)
{
	var old_password = $("#txt_old_password").val();
	var new_password = $("#txt_new_password").val();
	var c_password = $("#txt_c_password").val();

	if(old_password.trim() == '')
	{
		e.preventDefault();
		$("#txt_old_password").addClass('error_control');
		$('#err_txt_old_password').text('Please enter the old password.');
		$('#txt_old_password').focus();
		return false;
	}
	if(new_password.trim() == '')
	{
	    e.preventDefault();
	    $("#txt_new_password").addClass('error_control');
	    $("#err_txt_new_password").text('Please enter new password');
	    $("#txt_new_password").focus();
	    return false;
	}
	if(c_password.trim() == '')
	{
	    e.preventDefault();
	    $("#txt_c_password").addClass('error_control');
	    $("#err_txt_c_password").text('Please enter confirm password');
	    $("#txt_c_password").addClass('error_control');
	    $("#txt_c_password").focus();
	    return false;
	}
	if(new_password !=  c_password)
	{
	    e.preventDefault();
	    $("#txt_c_password").addClass('error_control');
	    $("#err_txt_c_password").text('New password and confirm password does not match');
	    $("#txt_c_password").focus();
	    $("#txt_c_password").val('');
	    return false;
  	}
  	else
  	{
  		var form = document.getElementById('frm_changepassword');
  		var form_data = new FormData(form);
  		$("#btn_update_password").attr('disabled',true);
  		$("#loader_password").removeClass('hide');
  		$.ajax({
  				url:'<?= base_url();?>c_ajax_admin/change_password',
  				data:form_data,
  				type:'POST',
  				cache:false,
  				contentType:false,
  				processData:false,
  				datatype:'JSON',
  				success:function(data)
  				{
  					//alert(data);
  					$("#txt_old_password").val('');
  					$("#txt_new_password").val('');
  					$("#txt_c_password").val('');
  					$("#btn_update_password").attr('disabled',false);
  					$("#loader_password").addClass('hide');
  					var jsonObj = JSON.parse(data);
  					if(jsonObj['STATUS'] == 1)
  					{
  						$("#div_success_msg_pass").fadeIn();
  						$("#div_success_msg_pass").text(jsonObj['message']);
  						$("#div_success_msg_pass").fadeOut(2000);
  					}
  					else if(jsonObj['STATUS'] == 0)
  					{
  						$("#err_txt_old_password").text(jsonObj['message']);
  					}
  					else
  					{
  						console.log('error');
  					}
  				}
  		});
  	}
}
</script>




<!-- Mirrored from demo.LAboO.com/trade/my-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 14 Feb 2018 18:19:19 GMT -->
</html>