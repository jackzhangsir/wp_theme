<?php

defined("ABSPATH") || exit("This file can not be loaded directly.");

if (!comments_open()) {
	return NULL;
}

$my_email = get_bloginfo("admin_email");
$str = "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_approved = '1' AND comment_type = '' AND comment_author_email";
$count_t = $post->comment_count;
date_default_timezone_set("PRC");
$closeTimer = (strtotime(date("Y-m-d G:i:s")) - strtotime(get_the_time("Y-m-d G:i:s"))) / 86400;
echo "<div class=\"title\" id=\"comments\">\r\n    <h3>";
echo _hui("comment_title");
echo " ";
echo $count_t ? "<b>" . $count_t . "</b>" : "<small>抢沙发</small>";
echo "</h3>\r\n</div>\r\n<div id=\"respond\" class=\"no_webshot\">\r\n    ";
if (get_option("comment_registration") && !is_user_logged_in()) {
	echo "  <div class=\"comment-signarea\">\r\n        <h3 class=\"text-muted\">评论前必须登录！</h3>\r\n    </div>\r\n    ";
}
else {
	if (get_option("close_comments_for_old_posts") && (get_option("close_comments_days_old") < $closeTimer)) {
		echo "  <h3 class=\"title\">\r\n        <strong>文章评论已关闭！</strong>\r\n    </h3>\r\n    ";
	}
	else {
		echo "  \r\n    <form action=\"";
		echo get_option("siteurl");
		echo "/wp-comments-post.php\" method=\"post\" id=\"commentform\">\r\n        <div class=\"comt\">\r\n            <div class=\"comt-title\">\r\n                ";

		if (is_user_logged_in()) {
			global $current_user;
			get_currentuserinfo();
			echo _get_the_avatar($user_id = get_current_user_id(), $user_email = $current_user->user_email);
			echo "<p>" . $user_identity . "</p>";
		}
		else {
			if ($comment_author_email !== "") {
				echo _get_the_avatar($user_id = "", $user_email = $comment->comment_author_email);
			}
			else {
				echo _get_the_avatar($user_id = "", $user_email = "");
			}

			if ($comment_author) {
				echo "<p>" . $comment_author . "</p>";
				echo "<p><a href=\"javascript:;\" evt=\"comment-user-change\">更换</a></p>";
			}
		}

		echo "              <p><a id=\"cancel-comment-reply-link\" href=\"javascript:;\">取消</a></p>\r\n            </div>\r\n            <div class=\"comt-box\">\r\n                <textarea placeholder=\"";
		echo _hui("comment_text");
		echo "\" class=\"input-block-level comt-area\" name=\"comment\" id=\"comment\" cols=\"100%\" rows=\"3\" tabindex=\"1\" onkeydown=\"if(event.ctrlKey&amp;&amp;event.keyCode==13){document.getElementById('submit').click();return false};\"></textarea>\r\n                <div class=\"comt-ctrl\">\r\n                    <div class=\"comt-tips\">";
		comment_id_fields();
		do_action("comment_form", $post->ID);
		echo "</div>\r\n                    <button type=\"submit\" name=\"submit\" id=\"submit\" tabindex=\"5\">";
		echo _hui("comment_submit_text") ? _hui("comment_submit_text") : "提交评论";
		echo "</button>\r\n                    <!-- <span data-type=\"comment-insert-smilie\" class=\"muted comt-smilie\"><i class=\"icon-thumbs-up icon12\"></i> 表情</span> -->\r\n                </div>\r\n            </div>\r\n\r\n            ";

		if (!is_user_logged_in()) {
			echo "              ";

			if (get_option("require_name_email")) {
				echo "                  <div class=\"comt-comterinfo\" id=\"comment-author-info\" ";

				if (!empty($comment_author)) {
					echo "style=\"display:none\"";
				}

				echo ">\r\n                        <ul>\r\n                            <li class=\"form-inline\"><label class=\"hide\" for=\"author\">";
				echo __("昵称", "haoui");
				echo "</label><input class=\"ipt\" type=\"text\" name=\"author\" id=\"author\" value=\"";
				echo esc_attr($comment_author);
				echo "\" tabindex=\"2\" placeholder=\"";
				echo __("昵称", "haoui");
				echo "\"><span class=\"text-muted\">";
				echo __("昵称", "haoui");
				echo " (";
				echo __("必填", "haoui");
				echo ")</span></li>\r\n                            <li class=\"form-inline\"><label class=\"hide\" for=\"email\">";
				echo __("邮箱", "haoui");
				echo "</label><input class=\"ipt\" type=\"text\" name=\"email\" id=\"email\" value=\"";
				echo esc_attr($comment_author_email);
				echo "\" tabindex=\"3\" placeholder=\"";
				echo __("邮箱", "haoui");
				echo "\"><span class=\"text-muted\">";
				echo __("邮箱", "haoui");
				echo " (";
				echo __("必填", "haoui");
				echo ")</span></li>\r\n                            <li class=\"form-inline\"><label class=\"hide\" for=\"url\">";
				echo __("网址", "haoui");
				echo "</label><input class=\"ipt\" type=\"text\" name=\"url\" id=\"url\" value=\"";
				echo esc_attr($comment_author_url);
				echo "\" tabindex=\"4\" placeholder=\"";
				echo __("网址", "haoui");
				echo "\"><span class=\"text-muted\">";
				echo __("网址", "haoui");
				echo "</span></li>\r\n                        </ul>\r\n                    </div>\r\n                ";
			}

			echo "          ";
		}

		echo "      </div>\r\n\r\n    </form>\r\n    ";
	}
}

echo "</div>\r\n";

if (have_comments()) {
	echo "<div id=\"postcomments\">\r\n    <ol class=\"commentlist\">\r\n        ";
	_moloader("mo_comments_list", false);
	wp_list_comments("type=comment&callback=mo_comments_list");
	echo "  </ol>\r\n    <div class=\"pagenav\">\r\n        ";
	paginate_comments_links("prev_next=0");
	echo "  </div>\r\n</div>\r\n";
}

?>
