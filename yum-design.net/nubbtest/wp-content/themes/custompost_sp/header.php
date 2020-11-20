<?php
/* header.php *
　すべてのページにおいて共通で読み込むヘッダーテンプレート。
 */
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<?php if ( is_front_page()): ?>
<!-- トップページでのタイトルタグ表記 -->
<title><?php bloginfo('name'); ?>｜<?php bloginfo('description'); ?></title>
<?php else: ?>
<!-- それ以外のページでのタイトルタグ表記 -->
<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo '｜'; } ?><?php bloginfo('name'); ?></title>
<?php endif; ?>

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=10, user-scalable=yes">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="日本大学野球部のオフィシャルサイトです。日本大学野球部の活動、最新試合結果、試合詳細、戦績、個人成績、野球部のニュースやトピックス、お問い合わせ先など、日本大学野球部に関する情報をご覧頂けます。">
<meta name="keywords" content="日本大学野球部,日大野球部,日大,大学野球,習志野">

<meta property="og:type" content="website">
<meta property="og:title" content="日本大学野球部">
<meta property="og:url" content="http://nu-baseball.jp/">
<meta property="og:image" content="<?php echo get_stylesheet_directory_uri(); ?>/images/og_image.jpg">
<meta property="og:description" content="日本大学野球部サイト">

<link rel="apple-touch-icon-precomposed" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon.png">
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.ico">
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen,print" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo get_stylesheet_directory_uri(); ?>/css/normalize.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sp.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo get_stylesheet_directory_uri(); ?>/css/jquery.pageslide.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo get_stylesheet_directory_uri(); ?>/css/menumodal.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo get_stylesheet_directory_uri(); ?>/css/accordion.css">

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<script type='text/javascript'>
/* <![CDATA[ */
var ai1ec_event = {"language":"ja"};
/* ]]> */
</script>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="spWrap">
	<header id="spHeader">
		<h1 class="spSiteLogo"><a href="<?php bloginfo('url'); ?>/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sp_sitelogo.png" alt="日本大学野球部" width="175" height="34"></a></h1>
		<div id="spHeaderMenu"><a href="#modal" class="second open" data-tor-smoothScroll="noSmooth"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sp_btnmenu.png" alt="MENU" width="90" height="40"></a></div>
	</header>
	<div id="modal">
		<div class="close"><a href="javascript:$.pageslide.close()">閉じる</a></div>
		<ul id="modalMain">
      		<li>
      			<div class="modalMainList"><a href="<?php bloginfo('url'); ?>/about/">日本大学野球部について</a></div>
			</li>
      		<li>
      			<div class="modalMainList"><a href="<?php bloginfo('url'); ?>/memberslist/">部員名鑑</a></div>
			</li>
      		<li><div class="modalMainList"><a href="<?php bloginfo('url'); ?>/category/news/">お知らせ</a></div></li>
      		<li>
      			<div class="modalMainList"><a href="<?php bloginfo('url'); ?>/gameresult/">試合結果</a></div>
    		</li>
      		<li>
      			<div class="modalMainList"><a href="<?php bloginfo('url'); ?>/category/ob/">桜門球友クラブ</a></div>
      		</li>
      		<li>
      			<div class="modalMainList"><a href="<?php bloginfo('url'); ?>/ob_official/">桜門球友クラブ役員一覧</a></div>
      		</li>
			<li><div class="modalMainList"><a href="http://ameblo.jp/nu-baseball/" target="_blank">ブログ</a></div></li>
			<li><div class="modalMainList"><a href="<?php bloginfo('url'); ?>/contact/">お問い合せ</a></div></li>
   		</ul>
  	<!--/.modal--></div>

<!-- header.php end -->
