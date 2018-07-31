<?php 

//base_url('item/product-name/2');


$search_val = '';
$sub_category_id = '';
$userId = '';
$city = '';
if(isset($userid))
{
	$userId = $userid;
}
if(isset($sub_cat_id))
{
	$sub_category_id = $sub_cat_id;
}
if(isset($search_value))
{
	$search_val = preg_replace('/\\-+/',' ',$search_value);
}
if(isset($icity))
{
	//$this->session->unset_userdata('city');
	$city = $icity;
	$this->session->set_userdata('city',$city);
}	

if($this->session->userdata('city') != '')
{	
	$city =  $this->session->userdata('city');
}
//echo $city;

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
	<section id="main" class="clearfix category-page">
		<div class="container">
			
			<div class="banner">
			
				<!-- banner-form -->
				<div class="banner-form banner-form-full">
					<?= form_open('',['name'=>'frm_search_val','id'=>'frm_search_val']); ?>
						<!-- category-change -->
						<!-- category-change -->

						<!-- language-dropdown -->
						<!-- language-dropdown -->
					
						<input type="text" id="txt_search_val" name="txt_search_val" class="form-control" placeholder="Type Your key word" value="<?= $search_val; ?>">
						<span class="erro_msg" id="err_txt_search_val"></span>
						<button type="button" class="form-control" value="Search" id="btn_search">Search</button>
					<?= form_close(); ?>
				</div><!-- banner-form -->
			</div>
			
			<div class="banner">
				<div class="b-c-b2">	
					<span class="">
					<?php if($city != null) {?>	
						Your Location is <b><?= $city; ?></b>,
					<?php } ?>	
						Please <a href="javascript:void(0);"  data-toggle="modal" data-target="#exampleModalCenter"> click here </a> to change your location Showing Result For India. 
					</span>
				</div>
			</div>

			<div class="category-info">

				<div class="row">
					<!-- accordion-->
					<div class="col-md-3 col-sm-4">
						<div class="accordion">
							<!-- panel-group -->
							<div class="panel-group" id="accordion">
							 	
								<!-- panel -->
								<div class="panel-default panel-faq">
									<!-- panel-heading -->
									<!-- panel-heading -->

									
								</div><!-- panel -->

								<!-- panel -->
								<div class="panel-default panel-faq">
									<!-- panel-heading -->
									<div class="panel-heading">
										<a data-toggle="collapse" data-parent="#accordion" href="#accordion-two" >
											<h4 class="panel-title">Condition<span class="pull-right"><i class="fa fa-minus"></i></span></h4>
										</a>
									</div><!-- panel-heading -->

									<div id="accordion-two" class="panel-collapse collapse in" aria-expanded="true">
										<!-- panel-body -->
										<div class="panel-body">
											<label for="chk_conditions_new"><input type="checkbox" name="chk_conditions" id="chk_conditions_new" value="new" class="checkbox" onclick="fun_chk_conditions(this.value);"> New</label>
											<label for="chk_conditions_used"><input type="checkbox" name="chk_conditions" id="chk_conditions_used" value="used" class="checkbox" onclick="fun_chk_conditions(this.value);">  Used</label>
                                           <!--  <label for="used"><input type="checkbox" name="used" id="used"> Swap</label> -->
										</div><!-- panel-body -->
									</div>
								</div><!-- panel -->

								<!-- panel -->
								<div class="panel-default panel-faq">
									<!-- panel-heading -->
									<div class="panel-heading">
										<a data-toggle="collapse" data-parent="#accordion" href="#accordion-three">
											<h4 class="panel-title">
											Price
											<span class="pull-right"><i class="fa fa-minus"></i></span>
											</h4>
										</a>
									</div><!-- panel-heading -->

									<div id="accordion-three" class="panel-collapse collapse in" aria-expanded="true">
										<!-- panel-body -->
										<div class="panel-body">
											
											<label for="chk_price_<1000"><input type="checkbox" name="chk_price" id="chk_price_<1000" value="<1000" class="checkbox" onclick="fun_chk_price(this.value);"> Under &#8377; 1000</label>
											<label for="chk_price_1000to5000"><input type="checkbox" name="chk_price" id="chk_price_1000to5000" value="1000to5000" class="checkbox" onclick="fun_chk_price(this.value);" > &#8377; 1000 to &#8377; 5000</label>
											<label for="chk_price_5000to10000"><input type="checkbox" name="chk_price" id="chk_price_5000to10000" value="5000to10000" class="checkbox" onclick="fun_chk_price(this.value);"> &#8377; 5000 to &#8377; 10000</label>
											<label for="chk_price_10000to25000"><input type="checkbox" name="chk_price" id="chk_price_10000to25000" value="10000to25000" class="checkbox" onclick="fun_chk_price(this.value);">&#8377; 10000 to &#8377; 25000 </label>

											&#8377;<input type="text" class="from_price" placeholder="From" name="txt_price_from" id="txt_price_from" /> - &#8377;<input type="text" class="to_price" name="txt_price_to" id="txt_price_to"  placeholder="To" />
											<button class="btn btn_filter_price" onclick="fun_search_by_price_range();">Search</button>
											
										
										</div><!-- panel-body -->
									</div>
								</div><!-- panel -->

								<!-- panel -->
							<?php /*								
								<div class="panel-default panel-faq">
									<!-- panel-heading -->
									<div class="panel-heading">
										<a data-toggle="collapse" data-parent="#accordion" href="#accordion-four">
											<h4 class="panel-title">Posted By<span class="pull-right"><i class="fa fa-plus"></i></span></h4>
										</a>
									</div>
									<!-- panel-heading -->

									<div id="accordion-four" class="panel-collapse collapse">
										<!-- panel-body -->
										<div class="panel-body">
											<label for="individual"><input type="checkbox" name="individual" id="individual"> Individual</label>
											<label for="dealer"><input type="checkbox" name="dealer" id="dealer"> Dealer</label>
											<label for="reseller"><input type="checkbox" name="reseller" id="reseller"> Reseller</label>
											<label for="manufacturer"><input type="checkbox" name="manufacturer" id="manufacturer"> Manufacturer</label>
										</div><!-- panel-body -->
									</div>
								</div><!-- panel -->
								*/ ?>
								<!-- panel -->
								<div class="panel-default panel-faq">
									<!-- panel-heading -->
									<!-- panel-heading -->

									
								</div> <!-- panel -->   
							 </div><!-- panel-group -->
						</div>
					</div><!-- accordion-->

					<!-- recommended-ads -->
					


					<div class="col-sm-8 col-md-9 p-t-20" >				
						<div class="section recommended-ads">


						<div  class="text-center" id="loader">
							<img height="100px" width="150px" src="<?= base_url(); ?>assets/images/loader/loading-2.gif">
						</div>	

					<!--  /////////////////////////////// -->
					<div id="div_append_item">		
							

							<!-- featured-top -->
						<?php /*	<div class="featured-top">
								<h4>Showing results for "xxx xxx xxx xxx"</h4>
								<div class="dropdown pull-right">
								
								<!-- category-change -->
								<!-- category-change -->														
								</div>							
							</div><!-- featured-top -->	

							<!-- ad-item -->
							<div class="ad-item row">
								<!-- item-image -->
								<div class="item-image-box col-sm-4">
									<div class="item-image">
										<a href="<?= base_url('product/Apple-TV-Everything-you-need-to-know');?>"><img src="images/listing/1.jpg" alt="Image" class="img-responsive"></a>
									</div><!-- item-image -->
								</div>
								
								<!-- rending-text -->
								<div class="item-info col-sm-8">
									<!-- ad-info -->
									<div class="ad-info">
										<h3 class="item-price">$800.00</h3>
										<h4 class="item-title"><a href="">Apple TV - Everything you need to know!</a></h4>
										<div class="item-cat">
											<span><a href="#">Electronics & Gedgets</a></span> /
											<span><a href="#">Tv & Video</a></span>
										</div>										
									</div><!-- ad-info -->
									
									<!-- ad-meta -->
									<div class="ad-meta">
										<div class="meta-content">
											<span class="dated"><a href="#">7 Jan, 16  10:10 pm </a></span>
											<a href="#" class="tag"><i class="fa fa-tags"></i> New</a>
										</div>										
										<!-- item-info-right -->
										<div class="user-option pull-right">
											<a href="#" data-toggle="tooltip" data-placement="top" title="Los Angeles, USA"><i class="fa fa-map-marker"></i> </a>
											<a class="online" href="#" data-toggle="tooltip" data-placement="top" title="Individual"><i class="fa fa-user"></i> </a>											
										</div><!-- item-info-right -->
									</div><!-- ad-meta -->
								</div><!-- item-info -->
							</div><!-- ad-item -->
							*/?>
							<!-- ad-item -->
					</div>	

							<!-- pagination  -->
							<div class="text-center" id="div_pagination">
								<?php /*<ul class="pagination" >
								 <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
									<li><a href="#">1</a></li>
									<li class="active"><a href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">4</a></li>
									<li><a href="#">5</a></li>
									<li><a>...</a></li>
									<li><a href="#">10</a></li>
									<li><a href="#">20</a></li>
									<li><a href="#">30</a></li>
									<li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
								</ul> */ ?>
							</div><!-- pagination  -->	

							

			<!--  /////////////////////////////// -->

						</div>
					</div><!-- recommended-ads -->

					
				</div>	
			</div>
		</div><!-- container -->
	</section><!-- main -->
	
	
	<section id="something-sell" class="clearfix parallax-section">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-center">
					<h2 class="title">Do you have something-sell?</h2>
					<h4>Post your ad for free on Trade.com</h4>
					<a href="<?= base_url('ad-post'); ?>" class="btn btn-primary">Post Your Ad</a>
				</div>
			</div><!-- row -->
		</div><!-- contaioner -->
	</section><!-- something-sell -->
	
	<!-- footer -->
	<?php include('inc/footer.php'); ?>
	<!-- footer -->

	<!--/Preset Style Chooser--> 
	<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="col-sm-8"> 
        	<h4 class="modal-title">Select City</h4>
		</div>
        <div class="col-sm-4">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	    </div>
      </div>
      <div class="modal-body">
      	
      	<nav class="navbar">
		  <div class="d-inline-flex justify-content-between">
		    <div class="row">
		    <?php if(isset($get_city) && $get_city != null) { 
		    	foreach ($get_city as  $value) {
		    		?>
		    				<div class="col-sm-3">
					    		<a href="#" onclick="fun_search_by_city('<?= $value->city_name; ?>');"><?= $value->city_name; ?></a>
					    	</div>

		    		<?php 		
		    	}
		    	?>		
		    	
		    <?php } ?>	

		    </div>	

		  </div>
		</nav> 	



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       <!--  <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>


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

<script type="text/javascript">
	
	var perpage = 2;
	
	var arr_price = [];
	var arr_conditions = [];
	var sub_category_id = '<?= $sub_category_id; ?>';
	var user_id = '<?= $userId; ?>';
	var city = '<?= $city; ?>';

	

  $(document).ready(function(){

    var offset = 0;
    
    var search_val = $("#txt_search_val").val();
    var price_from = $("#txt_price_from").val();
    var price_to = $("#txt_price_to").val();
    
    show_data(search_val,city,user_id,sub_category_id,arr_price,arr_conditions,price_from,price_to,offset,perpage);




    $("#txt_price_to").keydown(function(e){
      if(e.keyCode == 13)
      {
        fun_search_by_price_range();
      }
    }); 

/*    $("#txt_search_val").keydown(function(e){
      if(e.keyCode == 13)
      {
        show_data(this.value,user_id,sub_category_id,arr_price,arr_conditions,price_from,price_to,offset,perpage);
      }
    });
*/
    $("#btn_search").click(function(){
      	
      	var search_val = $("#txt_search_val").val();
      	
    	var category_name = $("#txt_hidden_category_name").val();
		var sub_category_name = $("#txt_hidden_sub_category_name").val();

      	
      if(search_val != '')
      {
      	search_val = search_val.replace(/\s+/g,'-','-');
      	
		if(category_name != '' &&  sub_category_name != '')
      	{
      		window.location = base_url+category_name+'/'+sub_category_name+'/'+sub_category_id+'/'+search_val;		
      	}

      	if(city != '')
      	{	
        	 //window.location = current_url+'/'+search_val+'/'+city;	
        	 window.location = base_url+'all-result/'+search_val+'/'+city;	
        }
        else
        {
        	//window.location = current_url+'/'+search_val;		
        	window.location = base_url+'all-result/'+search_val;		
        }
        //show_data(search_val,city,user_id,sub_category_id,arr_price,arr_conditions,price_from,price_to,offset,perpage);
      }
      else
      {
        $("#txt_search_val").focus();
      }

    });

	    document.getElementById('frm_search_val').addEventListener('submit', function(e) {
		var search_val = $("#txt_search_val").val();

		search_val = search_val.replace(/\s+/g,'-','-');

		var category_name = $("#txt_hidden_category_name").val();
		var sub_category_name = $("#txt_hidden_sub_category_name").val();
		
		if(search_val == '')
		{
			 e.preventDefault();
		}

			else if(category_name != '' &&  sub_category_name != '' && search_val != '' &&  city == '')
	      	{
	      		 window.location = base_url+category_name+'/'+sub_category_name+'/'+sub_category_id+'/'+search_val;	
	      	}
	      	else if(category_name != '' &&  sub_category_name != '' && search_val != '' &&  city != '')
	      	{
	      		 window.location = base_url+category_name+'/'+sub_category_name+'/'+sub_category_id+'/'+search_val+'/'+city;	
	      	}
	   		else if(city != 0 && search_val != '')
	      	{	
	      	  // window.location = current_url+'/'+search_val+'/'+city;	
	      	   window.location = base_url+'all-result/'+search_val+'/'+city;	
	        }
	        else if(city != 0 && search_val == '' )
	        {
	        	window.location = base_url+'result/'+city;	
	        }	
	        else
	        {
	        	//window.location = current_url+'/'+search_val;		
	        	window.location = base_url+'all-result/'+search_val;		
	        }
	   // show_data(search_val,city,user_id,sub_category_id,arr_price,arr_conditions,price_from,price_to,offset,perpage);
	    e.preventDefault();
	}, false);
	

  });


function fun_search_by_city(city)
{
	 var offset ='';
  var search_val = $("#txt_search_val").val();
  var price_from = $("#txt_price_from").val();
  var price_to = $("#txt_price_to").val();

  	var category_name = $("#txt_hidden_category_name").val();
	var sub_category_name = $("#txt_hidden_sub_category_name").val();

	if(category_name == '' &&  sub_category_name == '' && search_val.trim() != '' && city != '')
	{  
		search_val = search_val.replace(/\s+/g,'-','-');
		//window.location = current_url+'/'+search_val+'/'+city;
		window.location = base_url+'all-result/'+search_val+'/'+city;
	}
	else if(category_name != '' &&  sub_category_name != '' && search_val != '' &&  city == '')
  	{
  		 window.location = base_url+category_name+'/'+sub_category_name+'/'+sub_category_id+'/'+search_val;	
  	}
  	else if(category_name != '' &&  sub_category_name != '' && search_val != '' &&  city != '')
  	{
  		 window.location = base_url+category_name+'/'+sub_category_name+'/'+sub_category_id+'/'+search_val+'/'+city;	
  	}
  	else if(category_name != '' &&  sub_category_name != '' && search_val == '' &&  city != '')
  	{
  		 window.location = base_url+'result/'+category_name+'/'+sub_category_name+'/'+sub_category_id+'/'+city;	
  	}
	else
	{
		//window.location = current_url+'/'+city;	
		window.location = base_url+'result/'+city;	
	}	
  // show_data(search_val,city,user_id,sub_category_id,arr_price,arr_conditions,price_from,price_to,offset,perpage);


}



function show_data(search_val,city,user_id,sub_category_id,arr_price,arr_conditions,price_from,price_to,offset,perpage)
{

  //alert(JSON.stringify(arr_price));
  //alert(JSON.stringify(arr_conditions));
  $("#div_append_item").html('');
  $("#div_pagination").html('');
  $("#loader").removeClass('hide');
   $("#exampleModalCenter").modal('hide');

  $.ajax({
    
      url:'<?= base_url();?>c_ajax_site_home/filter_item',
      type:'POST',
        dataType:'JSON',
      data:{search_val:search_val,
      		city:city,
          user_id:user_id,
          sub_category_id:sub_category_id,
          arr_price:arr_price,
          arr_conditions:arr_conditions,
          price_to:price_to,
          price_from:price_from,
          offset:offset,
          perpage:perpage
        },
      success:function(data)
      {
        //alert(data);
       
         $("#loader").addClass('hide');
        
        $(jQuery.parseJSON(JSON.stringify(data))).each(function(){
          //alert(this.pagination);
            $("#div_append_item").append(this.records);
            $("#div_pagination").append(this.pagination);
            
          //$("#div_total_records").append(this.total_records);
        }); 

      } 

  });
} 
function next_page(start_id)
{
    var offset = start_id;
    
    var search_val = $("#txt_search_val").val();
    var price_from = $("#txt_price_from").val();
    var price_to = $("#txt_price_to").val();
    show_data(search_val,city,user_id,sub_category_id,arr_price,arr_conditions,price_from,price_to,offset,perpage);
}

function fun_chk_price(id)
{

  var offset ='';
   
  var price_from = $("#txt_price_from").val();
  var price_to = $("#txt_price_to").val();
  
  var search_val = $("#txt_search_val").val();

    var val = document.getElementById('chk_price_'+id).checked;
  
  if(val == true)
  {
    
      arr_price.push(id);
  } 
  else
  {
      var index_id = arr_price.indexOf(id);
      if(index_id > -1)
      {
        arr_price.splice(index_id,1);
      }
  }


 show_data(search_val,city,user_id,sub_category_id,arr_price,arr_conditions,price_from,price_to,offset,perpage);
}


function fun_chk_conditions(id)
{
  var offset ='';
  var price_from = $("#txt_price_from").val();
  var price_to = $("#txt_price_to").val();
  
  var search_val = $("#txt_search_val").val();


  var val = document.getElementById('chk_conditions_'+id).checked;
  
  if(val == true)
  {
    
      arr_conditions.push(id);
  } 
  else
  {
      var index_id = arr_conditions.indexOf(id);
      if(index_id > -1)
      {
        arr_conditions.splice(index_id,1);
      }
  }


   show_data(search_val,city,user_id,sub_category_id,arr_price,arr_conditions,price_from,price_to,offset,perpage);
}


function fun_search_by_price_range()
{

  var offset ='';
  var search_val = $("#txt_search_val").val();
  var price_from = $("#txt_price_from").val();
  var price_to = $("#txt_price_to").val();
 

   show_data(search_val,city,user_id,sub_category_id,arr_price,arr_conditions,price_from,price_to,offset,perpage);
}





</script>

  </body>

<!-- Mirrored from demo.LAboO.com/trade/<?= base_url('category'); ?> by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 14 Feb 2018 18:18:58 GMT -->
</html>