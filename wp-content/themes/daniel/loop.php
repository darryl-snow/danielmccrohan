

		<title>Daniel McCrohan : Travel writer based in Beijing, China</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="description" content="Daniel McCrohan is a writer and TV presenter, with over 10 years of experience. He is known for authoring various 'Lonely Planet' guide books, focusing on China and India. He speaks fluent Chinese and proficient Hindi. He lives in Beijing with his wife and two Children.">
		<meta name="keywords" content="Daniel McCrohan, Author, Writer, TV Presenter, Lonely Planet, Travel, China, India, Guidebook, Reviews">
		<meta name="author" content="Daniel McCrohan">
		<meta name="copyright" content="Daniel McCrohan 2012">
		<meta name="distribution" content="Global">
		<meta name="rating" content="General">
		<meta name="robots" content="INDEX,FOLLOW">
		<meta name="revisit-after" content="1 Month">
		<meta name="viewport" content="width=device-width,initial-scale=1">
	
		<meta content="Daniel McCrohan" itemprop="name">
		<meta content="Daniel" itemprop="nickname">
		<meta content="http://danielmccrohan.com/images/danielmccrohan.jpg" itemprop="photo">
		<meta content="Writer" itemprop="title">
		<meta content="Writer" itemprop="role">
		<meta content="http://danielmccrohan.com" itemprop="url">
		<meta content="Lonely Planet" itemprop="affiliation">
		
		<link href="img/favicon.ico" rel="shortcut icon">
		<link href="img/apple-touch-icon-114-precomposed.png" rel="apple-touch-icon-precomposed" sizes="114x114">
		<link href="img/apple-touch-icon-72-precomposed.png" rel="apple-touch-icon-precomposed" sizes="72x72">
		<link href="img/apple-touch-icon-57-precomposed.png" rel="apple-touch-icon-precomposed">

		<link href="<?php bloginfo( 'stylesheet_url' ); ?>" rel="stylesheet">
		<link href="<?php bloginfo( 'template_url' ); ?>/bootstrap.css" rel="stylesheet">
		<link href="<?php bloginfo( 'template_url' ); ?>/responsive.css" rel="stylesheet">
	
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="<?php bloginfo('template_url'); ?>/js/libs/jquery-1.7.1.min.js"><\/script>')</script>

		<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script><![endif]-->
	
	</head>
	<body data-spy="scroll" id="top">
	
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
				
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					
					</a>
					
					<div class="nav-collapse">

						<ul class="nav">
							<li class="scrollshow"><a href="#top" title="Back to top">Top of the page</a></li>
							<li class="divider-vertical scrollshow"></li>
							<li><a href="#books" title="Books">Books</a></li>
							<li><a href="#tv" title="TV">TV</a></li>
							<li><a href="#apps" title="Apps">Apps</a></li>
							<li><a href="#articles" title="Articles">Articles</a></li>
						</ul>
			
					</div>
				
				</div>
			</div>
		</div><!--NAVBAR-->
		
		<header class="hero-unit">
			
			<div class="container">
				<div class="row">
					<div class="span8">
						<h1>Daniel McCrohan</h1>
						<h2>Travel writer</h2>
					</div>
					<div class="span4">
						<ul class="unstyled">
							<li><a href="http://www.twitter.com/danielmccrohan" title="Follow me on Twitter"><i class="icon-twitter-sign"></i>Follow me on Twitter</a></li>
							<li><a href="#contact" title="Contact me"><i class="icon-envelope"></i>Contact me</a></li>
							<li><a href="#intro" title="Find out more about me"><i class="icon-user"></i>More about me</a></li>
						</ul>		
					</div>
				</div>
			</div>
			
			<div class="container">
				<div class="row" id="intro">
					<div class="span2">
						<?php $avtr = get_avatar(2); echo $avtr; ?>
					</div>
					<div class="span10">
						<p>
<?php

						$user_info = get_userdata(2);
						echo $user_info->user_description;
	
?>
						</p>
					</div>
				</div>
			</div><!--INTRO-->

<?php
					$wp_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 1));

					if (have_posts()) :
						while (have_posts()) : the_post();
?>
			<div class="container">
				<div class="alert alert-info">
					<a class="close" data-dismiss="alert" href="#">×</a>
					<h4 class="alert-heading"><?php the_title(); ?></h4>
					<?php the_content(); ?>
				</div>
			</div>
<?
						endwhile;
					endif;
?>
		</header><!--HEADER-->
		
		<section class="container" id="books">
		
			<div id="columns">

<?php

					$wp_query = new WP_Query(array('post_type' => 'book'));

					if (have_posts()) :
						while (have_posts()) : the_post();
						
							$dtA = strtotime(get_the_date("Y-m-d")); //date book added
							$dtB = strtotime(date("Y-m-d", strtotime("last month"))); //30 days ago
							
							$comingsoon = 0;
							$new = 0;
							
							//check if coming soon
							if (get_post_meta($post->ID, 'comingsoon', true) == 1) :
								$comingsoon = 1;
							//check if post is new
							elseif ($dtA>$dtB) :
								$new = 1;
							endif;
							
							if($comingsoon == 1) :
								$image_url = "http://danielmccrohan.com/wp-content/themes/daniel/images/comingsoon_book.png";
							else :
								$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
								$image_url = $image_url[0];
							endif;
?>
				
				<div class="book">
					<img alt="<?php the_title(); ?>" src="<?php echo $image_url; ?>"/>
					<h3><?php if($new == 1) : ?><span class="label label-info"><i class="icon-star"></i>New</span><?php endif; ?><?php the_title(); ?></h3>
					<?php the_content(); ?>
<?php
						if(get_post_meta($post->ID, 'link', true)) :
?>
					<a class="btn btn-primary" href="<?php echo get_post_meta($post->ID, 'link', true) ?>"><i class="icon-shopping-cart icon-large"></i><?php echo get_post_meta($post->ID, 'linktitle', true) ?></a>
<?php
						endif;
?>
				</div>
<?
						endwhile;
					else:
?>
				<p>Sorry, there are no books yet</p>
<?
					endif;
?>
			</div>
		
		</section><!--BOOKS-->
		
		<section id="tv">
<?php
					$wp_query = new WP_Query(array('post_type' => 'tv'));

					if (have_posts()) :
						while (have_posts()) : the_post();
?>
			<div class="container panel">
				<div class="row">
					<div class="span6">
						<?php the_content(); ?>
					</div>
					<div class="span6">
						<h3><?php the_title(); ?></h3>
						<?php echo get_post_meta($post->ID, 'description', true) ?>
						<br>
						<a class="btn btn-primary" href="<?php echo get_post_meta($post->ID, 'watchlink', true) ?>" title="Watch More"><i class="icon-facetime-video"></i><?php echo get_post_meta($post->ID, 'watchlinktitle', true) ?></a>
					</div>
				</div>
			</div>
			
<?
						endwhile;
					endif;
?>
			
		</section><!--TV-->
		
		<section id="apps">

<?php
					$wp_query = new WP_Query(array('post_type' => 'app', 'posts_per_page' => 3));

					if (have_posts()) :
						while (have_posts()) : the_post();
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
?>

			<div class="container panel">
				<div class="row">
					<div class="span6">
						<h3><?php the_title(); ?></h3>
						<?php the_content(); ?>
						
						<a class="btn btn-primary" href="<?php echo get_post_meta($post->ID, 'ios', true) ?>" title="Download from the App Store"><i class="icon-download-alt"></i>Download from the App Store</a>
						<a class="btn btn-primary" href="<?php echo get_post_meta($post->ID, 'android', true) ?>" title="Buy for Android"><i class="icon-download-alt"></i>Buy for Android</a>
					</div>
					<div class="span6">
						<img alt="<?php the_title(); ?>" src="<?php echo $large_image_url[0];?>">
					</div>
				</div>
			</div>
			
<?
						endwhile;
					endif;
?>
		
		</section><!--APPS-->
		
		<section id="articles">
		
			<div class="container">
				<div class="row">

					<div class="span4">
						<img alt="" height="70" src="http://danielmccrohan.com/wp-content/themes/daniel/images/lp_logo.png" width="150">
						<table class="table table-bordered table-striped">
<?php
					$categories=get_categories(array("type"=>"link", "orderby"=>"id"));
					foreach($categories as $category) {
						
						if($category->name == "lonelyplanet.com") :
						
							$bookmarks = get_bookmarks( array('orderby'=>'updated','order'=>'DESC', 'category_name'=>$category->name));
							$bookmarks = array_reverse($bookmarks);
							foreach ( $bookmarks as $bm ) {
?>
							<tr>
								<td><a href="<?php echo $bm->link_url ?>" title="<?php echo $bm->link_name ?>"><?php echo $bm->link_name ?></a></td>
							</tr>
<?php
							}
						endif;
					}
?>
						</table>
					</div>

					<div class="span4">
						<img alt="" height="70" src="http://danielmccrohan.com/wp-content/themes/daniel/images/bbc_logo.png" width="150">
						<table class="table table-bordered table-striped">
<?php
					$categories=get_categories(array("type"=>"link", "orderby"=>"id"));
					foreach($categories as $category) {
						
						if($category->name == "BBC Travel") :
						
							$bookmarks = get_bookmarks( array('orderby'=>'updated','order'=>'DESC', 'category_name'=>$category->name));
							$bookmarks = array_reverse($bookmarks);
							foreach ( $bookmarks as $bm ) {
?>
							<tr>
								<td><a href="<?php echo $bm->link_url ?>" title="<?php echo $bm->link_name ?>"><?php echo $bm->link_name ?></a></td>
							</tr>
<?php
							}
						endif;
					}
?>
						</table>
					</div>

					<div class="span4">
						<img alt="" height="70" src="http://danielmccrohan.com/wp-content/themes/daniel/images/ivillage_logo.png" width="150">
						<table class="table table-bordered table-striped">
<?php
					$categories=get_categories(array("type"=>"link", "orderby"=>"id"));
					foreach($categories as $category) {
						
						if($category->name == "iVillage") :
						
							$bookmarks = get_bookmarks( array('orderby'=>'updated','order'=>'DESC', 'category_name'=>$category->name));
							$bookmarks = array_reverse($bookmarks);
							foreach ( $bookmarks as $bm ) {
?>
							<tr>
								<td><a href="<?php echo $bm->link_url ?>" title="<?php echo $bm->link_name ?>"><?php echo $bm->link_name ?></a></td>
							</tr>
<?php
							}
						endif;
					}
?>
						</table>
					</div>

				</div>
			</div>
			
				

		</section><!--ARTICLES-->
		
		<footer>
		
			<div class="container">
				<div class="row">
					<div class="span6">
						<h3>My Latest Tweets <a class="btn btn-mini btn-info pull-right" href="http://www.twitter.com/danielmccrohan" title="Follow me on Twitter"><i class="icon-twitter-sign icon-large"></i>Follow me</a></h3>
						
						<ul class="tweets unstyled" id="tweets">
							<li>Loading tweets...</li>
						</ul>
						
					</div>
					<div class="span6" id="contact">
					
						<h3>Contact Me</h3>
					
						<form>
							<label for="name">My name is </label>
							<input class="span6" id="name" name="name" placeholder="name" type="text">
							<label for="email"> you can reach me at </label>
							<input class="span6" id="email" name="email" placeholder="em@il" type="text">
							<label for="message"> and I would just like to say </label>
							<textarea class="span6" id="message" name="message" placeholder="message"></textarea>
							<button class="btn btn-primary" id="submit" type="submit">Send message!</button>
						</form>
						
						<article id="thanks">
							<h2>Thanks!</h2>
							<p>I'll be in touch</p>
						</article>
						
						<div class="loader"><img alt="Please wait while the form submits" src="http://danielmccrohan.com/wp-content/themes/daniel/images/ajax-loader.gif"></div>
					
					</div>
				</div>
			</div>
			
			<footer>
				<div id="container">
					Website developed by <a href="http://dazsnow.com" title="Visit Darryl's website">Darryl Snow</a>
				</div>
			</footer>
		
		</footer>

		<div class="fade hide modal" id="reviews">
			<div class="modal-header">
				<button class="close" data-dismiss="modal">×</button>
				<h3>Reviews</h3>
			</div>
			<div class="modal-body">
				<ul class="unstyled">

<?php
					$wp_query = new WP_Query(array('post_type' => 'review', 'order' => 'ASC'));

					if (have_posts()) :
						while (have_posts()) : the_post();
?>
					<li>
						<h4><?php the_title(); ?>
<?php
							$rating = get_post_meta($post->ID, 'reviewerrating', true);
							for($x=0;$x<$rating;$x++) {
?>
							<i class="icon-star"></i>
<?php
							}
?>
						</h4>
						<p><?php the_content(); ?></p>
<?php
							$country = get_post_meta($post->ID, 'reviewercountry', true);
							switch ($country) {
								case "Australia":
									$country = "au";
									break;
								case "Canada":
									$country = "ca";
									break;
								case "China":
									$country = "cn";
									break;
								case "Hong Kong":
									$country = "hk";
									break;
								case "Ireland":
									$country = "ie";
									break;
								case "New Zealand":
									$country = "nz";
									break;
								case "Singapore":
									$country = "sg";
									break;
								case "South Africa":
									$country = "za";
									break;
								case "UK":
									$country = "gb";
									break;
								case "USA":
									$country = "us";
									break;
							}
?>
						<p class="reviewer"><i class="icon-comment"></i><?php echo get_post_meta($post->ID, 'reviewername', true); ?><span class="country flag-<?php echo $country ?>"></span></p>
					</li>
<?php
						endwhile;
					endif;
?>

				</ul>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
			</div>
		</div>

		<script src="<?php bloginfo('template_url'); ?>/js/default.js"></script>
		<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-15154341-1");
pageTracker._trackPageview();
} catch(err) {}</script>
