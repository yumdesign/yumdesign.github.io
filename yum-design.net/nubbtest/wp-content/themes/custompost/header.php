<?php
/* header.php *
　すべてのページにおいて共通で読み込むヘッダーテンプレート。
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="description" content="日本大学野球部のオフィシャルサイトです。日本大学野球部の活動、最新試合結果、試合詳細、戦績、個人成績、野球部のニュースやトピックス、お問い合わせ先など、日本大学野球部に関する情報をご覧頂けます。" />
<meta name="keywords" content="日本大学野球部,日大野球部,日大,大学野球,千葉県,習志野,日本大学,野球部,日大野球,東都大学," />
<?php if ( is_front_page()): ?>
<!-- トップページでのタイトルタグ表記 -->
<title><?php bloginfo('name'); ?>｜<?php bloginfo('description'); ?></title>
<?php else: ?>
<!-- それ以外のページでのタイトルタグ表記 -->
<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo '｜'; } ?><?php bloginfo('name'); ?></title>
<?php endif; ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen,print" />
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
<div id="header">
	<div id="title"><a href="<?php bloginfo('url'); ?>/" class="rollOver"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/nihon_baseball_logo.gif" alt="日本大学野球部 NIHON UNIVERSITY BASEBALL TEAM" /></a></div>
	<ul class="utilitynav">
		<li><a href="<?php bloginfo('url'); ?>/about/#access">交通アクセス</a></li>
		<li><a href="<?php bloginfo('url'); ?>/sitemap/">サイトマップ</a></li>
		<li><a href="<?php bloginfo('url'); ?>/links/">リンク</a></li>
		<li><a href="<?php bloginfo('url'); ?>/contact/">お問い合せ</a></li>
		<li><a href="https://www.nihon-u.ac.jp/privacypolicy/" target="_blank">個人情報保護</a></li>
	</ul>
	<div class="catchlogo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/header_speed_logo.png" alt="Speed &amp; Passion!" /></div>
</div><!-- /#header -->

<div id="global_bg">
<div id="global">
	
	<ul id="menu-mainmenu">
		<li id="mainmenu_about"><a href="<?php bloginfo('url'); ?>/about/">日本大学野球部について</a>
			<ul class="sub-menu">
				<li><a href="<?php bloginfo('url'); ?>/about/#history">沿革</a></li>
				<li><a href="<?php bloginfo('url'); ?>/about/#record">記録</a></li>
				<li><a href="<?php bloginfo('url'); ?>/about/#access">施設案内</a></li>
				<li><a href="<?php bloginfo('url'); ?>/about/#ob_members">OB選手一覧</a></li>
			</ul>
		</li>
		<li id="mainmenu_member"><a href="<?php bloginfo('url'); ?>/memberslist/">部員名鑑</a>
			<ul class="sub-menu">
						<li><a href="<?php bloginfo('url'); ?>/members_staff/">スタッフ紹介</a></li>
						<li><a href="<?php bloginfo('url'); ?>/members_pitcher/">部員紹介【投手】</a></li>
						<li><a href="<?php bloginfo('url'); ?>/members_catcher/">部員紹介【捕手】</a></li>
						<li><a href="<?php bloginfo('url'); ?>/members_infielder/">部員紹介【内野手】</a></li>
						<li><a href="<?php bloginfo('url'); ?>/members_outfielder/">部員紹介【外野手】</a></li>
			</ul>
		</li>
		<li id="mainmenu_news"><a href="<?php bloginfo('url'); ?>/category/news/">お知らせ</a></li>
		<li id="mainmenu_games"><a href="<?php bloginfo('url'); ?>/gameresult">試合結果</a>
			<ul class="sub-menu">
						<li><a href="<?php bloginfo('url'); ?>/gamescat/springopen">春季オープン戦</a></li>
						<li><a href="<?php bloginfo('url'); ?>/gamescat/springleague">春季リーグ戦</a></li>
						<li><a href="<?php bloginfo('url'); ?>/gamescat/summeropen">夏季オープン戦</a></li>
						<li><a href="<?php bloginfo('url'); ?>/gamescat/rookie">新人戦・交流戦</a></li>
						<li><a href="<?php bloginfo('url'); ?>/gamescat/autumnleague">秋季リーグ戦</a></li>
			</ul>
		</li>
		<li id="mainmenu_ob"><a href="<?php bloginfo('url'); ?>/category/ob/">桜門球友クラブ</a>
			<ul class="sub-menu">
						<li><a href="<?php bloginfo('url'); ?>/category/ob/">桜門球友クラブのお知らせ</a></li>
						<li><a href="<?php bloginfo('url'); ?>/ob_official/">役員一覧</a></li>
					</ul>
		</li>
		<li id="mainmenu_blog"><a href="http://ameblo.jp/nu-baseball/" target="_blank">ブログ</a></li>
	</ul>

</div><!-- /#global -->
</div><!-- /#global_bg -->

<div id="wrapper">
<div id="wrapper_contents">
<div id="wrapper_contents_bg">

<!-- header.php end -->
