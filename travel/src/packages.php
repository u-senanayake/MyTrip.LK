<?php
if(!isset($_SESSION[''])){
	session_start();
}
include_once('../ssi/db.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Green Wheels | Packages</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Travel, Sri Lanka, Journey, Adventure" />
<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="../css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="../css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="../css/font-awesome.css" rel="stylesheet">
<!-- Custom Theme files -->
<script src="../js/jquery-1.12.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<!--animate-->
<link href="../css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="../js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
</head>
<body>
<!-- top-header -->
<div class="top-header">
	<div class="container">
		<ul class="tp-hd-lft wow fadeInLeft animated" data-wow-delay=".5s">
			<li class="hm"><a href="../index.php"><i class="fa fa-home"></i></a></li>
			<li class="prnt"><a href="javascript:window.print()">Print/SMS Ticket</a></li>
				
		</ul>
		<ul class="tp-hd-rgt wow fadeInRight animated" data-wow-delay=".5s"> 
			<li class="tol">Toll Number : 123-4568790</li>				
			<li class="sig"><a href="#" data-toggle="modal" data-target="#myModal" >Sign Up</a></li> 
			<li class="sigi"><a href="#" data-toggle="modal" data-target="#myModal4" >/ Sign In</a></li>
        </ul>
		<div class="clearfix"></div>
	</div>
</div>
<!--- /top-header ---->
<!--- header ---->
<div class="header">
	<div class="container">
		<div class="logo wow fadeInDown animated" data-wow-delay=".5s">
			<a href="../index.php">Green <span>Wheels</span></a>	
		</div>
		<div class="bus wow fadeInUp animated" data-wow-delay=".5s">
            <a href="../index.php" class="buses active">BUSES</a>
            <a href="hotels.html">HOTELS</a>
        </div>
		<div class="lock fadeInDown animated" data-wow-delay=".5s"> 
			<li><i class="fa fa-lock"></i></li>
            <li><div class="securetxt">SAFE &amp; SECURE<br> ONLINE PAYMENTS</div></li>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!--- footer-btm ---->
<div class="footer-btm wow fadeInLeft animated" data-wow-delay=".5s">
	<div class="container">
	<div class="navigation">
			<nav class="navbar navbar-default">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
					<nav class="cl-effect-1">
						<ul class="nav navbar-nav">
							<li><a href="about.html">About</a></li>
								<li><a href="faq.html">Faq</a></li>
								<li><a href="apps.html">Apps</a></li>
								<li><a href="blog.html">Blog</a></li>
								<li><a href="travels.html">Travels</a></li>
								<li><a href="privacy.html">Privacy Policy</a></li>
								<li><a href="agent.html">Agent Registration</a></li>
								<li><a href="terms.html">Terms of Use</a></li>
								<li><a href="contact.html">Contact Us</a></li>
								<li>Need Help?<a href="#" data-toggle="modal" data-target="#myModal3"> / Write Us </a>  </li>
								<div class="clearfix"></div>
						</ul>
					</nav>
				</div><!-- /.navbar-collapse -->	
			</nav>
		</div>
		
		<div class="clearfix"></div>
	</div>
</div>
<!--- /footer-btm ---->
<!--- banner ---->
<div class="banner-2 ">
	<div class="container">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"> Green Wheels - Best in Class for Travel & Hotels</h1>
	</div>
</div>
<?php
if(isset($_POST['submit'])){
	$budget = $_POST['budget'];
	$types = $_POST['select2'];
	$test="";
	foreach ($types as $value){
		$test = $value."' or '".$test;	
	}
	$trimmed = chop($test,"or ''");
	$d1 = $_POST['d1'];
	$d2 = $_POST['d2'];
	$duration = date_diff(date_create($d1),date_create($d2))->format('%a');
	$sql = "SELECT * FROM package WHERE package_budget < '".$budget."' AND package_duration < '".$duration."' AND location_id IN (SELECT location_id FROM location WHERE TYPE='".$trimmed."')";
	$result = mysqli_query($con, $sql);
	if(mysqli_num_rows($result) > 0){
		?>
        <div class="container">
		<table class="table table-striped">
         <tr>
                <th>
                Package Name
                </th>
                <th>
                Package Budget
                </th>
                <th>
                Package Duration
                </th>
                <th>
                Locations
                </th>
                <th>
                Check the Package
                </th>
                </tr>
		<?php
        while($row = mysqli_fetch_array($result)){
			?>
                <tr>
                <td>
                <?php $pid = $row['package_id']; 
				echo $pid;
				?>
                </td>
                <td>
                <?php echo $row['package_budget']; ?>
                </td>
                <td>
                <?php echo $row['package_duration']; ?>
                </td>
                <td>
                <?php 
				$query = "SELECT location.name FROM location INNER JOIN package ON location.location_id=package.location_id WHERE package.package_id='".$pid."'";
				$re = mysqli_query($con, $query);
				if(mysqli_num_rows($re) > 0){
					while($r = mysqli_fetch_array($re)){
						echo $r['name']."<br/>"; 	
					}
				} ?>
                </td>
                <td>
                <input type="submit" value="VIEW">
                </td>
                </tr>
            <?php
		}
		?>
        </table>
		</div>
        <?php
	} else {
		echo "SORRY THERE ARE NO RESULTS FIND YOUR PATTERN";	
	}
}
?>
<!--- footer-top ---->
<div class="footer-top">
	<div class="container">
		<div class="col-md-6 footer-left wow fadeInLeft animated" data-wow-delay=".5s">
			<h3>Journey through</h3>
				<ul>
					<li><a href="../index.php">Mahiyangana</a></li>
					<li><a href="../index.php">Colombo</a></li>
					<li><a href="../index.php">Kekirawa</a></li>
					<li><a href="../index.php">Lunugama</a></li>
					<li><a href="../index.php">Puttalam</a></li>
					<li><a href="../index.php">Maskaliya</a></li>
					<li><a href="../index.php">Nuware Eliya</a></li>
					<li><a href="../index.php">Kandy</a></li>
					<li><a href="../index.php">Badulla</a></li>
					<li><a href="../index.php">Unawatuna</a></li>
					<li><a href="../index.php">Jaffna</a></li>
					<li><a href="../index.php">Trincomalee</a></li>
					<li><a href="../index.php">Anuradhapura</a></li>
					<li><a href="../index.php">Mullaitivu</a></li>
					<li><a href="../index.php">Monaragala</a></li>
					<div class="clearfix"></div>
				</ul>
		</div>
		<div class="col-md-6 footer-left wow fadeInRight animated" data-wow-delay=".5s">
			<h3>Guides found in</h3>
				<ul>
					<li><a href="../index.php">Mahiyangana</a></li>
					<li><a href="../index.php">Colombo</a></li>
					<li><a href="../index.php">Kekirawa</a></li>
					<li><a href="../index.php">Lunugama</a></li>
					<li><a href="../index.php">Puttalam</a></li>
					<li><a href="../index.php">Maskaliya</a></li>
					<li><a href="../index.php">Nuware Eliya</a></li>
					<li><a href="../index.php">Kandy</a></li>
					<li><a href="../index.php">Badulla</a></li>
					<li><a href="../index.php">Unawatuna</a></li>
					<li><a href="../index.php">Jaffna</a></li>
					<li><a href="../index.php">Trincomalee</a></li>
					<li><a href="../index.php">Anuradhapura</a></li>
					<li><a href="../index.php">Mullaitivu</a></li>
					<li><a href="../index.php">Monaragala</a></li>
					<div class="clearfix"></div>
				</ul>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!--- /footer-top ---->
<!---copy-right ---->
<div class="copy-right">
	<div class="container">
	
		<div class="footer-social-icons wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">
			<ul>
				<li><a class="facebook" href="#"><span>Facebook</span></a></li>
				<li><a class="twitter" href="#"><span>Twitter</span></a></li>
				<li><a class="flickr" href="#"><span>Flickr</span></a></li>
				<li><a class="googleplus" href="#"><span>Google+</span></a></li>
			</ul>
		</div>
		<p class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">© 2016 Green Wheels . All Rights Reserved | Design by  <a href="http://azeemullah.com/" target="_blank">zPOKOin</a> </p>
	</div>
</div>
<!--- /copy-right ---->
<!-- sign -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
						</div>
							<section>
								<div class="modal-body modal-spa">
									<div class="login-grids">
										<div class="login">
											<div class="login-left">
												<ul>
													<li><a class="fb" href="#"><i></i>Sign in with Facebook</a></li>
													<li><a class="goog" href="#"><i></i>Sign in with Google</a></li>
													<li><a class="linkin" href="#"><i></i>Sign in with Linkedin</a></li>
												</ul>
											</div>
											<div class="login-right">
												<form>
													<h3>Create your account </h3>
													<input type="text" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}" required="">
													<input type="text" value="Mobile number" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Mobile number';}" required="">
													<input type="text" value="Email id" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email id';}" required="">	
													<input type="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">	
													<input type="submit" value="CREATE ACCOUNT">
												</form>
											</div>
												<div class="clearfix"></div>								
										</div>
											<p>By logging in you agree to our <a href="terms.html">Terms and Conditions</a> and <a href="privacy.html">Privacy Policy</a></p>
									</div>
								</div>
							</section>
					</div>
				</div>
			</div>
<!-- //sign -->
<!-- signin -->
		<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-info">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>						
						</div>
						<div class="modal-body modal-spa">
							<div class="login-grids">
								<div class="login">
									<div class="login-left">
										<ul>
											<li><a class="fb" href="#"><i></i>Sign in with Facebook</a></li>
											<li><a class="goog" href="#"><i></i>Sign in with Google</a></li>
											<li><a class="linkin" href="#"><i></i>Sign in with Linkedin</a></li>
										</ul>
									</div>
									<div class="login-right">
										<form>
											<h3>Signin with your account </h3>
											<input type="text" value="Enter your mobile number or Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter your mobile number or Email';}" required="">	
											<input type="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">	
											<h4><a href="#">Forgot password</a></h4>
											<div class="single-bottom">
												<input type="checkbox" id="brand" value="">
												<label for="brand"><span></span>Remember Me.</label>
											</div>
											<input type="submit" value="SIGNIN">
										</form>
									</div>
									<div class="clearfix"></div>								
								</div>
								<p>By logging in you agree to our <a href="terms.html">Terms and Conditions</a> and <a href="privacy.html">Privacy Policy</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
<!-- //signin -->
<!-- write us -->
			<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
						</div>
							<section>
								<div class="modal-body modal-spa">
									<div class="writ">
										<h4>HOW CAN WE HELP YOU</h4>
											<ul>
												<li class="na-me">
													<input class="name" type="text" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}" required="">
												</li>
												<li class="na-me">
													<input class="Email" type="text" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
												</li>
												<li class="na-me">
													<input class="number" type="text" value="Mobile Number" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Mobile Number';}" required="">
												</li>
												<li class="na-me">
													<select id="country" onchange="change_country(this.value)" class="frm-field required sect">
														<option value="null">Select Issue</option> 		
														<option value="null">Booking Issues</option>
														<option value="null">Bus Cancellation</option>
														<option value="null">Refund</option>
														<option value="null">Wallet</option>														
													</select>
												</li>
												<li class="na-me">
													<select id="country" onchange="change_country(this.value)" class="frm-field required sect">
														<option value="null">Select Issue</option> 		
														<option value="null">Booking Issues</option>
														<option value="null">Bus Cancellation</option>
														<option value="null">Refund</option>
														<option value="null">Wallet</option>														
													</select>
												</li>
												<li class="descrip">
													<input class="special" type="text" value="Write Description" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Write Description';}" required="">
												</li>
													<div class="clearfix"></div>
											</ul>
											<div class="sub-bn">
												<form>
													<button class="subbtn">Submit</button>
												</form>
											</div>
									</div>
								</div>
							</section>
					</div>
				</div>
			</div>
<!-- //write us -->
</body>
</html>