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


if($this->session->userdata('city') != '')
{	
	//echo $this->session->userdata('city');
}

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

	<!-- home-one-info -->
	<section id="home-one-info" class="clearfix home-one">
		<!-- world -->
			<div class="row text-center mygreen">
				<h4> <?= $message; ?><?= $delete_msg; ?> </h4>
				<div id="loc"  class="hide"> </div>
			</div>

		<div id="banner-two" class="parallax-section">
			<div class="row text-center">

				<!-- banner -->
				<div class="col-sm-12 ">
					<div class="banner">
						<h1 class="title">World’s Largest Classifieds Portal  </h1>
						<h3>Search from over 15,00,000 classifieds & Post unlimited classifieds free!</h3>
						<!-- banner-form -->
						<div class="banner-form">
					<?= form_open('',['name'=>'frm_search_val','id'=>'frm_search_val']); ?>
						<!-- category-change -->
						<!-- category-change -->

						<!-- language-dropdown -->
						<!-- language-dropdown -->
						<input type="hidden" name="txt_icity" id="txt_icity">
						<input type="text" id="txt_search_val" name="txt_search_val" class="form-control" placeholder="Type Your key word">
						<span class="erro_msg" id="err_txt_search_val"></span>
						<button type="button" class="form-control" value="Search" id="btn_search">Search</button>
					<?= form_close(); ?>
						</div><!-- banner-form -->
						
						<!-- banner-socail -->
						<!-- banner-socail -->
					</div>
				</div><!-- banner -->
			</div><!-- row -->
		</div><!-- world -->



	<div class="container">

	
			<div class="section category-ad text-center" style="width: 100%;">
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
						

				</ul>				
			</div><!-- category-ad -->	
		
			<!-- featureds -->
			<!-- featureds -->

			<!-- ad-section -->						
			<!-- ad-section -->

			<!-- trending-ads -->
			<!-- trending-ads -->			

			<!-- cta -->
			<!-- cta -->	
		
										
</div><!-- container -->
	</section><!-- home-one-info -->
	
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
	<!-- <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
	-->
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
<script type="text/javascript">
/*
Filter records
 */
    $(document).ready(function(){
  /*  $("#txt_search_val").keydown(function(e){
        var search_val = this.value;  
        if(e.keyCode == 13)
        {
          window.location = base_url+'all-result/'+search_val;
        }
      });*/

      $("#btn_search").click(function(){
        var search_val = $("#txt_search_val").val().trim();
        search_val = search_val.replace(/\s+/g,'-','-');
       var var_city = '<?php echo $this->session->userdata('city'); ?>';
   		if(var_city != '')
        {
        	var icity = '<?php echo $this->session->userdata('city');?>';
        }
        else
        {	
        	var icity = $("#txt_icity").val();
        }
        if(search_val != '')
        {
          window.location = base_url+'all-result/'+search_val+'/'+icity;
        }
        else
        {
          $("#txt_search_val").focus();
        }

      });

document.getElementById('frm_search_val').addEventListener('submit', function(e) {
  var search_val = $("#txt_search_val").val().trim();
   		var var_city = '<?php echo $this->session->userdata('city'); ?>';
   		if(var_city != '')
        {
        	var icity = '<?php echo $this->session->userdata('city');?>';
        }
        else
        {	
        	var icity = $("#txt_icity").val();
        }
  search_val = search_val.replace(/\s+/g,'-','-');

  //alert(search_val);

    window.location = base_url+'all-result/'+search_val+'/'+icity;
    e.preventDefault();
}, false);

      
  });



 $(function(){
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(getLocation);
    } else { 
        $('#loc').html('Geolocation is not supported by your browser.');
    }

   function getLocation(loc) {
        	var latitude = loc.coords.latitude;
            var longitude = loc.coords.longitude;
            $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?latlng="+latitude+","+longitude, function(data) {
            console.log(data);
			var results = data.results;
			 // var p = data.results[0].formatted_address ;
			  //alert(results);
if (results[0]) {
//console.log("results.length= "+results.length);
//console.log("hi "+JSON.stringify(results[0],null,4));
for (var j = 0; j < results.length; j++){
//console.log("j= "+j);
//console.log(JSON.stringify(results[j],null,4));
for (var i = 0; i < results[j].address_components.length; i++){
if(results[j].address_components[i].types[0] == "locality") {
//this is the object you are looking for
locality = results[j].address_components[i];
}
}
}
console.log(locality.long_name);
console.log(locality.short_name);
}
// alert(locality.long_name);
var city = locality.long_name;
//alert(data.results[0].formatted_address);
//alert(locality.short_name);
             $("#loc").html(data.results[0].formatted_address);
           	 $("#txt_icity").val(city);
            }); 
   }


 });









</script>
<!-- Mirrored from demo.LAboO.com/trade/index-one.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 14 Feb 2018 18:18:21 GMT -->
</html>