
<?php  
$loginURL = '';
$mobno = '';
if(isset($mobile_no))
{
	$mobno = $mobile_no;
}
$session_otp =  '';
$register_msg =  '';
$ad_id = '';
$update_profile = '';
if(isset($this->session->userdata['session_OTP']['OTP']))
{
	$session_otp =  $this->session->userdata['session_OTP']['OTP'];

//  $url = base_url().'OTP_expired/'.$mobno;
//	header("Refresh:120;url = $url");
	
  echo $session_otp;

}
if(isset($this->session->userdata['session_OTP']['msg_otp']))
{
	$register_msg =  $this->session->userdata['session_OTP']['msg_otp'];
	
}
if(isset($this->session->userdata['session_OTP']['ad_id']))
{
	$ad_id =  $this->session->userdata['session_OTP']['ad_id'];
	
}
 if(isset($this->session->userdata['session_OTP']['update_profile']))
  {
      $update_profile =  $this->session->userdata['session_OTP']['update_profile'];
      
  }

if($ad_id == '' && $register_msg == '' && $update_profile == '')
{
    redirect(base_url());
}  
  /*echo '</br> AD_ID:'.$ad_id;
  echo '</br> register_msg:'.$register_msg;
  echo '</br> update_profile:'.$update_profile;*/
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

	<!-- signin-page -->
	<section id="main" class="clearfix user-page">
		<div class="container">
			<div class="row text-center">
				<!-- user-login -->			
				
				<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">


					<div class="user-account">
						<span  class="mygreen">Please enter the verification code sent to <?php echo $mobno; ?>.</span>
						<h2>Verify OTP</h2>
						<!-- form -->
						<?= form_open('#',['id'=>'frm_verifyotp','name'=>'frm_verifyotp']) ?>
							<div class="form-group"> <span id="err_txt_otp" class="erro_msg"></span>
								<input type="text" class="form-control" name="txt_otp" id="txt_otp" placeholder="OTP code" onkeypress="return fun_number_validate(event,this);" >
							</div>
					      
              <span id="countdown" class=""></span>

							<input type="hidden" name="txt_mobile_no" id="txt_mobile_no" value="<?= $mobno; ?>">
		          
              <div id="div_btn_verify" class="">     <a  href="javascript:void(0);" class="btn" id="btn_otp_verify">Verify</a> </div>

            <div id="div_btn_resend" class="hide"> <a href="javascript:void(0);" id="btn_resend_otp" class="btn">  Re-send OTP   </a> </div>
					 

                   <input type="hidden" name="city" id="city" />
                   <input type="hidden" name="state" id="state" />
                   <input type="hidden" name="country" id="country" />  	
						<?= form_close(); ?><!-- form -->
					
						<!-- forgot-password -->
			<!-- 			<div class="user-option">
							<div class="checkbox pull-left">
								<label for="logged"><input type="checkbox" name="logged" id="logged"> Keep me logged in </label>
							</div>
							<div class="pull-right forgot-password">
								<a href="#">Forgot password</a>
							</div>
						</div> --><!-- forgot-password -->
					</div>
                    
					<a href="<?= base_url('sign-up'); ?>" class="btn-primary">Create a New Account</a>
				</div><!-- user-login -->			
			</div><!-- row -->	
		</div><!-- container -->
	</section><!-- signin-page -->
	
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

 <script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
    
 <script language="Javascript"> 
 window.onload = function() {
    //document.write("Welcome to our visitors from "+geoplugin_city()+","+geoplugin_region()+", "+geoplugin_countryName()); 
    document.getElementById("city").value = geoplugin_city();
    document.getElementById("state").value = geoplugin_region();
    document.getElementById("country").value = geoplugin_countryName();
 };
</script>


<script type="text/javascript">

var mob_no = '<?= $mobno; ?>';

var session_otp = '<?= $session_otp; ?>';
var register_msg = '<?= $register_msg; ?>';
var ad_id = '<?= $ad_id; ?>';
var update_profile = '<?= $update_profile; ?>';

var x = '';
//alert(register_msg);

if(session_otp != '')
{
  
  //var countDown = new Date(c_date.getTime() + (1 * 10 * 1000));
  countdown_timer();

}
else
{
      $("#countdown").addClass('hide');
      $("#div_btn_resend").removeClass('hide');
      $("#div_btn_verify").addClass('hide');
     
}


// Update the count down every 1 second
function countdown_timer()
{
          var c_date = new Date();
          var countDown = new Date(c_date.getTime() + (1 * 30 * 1000));
          x = setInterval(function() {

          // Get todays date and time
          var now = new Date().getTime();
          
          // Find the distance between now an the count down date
          var distance = countDown - now;
         // var distance = 120000 - now;
         
          // Time calculations for days, hours, minutes and seconds
          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);
          
          // Output the result in an element with id="demo"
          $("#countdown").text(minutes + " : " + seconds) ;
          
          // If the count down is over, write some text 
          if (distance < 0) {
              clearInterval(x);
              $.ajax({
                    type:'POST',
                    data:{mobno:mob_no},
                    url:"<?= base_url('c_home/OTP-expired'); ?>",
                    success:function(data){
                        
                        $("#countdown").text("TIME OVER");
                        $("#div_btn_resend").removeClass('hide');
                        $("#div_btn_verify").addClass('hide');

                    }
              });


             
                 
              }
          }, 1000);

}







$(document).ready(function(){

	 $("#btn_otp_verify").click(function(e){
	    fun_verify_otp(e);
	  });

	  $("#txt_otp").keydown(function(e){
       if(e.keyCode == 13)
	      {
          //alert('sdfsdf');
	        // fun_verify_otp(e);
	      }

	  });

    $("#btn_resend_otp").click(function(){

          var date = new Date();
          $("#countdown").text('');
           clearInterval(x);
          $.ajax({

                  url:"<?= base_url('c_home/resend-otp');?>",
                  data:{mobno:mob_no,
                        register_msg:register_msg,
                        ad_id:ad_id,
                        update_profile:update_profile
                        },
                  type:'POST',
                  success:function(data)
                  {
                     
                     
                      $("#countdown").removeClass('hide');
                     
                      $("#div_btn_resend").addClass('hide');
                      $("#div_btn_verify").removeClass('hide');
                      
                       countdown_timer();
                  }
          });

    });


});



function fun_verify_otp(e)
{
    var otp = $("#txt_otp").val();
  //  var mob_no = $("#txt_mobile_no").val();


    if(otp.trim() == '' )
    {
      e.preventDefault();
      $("#err_txt_otp").text('Enetr OTP.');
      $("#txt_otp").addClass('error_control');
      $("#txt_otp"),focus();
      return false;
    }
    else
    {

        var form = document.getElementById('frm_verifyotp');
        var form_data = new FormData(form);

        $.ajax({
                url:"<?= base_url('c_ajax_site_home/verify_otp'); ?>",
                //dataType:'json',
                type:'POST',
               	data:form_data,
                //data:{txt_otp:otp,
                  //  txt_mobile_no:mob_no},
                contentType:false,
                cache:false,
                processData:false,
               success:function(data)
                {
                  // alert(data);
                   var Obj = JSON.parse(data);
                   if(Obj.STATUS == 101)
                   {
                        e.preventDefault();
                   		$("#err_txt_otp").text(Obj.message);
                     $("#div_btn_resend").removeClass('hide');
                      return false;
                   }
                   else
                   {
                   		//alert(Obj.message);
                   		if(Obj.action_page == 'ad_post')
                   		{
                   			window.location = base_url+'post-done';
                   		}
                      if(Obj.action_page == 'my-account/profile')
                      {
                        window.location = base_url+'my-account/profile';
                      }
                   		else
                   		{
                   			window.location = base_url;	
                   		}
                   		
                   }
                }

        });

    }


}

</script>


  </body>


</html>