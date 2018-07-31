<?php 
/*
for($i=1;$i<=6;$i++)
{
	for($j=6;$j>0;$j--)
	{
		if($i==$j)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}

	}
	echo '</br>';
}*/
$message = '';
if($this->session->flashdata('message') != null)
{
	$message = $this->session->flashdata('message');
}

$delete_msg = '';
if($this->session->flashdata('user_delete') != null)
{
	$delete_msg = $this->session->flashdata('user_delete');
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
	<section id="main" class="clearfix home-default">
			<div class="row text-center mygreen">
				<h4> <?= $message; ?><?= $delete_msg; ?> </h4>
			</div>
		<div class="container">
			<!-- banner -->
			<div class="banner-section text-center">
				<h1 class="title">World's Largest Classifieds Portal </h1>
				<h3>Search from over 15,00,000 classifieds & Post unlimited classifieds free!</h3>
				<!-- banner-form -->
				<div class="banner-form">
					<?= form_open('',['name'=>'frm_search_val','id'=>'frm_search_val']); ?>
						<!-- category-change -->
						<!-- category-change -->

						<!-- language-dropdown -->
						<!-- language-dropdown -->
					
						<input type="text" id="txt_search_val" name="txt_search_val" class="form-control" placeholder="Type Your key word">
						<span class="erro_msg" id="err_txt_search_val"></span>
						<button type="button" class="form-control" value="Search" id="btn_search">Search</button>
					<?= form_close(); ?>
				</div><!-- banner-form -->
				
				<!-- banner-socail -->
				<!-- banner-socail -->
			</div><!-- banner -->
			
			<!-- main-content -->
			<div class="main-content">
				<!-- row -->
				<div class="row">
					<div class="hidden-xs hidden-sm col-md-2 text-center">
						<div class="advertisement">
							<a href="#"><img src="<?= base_url('assets/images/ads/2.jpg');?>" alt="Images" class="img-responsive"></a>
						</div>
					</div>
					
					<!-- product-list -->
					<div class="col-md-8">
						<!-- categorys -->
						<div class="section category-ad text-center">
							<ul class="category-list">	
								<?php 
								if($category_list != null)
								{
									foreach ($category_list as $value) {
										$image = $value->category_image;
										?>
											<li class="category-item">
												<a href="<?= base_url('category/'.$value->category_id); ?>">
													<div class="category-icon"><img src="<?= base_url('assets/images/Cat_Subcat/'.$image);?>" alt="images" class="img-responsive"></div>
													<span class="category-title"><?= $value->category_name; ?></span>
													<span class="category-quantity"></span>
												</a>
											</li><!-- category-item -->


										<?php 
									}
								}

								?>
									
										
								<!-- category-item -->
								<!-- category-item -->					
							</ul>				
						</div><!-- category-ad -->	
						
						<!-- featureds -->
						<!-- featureds -->

						<!-- ad-section -->						
						<div class="ad-section text-center">
							<a href="#"><img src="<?=base_url(); ?>assets/images/ads/3.jpg" alt="Image" class="img-responsive"></a>
						</div><!-- ad-section -->

						<!-- trending-ads -->
						<!-- trending-ads -->		

						<!-- cta -->
						<!-- cta -->
					</div><!-- product-list -->

					<!-- advertisement -->
					<div class="hidden-xs hidden-sm col-md-2">
						<div class="advertisement text-center">
							<a href="#"><img src="<?=base_url(); ?>assets/images/ads/1.jpg" alt="Images" class="img-responsive"></a>
						</div>
					</div><!-- advertisement -->
				</div><!-- row -->
			</div><!-- main-content -->
		</div><!-- container -->
	</section><!-- main -->
	
	<!-- download -->
	<section id="download" class="clearfix parallax-section">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-center">
					<h2>Download on App Store</h2>
				</div>
			</div><!-- row -->

			<!-- row -->
			<div class="row">
				<!-- download-app -->
				<div class="col-sm-4">
					<a href="#" class="download-app">
						<img src="<?= base_url('assets/images/icon/16.png');?>" alt="Image" class="img-responsive">
						<span class="pull-left">
							<span>available on</span>
							<strong>Google Play</strong>
						</span>
					</a>
				</div><!-- download-app -->

				<!-- download-app -->
				<div class="col-sm-4">
					<a href="#" class="download-app">
						<img src="<?= base_url('assets/images/icon/17.png');?>" alt="Image" class="img-responsive">
						<span class="pull-left">
							<span>comming soon</span>
							<strong>App Store</strong>
                            
						</span>
					</a>
				</div><!-- download-app -->

				<!-- download-app -->
				<div class="col-sm-4">
					<a href="#" class="download-app">
						<img src="<?= base_url('assets/images/icon/18.png');?>" alt="Image" class="img-responsive">
						<span class="pull-left">
							<span>comming soon</span>
							<strong>Windows Store</strong>
						</span>
					</a>
				</div><!-- download-app -->
			</div><!-- row -->
		</div><!-- contaioner -->
	</section><!-- download -->

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
	<script src="<?= base_url('assets/js/common.js');?>"></script>
<!----<script>  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','../../www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-73239902-1', 'auto');
	  ga('send', 'pageview');             </script>-->
  </body>

</html>