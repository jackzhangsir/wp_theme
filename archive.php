<?php

get_header();
$pagedtext = "";
if ($paged && (1 < $paged)) {
	$pagedtext = " <small>第" . $paged . "页</small>";
}

echo "<section class=\"container\">\r\n\t<div class=\"content-wrap\">\r\n\t<div class=\"content\">\r\n\t\t<div class=\"pagetitle\"><h1>";

if (is_day()) {
	echo the_time("Y年m月j日");
}
else if (is_month()) {
	echo the_time("Y年m月");
}
else if (is_year()) {
	echo the_time("Y年");
}

echo "的文章</h1>";
echo $pagedtext;
echo "</div>\r\n\t\t";
get_template_part("excerpt");
echo "\t</div>\r\n\t</div>\r\n\t";
get_sidebar();
echo "</section>\r\n\r\n";
get_footer();

?>
