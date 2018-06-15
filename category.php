<?php

get_header();
$pagedtext = "";
if ($paged && (1 < $paged)) {
	$pagedtext = " <small>第" . $paged . "页</small>";
}

_moloader("mo_is_minicat", false);
$description = trim(strip_tags(category_description()));
echo "\r\n";

if (mo_is_minicat()) {
	echo "<div class=\"pageheader\">\r\n\t<div class=\"container\">\r\n\t\t<div class=\"share bdsharebuttonbox\">\r\n\t\t\t";
	_moloader("mo_share", false);
	mo_share("renren");
	echo "\t\t</div>\r\n\t  \t<h1>";
	single_cat_title();
	echo $pagedtext;
	echo "</h1>\r\n\t  \t<div class=\"note\">";
	echo $description ? $description : "去分类设置中添加分类描述吧";
	echo "</div>\r\n\t</div>\r\n</div>\r\n";
}

echo "\r\n<section class=\"container\">\r\n\t<div class=\"content-wrap\">\r\n\t\t<div class=\"content\">\r\n\t\t\t";
_the_ads($name = "ads_cat_01", $class = "asb-cat asb-cat-01");
echo "\t\t\t";

if (mo_is_minicat()) {
	$p_meta = _hui("post_plugin");

	while (have_posts()) {
		the_post();
		echo "<article class=\"excerpt-minic\">";
		echo "<h2><a" . _post_target_blank() . " href=\"" . get_permalink() . "\" title=\"" . get_the_title() . _get_delimiter() . get_bloginfo("name") . "\">" . get_the_title() . "</a></h2>";
		echo "<p class=\"meta\">";
		if ($p_meta && $p_meta["date"]) {
			echo "<time><i class=\"fa fa-clock-o\"></i>" . get_the_time("Y-m-d") . "</time>";
		}

		if ($p_meta && $p_meta["author"]) {
			$author = get_the_author();

			if (_hui("author_link")) {
				$author = "<a href=\"" . get_author_posts_url(get_the_author_meta("ID")) . "\">" . $author . "</a>";
			}

			echo "<span class=\"author\"><i class=\"fa fa-user\"></i>" . $author . "</span>";
		}

		if ($p_meta && $p_meta["view"]) {
			echo "<span class=\"pv\"><i class=\"fa fa-eye\"></i>" . _get_post_views() . "</span>";
		}

		if (comments_open() && $p_meta && $p_meta["view"]) {
			echo "<a class=\"pc\" href=\"" . get_comments_link() . "\"><i class=\"fa fa-comments-o\"></i>评论(" . get_comments_number("0", "1", "%") . ")</a>";
		}

		echo "</p>";
		echo "<div class=\"article-content\">";
		the_content();
		echo "</div>";
		echo "</article>";
	}

	_moloader("mo_paging");
	wp_reset_query();
}
else {
	echo "<div class=\"pagetitle\"><h1>";
	echo single_cat_title();
	echo "</h1>" . $pagedtext . "</div>";
	get_template_part("excerpt");
}

echo "\t\t</div>\r\n\t</div>\r\n\t";
get_sidebar();
echo "</section>\r\n\r\n";
get_footer();

?>
