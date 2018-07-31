
<header id="header" class="clearfix">
		<!-- navbar -->
		<nav class="navbar navbar-default">
			<div class="container">
				<!-- navbar-header -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?= base_url('home'); ?>"><img class="img-responsive" src="<?= base_url('assets/images/logo.jpg');?>" alt="Logo"></a>
				</div>
				<!-- /navbar-header -->
				
			  <!-- nav-right -->
				<div class="nav-right">
					<!-- language-dropdown -->
					<!-- language-dropdown -->

					<!-- language-dropdown -->

					<!-- sign-in -->					
					<ul class="sign-in">
						<li><i class="fa fa-user"></i></li>
						<?php 
						if(isset($this->session->userdata['user_logged_in']))
						{   
						   $username = $this->session->userdata['user_logged_in']['user_name'];
						   ?>
						   	<div class="dropdown language-dropdown">
								<!-- <i class="fa fa-globe"></i> 						 -->
								<a data-toggle="dropdown" href="#"><span class="change-text"><?= $username; ?></span>
								 <!-- <i class="fa fa-angle-down"></i> -->
								 <span class="caret"></span>
								</a>
								<ul class="dropdown-menu">
									<li><a href="<?= base_url('my-account'); ?>">My Account</a></li>
									<li><a href="<?= base_url('my-account/profile');?>">Change Password</a></li>
									<li><a href="<?= base_url('logout'); ?>"> Logout </a></li>
								</ul>								
							</div>
				<!-- 		  <li><a>  </a></li>
						   -->
						   <?php 
						 }
						 else
						 {
						 	?>
						 		<li><a href="<?= base_url('sign-in'); ?>"> Sign In </a></li>
						 		
						 		<li></li>
						 		<li>/</li>
								<li><a href="<?= base_url('sign-up'); ?>">Register</a></li>
							
						 	<?php 
						 }  
						   ?>

					

					</ul><!-- sign-in -->					

					<a href="<?= base_url('ad-post'); ?>" class="btn">Post Your Ad</a>
				</div>
				<!-- nav-right -->
			</div><!-- container -->
		</nav><!-- navbar -->
	</header>