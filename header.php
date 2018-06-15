<?php

echo "<!DOCTYPE HTML>\r\n<html>\r\n<head>\r\n<meta charset=\"UTF-8\">\r\n<link rel=\"dns-prefetch\" href=\"//apps.bdimg.com\">\r\n<meta http-equiv=\"X-UA-Compatible\" content=\"IE=11,IE=10,IE=9,IE=8\">\r\n<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0\">\r\n<meta name=\"apple-mobile-web-app-title\" content=\"";
echo get_bloginfo("name");
echo "\">\r\n<meta http-equiv=\"Cache-Control\" content=\"no-siteapp\">\r\n<title>";
echo _title();
echo "</title>\r\n";
wp_head();
echo "<link rel=\"shortcut icon\" href=\"";
echo home_url() . "/favicon.ico";
echo "\">\r\n<!--[if lt IE 9]><script src=\"";
echo get_stylesheet_directory_uri();
echo "/js/libs/html5.min.js\"></script><![endif]-->\r\n</head>\r\n<body ";
body_class(_bodyclass());
echo ">\r\n<header class=\"header\">\r\n\t<div class=\"container\">\r\n\t\t";
_the_logo();
echo "\t\t";
$_brand = _hui("brand");

if ($_brand) {
	$_brand = explode("\n", $_brand);
	echo "<div class=\"brand\">" . $_brand[0] . "<br>" . $_brand[1] . "</div>";
}

echo "\t\t<ul class=\"site-nav site-navbar\">\r\n\t\t\t";
_the_menu("nav");
echo "\t\t\t";

if (!is_search()) {
	echo "\t\t\t\t<li class=\"navto-search\"><a href=\"javascript:;\" class=\"search-show active\"><i class=\"fa fa-search\"></i></a></li>\r\n\t\t\t";
}

echo "\t\t</ul>\r\n\t\t<div class=\"topbar\">\r\n\t\t\t<ul class=\"site-nav topmenu\">\r\n\t\t\t\t";
_the_menu("topmenu");
echo "\t\t\t\t<li class=\"menusns\">\r\n\t\t\t\t\t<a href=\"javascript:;\">关注本站 <i class=\"fa fa-angle-down\"></i></a>\r\n\t\t\t\t\t<ul class=\"sub-menu\">\r\n\t\t\t\t\t\t";

if (_hui("wechat")) {
	echo "<li><a class=\"sns-wechat\" href=\"javascript:;\" title=\"" . __("关注", "haoui") . "”" . _hui("wechat") . "“\" data-src=\"" . _hui("wechat_qr") . "\"><i class=\"fa fa-wechat\"></i> 微信</a></li>";
}

echo "\t\t\t\t\t\t";

if (_hui("weibo")) {
	echo "<li><a target=\"_blank\" rel=\"external nofollow\" href=\"" . _hui("weibo") . "\"><i class=\"fa fa-weibo\"></i> 微博</a></li>";
}

echo "\t\t\t\t\t\t";

if (_hui("tqq")) {
	echo "<li><a target=\"_blank\" rel=\"external nofollow\" href=\"" . _hui("tqq") . "\"><i class=\"fa fa-tencent-weibo\"></i> 腾讯微博</a></li>";
}

echo "\t\t\t\t\t\t";

if (_hui("twitter")) {
	echo "<li><a target=\"_blank\" rel=\"external nofollow\" href=\"" . _hui("twitter") . "\"><i class=\"fa fa-twitter\"></i> Twitter</a></li>";
}

echo "\t\t\t\t\t\t";

if (_hui("facebook")) {
	echo "<li><a target=\"_blank\" rel=\"external nofollow\" href=\"" . _hui("facebook") . "\"><i class=\"fa fa-facebook\"></i> Facebook</a></li>";
}

echo "\t\t\t\t\t\t";

if (_hui("feed")) {
	echo "<li><a target=\"_blank\" href=\"" . _hui("feed") . "\"><i class=\"fa fa-rss\"></i> RSS订阅</a></li>";
}

echo "\t\t\t\t\t</ul>\r\n\t\t\t\t</li>\r\n\t\t\t</ul>\r\n\t\t\t";

if (is_user_logged_in()) {
	global $current_user;
	echo "\t\t\t\t";
	_moloader("mo_get_user_page", false);
	echo "\t\t\t\tHi, ";
	echo $current_user->display_name;
	echo "\t\t\t\t&nbsp; &nbsp; <a href=\"";
	echo mo_get_user_page();
	echo "\">进入会员中心</a>\r\n\t\t\t\t";

	if (is_super_admin()) {
		echo "\t\t\t\t&nbsp; &nbsp; <a target=\"_blank\" href=\"";
		echo site_url("/wp-admin/");
		echo "\">后台管理</a>\r\n\t\t\t\t";
	}

	echo "\t\t\t";
}
else {
	echo "\t\t\t\t";
	_moloader("mo_get_user_rp", false);
	echo "\t\t\t\t<a href=\"javascript:;\" class=\"signin-loader\">Hi, 请登录</a>\r\n\t\t\t\t&nbsp; &nbsp; <a href=\"javascript:;\" class=\"signup-loader\">我要注册</a>\r\n\t\t\t\t&nbsp; &nbsp; <a href=\"";
	echo mo_get_user_rp();
	echo "\">找回密码</a>\r\n\t\t\t";
}

echo "\t\t</div>\r\n\t\t<i class=\"fa fa-bars m-icon-nav\"></i>\r\n\t</div>\r\n</header>\r\n<div class=\"site-search\">\r\n\t<div class=\"container\">\r\n\t\t";
if (_hui("search_baidu") && _hui("search_baidu_code")) {
	echo _hui("search_baidu_code");
}
else {
	echo "<form method=\"get\" class=\"site-search-form\" action=\"" . esc_url(home_url("/")) . "\" ><input class=\"search-input\" name=\"s\" type=\"text\" placeholder=\"输入关键字\" value=\"" . htmlspecialchars($s) . "\"><button class=\"search-btn\" type=\"submit\"><i class=\"fa fa-search\"></i></button></form>";
}

echo "\t</div>\r\n</div>";

?>
