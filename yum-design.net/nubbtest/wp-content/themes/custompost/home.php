<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="description" content="日本大学野球部のオフィシャルサイトです。日本大学野球部の活動、最新試合結果、試合詳細、戦績、個人成績、野球部のニュースやトピックス、お問い合わせ先など、日本大学野球部に関する情報をご覧頂けます。" />
<meta name="keywords" content="日本大学野球部,日大野球部,日大,大学野球,千葉県,習志野,日本大学,野球部,日大野球,東都大学," />
<title><?php bloginfo('name'); ?>｜<?php bloginfo('description'); ?></title>
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
	<div class="catchlogo"><!-- <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/header_speed_logo.png" alt="Speed &amp; Passion!" /> --></div>
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
						<li><a href="<?php bloginfo('url'); ?>/gamescat/rookie">新人戦</a></li>
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

<div class="home_catch"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/top_catch_photo.jpg" width="960" height="220" alt="Start All Over Again 原点からの再出発" /></div>

<div id="wrapper_home_contents">
<div id="urgentnews_wrap">
	<div class="urgentnews_title"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/urgentnews_title.png" alt="速報" /></div>
	<div class="urgentnews_detail">
		<ul id="news03">
<?php get_template_part('urgentnews'); ?>
		</ul>
	</div>
</div><!-- / #urgentnews_wrap .clearfix -->

<div id="home_main_wrap" class="clearfix">
<div id="home_news_wrap">
	<div class="home_news_title"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/top_latestnews_title.gif" alt="最新のお知らせ"/></div>
	<!-- 投稿ループここから -->
<?php
$posts = get_posts("numberposts=10&category=&orderby=post_date&offset=0");
foreach ($posts as $post):
setup_postdata($post);
?>
	<dl class="home_news">
		<dt><?php the_time('Y年n月j日(D)'); ?></dt>
        <dd>
            <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
        </dd>
        		   
        		     </dl>
		     <?php endforeach; ?>
<!-- /投稿ループここまで -->
	 <div class="home_news_more"><a href="<?php bloginfo('url'); ?>/category/news/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/btn_news_more.png" alt="お知らせをもっと見る" /></a></div>
</div><!-- /#home_news_wrap -->


<div id="home_games_wrap">
	<div class="home_games_title"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/top_game_title.png" alt="最新の試合結果" /></div>
	<div class="home_games">
	<div class="home_games_contents">
	<?php $paged = get_query_var('paged'); ?>
	<?php query_posts( array( //これで'goods'というカスタム投稿タイプの記事のループを呼び出してる。数字は、1ページに表示させる投稿の数。
	'post_type' => 'games',
	'posts_per_page' => 1,
	'paged' => $paged
)); ?>
<?php if(have_posts()): while(have_posts()): the_post(); ?>
		<!-- 投稿ループここから -->

		<div class="post">
		<h2 class="posttitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<p class="postdate_home"><?php
$taxonomy = gamescat; //分類で設定した名称
echo get_the_term_list( $post->ID, $taxonomy, 'シーズン: ',' ','' );
?>&nbsp;｜&nbsp;<?php the_time('Y年n月j日(D) H:i'); ?></p>

	<div class="gamescore_wrap">	
	<p><?php echo wp_get_attachment_image(get_post_meta($post->ID,"score",true),'large'); ?></p>
	<p><?php echo wp_get_attachment_image(get_post_meta($post->ID,"pitching_record",true),'large'); ?></p>
<ul class="games_batresult">
 <?php echo c2c_get_custom('home-run','<li>【本塁打】','</li>'); ?>  
 <?php echo c2c_get_custom('3base_hit','<li>【三塁打】','</li>'); ?>  
 <?php echo c2c_get_custom('2base_hit','<li>【二塁打】','</li>'); ?>
 <?php echo c2c_get_custom('base_stealing','<li>【盗塁】','</li>'); ?>
</ul>
<p><?php echo wp_get_attachment_image(get_post_meta($post->ID,"batting_record",true),'large'); ?></p>
	<!-- / .gamescore_wrap --></div>
	<?php the_post_thumbnail(); 
	//アイキャッチ画像の出力 ?>
	<?php the_content();
	//投稿本文の出力（本文じゃなく抜粋がいい時はthe_excerptに変えればOK） ?>
<p class="home_games_detail"><a href="<?php the_permalink(); ?>">→このページの詳細を見る</a></p>
</div><!-- /.post -->
<?php endwhile; endif; ?>
<!-- /投稿ループここまで -->
	<!-- / .home_games_contents --></div>
	<!-- / .home_games --></div>
    <div class="home_games_more"><a href="<?php bloginfo('url'); ?>/gameresult"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/btn_game_more.png" alt="試合結果をもっと見る" /></a></div>
    <dl class="realtime_news">
			<dt><a href="http://minimini.jp/sports/pc/index.html" target="_blank">リアルタイム速報</a></dt>
			<dd>[スポ☆チャン]では、東都大学リーグ戦中、各大学の試合情報をリアルタイムで配信しています。</dd>
		</dl>
</div><!-- /#home_games_wrap -->
</div><!-- / #home_main_wrap .clearfix -->

<div class="pagetop_home"><a href="#" class="scroll rollOver"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/pagetop.gif" alt="ページの先頭へ" /></a></div>

<div class="spSwitch">
	<a href="<?php bloginfo('url'); ?>/?pc-switcher=0"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/btn_smswitch.png" alt="スマートフォン版の表示に切り替え" /></a>
</div>

</div><!-- / #wrapper_home_contents -->

<div id="footer">
<p class="copyright">Copyright &copy; <a href="">NIHON UNIVERSITY BASEBALL TEAM</a>. All rights reserved.</p>
<p class="credit">Powered by <a href="http://ja.wordpress.org/">WordPress</a> / <a href="http://mypacecreator.net/theme/category/mypace-custom/">mypace custom theme</a></p>
</div><!-- /#footer -->

</div><!-- /#wrapper-->

</body>
</html><!-- home.php end -->