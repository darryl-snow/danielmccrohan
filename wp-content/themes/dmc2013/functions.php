<?php

remove_action('wp_head', 'wp_generator');

add_theme_support( 'post-thumbnails' );

add_action('init', 'posttypes_register');

function posttypes_register() {
    $args = array(
       	'label' => __('Books'),
       	'singular_label' => __('Book'),
       	'public' => true,
       	'show_ui' => true,
       	'capability_type' => 'post',
       	'hierarchical' => false,
       	'rewrite' => array('slug' => 'book'),
       	'supports' => array('title', 'editor', 'thumbnail')
    );

    register_post_type( 'book' , $args );
    
    $args = array(
       	'label' => __('TV Programmes'),
       	'singular_label' => __('TV Programme'),
       	'public' => true,
       	'show_ui' => true,
       	'capability_type' => 'post',
       	'hierarchical' => false,
       	'rewrite' => array('slug' => 'tv'),
       	'supports' => array('title', 'editor', 'thumbnail')
    );
    
    register_post_type( 'tv' , $args );
    
    $args = array(
       	'label' => __('Apps'),
       	'singular_label' => __('App'),
       	'public' => true,
       	'show_ui' => true,
       	'capability_type' => 'post',
       	'hierarchical' => false,
       	'rewrite' => array('slug' => 'app'),
       	'supports' => array('title', 'editor', 'thumbnail')
    );
    
    register_post_type( 'app' , $args );

    $args = array(
       	'label' => __('Reviews'),
       	'singular_label' => __('Review'),
       	'public' => true,
       	'show_ui' => true,
       	'capability_type' => 'post',
       	'hierarchical' => false,
       	'rewrite' => array('slug' => 'review'),
       	'supports' => array('title', 'editor')
    );
    
    register_post_type( 'review' , $args );

    $args = array(
       	'label' => __('Articles'),
       	'singular_label' => __('Article'),
       	'public' => true,
       	'show_ui' => true,
       	'capability_type' => 'post',
       	'hierarchical' => false,
       	'rewrite' => array('slug' => 'article'),
       	'supports' => array('title', 'editor', 'thumbnail')
    );

    register_post_type( 'article' , $args );

    $args = array(
       	'label' => __('Promotions'),
       	'singular_label' => __('Promotion'),
       	'public' => true,
       	'show_ui' => true,
       	'capability_type' => 'post',
       	'hierarchical' => false,
       	'rewrite' => array('slug' => 'promotion'),
       	'supports' => array('title', 'editor', 'thumbnail')
    );

    register_post_type( 'promotion' , $args );
}

function setup_theme_admin_menu() {  
	add_submenu_page('options-general.php',   
        'DMC Home Page Settings', 'DMC Settings', 'manage_options',   
        'dmc-settings', 'dmc_settings');
}
function dmc_settings() {

	if (isset($_POST["update_settings"])) {
    
		$booksintro = esc_attr($_POST["booksintro"]);
		update_option("books_intro", $booksintro);

		$tvintro = esc_attr($_POST["tvintro"]);
		update_option("tv_intro", $tvintro);

		$appsintro = esc_attr($_POST["appsintro"]);
		update_option("apps_intro", $appsintro);

		$articlesintro = esc_attr($_POST["articlesintro"]);
		update_option("articles_intro", $articlesintro);

?>
	<div id="message" class="updated">Saved</div> 
<?php

	} else {
		$booksintro = get_option("books_intro");
		$tvintro = get_option("tv_intro");
		$appsintro = get_option("apps_intro");
		$articlesintro = get_option("articles_intro");
	}
?>
	<form action="" method="POST">
		<h1>Books Section Intro:</h1>
<?php
	wp_editor($booksintro, "booksintro");
?>
		<h1 for="tvintro">TV Section Intro:</h1>   
<?php
	wp_editor($tvintro, "tvintro");
?>
		<h1 for="appsintro">Apps Section Intro:</h1>   
<?php
	wp_editor($appsintro, "appsintro");
?>
		<h1 for="articlesintro">Articles Section Intro:</h1>   
<?php
	wp_editor($articlesintro, "articlesintro");
?>
		<input type="hidden" name="update_settings" value="Y">
		<p>  
			<input type="submit" value="Save" class="button-primary">  
		</p> 
	</form>
<?php
}

add_action("admin_menu", "setup_theme_admin_menu");  


add_action("admin_init", "admin_init");
add_action('save_post', 'save_info');
add_action('add_link', 'save_article');

function admin_init(){
	add_meta_box("bookInfo-meta", "Buy Link", "buylink_meta", "book", "side", "high");
	add_meta_box("bookInto-meta2", "Related Content", "related_content_meta", "book", "normal", "high");
	add_meta_box("bookInfo-meta3", "Coming Soon?", "comingsoon_meta", "book", "side", "high");
	add_meta_box("bookInfo-meta4", "Has video?", "hasvideo_meta", "book", "side", "high");
	add_meta_box("bookInfo-meta5", "Publisher", "publisher_meta", "book", "side", "high");

	add_meta_box("appInfo-meta", "Buy Link (App Store)", "buylink_ios_meta", "app", "side", "high");
	add_meta_box("appInfo-meta2", "Buy Link (Android)", "buylink_android_meta", "app", "side", "high");
	add_meta_box("appInto-meta3", "Related Content", "related_content_meta", "app", "normal", "high");

	add_meta_box("tvInfo-meta", "Watch More Link", "watchlink_meta", "tv", "side", "high");
	add_meta_box("tvInto-meta2", "Description", "description_meta", "tv", "normal", "high");
	add_meta_box("tvInto-meta3", "Related Content", "related_content_meta", "tv", "normal", "high");
	
	add_meta_box("reviewer-meta", "Reviewer", "reviewer_meta", "review", "side", "high");
	add_meta_box("app-review", "App", "app_review_meta", "review", "side", "high");

	add_meta_box("article-meta", "Details", "article_details_meta", "article", "side", "high");
	add_meta_box("article-meta2", "Published Date", "article_date_meta", "article", "side", "high");

	add_meta_box("promo-meta", "Link", "promo_link_meta", "promotion", "side", "high");
}

function publisher_meta() {
	global $post;
	$custom = get_post_custom($post->ID);
	$publisher = $custom["publisher"][0];
	$publisheddate = $custom["publisheddate"][0];
?>
	<label for="publisher">Publisher</label>
	<input name="publisher" type="text" value="<?php echo $publisher; ?>">
	<label for="publisheddate">Published Date</label>
	<input name="publisheddate" type="text" value="<?php echo $publisheddate; ?>">
<?php
}

function article_date_meta() {
	global $post;
	$custom = get_post_custom($post->ID);
	$publisheddate = $custom["publisheddate"][0];
?>
	<label for="publisheddate">Published Date</label>
	<input name="publisheddate" type="text" value="<?php echo $publisheddate; ?>">
<?php
}

function hasvideo_meta() {
	global $post;
	$custom = get_post_custom($post->ID);
	$has_video = $custom["hasvideo"][0];
?>
	<label for="hasvideo">Has Video?</label>
	<fieldset>
		<label>no (default)</label>
		<input name="hasvideo" type="radio" value="0" <?php if($has_video==0) echo " checked" ?>>
		<label>yes</label>
		<input name="hasvideo" type="radio" value="1" <?php if($has_video==1) echo " checked" ?>>
	</fieldset>
<?php
}

function article_details_meta(){
	global $post;
	$custom = get_post_custom($post->ID);
	$article_link = $custom["articlelink"][0];
	$article_publisher = $custom["publisher"][0];
?>
	<label for="articlelink">URL:</label>
	<input name="articlelink" id="articlelink" value="<?php echo $article_link; ?>" type="text"/>
	<label for="Publisher">Publisher:</label>
	<select name="publisher" id="publisher">
		<option value="<?php echo $article_publisher; ?>" selected="selected"><?php echo $article_publisher; ?></option>
		<option value="BBC">BBC</option>
		<option value="Lonely Planet">Lonely Planet</option>
		<option value="ivillage.co.uk">ivillage.co.uk</option>
	</select>
<?php
}

function related_content_meta() {
	global $post;
	$custom = get_post_custom($post->ID);
	$related_content = $custom["relatedcontent"][0];
	wp_editor($related_content, "relatedcontent");
}

function description_meta() {
	global $post;
	$custom = get_post_custom($post->ID);
	$description = $custom["description"][0];
	wp_editor($description, "description");
}

function promo_link_meta() {
	global $post;
	$custom = get_post_custom($post->ID);
	$promo_link = $custom["promo-link"][0];
?>
	<label for="promolink">Link:</label>
	<input name="promolink" id="promolink" value="<?php echo $promo_link; ?>" type="text"/>
<?php
}

function reviewer_meta(){
	global $post;
	$custom = get_post_custom($post->ID);
	$reviewerrating = $custom["reviewerrating"][0];
	$reviewername = $custom["reviewername"][0];
	$reviewercountry = $custom["reviewercountry"][0];
?>
	<script type="text/javascript">
		function showRangeValue(therating) {
			document.getElementById("range").innerHTML = therating;
		}
	</script>
	<label for="reviewerrating">Rating:</label>
	<input id="reviewerrating" name="reviewerrating" type="range" min="1" max="5" value="<?php if($reviewerrating) echo $reviewerrating; else echo '5'; ?>" step="1" onchange="showRangeValue(this.value);" />
	<span id="range"><?php if($reviewerrating) echo $reviewerrating; else echo "5"; ?></span>
	<br><br><label for="reviewername">Name:</label>
	<input id="reviewername" name="reviewername" value="<?php echo $reviewername; ?>" />
	<br><br><label for="reviewercountry">Country:</label>
	<select id="reviewercountry" name="reviewercountry">
		<option value="<?php echo $reviewercountry?>" selected="selected"><?php echo $reviewercountry?></option>
		<option value="" disabled="disabled">-------</option>
		<option value="Australia">Australia</option>
		<option value="Canada">Canada</option>
		<option value="Chile">Chile</option>
		<option value="China">China</option>
		<option value="Germany">Germany</option>
		<option value="Hong Kong">Hong Kong</option>
		<option value="Ireland">Ireland</option>
		<option value="The Netherlands">The Netherlands</option>
		<option value="New Zealand">New Zealand</option>
		<option value="Russia">Russia</option>
		<option value="Singapore">Singapore</option>
		<option value="South Africa">South Africa</option>
		<option value="UK">UK</option>
		<option value="USA">USA</option>
	</select>
<?php
}

function app_review_meta(){
	global $post;
	$custom = get_post_custom($post->ID);
	$app = $custom["reviewedapp"][0];

	$args = array('post_type'=>'app');
	$theapps = get_posts( $args );
?>
	<label for="reviewedapp">App:</label>
	<select id="reviewedapp" name="reviewedapp">
		<option value="<?php echo $app?>" selected="selected"><?php echo $app?></option>
		<option value="" disabled="disabled">-------</option>
<?php foreach( $theapps as $app ) :	setup_postdata($app); ?>
		<option value="<?php the_title(); ?>"><?php the_title(); ?></option>
<?php endforeach; ?>
	</select>
<?php
}

function watchlink_meta(){
	global $post;
	$custom = get_post_custom($post->ID);
	$link = $custom["watchlink"][0];
	$linktitle = $custom["watchlinktitle"][0];
?>
	<label>Watch More Link:</label><input name="watchlink" value="<?php echo $link; ?>" />
	<br><label>Link Title:</label><input name="watchlinktitle" value="<?php echo $linktitle; ?>" />
<?php
}

function buylink_meta(){
	global $post;
	$custom = get_post_custom($post->ID);
	$link = $custom["link"][0];
	$linktitle = $custom["linktitle"][0];
?>
	<label>Buy Link:</label><input name="link" value="<?php echo $link; ?>" />
	<br><label>Link Title:</label><input name="linktitle" value="<?php echo $linktitle; ?>" />
<?php
}

function buylink_ios_meta(){
	global $post;
	$custom = get_post_custom($post->ID);
	$link = $custom["ios"][0];
?>
	<label>Buy Link (iOS):</label><input name="ios" value="<?php echo $link; ?>" />
<?php
}

function buylink_android_meta(){
	global $post;
	$custom = get_post_custom($post->ID);
	$link = $custom["android"][0];
?>
	<label>Buy Link (Android):</label><input name="android" value="<?php echo $link; ?>" />
<?php
}

function comingsoon_meta(){
	global $post;
	$custom = get_post_custom($post->ID);
	$comingsoon = $custom["comingsoon"][0];
?>
	<fieldset>
		<label>no (default)</label>
		<input name="comingsoon" type="radio" value="0" <?php if($comingsoon==0) echo " checked" ?>>
		<label>yes</label>
		<input name="comingsoon" type="radio" value="1" <?php if($comingsoon==1) echo " checked" ?>>
	</fieldset>
<?php
}

add_filter( 'manage_edit-review_columns', 'edit_review_columns' );

function edit_review_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Movie' ),
		'app' => __( 'App' ),
		'rating' => __( 'Rating' ),
		'date' => __( 'Date' )
	);

	return $columns;
}

add_action( 'manage_review_posts_custom_column', 'manage_review_columns', 10, 2 );

function manage_review_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		/* If displaying the 'app' column. */
		case 'app' :

			/* Get the post meta. */
			$app = get_post_meta( $post_id, 'reviewedapp', true );

			/* If no app is found, output a default message. */
			if ( empty( $app ) )
				echo __( 'Unknown' );

			/* If there is an app, append 'minutes' to the text string. */
			else
				echo $app;

			break;

		/* If displaying the 'rating' column. */
		case 'rating' :

			/* Get the post meta. */
			$rating = get_post_meta( $post_id, 'reviewerrating', true );

			/* If no rating is found, output a default message. */
			if ( empty( $rating ) )
				echo __( 'Unknown' );

			/* If there is a rating, append 'minutes' to the text string. */
			else
				echo $rating;

			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}

function save_info(){
	global $post;
	update_post_meta($post->ID, "link", $_POST["link"]);
	update_post_meta($post->ID, "linktitle", $_POST["linktitle"]);
	update_post_meta($post->ID, "relatedcontent", $_POST["relatedcontent"]);
	update_post_meta($post->ID, "hasvideo", $_POST["hasvideo"]);
	update_post_meta($post->ID, "ios", $_POST["ios"]);
	update_post_meta($post->ID, "android", $_POST["android"]);
	update_post_meta($post->ID, "watchlink", $_POST["watchlink"]);
	update_post_meta($post->ID, "watchlinktitle", $_POST["watchlinktitle"]);
	update_post_meta($post->ID, "description", $_POST["description"]);
	update_post_meta($post->ID, "comingsoon", $_POST["comingsoon"]);
	update_post_meta($post->ID, "reviewerrating", $_POST["reviewerrating"]);
	update_post_meta($post->ID, "reviewername", $_POST["reviewername"]);
	update_post_meta($post->ID, "reviewercountry", $_POST["reviewercountry"]);
	update_post_meta($post->ID, "reviewedapp", $_POST["reviewedapp"]);
	update_post_meta($post->ID, "promo-link", $_POST["promolink"]);
	update_post_meta($post->ID, "articlelink", $_POST["articlelink"]);
	update_post_meta($post->ID, "publisher", $_POST["publisher"]);
	update_post_meta($post->ID, "publisheddate", $_POST["publisheddate"]);
	update_post_meta($post->ID, "slug", $post->post_name);
}

function save_article() {
	global $post;
	$blogtime = current_time('mysql'); 
	update_post_meta($link->ID, "updated", $blogtime);
}

function remove_dashboard_widgets(){
  global$wp_meta_boxes;
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); 
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

// THIS INCLUDES THE THUMBNAIL IN OUR RSS FEED
function insertThumbnailRSS($content) {
global $post;
if ( has_post_thumbnail( $post->ID ) ){
$content = '' . get_the_post_thumbnail( $post->ID, array(590, 198) ) . '' . $content;
}
return $content;
}

add_filter('the_excerpt_rss', 'insertThumbnailRSS');
add_filter('the_content_feed', 'insertThumbnailRSS');

function myfeed_request($qv) {
	if (isset($qv['feed']))
		$qv['post_type'] = get_post_types();
	return $qv;
}
add_filter('request', 'myfeed_request');

function add_custom_controller($controllers) {
	$controllers[] = "custom";
	return $controllers;
}
add_filter("json_api_controllers", "add_custom_controller");

function add_custom_controller_path() {
	return get_stylesheet_directory()."/custom-api.php";
}
add_filter("json_api_custom_controller_path","add_custom_controller_path");
?>