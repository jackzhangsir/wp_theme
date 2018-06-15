<?php

get_header();
echo "\n\t<div class=\"content-wrap\">\n\t\t<div class=\"content\" role=\"main\">\n\n\t\t";

while (have_posts()) {
	the_post();
	echo "\n\t\t\t\t<article id=\"post-";
	the_id();
	echo "\" ";
	post_class("image-attachment");
	echo ">\n\t\t\t\t\t<header class=\"entry-header\">\n\t\t\t\t\t\t<h1 class=\"entry-title\">";
	the_title();
	echo "</h1>\n\n\t\t\t\t\t\t<footer class=\"entry-meta\">\n\t\t\t\t\t\t\t";
	$metadata = wp_get_attachment_metadata();
	printf(__("<span class=\"meta-prep meta-prep-entry-date\">Published </span> <span class=\"entry-date\"><time class=\"entry-date\" datetime=\"%1\$s\">%2\$s</time></span> at <a href=\"%3\$s\" title=\"Link to full-size image\">%4\$s &times; %5\$s</a> in <a href=\"%6\$s\" title=\"Return to %7\$s\" rel=\"gallery\">%8\$s</a>.", "twentytwelve"), esc_attr(get_the_date("c")), esc_html(get_the_date()), esc_url(wp_get_attachment_url()), $metadata["width"], $metadata["height"], esc_url(get_permalink($post->post_parent)), esc_attr(strip_tags(get_the_title($post->post_parent))), get_the_title($post->post_parent));
	echo "\t\t\t\t\t\t\t";
	edit_post_link(__("Edit", "twentytwelve"), "<span class=\"edit-link\">", "</span>");
	echo "\t\t\t\t\t\t</footer><!-- .entry-meta -->\n\n\t\t\t\t\t\t<nav id=\"image-navigation\" class=\"navigation\" role=\"navigation\">\n\t\t\t\t\t\t\t<span class=\"previous-image\">";
	previous_image_link(false, __("&larr; Previous", "twentytwelve"));
	echo "</span>\n\t\t\t\t\t\t\t<span class=\"next-image\">";
	next_image_link(false, __("Next &rarr;", "twentytwelve"));
	echo "</span>\n\t\t\t\t\t\t</nav><!-- #image-navigation -->\n\t\t\t\t\t</header><!-- .entry-header -->\n\n\t\t\t\t\t<div class=\"entry-content\">\n\n\t\t\t\t\t\t<div class=\"entry-attachment\">\n\t\t\t\t\t\t\t<div class=\"attachment\">\n";
	$attachments = array_values(get_children(array("post_parent" => $post->post_parent, "post_status" => "inherit", "post_type" => "attachment", "post_mime_type" => "image", "order" => "ASC", "orderby" => "menu_order ID")));

	foreach ($attachments as $k => $attachment ) {
		if ($attachment->ID == $post->ID) {
			break;
		}
	}

	$k++;

	if (1 < count($attachments)) {
		if ($attachments[$k]) {
			$next_attachment_url = get_attachment_link($attachments[$k]->ID);
		}
		else {
			$next_attachment_url = get_attachment_link($attachments[0]->ID);
		}
	}
	else {
		$next_attachment_url = wp_get_attachment_url();
	}

	echo "\t\t\t\t\t\t\t\t<a href=\"";
	echo esc_url($next_attachment_url);
	echo "\" title=\"";
	the_title_attribute();
	echo "\" rel=\"attachment\">";
	$attachment_size = apply_filters("twentytwelve_attachment_size", array(960, 960));
	echo wp_get_attachment_image($post->ID, $attachment_size);
	echo "</a>\n\n\t\t\t\t\t\t\t\t";

	if (!$post->post_excerpt) {
		echo "\t\t\t\t\t\t\t\t<div class=\"entry-caption\">\n\t\t\t\t\t\t\t\t\t";
		the_excerpt();
		echo "\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t";
	}

	echo "\t\t\t\t\t\t\t</div><!-- .attachment -->\n\n\t\t\t\t\t\t</div><!-- .entry-attachment -->\n\n\t\t\t\t\t\t<div class=\"entry-description\">\n\t\t\t\t\t\t\t";
	the_content();
	echo "\t\t\t\t\t\t\t";
	wp_link_pages(array("before" => "<div class=\"page-links\">" . __("Pages:", "twentytwelve"), "after" => "</div>"));
	echo "\t\t\t\t\t\t</div><!-- .entry-description -->\n\n\t\t\t\t\t</div><!-- .entry-content -->\n\n\t\t\t\t</article><!-- #post -->\n\n\t\t\t\t";
	comments_template();
	echo "\n\t\t\t";
}

echo "\n\t\t</div><!-- #content -->\n\t</div><!-- #primary -->\n\n";
get_footer();

?>
