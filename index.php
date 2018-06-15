<?php

get_header();
$paged = (get_query_var("paged") ? get_query_var("paged") : 1);
echo "<section class=\"container\">\n\t<div class=\"content-wrap\">\n\t<div class=\"content\">\n\t\t";
if (($paged == 1) && _hui("focusslide_s")) {
	_moloader("mo_slider", false);
	mo_slider("focusslide");
}

echo "\t\t";
$pagedtext = "";

if (1 < $paged) {
	$pagedtext = " <small>第" . $paged . "页</small>";
}

echo "\t\t";

if (_hui("minicat_home_s")) {
	_moloader("mo_minicat");
}

echo "\t\t";
_the_ads($name = "ads_index_01", $class = "asb-index asb-index-01");
echo "\t\t<div class=\"title\">\n\t\t\t<h3>\n\t\t\t\t";
echo _hui("index_list_title") ? _hui("index_list_title") : "最新发布";
echo "\t\t\t\t";
echo $pagedtext;
echo "\t\t\t</h3>\n\t\t\t";

if (_hui("index_list_title_r")) {
	echo "<div class=\"more\">" . _hui("index_list_title_r") . "</div>";
}

echo "\t\t</div>\n\t\t";
$args = array("ignore_sticky_posts" => 1, "paged" => $paged);

if (_hui("notinhome")) {
	$pool = array();

	foreach (_hui("notinhome") as $key => $value ) {
		if ($value) {
			$pool[] = $key;
		}
	}

	$args["cat"] = "-" . implode($pool, ",-");
}

if (_hui("notinhome_post")) {
	$pool = _hui("notinhome_post");
	$args["post__not_in"] = explode("\n", $pool);
}

query_posts($args);
echo " \n\t\t";
get_template_part("excerpt");
echo "\t\t";
_the_ads($name = "ads_index_02", $class = "asb-index asb-index-02");
echo "\t</div>\n\t</div>\n\t";
get_sidebar();
echo "</section>\n";
get_footer();

?>
