<?php 
$msg = '';
if(($this->session->flashdata('success') != ''))
{
	$msg = $this->session->flashdata('success');
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
	<?php include('inc/header.php'); ?>

	<!-- header -->

	<!-- signup-page -->
	<section id="main" class="clearfix user-page">
		<div class="container">
			<div class="row text-center">
				<!-- user-login -->	
						
				<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
					<div class="user-account">
						<span  class="mygreen"><?= $msg; ?></span>
						<h2>Create a Swapiee Account</h2>
						<?= form_open(base_url('sign-up'),['id'=>'frm_signup','name'=>'frm_signup']) ?>
							
							<div class="form-group"><span id="err_txt_user_name" class="erro_msg"><?= form_error('txt_user_name'); ?></span>
								<input type="text" class="form-control" name="txt_user_name" id="txt_user_name" placeholder="Name" onkeypress="user_name_validate(event,this,'err_txt_user_name','txt_user_name');" value="<?= set_value('txt_user_name'); ?>" >
							</div>
							
							<div class="form-group"> <span id="err_txt_password" class="erro_msg"><?= form_error('txt_password'); ?></span>
								<input type="password" class="form-control" name="txt_password" id="txt_password" placeholder="Password" onblur="password_validate('txt_password','err_txt_password');" onkeypress="fun_remove_error_message('txt_password','err_txt_password');">
							</div>

							<div class="form-group"> <span id="err_txt_c_password" class="erro_msg"><?= form_error('txt_c_password'); ?></span>
								<input type="password" class="form-control" name="txt_c_password" id="txt_c_password" placeholder="Confirm Password"  onkeypress="fun_remove_error_message('txt_c_password','err_txt_c_password');"	>
							</div>
							<div class="form-group"> <span id="err_txt_mob_no" class="erro_msg"><?= form_error('txt_mob_no'); ?></span>
								<input type="text" class="form-control" name="txt_mob_no" id="txt_mob_no" placeholder="Mobile Number" onblur="fun_ValidatePhoneno(event,this,'err_txt_mob_no');" value="<?= set_value('txt_mob_no'); ?>">
							</div> 
							<!-- select -->
							<!-- select -->
							
							<div class="checkbox"> <span class="erro_msg" id="err_chk_terms"> </span>
								<label class="pull-left checked" for="chk_terms_signing"><input type="checkbox" name="chk_terms_signing" id="chk_terms_signing" checked> By signing up for an account you agree to our Terms and Conditions </label>
							</div><!-- checkbox -->	
							<button type="submit" class="btn" id="btn_signUp">Registration</button>	
					<?= form_close(); ?>
						<!-- checkbox -->
										
					</div>
				</div>
				
				<!-- user-login -->			
			</div><!-- row -->	
		</div><!-- container -->
	</section><!-- signup-page -->
	
	<!-- footer -->
	
	<?php include('inc/footer.php'); ?>

	<!-- footer -->

   	<!--/Preset Style Chooser--> 
	
	<!--/End:Preset Style Chooser-->
	
    <!-- JS -->
    <script src="<?= base_url('assets/js/jquery.min.js');?>"></script>
    <script src="<?= base_url('assets/js/modernizr.min.js');?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js');?>"></script>
	<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<script src="<?= base_url('assets/js/gmaps.min.js');?>"></script>
    <script src="<?= base_url('assets/js/owl.carousel.min.js');?>"></script>
    <script src="<?= base_url('assets/js/smoothscroll.min.js');?>"></script>
    <script src="<?= base_url('assets/js/scrollup.min.js');?>"></script>
    <script src="<?= base_url('assets/js/price-range.js');?>"></script>
    <script src="<?= base_url('assets/js/jquery.countdown.js');?>"></script>   
    <script src="<?= base_url('assets/js/custom.js');?>"></script>
	<script src="<?= base_url('assets/js/switcher.js');?>"></script>

	<script src="<?= base_url('assets/js/common.js?');?>"></script>	
	<!----<script>  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','../../www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-73239902-1', 'auto');
	  ga('send', 'pageview');             </script>---->
  </body>

<!-- Mirrored from demo.LAboO.com/trade/base_url('sign-up') by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 14 Feb 2018 18:19:19 GMT -->
</html>