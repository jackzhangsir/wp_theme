<?php

get_header();

if (!have_posts()) {
	get_template_part("content-404");
	get_footer();
	exit();
}

echo "\r\n<section class=\"container\">\r\n\t<div class=\"content-wrap\">\r\n\t\t<div class=\"content\">\r\n\t\t\t";
_the_ads($name = "ads_search_01", $class = "asb-search asb-search-01");
echo "\t\t\t<div class=\"pagetitle\"><h1>";
echo $s;
echo " 的搜索结果</h1></div>\r\n\t\t\t";
get_template_part("excerpt");
echo "\t\t</div>\r\n\t</div>\r\n\t";
get_sidebar();
echo "</section>\r\n\r\n";
get_footer();

?>
