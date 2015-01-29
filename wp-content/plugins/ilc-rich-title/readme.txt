=== ILC Rich Title ===
Contributors: ilovecolors
Donate link: http://ilovecolors.com.ar
Tags: edit post, edit page, tinymce, title, rich text, admin
Requires at least: 2.5
Tested up to: 2.7
Stable tag: trunk

Enables TinyMCE for the title when writing a post or page. 


== Description ==

This plugin will enable the TinyMCE rich text editor for the title field
when writing a page or post. Requires jQuery to work, but rather than
including it with <script>, the plugin will enqueue the jQuery library
included with WordPress using wp_enqueue_script on the admin area.

There are a couple of style to remove the margin between the title
label and the TinyMCE editor area, and the padding around the title
box and the border.

Beware, for this plugin will paragraphise all your titles, so what
once was a h3 headline in your styles now might be h3 p.

This software is provided without warranty of any kind.


== Installation ==

1. Upload `ilc_rich_title.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to a Edit page/post area in your WordPress Admin


== Frequently Asked Questions ==

= The styles of my titles in my site have dissapeared! =
That's because of the wpautop running when your content is rendered
to be displayed on the site. If you had "h3" defined in your stylesheet,
you will have to redefine it as "h3 p" and add the desired style.


== Screenshots ==

1. TinyMCE for the title in WP 2.6
2. TinyMCE for the title in WP 2.7


