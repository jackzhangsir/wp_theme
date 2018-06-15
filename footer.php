<?php

if (_hui("footer_brand_s")) {
	_moloader("mo_footer_brand", false);
}

echo "\r\n<footer class=\"footer\">\r\n\t<div class=\"container\">\r\n\t\t<p>&copy; ";
echo date("Y");
echo " <a href=\"";
echo home_url();
echo "\">";
echo get_bloginfo("name");
echo "</a> &nbsp; ";
echo _hui("footer_seo");
echo "</p>\r\n\t\t";
echo _hui("trackcode");
echo "\t</div>\r\n</footer>\r\n\r\n";
$roll = 0;
if (is_home() && _hui("sideroll_index_s")) {
	$roll = _hui("sideroll_index");
}
else {
	if ((is_category() || is_tag() || is_search()) && _hui("sideroll_list_s")) {
		$roll = _hui("sideroll_list");
	}
	else {
		if (is_single() && _hui("sideroll_post_s")) {
			$roll = _hui("sideroll_post");
		}
	}
}

if ($roll) {
	$roll = json_encode(explode(" ", $roll));
}

_moloader("mo_get_user_rp");
echo "<script>\r\nwindow.jsui={\r\n    www: '";
echo home_url();
echo "',\r\n    uri: '";
echo get_stylesheet_directory_uri();
echo "',\r\n    ver: '";
echo THEME_VERSION;
echo "',\r\n\troll: ";
echo $roll;
echo ",\r\n    ajaxpager: '";
echo _hui("ajaxpager");
echo "',\r\n    url_rp: '";
echo mo_get_user_rp();
echo "'\r\n};\r\n</script>\r\n";
wp_footer();
echo "</body>\r\n</html>";

?>
