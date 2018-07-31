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

	<!-- myads-page -->
	<section id="main" class="clearfix myads-page">
		<div class="container">

			<div class="breadcrumb-section">
				<!-- breadcrumb -->
				<!-- breadcrumb -->						
				<h2 class="title">Pending Ads</h2>
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
						<li ><a href="<?= base_url('my-account/profile');?>">Profile</a></li>
						<li><a href="<?= base_url('my-account/active-ads');?>">Active ads</a></li>
						<li><a href="<?= base_url('my-account/deactive-ads');?>">Deactive ads</a></li>
						<li class="active"><a href="<?= base_url('my-account/pending-ads');?>">Pending approval</a></li>
						<li><a href="<?= base_url('my-account/deactiveted-ads');?>">Deactive by Admin</a></li>
						<li><a href="<?= base_url('my-account/delete-account');?>">Close account</a></li>
					</ul>
			
			</div><!-- ad-profile -->			
			
			<div class="ads-info">
				<div class="row">
					<div class="col-sm-8">
						<div class="my-ads section">
							<h2>Pending ads
									<span  class="" id="spn_total_ads" style="font-size:15px">( <?= count($pending_ads);?> Ads )	</span>
									<span class="mygreen pull-right"  id="spn_msg" style="font-size:20px" ></span>
							</h2>
							<!-- ad-item -->
			<?php 				
			if(isset($pending_ads) && $pending_ads != null)        
	        {  
    		 foreach ($pending_ads as  $value) {
	                
	                $data_price	='';
	                $ad_id = $value->ad_id;
	                $ad_title = $value->ad_title;
	                $image = explode(",",$value->image);
	                $image_url = base_url().'assets/images/ads_images/'.$image[0];
	                $url = base_url().'item/'.$value->ad_url.'/'.$ad_id;
	                $price = $value->price;
	                if($price != ''){ $data_price = '&#8377; '.$price;}
	                $salary_upto = $value->salary_upto; 
	                if($salary_upto != ''){ $data_price = '&#8377; '.$salary_upto;}



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

	             
	                $date =strtotime($value->ent_datetime);
	                $dateformate = date ("d M, Y H:i:s A", strtotime($value->ent_datetime));
	                $time = date("g:i A",$date);
	                $publish_date = date('Y-m-d',strtotime($value->ent_datetime));
	                $today = date('Y-m-d');
					
				  	$ads_url = 'javascript:void(0);';//base_url().'item/'.$value->ad_url.'/'.$ad_id;
              	
					
										
					$sub_cat_id = $value->sub_category_id;
					
					$url = base_url('edit-post-details/'.$ad_id); 

	                ?>	
	                	<div id="row_<?= $ad_id; ?>">
							<div class="ad-item row">
								<!-- item-image -->
								<div class="item-image-box col-sm-4">
									<div class="item-image">
										<a href="<?= $ads_url; ?>"><img src="<?= $image_url; ?>" alt="Image" class="img-responsive"></a>
									</div><!-- item-image -->
								</div>
								
								<!-- rending-text -->
								<div class="item-info col-sm-8">
									<!-- ad-info -->
									<div class="ad-info">
										<h3 class="item-price"><?= $data_price; ?></h3>
										<h4 class="item-title"><a href="<?= $ads_url;?>"><?= $ad_title; ?></a></h4>
										<div class="item-cat">
											<span><a href="#"><?= $value->category; ?></a></span> /
											<span><a href="#"><?= $value->sub_category; ?></a></span>
										</div>										
									</div><!-- ad-info -->
									
									<!-- ad-meta -->
									<div class="ad-meta">
										<div class="meta-content">
											<?php  if($today == $publish_date)
                                            { ?> 	
												<span class="dated">Posted On: <a href="#">Today <?= $time; ?></a></span>
											<?php }else{ ?>
												<span class="dated">Posted On: <a href="#"><?= $dateformate; ?> </a></span>	
											<?php } ?>
											<span class="pending">Pending</span>
											<!-- <span class="visitors">Visitors: <?= $value->no_of_view; ?></span>  -->
										</div>										
										<!-- item-info-right -->
										<div class="user-option pull-right">
											<a class="edit-item" href="<?= $url;?>" data-toggle="tooltip" data-placement="top" title="Edit this ad"><i class="fa fa-pencil"></i></a>
											<a class="delete-item" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Delete this ad"><i class="fa fa-times" onclick="fun_delete_ads('<?= $ad_id; ?>');"></i></a>
										</div><!-- item-info-right -->
									</div><!-- ad-meta -->
								</div><!-- item-info -->
							</div><!-- ad-item -->
						</div>
						<?php 
						}
					}
						?>		
						<input type="hidden" name="city" id="city" />
		                 <input type="hidden" name="state" id="state" />
		                 <input type="hidden" name="country" id="country" /> 	

						</div>
					</div><!-- my-ads -->

					<!-- recommended-cta-->
					<div class="col-sm-4 text-center">
						<!-- recommended-cta -->
						
					</div><!-- recommended-cta-->				
					
				</div><!-- row -->
			</div><!-- row -->
		</div><!-- container -->
	</section><!-- myads-page -->
	
	
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
	<script src="<?= base_url('assets/js/common.js');?>"></script>
	<!----<script>  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','../../www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-73239902-1', 'auto');
	  ga('send', 'pageview');             </script>---->
  </body>
    <script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>

 <script language="Javascript"> 
 window.onload = function() {
    //document.write("Welcome to our visitors from "+geoplugin_city()+","+geoplugin_region()+", "+geoplugin_countryName()); 
    document.getElementById("city").value = geoplugin_city();
    document.getElementById("state").value = geoplugin_region();
    document.getElementById("country").value = geoplugin_countryName();
 };

var total_ads ='<?= count($pending_ads);?>';
$(document).ready(function(){



});

</script>


<!-- Mirrored from demo.LAboO.com/trade/my-ads.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 14 Feb 2018 18:19:19 GMT -->
</html>