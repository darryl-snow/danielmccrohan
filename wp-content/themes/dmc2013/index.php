<!DOCTYPE html>
<html lang="en" class="page  page--home" itemscope itemtype="http://data-vocabulary.org/Person" ng-app="dmc">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, minimum-scale=1.0">

		<title>Daniel McCrohan &ndash; Travel Specialist, Lonely Planet Author</title>

		<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/style.css" type="text/css" media="all">

		<link rel="shortcut icon" href="<?php bloginfo('template_directory');?>/icon.png">
		<link rel="apple-touch-icon-precomposed" href="<?php bloginfo('template_directory');?>/icon.png">
		<meta name="apple-mobile-web-app-title" content="Daniel McCrohan - Travel Specialist, Lonely Planet Author">
		<meta name="description" content="{{info}}">

		<meta content="Lonely Planet" itemprop="organization">
		<meta content="Daniel" itemprop="nickname">
		<meta content="Lonely Planet" itemprop="affiliation">
		<meta content="http://danielmccrohan.com" itemprop="url">
		<meta content="Darryl Snow" itemprop="friend">
		<meta itemprop="address" itemscope itemtype="http://www.data-vocabulary.org/Address/">
			<meta content="Dongcheng District" itemprop="street-address">
			<meta content="Beijing" itemprop="locality">
			<meta content="China" itemprop="country-name">

	</head>
	<body>

		<header class="masthead">
			<div class="container">

				<div class="hgroup">
					<a href="" class="title-link">
						<h1 itemprop="name">Daniel McCrohan</h1>
						<p class="tagline"><span>Travel Specialist</span></p>
					</a>
				</div>

				<div class="contact-methods">
					<a href="mailto:daniel@danielmccrohan.com?subject=Message%20from%20DanielMcCrohan.com" class="contact-method email" title="Email me">
						<span class="icon icon-large icon-envelope"></span>
					</a>
					<a href="http://www.twitter.com/danielmccrohan" class="contact-method twitter" title="Follow me on Twitter">
						<span class="icon icon-large icon-twitter"></span>
					</a>
				</div>

			</div>
		</header>

		<div ng-view>
			
		</div>
		
		<footer>
			
			<div class="wrapper">

				<div class="row-fluid" ng-controller="InfoCtrl" ng-switch="loadedyet" data-ng-animate="'fade'" ng-cloak>
					<div class="span3">
						<div class="photo-container">
							<img src="{{photo}}" alt="Daniel McCrohan" ng-switch-when="loaded">
						</div>
					</div>
					<div class="span7">
						<p class="intro" ng-switch-when="notyet">Loading...</p>
						<p class="intro" ng-switch-when="loaded">{{info}}</p>
					</div>
					<div class="span2">
						<ul class="footer-contacts">
							<li><a href="mailto:daniel@danielmccrohan.com?subject=Message%20from%20DanielMcCrohan.com" title="">Email</a></li>
							<li><a href="http://www.twitter.com/danielmccrohan" title="">Twitter</a></li>
						</ul>
					</div>
				</div>

			</div>

			<p class="copyright" role="contentinfo">&copy; 2013 Daniel McCrohan  &ndash;  web design &amp; development by <a href="http://yourweb.expert" title="Visit Darryl's website">Darryl Snow</a></p>

		</footer>

		<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.1.4/angular.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.0.6/angular-resource.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.0.6/angular-sanitize.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="<?php bloginfo('template_directory');?>/js/jquery.bxslider.min.js"></script>
		<script src="<?php bloginfo('template_directory');?>/js/app.js"></script>

		<script>
		    
		    var _gaq = _gaq || [];
		    _gaq.push(['_setAccount', 'UA-15154341-1']);
		    _gaq.push(['_trackPageview']);
		    
		    (function() {
		        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		    })();
		    
		</script>

	</body>
</html>