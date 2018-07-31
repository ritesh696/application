<?php 

$total_no_of_ads = 0 ;
//print_r($user_detail);
foreach ($user_detail as $value) {

	$user_name = $value->user_name;		

}
if(isset($total_ads))
{	
	$total_no_of_ads = $total_ads[0]['total_ads'];			
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
	<?php include_once(__DIR__.'/../inc/header.php'); ?>
	<!-- header -->

	<!-- delete-page -->
	<section id="main" class="clearfix delete-page">
		<div class="container">
			<div class="breadcrumb-section">
				<!-- breadcrumb -->
				<!-- breadcrumb -->						
				<h2 class="title">Close Account</h2>
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
						<li><a href="<?= base_url('my-account/profile');?>">Profile</a></li>
						<li><a href="<?= base_url('my-account/active-ads');?>">Active ads</a></li>
						<li><a href="<?= base_url('my-account/deactive-ads');?>">Deactive ads</a></li>
						<li><a href="<?= base_url('my-account/pending-ads');?>">Pending approval</a></li>
						<li><a href="<?= base_url('my-account/deactiveted-ads');?>">Deactive by Admin</a></li>
						<li class="active"><a href="<?= base_url('my-account/delete-account');?>">Close account</a></li>
					</ul>
			
			</div><!-- ad-profile -->		
			
			<div class="close-account">
				<div class="row">
					<div class="col-sm-8 text-center">
						<div class="delete-account section">
							<h2>Delete Your Account</h2>
							
								<div class="form-group ">
									<div class="col-sm-12">
										<label for="txa_other_reason">Comment</label>
										<textarea name="txa_delete_reason" id="txa_detele_reason" class="form-control font-500"></textarea>
										<span class="erro_msg" id="err_txa_delete_reason"> </span>
									</div>
								</div>
								<h4>Are you sure, you want to delete your account?</h4>
						
							<a href="javascript:void(0);" id="btn_delete" class="btn">Delete Account</a>
							<a href="<?= base_url('my-account/active-ads'); ?>" class="btn cancle">Cancle</a>
					

							 <input type="hidden" name="city" id="city" />
			                 <input type="hidden" name="state" id="state" />
			                 <input type="hidden" name="country" id="country" /> 



						</div>
					</div><!-- delete-account -->

									
				</div><!-- row -->
			</div>
		</div><!-- container -->
	</section><!-- delete-page -->
	
	<!-- footer -->
	<?php include_once(__DIR__.'/../inc/footer.php'); ?>
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
	<!----<script>  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','../../www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-73239902-1', 'auto');
	  ga('send', 'pageview');             </script>---->
  </body>

  <script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
 
<script type="text/javascript">
 window.onload = function() {
    //document.write("Welcome to our visitors from "+geoplugin_city()+","+geoplugin_region()+", "+geoplugin_countryName()); 
    document.getElementById("city").value = geoplugin_city();
    document.getElementById("state").value = geoplugin_region();
    document.getElementById("country").value = geoplugin_countryName();
 };





	$(document).ready(function(){

		$("#txa_detele_reason").keypress(function(){
			$("#err_txa_delete_reason").text('');
		});

		$("#btn_delete").click(function(){

			var delete_reason = $("#txa_detele_reason").val();
			var city = $("#city").val();
			var state = $("#state").val();
			var country = $("#country").val();
			if(delete_reason.trim() == '')
			{
				$("#err_txa_delete_reason").text('Please enter Reason.');
				$("#txa_detele_reason").focus();
				return false;
			}
			if(delete_reason.length < 10)
			{
				$("#err_txa_delete_reason").text("Enter minimum 10 characters.");
				$("#txa_detele_reason").focus();
				return false;
			}
			else
			{
					$.ajax({
							url:"<?= base_url('my_account/delete_user_account');?>",
							type:'POST',
							data:{delete_reason:delete_reason,
									city:city,
									state:state,
									country:country},
							success:function(data)
							{
								//alert(data);
								var jsonObj = JSON.parse(data);

								if(jsonObj['STATUS'] == 1)
								{	
									window.location=base_url;
								}
								else
								{
									console.log('error');
								}

							}


					});
					
			}

			

		});


	});

</script>
<!-- Mirrored from demo.LAboO.com/trade/delete-account.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 14 Feb 2018 18:19:19 GMT -->
</html>