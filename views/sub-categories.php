<?php 


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

	<!-- post-page -->
	<section id="main" class="clearfix ad-post-page">
		<div class="container">

			<div class="breadcrumb-section">
				<!-- breadcrumb -->
				<!-- breadcrumb -->						
				<h2 class="title">All Category with Subcategory</h2>
			</div><!-- banner -->
 
			<div id="ad-post">
				<div class="row category-tab">	
					<div class="col-md-4 col-sm-6">
						<div class="section cat-option select-category post-option">
							<h4>Select a category</h4>
							<ul role="tablist">
								<?php 
							if($category_list != null)
							{
								$old_cat_id = '';
								foreach ($category_list as $value) {
									$image = $value->category_image;
									$cat_id = $value->category_id;
									if($old_cat_id != $cat_id)
									{
								?>	
									<li id="li_cat<?= $cat_id; ?>"><a href="#cat<?= $cat_id; ?>" aria-controls="cat<?= $cat_id; ?>" role="tab" data-toggle="tab">
										<span class="select">
											<img src="<?= base_url('assets/images/Cat_Subcat/'.$image);?>" alt="Images" class="img-">
										</span>
										<?= $value->category_name; ?>
									</a> </li>

								<?php
									}
									$old_cat_id = $cat_id ;
							}
						}

						?>
								
							</ul>
						</div>
					</div>
					
					<!-- Tab panes -->
					<div class="col-md-4 col-sm-6">
						<div class="section tab-content subcategory post-option">
							<h4>Select a subcategory</h4>
							<?php 
							if(isset($category_list) && $category_list != null)
							{
								$i =0; $cat_id = '';$old_cat_id =''; $sub_cat_id =''; $old_sub_cat_id = '';
								foreach ($category_list as  $row) {
									$cat_id = $row->category_id;
									$cat_name = $row->category_name;
									$category_name = preg_replace('/\\s+/',' ', $cat_name);
									$cat_url = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/',' ', $category_name));
									$cat_url = preg_replace('/\\s+/', '-', $cat_url);
									
									
									if($old_cat_id != $cat_id)
									{
										?>

										<div role="tabpanel" class="tab-pane" id="cat<?= $cat_id; ?>">
											<ul>
												<?php 
												foreach ($category_list as  $value) {
													if($cat_id == $value->category_id)
													{
														$sub_cat_id = $value->sub_category_id;
														$sub_category_name = preg_replace('/\\s+/',' ',$value->sub_category_name);
														$url = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/',' ',$sub_category_name));
														$url = base_url().$cat_url.'/'.preg_replace('/\\s+/', '-',$url).'/'.$sub_cat_id;
														
													?>
													<li><a href="<?= $url;?>"><?= $value->sub_category_name; ?></a></li>
													<?php 
												    }
												}

												?>
												
												
											</ul>	
										</div>
									<?php 
									}
									$old_cat_id = $cat_id;
								}
							}

							?>



							<!-- <div role="tabpanel" class="tab-pane" id="cat1">
								<ul>
									<li><a href="base_url('cars-buses')">Cars & Buses</a></li>
									<li><a href="javascript:void(0)">Motorbikes & Scooters</a></li>
									<li><a href="javascript:void(0)">Bicycles and Three Wheelers</a></li>
									<li><a href="javascript:void(0)">Three Wheelers</a></li>
									<li><a href="javascript:void(0)">Trucks, Vans & Buses</a></li>
									<li><a href="javascript:void(0)">Tractors & Heavy-Duty</a></li>
									<li><a href="javascript:void(0)">Auto Parts & Accessories</a></li>
								</ul>	
							</div>
							<div role="tabpanel" class="tab-pane active" id="cat2">
								<ul>
									<li><a href="javascript:void(0)">Laptop & Computer</a></li>
									<li><a href="javascript:void(0)">Mobile Phones</a></li>
									<li><a href="javascript:void(0)">Phablet & Tablets</a></li>
									<li><a href="javascript:void(0)">Audio & MP</a></li>
									<li><a href="javascript:void(0)">Accessories</a></li>
									<li><a href="javascript:void(0)">Cameras</a></li>
									<li><a href="javascript:void(0)">Mobile Accessories</a></li>
									<li><a href="javascript:void(0)">TV & Video</a></li>
									<li><a href="javascript:void(0)">Other Electronics</a></li>
									<li><a href="javascript:void(0)">TV & Video Accessories</a></li>
								</ul>
							</div>
							<div role="tabpanel" class="tab-pane" id="cat3">
								<ul>
									<li><a href="javascript:void(0)">Houses & Plots</a></li>
									<li><a href="javascript:void(0)">Lands & property</a></li>
									<li><a href="javascript:void(0)">Plots & Lands</a></li>
									<li><a href="javascript:void(0)">Apartment</a></li>
								</ul>
							</div>
							<div role="tabpanel" class="tab-pane" id="cat4">
								<ul>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
								</ul>
							</div>
							<div role="tabpanel" class="tab-pane" id="cat5">
								<ul>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
								</ul>
							</div>
							<div role="tabpanel" class="tab-pane" id="cat6">
								<ul>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
								</ul>
							</div>
							<div role="tabpanel" class="tab-pane" id="cat7">
								<ul>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
								</ul>
							</div>
							<div role="tabpanel" class="tab-pane" id="cat8">
								<ul>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
								</ul>
							</div>
							<div role="tabpanel" class="tab-pane" id="cat9">
								<ul>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
								</ul>
							</div>
							<div role="tabpanel" class="tab-pane" id="cat10">
								<ul>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
								</ul>
							</div>
							<div role="tabpanel" class="tab-pane" id="cat11">
								<ul>
									<li><a href="javascript:void(0)">Sub Category Item</a></li>
								</ul>
							</div> -->
						</div>
					</div>
				<!--	<div class="col-md-4 col-sm-6">
						<div class="section next-stap post-option">
							<h2>Post an Ad in just <span>30 seconds</span></h2>
							<p>Please DO NOT post multiple ads for the same items or service. All duplicate, spam and wrongly categorized ads will be deleted.</p>
							<div class="btn-section">
								<a href="ad-post-details.html" class="btn">Next</a>
								<a href="#" class="btn-info">or Cancle</a>
							</div>
						</div>
					</div> next-stap -->
				</div>
				<div class="row">
					<div class="col-sm-8 col-sm-offset-2 text-center">
						<div class="ad-section">
							<a href="#"><img src="<?= base_url('assets/images/ads/3.jpg');?>" alt="Image" class="img-responsive"></a>
						</div>
					</div>
				</div><!-- row -->
			</div>				
		</div><!-- container -->
	</section><!-- post-page -->
	
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
	<!----<script>  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','../../www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-73239902-1', 'auto');
	  ga('send', 'pageview');             </script>---->

<script type="text/javascript">
$(document).ready(function(){

	var category_id = '<?= $category_id; ?>';

	$("#cat"+category_id).addClass('active');
	$("#li_cat"+category_id).addClass('active');


});

</script>

  </body>

<!-- Mirrored from demo.LAboO.com/trade/<?= base_url('ad-post'); ?> by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 14 Feb 2018 18:19:18 GMT -->
</html>