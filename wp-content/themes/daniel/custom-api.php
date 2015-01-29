<?php

	class JSON_API_Custom_Controller {

		public function get_author_info() {
			$array = array();

			preg_match("/src='(.*?)'/i", get_avatar(2), $matches);
			$avatar = $matches[1];

			$user_info = get_userdata(2); 
			$array['info'] = $user_info->user_description;
			$array['photo'] = $avatar;

			return $array;
		}

		public function get_numbers() {
			$array = array();

			$array['promos'] = wp_count_posts("promo");
			$array['books'] = wp_count_posts("book");
			$array['tvs'] = wp_count_posts("tv");
			$array['apps'] = wp_count_posts("app");
			$array['articles'] = wp_count_posts("article");
			$array['reviews'] = wp_count_posts("review");

			return $array;
		}

		public function get_intros() {
			$array = array();

			$array['booksintro'] = get_option("books_intro");
			$array['tvintro'] = get_option("tv_intro");
			$array['appsintro'] = get_option("apps_intro");
			$array['articlesintro'] = get_option("articles_intro");

			return $array;
		}

		public function get_books() {
			$array = array();

			$args = array('post_type'=>'book', 'posts_per_page'=>-1,'oderby'=>'title', 'order'=>'ASC');
			$loop = new WP_Query($args);

			$counter = 0;

			while($loop->have_posts()) : $loop->the_post();

				$array['books'][$counter]['id'] = get_the_id();
				$array['books'][$counter]['title'] = get_the_title();
				$array['books'][$counter]['content'] = get_the_content();
				$array['books'][$counter]['summary'] = get_the_excerpt();
				$array['books'][$counter]['relatedcontent'] = get_post_meta(get_the_id(), 'relatedcontent', true);
				$array['books'][$counter]['buylink'] = get_post_meta(get_the_id(), 'link', true);
				$array['books'][$counter]['publisher'] = get_post_meta(get_the_id(), 'publisher', true);
				$array['books'][$counter]['publisheddate'] = get_post_meta(get_the_id(), 'publisheddate', true);
				$array['books'][$counter]['buylinktitle'] = get_post_meta(get_the_id(), 'linktitle', true);
				$array['books'][$counter]['comingsoon'] = get_post_meta(get_the_id(), 'comingsoon', true);
				$array['books'][$counter]['hasvideo'] = get_post_meta(get_the_id(), 'hasvideo', true);
				$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
				$image_url = $image_url[0];
				$array['books'][$counter]['featuredimage'] = $image_url;

				$custom = get_post_custom(get_the_id());

				foreach($custom as $k => $v) {
					$array['book'][$counter][$k] = array_shift($v);
				}

				$counter++;

			endwhile;

			return $array;
		}

		public function get_book() {
			global $json_api;

			$id = $json_api->query->id;

			$array = array();

			$array['book']['title'] = get_the_title($id);
			$array['book']['content'] = get_post_field('post_content', $id);

			$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full');
			$image_url = $image_url[0];
			if(is_null($image_url)) $image_url = "";

			$array['book']['featuredimage'] = $image_url;

			$custom = get_post_custom($id);

			foreach($custom as $k => $v) {
				$array['book'][$k] = array_shift($v);
			}

			return $array;
		}

		public function get_tvs() {
			$array = array();

			$args = array('post_type'=>'tv', 'posts_per_page'=>-1,'oderby'=>'title', 'order'=>'ASC');
			$loop = new WP_Query($args);

			$counter = 0;

			while($loop->have_posts()) : $loop->the_post();

				$array['tvs'][$counter]['id'] = get_the_id();
				$array['tvs'][$counter]['title'] = get_the_title();
				$array['tvs'][$counter]['content'] = get_the_content();
				$array['tvs'][$counter]['relatedcontent'] = get_post_meta(get_the_id(), 'relatedcontent', true);
				$array['tvs'][$counter]['watchlink'] = get_post_meta(get_the_id(), 'watchlink', true);
				$array['tvs'][$counter]['watchlinktitle'] = get_post_meta(get_the_id(), 'watchlinktitle', true);
				$array['tvs'][$counter]['description'] = get_post_meta(get_the_id(), 'description', true);

				$counter++;

			endwhile;

			return $array;
		}

		public function get_tv() {
			global $json_api;
			
			$id = $json_api->query->id;

			$array = array();
			
			$array['tv']['title'] = get_the_title($id);
			$array['tv']['content'] = get_post_field('post_content', $id);

			$custom = get_post_custom($id);

			foreach($custom as $k => $v) {
				$array['tv'][$k] = array_shift($v);
			}

			return $array;
		}

		public function get_articles() {
			global $json_api;
			$publisher = $json_api->query->publisher;

			$array = array();

			if(empty($publisher)) {
				$args = array('post_type'=>'article', 'posts_per_page'=>-1,'oderby'=>'title', 'order'=>'ASC');
			} else {
				$args = array('meta_value'=> $publisher, 'post_type'=>'article', 'posts_per_page'=>-1,'oderby'=>'title', 'order'=>'ASC');
			}
			$loop = new WP_Query($args);

			$counter = 0;

			while($loop->have_posts()) : $loop->the_post();
				$array['articles'][$counter]['id'] = get_the_id();
				$array['articles'][$counter]['title'] = get_the_title();
				$array['articles'][$counter]['content'] = get_the_content();
				$array['articles'][$counter]['date'] = mysql2date('M, Y', get_the_date());
				$array['articles'][$counter]['link'] = get_post_meta(get_the_id(), 'articlelink', true);
				$array['articles'][$counter]['publisher'] = get_post_meta(get_the_id(), 'publisher', true);

				$counter++;
			endwhile;
			
			return $array;
		}

		public function get_article() {
			global $json_api;
			$name = $json_api->query->name;

			$article = get_page_by_title($name, OBJECT, 'article');
			$id = $article->ID;

			$array = array();
			
			$array['article']['title'] = get_the_title($id);
			$array['article']['content'] = get_post_field('post_content', $id);
			$array['article']['date'] = mysql2date('M, Y', get_the_date($id));

			$custom = get_post_custom($id);

			foreach($custom as $k => $v) {
				$array['article'][$k] = array_shift($v);
			}

			return $array;
		}

		public function get_apps() {
			$array = array();
			
			$args = array('post_type'=>'app', 'posts_per_page'=>-1,'oderby'=>'title', 'order'=>'ASC');
			$loop = new WP_Query($args);

			$counter = 0;

			while($loop->have_posts()) : $loop->the_post();
				$array['apps'][$counter]['id'] = get_the_id();
				$array['apps'][$counter]['title'] = get_the_title();
				$array['apps'][$counter]['content'] = get_the_content();
				$array['apps'][$counter]['ioslink'] = get_post_meta(get_the_id(), 'ios', true);
				$array['apps'][$counter]['androidlink'] = get_post_meta(get_the_id(), 'android', true);
				//need to add more images
				$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
				$image_url = $image_url[0];
				$array['apps'][$counter]['featuredimage'] = $image_url;

				$counter++;
			endwhile;

			return $array;
		}

		public function get_app() {
			global $json_api;
			$id = $json_api->query->id;

			$array = array();
			
			$array['app']['title'] = get_the_title($id);
			$array['app']['content'] = get_post_field('post_content', $id);

			//get images
			$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full');
			$image_url = $image_url[0];

			$array['app']['featuredimage'] = $image_url;

			$custom = get_post_custom($id);

			foreach($custom as $k => $v) {
				$array['app'][$k] = array_shift($v);
			}

			return $array;
		}

		public function get_reviews() {

			global $json_api;
			$app = $json_api->query->app;

			$array = array();

			if(empty($app)) {
				$args = array('post_type'=>'review', 'posts_per_page'=>-1,'oderby'=>'title', 'order'=>'ASC');
			} else {
				$args = array('meta_value'=> $app, 'post_type'=>'review', 'posts_per_page'=>-1,'oderby'=>'title', 'order'=>'ASC');
			}
			
			$args = array('post_type'=>'review', 'posts_per_page'=>-1,'oderby'=>'title', 'order'=>'ASC');
			$loop = new WP_Query($args);

			$counter = 0;

			while($loop->have_posts()) : $loop->the_post();
				$array['reviews'][$counter]['id'] = get_the_id();
				$array['reviews'][$counter]['title'] = get_the_title();
				$array['reviews'][$counter]['content'] = get_the_content();
				$array['reviews'][$counter]['rating'] = get_post_meta(get_the_id(), 'reviewerrating', true);
				$array['reviews'][$counter]['reviewer'] = get_post_meta(get_the_id(), 'reviewername', true);
				$array['reviews'][$counter]['country'] = get_post_meta(get_the_id(), 'reviewercountry', true);
				$array['reviews'][$counter]['app'] = get_post_meta(get_the_id(), 'reviewedapp', true);

				$counter++;
			endwhile;
			
			return $array;
		}

		public function get_review() {
			global $json_api;
			
			$name = $json_api->query->name;

			$review = get_page_by_title($name, OBJECT, 'review');
			$id = $review->ID;

			$app = $json_api->query->app;
			$array = array();

			$array['review']['title'] = get_the_title($id);
			$array['review']['content'] = get_post_field('post_content', $id);

			$custom = get_post_custom($id);

			foreach($custom as $k => $v) {
				$array['review'][$k] = array_shift($v);
			}
			
			return $array;
		}

		public function get_promos() {
			$array = array();

			$args = array('post_type'=>'promotion', 'posts_per_page'=>-1,'oderby'=>'title', 'order'=>'ASC');
			$loop = new WP_Query($args);

			$counter = 0;

			while($loop->have_posts()) : $loop->the_post();
				$array['promos'][$counter]['id'] = get_the_id();
				$array['promos'][$counter]['title'] = get_the_title();
				$array['promos'][$counter]['content'] = get_the_content();
				$array['promos'][$counter]['link'] = get_post_meta(get_the_id(), 'promo-link', true);

				$counter++;

			endwhile;
			
			return $array;
		}

		public function get_promo() {
			global $json_api;
			
			$name = $json_api->query->name;

			$promo = get_page_by_title($name, OBJECT, 'promo');
			$id = $promo->ID;

			$array = array();
			
			$array['promo']['title'] = get_the_title($id);
			$array['promo']['content'] = get_post_field('post_content', $id);

			$custom = get_post_custom($id);

			foreach($custom as $k => $v) {
				$array['promo'][$k] = array_shift($v);
			}

			return $array;
		}

	}

	//Articles: add link and publisher custom fields
	//Promo: need to add link custom field
	//Apps: need multiple featured images
	//RELATED CONTENT?

?>