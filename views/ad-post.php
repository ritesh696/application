
<?php
$cat_id_load = '1';

if(isset($category_id) && $category_id != null)
{
	$cat_id_load = $category_id;
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

	<!-- post-page -->
	<section id="main" class="clearfix ad-post-page">
		<div class="container">

			<div class="breadcrumb-section">
				<!-- breadcrumb -->
				<!-- breadcrumb -->
				<h2 class="title">Post Free Ad</h2>
			</div><!-- banner -->



			<div id="ad-post">
				<div class="row category-tab">
					<div class="col-md-4 col-sm-6">
						<div class="section cat-option select-category post-option">
							<h4>Select a subcategory</h4>
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
											<li id="li_cat<?= $cat_id; ?>"><a href="#cat<?= $cat_id; ?>" id="aria_cat<?= $cat_id; ?>" aria-controls="cat<?= $cat_id; ?>" role="tab" data-toggle="tab" >
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
						<div class="section tab-content subcategory post-option" id="div_sub_category">
							<h4>Select a subcategory</h4>

								<?php
							if(isset($category_list) && $category_list != null)
							{
								$i =0; $cat_id = '';$old_cat_id =''; $sub_cat_id =''; $old_sub_cat_id = '';
								foreach ($category_list as  $row) {
									$cat_id = $row->category_id;
								//	$sub_cat_id = $row->sub_category_id;

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
														/*$sub_category_name = preg_replace('/\\s+/',' ', $value->sub_category_name);
														$url = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/',' ', $sub_category_name));
														$url = base_url().preg_replace('/\\s+/', '-', $url);*/

													?>
													<li onclick="fun_show_next('<?= $sub_cat_id; ?>');"><a href="javascript:void(0)"><?= $value->sub_category_name; ?></a></li>
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
						</div>
					</div>
					<div class="col-md-4 col-sm-6 hide" id="div_next">
						<input type=hidden"  name="txt_hidden_subcatid" id="txt_hidden_subcatid" class="hide">
						<div class="section next-stap post-option">
							<h2>Post an Ad in just <span>30 seconds</span></h2>
							<p>Please DO NOT post multiple ads for the same items or service. All duplicate, spam and wrongly categorized ads will be deleted.</p>
							<div class="btn-section">
								<span class="btn btn-primary" id="btn_next" onclick="fun_show_post_details();">Next</span>
								<a href="#" class="btn-info">or Cancle</a>
							</div>
						</div>
					</div><!-- next-stap -->
				</div>
				<div class="row">
					<div class="col-sm-8 col-sm-offset-2 text-center">
						<div class="ad-section">
							<a href="#"><img src="images/ads/3.jpg" alt="Image" class="img-responsive"></a>
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
	<div class="style-chooser">
		<div class="style-chooser-inner">
			<a href="#" class="toggler"><i class="fa fa-life-ring fa-spin"></i></a>
			<h4>Presets</h4>
			<ul class="preset-list clearfix">
				<li class="preset1 active" data-preset="1"><a href="#" data-color="preset1"></a></li>
				<li class="preset2" data-preset="2"><a href="#" data-color="preset2"></a></li>
				<li class="preset3" data-preset="3"><a href="#" data-color="preset3"></a></li>
				<li class="preset4" data-preset="4"><a href="#" data-color="preset4"></a></li>
			</ul>
		</div>
	</div>
	<!--/End:Preset Style Chooser-->

    <!-- JS -->
    <script src="<?= base_url('assets/js/jquery.min.js');?>"></script>
    <script src="<?= base_url('assets/js/modernizr.min.js');?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js');?>"></script>
	<!-- <script src="http://maps.google.com/maps/api/js?sensor=true"></script> -->
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



});


$(window).load(function(){

    var cat_id = "<?= $cat_id_load; ?>";

	$("#cat"+cat_id).addClass('active');
	$("#li_cat"+cat_id).addClass('active');

});

function fun_show_post_details()
{
	var sub_cat_id = $("#txt_hidden_subcatid").val();
	window.location = "<?= base_url('ad-post-details/') ?>"+sub_cat_id;

}

function fun_show_next(sub_cat_id)
{
	$("#div_next").removeClass('hide');
	$("#txt_hidden_subcatid").val(sub_cat_id);
}
</script>

  </body>

<!-- Mirrored from demo.LAboO.com/trade/<?= base_url('ad-post'); ?> by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 14 Feb 2018 18:19:18 GMT -->
</html>
