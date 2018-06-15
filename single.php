<?php

get_header();
echo "<section class=\"container\">\r\n\t<div class=\"content-wrap\">\r\n\t<div class=\"content\">\r\n\t\t";

while (have_posts()) {
	the_post();
	echo "\t\t<header class=\"article-header\">\r\n\t\t\t<h1 class=\"article-title\"><a href=\"";
	the_permalink();
	echo "\">";
	the_title();
	echo "</a></h1>\r\n\t\t\t<div class=\"article-meta\">\r\n\t\t\t\t<span class=\"item\">";
	echo get_the_time("Y-m-d");
	echo "</span>\r\n\t\t\t\t";
	_moloader("mo_get_post_from", false);
	echo "\t\t\t\t";

	if (mo_get_post_from()) {
		echo "<span class=\"item\">";
		echo mo_get_post_from();
		echo "</span>";
	}

	echo "\t\t\t\t<span class=\"item\">";
	echo "分类：";
	the_category(" / ");
	echo "</span>\r\n\t\t\t\t<span class=\"item post-views\">";
	echo _get_post_views();
	echo "</span>\r\n\t\t\t\t<span class=\"item\">";
	echo _get_post_comments();
	echo "</span>\r\n\t\t\t\t<span class=\"item\">";
	edit_post_link("[编辑]");
	echo "</span>\r\n\t\t\t</div>\r\n\t\t</header>\r\n\t\t<article class=\"article-content\">\r\n\t\t\t";
	_the_ads($name = "ads_post_01", $class = "asb-post asb-post-01");
	echo "\t\t\t";
	the_content();
	echo "\t\t</article>\r\n\t\t";
}

echo "\t\t";

if (_hui("post_link_single_s")) {
	_moloader("mo_post_link");
}

echo "\t\t<div class=\"action-share bdsharebuttonbox\">\r\n\t\t\t";
_moloader("mo_share");
echo "\t\t</div>\r\n\t\t<div class=\"article-tags\">";
the_tags("标签：", "", "");
echo "</div>\r\n\t\t";
_the_ads($name = "ads_post_02", $class = "asb-post asb-post-02");
echo "\t\t";

if (_hui("post_related_s")) {
	_moloader("mo_posts_related", false);
	mo_posts_related(_hui("related_title"), _hui("post_related_n"));
}

echo "\t\t";
_the_ads($name = "ads_post_03", $class = "asb-post asb-post-03");
echo "\t\t";
comments_template("", true);
echo "\t</div>\r\n\t</div>\r\n\t";
echo "\t\t</div>\r\n\t</div>\r\n\t";
get_sidebar();
echo "</section>\r\n\r\n";
get_footer();

?>
