<script type="text/javascript">
	
	var base_url = '<?= base_url(); ?>';
</script>

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
					<a class="navbar-brand" href="<?= base_url('home'); ?>"><img class="img-responsive" src="<?= base_url('assets/images/logo.png');?>" alt="Logo"></a>
				</div>
				<!-- /navbar-header -->
				
			  <!-- nav-right -->
				<div class="nav-right">
					<!-- language-dropdown -->
					<!-- language-dropdown -->

					<!-- language-dropdown -->

					<!-- sign-in -->					
					<ul class="sign-in">
						
						<?php 
						if(isset($this->session->userdata['admin_logged_in']))
						{   
						   $username = $this->session->userdata['admin_logged_in']['admin_name'];
						   ?>
						   <li><i class="fa fa-user"></i></li>
						   	<div class="dropdown language-dropdown">
								<!-- <i class="fa fa-globe"></i> 						 -->
								<a data-toggle="dropdown" href="#"><span class="change-text"><?= $username; ?></span>
								 <!-- <i class="fa fa-angle-down"></i> -->
								 <span class="caret"></span>
								</a>
								<ul class="dropdown-menu">
									<li><a href="<?= base_url('siteadmin/profile');?>">Change Password</a></li>
									<li><a href="<?= base_url('siteadmin/logout'); ?>"> Logout </a></li>
								</ul>								
							</div>
				<!-- 		  <li><a>  </a></li>
						   -->
						   <?php 
						 }
						 else
						 {
						 	?>
						 		
						 	<?php 
						 }  
						   ?>

					

					</ul><!-- sign-in -->					

					
				</div>
				<!-- nav-right -->
			</div><!-- container -->
		</nav><!-- navbar -->
	</header>




	
<div id="reason_return_popup" class="my_popup" style="display :none ;">
	<div class="my_popup_sub">
		<div class="my_popup_body" style="height: 480px">
			<div class="my_popup_head">
				<span class="close_popup" onclick="fun_close_popup();"><i class="fa fa-close"></i></span>
			</div>
			<div id="login_body" class="my_popup_content">
				<h2 class="login_title">Deactive Ads </h2>
				<?= form_open('',['name'=>'frm_deactive','id'=>'frm_deactive']) ?>
					<input type="hidden" name="txt_hidden_ad_id" id="txt_hidden_ad_id"/>		
					<input type="hidden" name="txt_hidden_user_id" id="txt_hidden_user_id"/>		
					<h5 class="black">Choose Your reason</h5>
				<div class="form-group">
					<span class="erro_msg" id="err_radio_deactive"> </span>
					<div class="col-sm-8">
						<input type="radio" name="radio_reason" id="radio_reason_1" value="your ads is not propoer">
						<label for="radio_reason_1">your ads is not propoer</label>
					</div>
					<div class="col-sm-8">
						<input type="radio" name="radio_reason" id="radio_reason_2"  value="your ads description is wrong">
						<label for="radio_reason_2">your ads description is wrong</label>
					</div>
					<div class="col-sm-12">
						<input type="radio" name="radio_reason" id="radio_reason_3"  value="You can not sold such kind of item">
						<label for="radio_reason_3">You can not sold such kind of item</label>
					</div>
					<div class="col-sm-12">
						<input type="radio" name="radio_reason" id="radio_reason_4"  value="Your ad Title is not proper">
						<label for="radio_reason_4">Your ad Title is not proper</label>
					</div>
					<div class="col-sm-12">
						<input type="radio" name="radio_reason" id="radio_reason_5"  value="Please do not post Dublicate ads">
						<label for="radio_reason_5">Please do not post Dublicate ads</label>
					</div>
					<div class="col-sm-12">
						<input type="radio" name="radio_reason" id="radio_reason_6"  value="Please insert relevant and good quaility images">
						<label for="radio_reason_6">Please insert relevant and good quaility images</label>
					</div>
					<div class="col-sm-12">
						<input type="radio" name="radio_reason" id="radio_reason_7"  value="Other reason">
						<label for="radio_reason_7">Other reason</label>
					</div>
				</div>
				<div class="form-group ">
					<div class="col-sm-12">
						<label for="txa_other_reason">Comment</label>
						<textarea name="txa_other_reason" id="txa_other_reason" class="form-control font-500"></textarea>
						<span class="erro_msg" id="err_txa_other_reason"> </span>
					</div>

				</div>
				
				<div class="form-group">
					<div class="col-sm-12">
						<button class="btn btn-lg btn-block waves-effect waves-light" type="button" id="btn_reason" >
							Submit<i id="loader_reason" class="fa fa-spinner fa-spin hide"></i>
						</button>
					</div>
				</div>

				 <input type="hidden" name="city" id="city" />
                 <input type="hidden" name="state" id="state" />
                 <input type="hidden" name="country" id="country" /> 


				<?= form_close(); ?>
			</div>
		</div>
	</div>
</div>
