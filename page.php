<?php

get_header();
echo "<section class=\"container container-page\">\r\n\t";
_moloader("mo_pagemenu", false);
echo "\t<div class=\"content\">\r\n\t\t";

while (have_posts()) {
	the_post();
	echo "\t\t<header class=\"article-header\">\r\n\t\t\t<h1 class=\"article-title\"><a href=\"";
	the_permalink();
	echo "\">";
	the_title();
	echo "</a></h1>\r\n\t\t</header>\r\n\t\t<article class=\"article-content\">\r\n\t\t\t";
	the_content();
	echo "\t\t</article>\r\n\t\t";
}

echo "\t\t<p>&nbsp;</p>\r\n\t\t";
comments_template("", true);
echo "\t</div>\r\n</section>\r\n";
get_footer();

?>
