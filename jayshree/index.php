<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

// Output as HTML5
$doc->setHtml5(true);

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

$doc->addScriptVersion($this->baseurl . '/templates/' . $this->template . '/js/template.js');

// Add Stylesheets
$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/template.css');

$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/bootstrap.min.css');
$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/style.css');
$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/header.css');
$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/slider.css');
$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/font-awesome/css/font-awesome.min.css');
$doc->addStyleSheet('//db.onlinewebfonts.com/c/07689d4eaaa3d530d58826b5d7f84735?family=Montserrat');

// Use of Google Font
/*if ($this->params->get('googleFont'))
{
	$doc->addStyleSheet('//fonts.googleapis.com/css?family=' . $this->params->get('googleFontName'));
	$doc->addStyleDeclaration("
	h1, h2, h3, h4, h5, h6, .site-title {
		font-family: '" . str_replace('+', ' ', $this->params->get('googleFontName')) . "', sans-serif;
	}");
}*/

// Template color
if ($this->params->get('templateColor'))
{
	$doc->addStyleDeclaration("
	body.site {
		border-top: 3px solid " . $this->params->get('templateColor') . ";
		background-color: " . $this->params->get('templateBackgroundColor') . ";
	}
	a {
		color: " . $this->params->get('templateColor') . ";
	}
	.nav-list > .active > a,
	.nav-list > .active > a:hover,
	.dropdown-menu li > a:hover,
	.dropdown-menu .active > a,
	.dropdown-menu .active > a:hover,
	.nav-pills > .active > a,
	.nav-pills > .active > a:hover,
	.btn-primary {
		background: " . $this->params->get('templateColor') . ";
	}");
}

// Check for a custom CSS file
$userCss = JPATH_SITE . '/templates/' . $this->template . '/css/user.css';

if (file_exists($userCss) && filesize($userCss) > 0)
{
	$this->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/user.css');
}

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Adjusting content width
if ($this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span6";
}
elseif ($this->countModules('position-7') && !$this->countModules('position-8'))
{
	$span = "span9";
}
elseif (!$this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span9";
}
else
{
	$span = "span12";
}

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle'), ENT_COMPAT, 'UTF-8') . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
	<!--[if lt IE 9]><script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script><![endif]-->
</head>
<body>
<div class="container-fluid">
    <div class="common">

		<?php if ($this->countModules('position-0')) : ?>
		<div class="header">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-xs-12 pull-right">

					<jdoc:include type="modules" name="position-0" style="none" />
					<!--<ul class="list-inline">
						<li><a href="login.html">LOGIN</a></li>
						<span class="line"></span>
						<li><a href="#">SIGNUP</a></li>
						<span class="line"></span>
						<li><a href="#">REGISTRATION FOR DOCTOR</a></li>
					</ul>-->
				</div>
				<div class="cleafix"></div>
			</div>
  	</div>
	  <?php endif; ?>

		<?php if ($this->countModules('position-1')) : ?>
        <!--Navbar start-->
		<div class="navbar_wrapper">
			<div class="col-md-12">
				<nav class="navbar" role="navigation">
					<div class="">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse"
									data-target="#menu" style="z-index:9999;">

								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>

							</button>
							<a class="navbar-brand" href="index.html">
								<img src="http://placehold.it/150x50&text=Logo" alt="">
							</a>
						</div>

						<div class="collapse navbar-collapse" id="menu">
							<jdoc:include type="modules" name="position-1" style="none" />
							<!--<ul class="nav navbar-nav navbar-right">
								<li><a href="healthtips.html">healthy tips </a>

								</li>

								<li><a href="#">Our Events	</a>

								</li>
								<li><a href="#">Expert Team Opinion</a>

								</li>
								<li><a href="#">Case Studies</a>

								</li>
								<li><a href="contact.html">Contact Us</a></li>
							</ul>-->
						</div>
					</div>
				</nav>
			</div>
			<div class="clearfix"></div>
		</div>
		<?php endif; ?>

	</div>

 <!--Navbar End-->
 <?php if ($this->countModules('position-2')) : ?>
	<div class="row">
		<jdoc:include type="modules" name="position-2" style="none" />
        <div id="main_bg_banner" class="banner_tab0_img">
			<div class="container">
				<div class="col-md-7 col-md-offset-1 col-xs-12 Tabs">
					<div class="active">
						<ul class="nav nav-pills" id="banner_li">
							<li class="active" data-banner="banner_tab0_img"><a data-toggle="pill" href="#banner_tab0">Consult Online</a></li>
							<li data-banner="banner_tab1_img"><a data-toggle="pill" href="#banner_tab1">Ask a Question</a></li>
							<li data-banner="banner_tab2_img"><a data-toggle="pill" href="#banner_tab2">Book Appointment</a></li>
							<li data-banner="banner_tab3_img"><a data-toggle="pill" href="#banner_tab3">Home Visit</a></li>
						</ul>

						<div class="tab-content homeo_services_content">
							<div id="banner_tab0" class="tab-pane fade in active">
									<div class="h3">Why wait in queues at the clinic!</div>
									<div class="title">Consult Best  Homeopathy Doctors in Delhi/NCR Anytime Anywhere At All the Time</div>
									<div class="input">
										<div id="imaginary_container">
											<div class="form-group">
												<div class=" col-md-5 col-xs-12 icon-addon addon-md">
													<div class="row">
														<select class="form-control  form">
															<option>Select Option</option>
															<option>Sample</option>
															<option>Sample</option>
														</select>
														<!--<label for="email" class="glyphicon glyphicon-search" rel="tooltip" title="email"></label>-->
													</div>
												</div>
												<div class=" col-md-5 col-xs-12 icon-addon addon-md">
													<div class="row">
														<select class="form-control  form">
															<option>Select Option</option>
															<option>Sample</option>
															<option>Sample</option>
														</select>
														<!--<label for="email" class="glyphicon glyphicon-search" rel="tooltip" title="email"></label>-->
													</div>
												</div>
												<div class=" col-md-2 col-xs-12 icon-addon addon-md">
													<div class="row">
														<button type="button" class="submit button">SEARCH</button>
														<!--<label for="email" class="glyphicon glyphicon-search" rel="tooltip" title="email"></label>-->
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="step">
										<div class="row">
											<div class="col-md-3 col-xs-12">
												<img src="images/s.no1.png" alt="1."/>
												<img src="images/doctor.png" alt="doctor" class="icons"/>
												<p>CHOOSE A DOCTOR</p>
											</div>
											<div class="col-md-4 col-lg-offset-1 col-xs-12">
												<img src="images/s.no2.png" alt="1."/>
												<img src="images/money.png" alt="doctor" class="icons"/>
												<p>PAY CONSULTATION FEE</p>
											</div>
											<div class="col-md-3 col-lg-offset-1 col-xs-12">
												<img src="images/s.no3.png" alt="1."/>
												<img src="images/msg.png" alt="doctor" class="icons"/>
												<p>TALK TO THE DOCTOR</p>
											</div>
										</div>
									</div>
							</div>
							<div id="banner_tab1" class="tab-pane fade">
								  <div class="h3">Why wait in queues at the clinic!</div>
								  <div class="title">Get brief answers for your health queries. It's FREE!</div>
								  <br>
									<div class="form-group">
									  <label for="comment">Your Question :</label>
									  <textarea class="form-control" rows="3" id="comment"></textarea>
									</div>
									<div class="ask-button"><a href="#">Get your Answers</a></div>
									<div class="clearfix"></div>
									<div class="step">
										<div class="row">
											<div class="col-md-4 col-xs-12">
												<img src="images/s.no1.png" alt="1."/>
												<img src="images/doctor.png" alt="doctor" class="icons"/>
												<p>Verified Doctors</p>
											</div>
											<div class="col-md-4 col-xs-12">
												<img src="images/s.no2.png" alt="1."/>
												<img src="images/anonyms.png" alt="doctor" class="icons"/>
												<p>Remain Anonymous</p>
											</div>
											<div class="col-md-4 col-xs-12">
												<img src="images/s.no3.png" alt="1."/>
												<img src="images/time.png" alt="doctor" class="icons"/>
												<p>Quick Responses 24-48 hours</p>
											</div>
										</div>
									</div>
							</div>
							<div id="banner_tab2" class="tab-pane fade">
								 <div class="h3">Why wait in queues at the clinic!</div>
									<div class="title">Book instant appointments with doctors.</div>
									<div class="input">
										<div id="imaginary_container">
											<div class="form-group">
												<div class=" col-md-5 col-xs-12 icon-addon addon-md">
													<div class="row">
														<select class="form-control  form">
															<option>Select City</option>
															<option>Sample</option>
															<option>Sample</option>
														</select>
														<!--<label for="email" class="glyphicon glyphicon-search" rel="tooltip" title="email"></label>-->
													</div>
												</div>
												<div class=" col-md-5 col-xs-12 icon-addon addon-md">
													<div class="row">
														<select class="form-control  form">
															<option>Select Locality</option>
															<option>Sample</option>
															<option>Sample</option>
														</select>
														<!--<label for="email" class="glyphicon glyphicon-search" rel="tooltip" title="email"></label>-->
													</div>
												</div>
												<div class=" col-md-2 col-xs-12 icon-addon addon-md">
													<div class="row">
														<button type="button" class="submit button">SEARCH</button>
														<!--<label for="email" class="glyphicon glyphicon-search" rel="tooltip" title="email"></label>-->
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="step">
										<div class="row">
											<div class="col-md-4 col-xs-12">
												<img src="images/s.no1.png" alt="1."/>
												<img src="images/location.png" alt="doctor" class="icons"/>
												<p>Doctors in Delhi/NCR</p>
											</div>
											<div class="col-md-4 col-xs-12">
												<img src="images/s.no2.png" alt="1."/>
												<img src="images/verified-patient.png" alt="doctor" class="icons"/>
												<p>Verified patient reviews</p>
											</div>
											<div class="col-md-4 col-xs-12">
												<img src="images/s.no3.png" alt="1."/>
												<img src="images/appointments.png" alt="doctor" class="icons"/>
												<p>Appointments without hassle</p>
											</div>
										</div>
									</div>
							</div>
							<div id="banner_tab3" class="tab-pane fade">
								   <div class="h3">Beat traffic jams and clinic queues.</div>
									<div class="title">Book appointments for home visit</div>
									<div class="input">
										<div id="imaginary_container">
											<div class="form-group">
												<div class=" col-md-5 col-xs-12 icon-addon addon-md">
													<div class="row">
														<select class="form-control  form">
															<option>Select City</option>
															<option>Sample</option>
															<option>Sample</option>
														</select>
														<!--<label for="email" class="glyphicon glyphicon-search" rel="tooltip" title="email"></label>-->
													</div>
												</div>
												<div class=" col-md-5 col-xs-12 icon-addon addon-md">
													<div class="row">
														<select class="form-control  form">
															<option>Select Locality</option>
															<option>Sample</option>
															<option>Sample</option>
														</select>
														<!--<label for="email" class="glyphicon glyphicon-search" rel="tooltip" title="email"></label>-->
													</div>
												</div>
												<div class=" col-md-2 col-xs-12 icon-addon addon-md">
													<div class="row">
														<button type="button" class="submit button">SEARCH</button>
														<!--<label for="email" class="glyphicon glyphicon-search" rel="tooltip" title="email"></label>-->
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="step">
										<div class="row">

											<div class="col-md-4 col-xs-12">
												<img src="images/s.no1.png" alt="1."/>
												<img src="images/home.png" alt="doctor" class="icons"/>
												<p class="">AT HOME SERVICE</p>
											</div>
											<div class="col-md-3 col-xs-12">
												<img src="images/s.no1.png" alt="1."/>
												<img src="images/doctor.png" alt="doctor" class="icons"/>
												<p>CHOOSE A DOCTOR</p>
											</div>
											<div class="col-md-4 col-lg-offset-1 col-xs-12">
												<img src="images/s.no2.png" alt="1."/>
												<img src="images/medical-result.png" alt="doctor" class="icons"/>
												<p class="text-center">100% VERIFIED RESULT</p>
											</div>
										</div>
									</div>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
	<?php endif; ?>

    <div class="row bg">
        <div class="container">
            <div class="sections sections_white">
				<div class="col-lg-8 col-lg-offset-2 text-center">
					<span class="text"> Some Cool Facts</span>
					<h1>WHY YOU SHOULD CHOOSE US</h1>
					<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean finibus interdum urna. Phasellus ac lorem ut tellus 			                    ornare condimentum. Nulla facilisi. Nulla at facilisis nibh, in ultricies arcu. Fusce elementum mollis eros, vel                    ultricies enim consequat in.
					</p>

                </div>
				<div class="clearfix"></div>
                <div>
					<div class="col-md-4 col-xs-12 text-center division">
						<img src="images/icon1.png" alt="img"/>
						<h3>Space barrier is broken</h3>
						<p>Now patients can choose the doctors from anywhere in the world.</p>
					</div>
					<div class="col-md-4 col-xs-12 text-center division">
						<img src="images/icon2.png" alt="img"/>
						<h3>Space barrier is broken</h3>
						<p>Now patients can choose the doctors from anywhere in the world.</p>
					</div>
					<div class="col-md-4 col-xs-12 text-center division">
						<img src="images/icon3.png" alt="img"/>
						<h3>Space barrier is broken</h3>
						<p>Now patients can choose the doctors from anywhere in the world.</p>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="text-center">
					<ul class="list-inline">
						<li class="read_more"><a href="#">READ MORE</a></li>
						<li class="book_appointment"><a href="#">BOOK APPOINTMENT</a></li>
					</ul>
				</div>
			</div>
		</div>
		<svg class="bot_triangle" xmlns="#" version="1.1" width="100%" height="100" viewBox="0 0 100 102" preserveAspectRatio="none">
			<path class="white" d="M0 0 L50 100 L100 0 Z" />
		</svg>
	</div>

    <div class="row bg_lightpurple">
        <div class="container">
            <div class="sections">
				<div class="col-lg-8 col-lg-offset-2 text-center clearfix">
					<span class="text">Categories</span>
					<h1>PLEASE EXPLORE THE OUR CATEGORIES</h1>
					<p>
					Health tips from our experts just right at your fingertips. Homeo 8 Home aims to provide your family with the best                     possible care. No one knows your health like you do, but sometimes you need some quick tips,
					new ideas and a little support to grow and live a healthy life.
					</p>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-12 col-xs-12 categories">
					<div class="" >
						<ul class="list-inline text-center">
							<li>
								<a href="#" class="unit">
									<div class="unit_text">Allergy Disease Treatment</div>
								</a>
							</li>
							<li>
								<a href="#" class="unit">
									<div class="unit_text">Allergy Disease Treatment</div>
								</a>
							</li>
							<li>
								<a href="#" class="unit">
									<div class="unit_text">Allergy Disease Treatment</div>
								</a>
							</li>
							<li>
								<a href="#" class="unit">
									<div class="unit_text">Allergy Disease Treatment</div>
								</a>
							</li>
							<li>
								<a href="#" class="unit">
									<div class="unit_text">Allergy Disease Treatment</div>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="text-center">
					<ul class="list-inline">
						<li class="read_more"><a href="#">View all blog</a></li>
					</ul>
				</div>
            </div>
        </div>
		<svg class="bot_triangle" xmlns="#" version="1.1" width="100%" height="100" viewBox="0 0 100 102" preserveAspectRatio="none">
			<path class="fade_white" d="M0 0 L50 100 L100 0 Z" />
		</svg>
    </div>
	<div class="row bg_purple">
        <div class="container">
            <div class="sections">
				<div class='col-md-12'>
					<div class="carousel slide" data-ride="carousel" id="quote-carousel">
						<!-- Bottom Carousel Indicators -->
						<ol class="carousel-indicators">
						  <li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
						  <li data-target="#quote-carousel" data-slide-to="1"></li>
						  <li data-target="#quote-carousel" data-slide-to="2"></li>
						   <li data-target="#quote-carousel" data-slide-to="3"></li>
						</ol>

						<!-- Carousel Slides / Quotes -->
						<div class="carousel-inner">

						  <!-- Quote 1 -->
						  <div class="item active">
							<blockquote>
							  <div class="row">
								<div class="col-sm-12 col-xs-12 text-center">
								  <img class="" src="images/aboutdoctor.png">
								  <!--<img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/128.jpg" style="width: 100px;height:100px;">-->
								</div>
								<div class="col-sm-8 col-md-offset-2 col-xs-12 text-center">
									<small>BHMS</small>
									<h2>Dr. Shantanu Nigam</h2>
								  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean finibus interdum urna. Phasellus ac lorem ut tellus ornare condimentum. Nulla facilisi. Nulla at facilisis nibh, in ultricies arcu. Fusce elementum mollis eros, vel ultricies enim consequat in.</p>
								</div>
							  </div>
							</blockquote>
						  </div>
						  <!-- Quote 2 -->
						  <div class="item">
							<blockquote>
							  <div class="row">
								<div class="col-sm-12 text-center">
								   <img class="" src="images/aboutdoctor.png">
								</div>
								<div class="col-sm-8 col-md-offset-2 col-xs-12 text-center">
									<small>BHMS</small>
									<h2>Dr. Shantanu Nigam</h2>
								  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean finibus interdum urna. Phasellus ac lorem ut tellus ornare condimentum. Nulla facilisi. Nulla at facilisis nibh, in ultricies arcu. Fusce elementum mollis eros, vel ultricies enim consequat in.</p>
								</div>
							  </div>
							</blockquote>
						  </div>
						  <!-- Quote 3 -->
						  <div class="item">
							<blockquote>
							  <div class="row">
								<div class="col-sm-12 text-center">
								   <img class="" src="images/aboutdoctor.png">
								</div>
								<div class="col-sm-8 col-md-offset-2 col-xs-12 text-center">
									<small>BHMS</small>
									<h2>Dr. Shantanu Nigam</h2>
								  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean finibus interdum urna. Phasellus ac lorem ut tellus ornare condimentum. Nulla facilisi. Nulla at facilisis nibh, in ultricies arcu. Fusce elementum mollis eros, vel ultricies enim consequat in.</p>
								</div>
							  </div>
							</blockquote>
						  </div>
							<!-- Quote 4 -->
						  <div class="item">
							<blockquote>
							  <div class="row">
								<div class="col-xs-12 text-center">
								   <img class="" src="images/aboutdoctor.png">
								</div>
								<div class="col-sm-8 col-md-offset-2 col-xs-12 text-center">
									<small>BHMS</small>
									<h2>Dr. Shantanu Nigam</h2>
								  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean finibus interdum urna. Phasellus ac lorem ut tellus ornare condimentum. Nulla facilisi. Nulla at facilisis nibh, in ultricies arcu. Fusce elementum mollis eros, vel ultricies enim consequat in.</p>
								</div>
							  </div>
							</blockquote>
						  </div>
						</div>
						<!-- Carousel Buttons Next/Prev -->
						<a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
						<a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
					</div>
				</div>
			</div>
		</div>
		<svg class="bot_triangle" xmlns="#" version="1.1" width="100%" height="100" viewBox="0 0 100 102" preserveAspectRatio="none">
			<path class="purple" d="M0 0 L50 100 L100 0 Z" />
		</svg>
	</div>
	<div class="row bg_image">
        <div class="container">
			<div class="sections">
				<div class="row">
					<div class="col-md-7 col-xs-12">
						<span class="text">Join us in our journey </span>
						<h1>Are you a Doctor ? </h1>

						<p>Be a part of the next big thing in healthcare. </p>
						<br>
						<p>Join us in our journey of revolutionizing healthcare delivery by harnessing technology to help millions lead healthier lives. </p>
					</div>
					<div class="clear"></div>
				</div>
				<div class="">
					<ul class="list-inline">
						<li class="read_more"><a href="#">know MORE</a></li>
						<li class="book_appointment"><a href="#">join us now</a></li>
					</ul>
				</div>

			</div>
		</div>
	</div>
	<div class="row bg_lightpurple">
        <div class="container">
			<div class="sections">
				<div class="row">
					<div class="col-md-7 col-xs-12">
						<span class="text">Satisfied? </span>
						<h1>AWESOME.<br>
						BOOK An Apoointment NOW.</h1>

						<p>You can simply book your appointment with our expert Doctors through online to save your precious time.</p>
						<br>
						<p>Homeo 8 Home organizes camps for people in need. We aim to provide the best healthcare facilities and advantages of Homeopathy treatment for free.fringilla. Mauris </p>
					</div>
					<div class="col-md-4 col-md-offset-1 col-xs-12">
						<h3>Schedule your Appointment</h3>
						<img src="images/calender.png" alt="img" class="img-responsive"/>
					</div>
					<div class="clear"></div>
				</div>
				<div class="">
					<ul class="list-inline">
						<li class="read_more"><a href="#">book appointment</a></li>
					</ul>
				</div>

			</div>
		</div>
		<svg class="bot_triangle" xmlns="#" version="1.1" width="100%" height="100" viewBox="0 0 100 102" preserveAspectRatio="none">
			<path class="fade_white" d="M0 0 L50 100 L100 0 Z" />
		</svg>
	</div>
	<div class="row bg">
        <div class="container">
			<div class="sections">
				<span class="text">Something about me</span>
				<div class="row">
					<div class="col-md-7 col-xs-12">
						<h1>WELL ORGANIZED.<br>
							TRUSTED BY THOUSANDS.</h1>

						<p>Homeo 8 Home aims to provide high level of healthcare facilities with the right Classical Homeopathic treatment in the comfort of your home. With the help of continuously evolving treatment strategies, we ensure to give you the best quality care in just a single click.</p>
						<br>
						<p>We strive to maximise the values offered to our patients, so we put personal care and convenience first. From consultation to treatment, we make sure that the patients receive services based on pure Classical Homeopathic approach. In a culture to promote the highest standards of ethics and compliance, we make sure that the treatment you receive is not life-threatening and symptomatic at all.
						</p>
						<br>
					</div>
					<div class="col-md-4 col-xs-12">
						<iframe width="454" height="312" src="https://www.youtube.com/embed/ykMmO9aaYPw" frameborder="0" allowfullscreen></iframe>
					</div>

					<div class="clear"></div>
				</div>
				<div class="">
					<ul class="list-inline">
						<li class="read_more"><a href="#">read more</a></li>
					</ul>
				</div>

			</div>
		</div>
	</div>

    <div class="row footer">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-xs-12">
					<div class="footer_heading">homeo8home</div>
					<ul class="list-unstyled">
						<li><a href="#">Welcome to Home8Home</a></li>
						<li><a href="#">Something About us</a></li>
						<li><a href="#">Our Team Members</a></li>
						<li><a href="#">Want to Join us</a></li>
						<li><a href="#">Direct From Blog</a></li>
						<li><a href="#">How to Reach Us</a></li>
					</ul>
				</div>
				<div class="col-md-3 col-xs-12">
					<div class="footer_heading">Our Services</div>
					<ul class="list-unstyled">
						<li><a href="#">Online Consultation</a></li>
						<li><a href="#">Appointment Booking</a></li>
						<li><a href="#">Ask Your Questions</a></li>
						<li><a href="#">Visit at Home</a></li>
						<li><a href="#">Monthly Campaign</a></li>
						<li><a href="#">Case Studies</a></li>
						<li><a href="#">Expert Team Opinion</a></li>
					</ul>
				</div>
				<div class="col-md-3 col-xs-12">
					<div class="footer_heading">Our Policies</div>
					<ul class="list-unstyled">
						<li><a href="#">Privacy Policy</a></li>
						<li><a href="#">Shipping Policy</a></li>
						<li><a href="#">Terms & Conditions</a></li>
						<li><a href="#">Refund and Return Policy</a></li>
						<li><a href="#">Cancellation Policy</a></li>
						<li><a href="#">Disclaimer Policy</a></li>
					</ul>
				</div>
				<div class="col-md-3 col-xs-12">
					<div class="footer_heading">How to Reach</div>
					<ul class="list-unstyled">
						<li><a href="#">B - 129 2nd floor, Nirman Colony, Nirman Vihar, New Delhi, India.</a></li>
						<li><a href="#">&nbsp;</a></li>
						<li><a href="#"><i class="fa fa-phone fa-fw" id="font_icons"></i> : +91 0000000000</a></li>
						<li><a href="#"><i class="fa fa-envelope fa-fw" id="font_icons"></i> : info@homeo8home.com</a></li>
						<li><a href="#"><i class="fa fa-globe fa-fw" id="font_icons"></i> : homeo8home.com</a></li>
					</ul>
				</div>
			<div class="clear"></div>
			</div>
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="footer_heading">Subscribe our NEWSLETTER</div>
					<ul class="list-unstyled">
						<li>Subscripe our newsletter to get offers, Discounr and Campaign Detail</li>
						<br>
						<li>
						<div class="col-md-10 input-group">
							<input type="text" class="form-control" placeholder="">
							<span class="input-group-btn">
								<button class="btn subscribe" type="button">Subscribe</button>
							</span>
						</div>
						</li>
					</ul>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="footer_heading">Follow us Online</div>
					<ul class="list-unstyled">
						<li>Keep in touch with us socially and follow us</li>
						<br>
						<li>
							<ul class="list-inline social_icons">
								<li><a href="#"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter fa-fw" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus fa-fw" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin fa-fw" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-youtube-play fa-fw" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram fa-fw" aria-hidden="true"></i></a></li>
							</ul>
						</li>
					</ul>
				</div>
			<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="copyright">
			<div class="container">
				<p>Copyright 2016 www.home8home.com  &nbsp;
				<span class="line"></span>&nbsp;
				All Rights Reserved &nbsp;
				<span class="line"></span> &nbsp;
				Powered By Anicreative</p>
			</div>
		</div>
	</div>
    </div> <!--container-fluid end-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function() {
		  //Set the carousel options
		  $('#quote-carousel').carousel({
			pause: true,
			interval: 4000,
		  });

		   $("ul#banner_li li").on('click',function(){
                        $("div#main_bg_banner").removeClass();
                        $("div#main_bg_banner").addClass($(this).attr('data-banner'));
                    });
		});
	</script>
  </body>
</html>
