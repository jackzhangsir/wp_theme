<?php

get_header();
global $wp_query;
$curauth = $wp_query->get_queried_object();
echo "\r\n<section class=\"container\">\r\n\t<div class=\"content-wrap\">\r\n\t<div class=\"content\">\r\n\t\t";
$pagedtext = "";
if ($paged && (1 < $paged)) {
	$pagedtext = " <small>第" . $paged . "页</small>";
}

echo "<div class=\"pagetitle\"><h1>" . $curauth->display_name . "的文章</h1>" . $pagedtext . "</div>";
get_template_part("excerpt");
echo "\t</div>\r\n\t</div>\r\n\t";
get_sidebar();
echo "</section>\r\n\r\n";
get_footer();

?>
