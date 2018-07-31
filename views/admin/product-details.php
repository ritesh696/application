<?php 
$ad_id = '';
$category_id = '';
$sub_category_id = '';
$ad_title = '';
$ad_description= '';
$ad_type = '';
$conditions = '';
$price = '';
$negotiable = '';
$company = '';
$model = '';
$year = '';
$kmdriven = '';
$fuel = '';
$salary_upto = '';
$job_period ='';
$ad_images = array();
$status_update_date = '';
$user_name = '';
$user_type = '';
$phone_no = '';
$user_id = '';
$city = '';
$locality = '';
$login_status = '';
$cl_online = '';
$m_need = '';
//print_r($ad_detail);
foreach ($ad_detail as $value) {
	$ad_id = $value->ad_id;
	$category_id = $value->category_id;
	$sub_category_id = $value->sub_category_id;
	$ad_title = $value->ad_title;
	$ad_description= $value->description;

            if($value->ad_type == 'buy')
            {
                $ad_type = "Buy";
            }
	


	$conditions = $value->conditions;
	$price = $value->price;
	$negotiable = $value->negotiable;
	$company = $value->company;
	$model = $value->model;
	$year = $value->year;
	$kmdriven = $value->kmdriven;
	$fuel = $value->fuel;
	$salary_upto = $value->salary_upto;
	$job_period =$value->job_period;
	$ad_images = explode(",", $value->image);
	$status_update_date = date('D, d m, Y H:i:s A',strtotime($value->status_update_date));
	$user_name = $value->user_name;
	$user_type = $value->user_type;
	$phone_no = $value->phone_no;
	$user_id = $value->user_id;
	$login_status = $value->login_status;
	$city = $value->city;
	$locality = $value->locality;
	$m_need = $value->m_need;
	if($login_status == 1)
	{
		$cl_online = 'online';
	}
	if($negotiable != '')
	{
		$negotiable = '(Negotiable)';
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
	<?php include('inc/header.php'); ?>
	<!-- header -->

	<!-- main -->
	<section id="main" class="clearfix details-page">
		<div class="container">
			
						
	
			<div class="section slider">					
				<div class="row">
					<!-- carousel -->
					<div class="col-md-7">
						<div id="product-carousel" class="carousel slide" data-ride="carousel">
							<!-- Indicators -->
							<ol class="carousel-indicators">
							<?php 
								for ($i=0; $i < count($ad_images); $i++) { 
								$images_url = base_url()."assets/images/ads_images/".$ad_images[$i];
								if($i==0)
								{
									$class = 'active';
								}	
								else
								{
									$class = '';
								}	
							?>				
								<li data-target="#product-carousel" data-slide-to="<?= $i; ?>" class="<?= $class; ?>" >
									<img src="<?= $images_url; ?>" alt="Carousel Thumb" class="img-responsive">
								</li>
							<?php } ?>									
							</ol>


							<!-- Wrapper for slides -->
							<div class="carousel-inner" role="listbox">
							<?php 

							for ($i=0; $i < count($ad_images); $i++) { 
								$images_url = base_url()."assets/images/ads_images/".$ad_images[$i];

							
								if($i==0)
								{
									$class = 'active';
								}	
								else
								{
									$class = '';
								}
								?>
									<!-- item -->
								<div class="item <?= $class; ?>">
									<div class="carousel-image">
										<!-- image-wrapper -->
										<img src="<?= $images_url; ?>" alt="Featured Image" class="img-responsive">
									</div>
								</div><!-- item -->


								<?php 

							}
							?>

															
							</div><!-- carousel-inner -->

							<!-- Controls -->
							<a class="left carousel-control" href="#product-carousel" role="button" data-slide="prev">
								<i class="fa fa-chevron-left"></i>
							</a>
							<a class="right carousel-control" href="#product-carousel" role="button" data-slide="next">
								<i class="fa fa-chevron-right"></i>
							</a><!-- Controls -->
						</div>
					</div><!-- Controls -->	

					<!-- slider-text -->
					<div class="col-md-5">
						<div class="slider-text">
							
							<?php if($price != '' ){ ?> <h2>&#8377; <?= $price; ?>  
									<span><?= $negotiable;?></span>
                                   	<span style="color:blue"> <?= $ad_type;?></span>
							   </h2>  <?php }?>
							<h3 class="title"><?= $ad_title; ?></h3>

							<p><span>Offered by: <a href="<?= base_url('all-result/user/'.$user_id) ?>"><?= $user_name; ?></a></span>
							<span> Ad ID:<a href="#" class="time"> <?= $ad_id; ?></a></span></p>
							<span class="icon"><i class="fa fa-clock-o"></i><a href="#"><?= $status_update_date; ?></a></span>
							<span class="icon"><i class="fa fa-map-marker"></i><a href="#"><?= $locality; ?>, <?= $city; ?></a></span>
							<span class="icon"><i class="fa fa-suitcase <?= $cl_online; ?>"></i><a href="#"><?= $user_type ?> <?php  if($login_status == 1){ ?><strong>(online)</strong><?php } ?></a></span>
							
							<!-- short-info -->
							<div class="short-info">
								<h4></h4>
								<?php if($salary_upto != ''){ ?> <p><strong>Salary Upto: </strong><a href="#">&#8377; <?= $salary_upto; ?></a> </p>  <?php }  ?>
								<?php if($job_period != ''){ ?> <p><strong>Job Period: </strong><a href="#"><?= $job_period; ?></a> </p>  <?php }  ?>
								<?php if($conditions != ''){ ?> <p><strong>Condition: </strong><a href="#"><?= $conditions; ?></a> </p>  <?php }  ?>
								<?php if($company != ''){ ?> <p><strong>Brand: </strong><a href="#"><?= $company; ?></a> </p>  <?php }  ?>
								<?php if($model != ''){ ?> <p><strong>Model: </strong><a href="#"> <?= $model; ?> </a> </p>  <?php }  ?>
								<?php if($year != ''){ ?> <p><strong>Year: </strong><a href="#"> <?= $year; ?> </a> </p>  <?php }  ?>
								<?php if($fuel != ''){ ?> <p><strong>Fuel: </strong><a href="#"> <?= $fuel; ?> </a> </p>  <?php }  ?>
								<?php if($kmdriven != 0 && $kmdriven != ''){ ?> <p><strong>Km Driven: </strong><a href="#"> <?= $kmdriven; ?> </a> </p>  <?php }  ?>
								<?php if($m_need != ''){ ?> <p><strong>Need: </strong><a href="#"> <?= $m_need; ?> </a> </p>  <?php }  ?>

								
								
						
							</div><!-- short-info -->
							
							<!-- contact-with -->
							<div class="contact-with">
								<h4>Contact with </h4>
								<span class="btn btn-red show-number">
									<i class="fa fa-phone-square"></i>
									<span class="hide-text">Click to show phone number </span> 
									<span class="hide-number"><?= $phone_no; ?></span>
								</span>
								
							</div><!-- contact-with -->
							
							<!-- social-links -->
							<!-- social-links -->						
						</div>
					</div><!-- slider-text -->				
				</div>				
			</div><!-- slider -->

			<div class="description-info">
				<div class="row">
					<!-- description -->
					<div class="col-md-8">
						<div class="description">
							<h4>Description</h4>
							<p> <?= $ad_description; ?></p>
						</div>
					</div><!-- description -->

					<!-- description-short-info -->
					<div class="col-md-4">					
						<div class="short-info">
							<h4>Actions</h4>
							<!-- social-icon -->
							<ul>
								<li><i class="fa fa-shopping-cart"></i><a href="#">Delivery: Meet in person</a></li>
								<li><i class="fa fa-user-plus"></i><a href="<?= base_url('all-result/user/'.$user_id) ?>">More ads by <span><?= $user_name; ?></span></a></li>
								
								<li><i class="fa fa-exclamation-triangle"></i><a href="#">Report this ad</a></li>
							</ul><!-- social-icon -->
						</div>
					</div>
				</div><!-- row -->
			</div><!-- description-info -->	
			
			<!-- recommended-info -->
		</div><!-- container -->
	</section><!-- main -->
	
	<!-- download -->
	<!-- download -->
	
	<!-- footer -->
	<?php //include('inc/footer.php'); ?>
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

<!-- Mirrored from demo.LAboO.com/trade/details.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 14 Feb 2018 18:19:14 GMT -->
</html>