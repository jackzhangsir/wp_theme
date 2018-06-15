<?php

echo "<section class=\"container\">\r\n\t<div class=\"f404\">\r\n\t\t<img src=\"";
echo "wp-content/themes/dux/img/404.png\">\r\n\t\t<h1>404 . Not Found</h1>\r\n\t\t<h2>沒有找到你要的内容！</h2>\r\n\t\t<p>\r\n\t\t\t<a class=\"btn btn-primary\" href=\"";
echo get_bloginfo("url");
echo "\">返回 ";
echo get_bloginfo("name");
echo " 首页</a>\r\n\t\t</p>\r\n\t</div>\r\n</section>";

?>
