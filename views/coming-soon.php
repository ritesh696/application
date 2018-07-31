<?php 
$array = array('200', '15','69','122','50','201','203','301');
print_r($array);
echo "<br />";


arsort($array);

print_r($array);

$i = count($array);

echo '</br>'.$array[$i-1];
echo '</br>'.$array[$i-2];
echo "<br />";

$max_1 = $max_2 = 0;

for($i=0; $i<count($array); $i++)
{
    if($array[$i] > $max_1)
    {
      $max_2 = $max_1;
      $max_1 = $array[$i];
    }
    else if($array[$i] > $max_2)
    {
      $max_2 = $array[$i];
    }
}
echo "Max=".$max_1;
echo "<br />"; 
echo "Smax 2=".$max_2;


echo "<br />"; 
echo "<br />"; 
echo "ODD EVEN </br>";
$input = array(1,4, 3, 6, 5, 8, 7, 2,9,10);
 
// comparator function to filter odd elements
function oddCmp($input)
{
    return ($input & 1);
}
 
// comparator function to filter odd elements
function evenCmp($input)
{
    return !($input & 1);
}
 
// filter odd-index elements
$odd = array_filter($input, "oddCmp");
 
// filter even-index elements
$even = array_filter($input, "evenCmp");
 
// re-index odd array by use of array_values()
$odd = array_values(array_filter($odd));
 
// re-index even array by use of array_values()
$even = array_values(array_filter($even));
 
// print odd-indexed array
echo "<br />"; 
print"Odd array :\n";
print_r($odd);
 
 echo "<br />"; 
// print even-indexed array
print"\nEven array :\n";
print_r($even);




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
	<?= link_tag('assets/css/ff');?>
	<?= link_tag('assets/css/gg');?>

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
  	<div class="upcoming-section">
  		<div class="upcoming-overlay"></div>
  		<div class="container">
  			<div class="logo-intro">
  				<a href="#"><img class="img-responsive" src="<?= base_url(); ?>assets/images/swapieelogo.jpg" alt="Logo"></a>
  			</div>
  			<h1>We are Coming Soon</h1>
  			<h2>Our website is under costruction,Launching in</h2>
			 <p id="demo" style="font-size:50px"></p>
			 <ul id="countdown">
			   <li>                     
			        <span class="days" id="days"></span>
			        <p>days</p>
			    </li>
			    <li>
			        <span class="hours" id="hours"></span>
			        <p>hours</p>
			    </li>
			    <li>
			        <span class="minutes" id="minutes"></span>
			        <p>minutes</p>
			    </li>
			    <li>
			        <span class="seconds" id="seconds"></span>
			        <p>seconds</p>
			    </li>              
			</ul> 
 			<!--<ul class="socail list-inline">
				<li><a href="#" title="Facebook"><i class="fa fa-facebook"></i></a></li>
				<li><a href="#" title="Twitter"><i class="fa fa-twitter"></i></a></li>
				<li><a href="#" title="Google Plus"><i class="fa fa-google-plus"></i></a></li>
				<li><a href="#" title="Youtube"><i class="fa fa-youtube"></i></a></li>
			</ul>--> 
  		</div><!-- container -->
  	</div><!-- upcoming section -->

<script>
// Set the date we're counting down to
var countDownDate = new Date("July 23, 2018 00:00:00").getTime();

// Update the count down every 1 second
var countdownfunction = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
   // document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    //+ minutes + "m " + seconds + "s ";
	document.getElementById("days").innerHTML = days; 
	document.getElementById("hours").innerHTML = hours; 
	document.getElementById("minutes").innerHTML = minutes; 
	document.getElementById("seconds").innerHTML = seconds; 
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(countdownfunction);
        document.getElementById("demo").innerHTML = "EXPIRED";
    }
}, 1000);
</script>
  	

  	

  	


	

   	
	
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

	<script>
	    (function () {

	        $("#countdown").countdown({
	            date: "27 December 2017 12:00:00",
	            format: "on"
	        });
	    
	    }());   		
	</script>
	<!----<script>  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','../../www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-73239902-1', 'auto');
	  ga('send', 'pageview');             </script>---->

  </body>


</html>