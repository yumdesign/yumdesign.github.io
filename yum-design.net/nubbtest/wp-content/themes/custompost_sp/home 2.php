<?php get_header(); ?>
  	
  	<div id="spTopImg">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sp_mainimg.jpg" alt="Speed & Passion!">
	<!-- / #spTopImg --></div>
	
	<div id="spTopTickerWrap">
		<div class="spTopTickerTitle">速報</div>
		<div class="ticker" rel="slide">
			<ul id="spTopTicker">
				<?php include(get_theme_root() . '/custompost/urgentnews.php'); ?>
			</ul>
		</div>
	<!-- /#spTopTickerWrap --></div>
	
	<div id="spTopGameWrap">
		<h2 id="spTopGameTitle">最新の試合結果</h2>
		<div id="spTopGame">
			<?php $paged = get_query_var('paged'); ?>
	<?php query_posts( array( //これで'goods'というカスタム投稿タイプの記事のループを呼び出してる。数字は、1ページに表示させる投稿の数。
	'post_type' => 'games',
	'posts_per_page' => 1,
	'paged' => $paged
)); ?>
		<?php if(have_posts()): while(have_posts()): the_post(); ?>
		<!-- 投稿ループここから -->
			<p id="spTopGameResult"><a href="<?php the_permalink(); ?>" class="spTopGameResultA"><?php the_title(); ?></a></p>
			<p id="spTopGameDate"><?php the_time('Y年n月j日(D) H:i'); ?><span class="spTopGamescat"><?php
$taxonomy = gamescat; //分類で設定した名称
echo get_the_term_list( $post->ID, $taxonomy, ' ','' );
?></span></p>
		<?php endwhile; endif; ?>
		<!-- /投稿ループここまで -->
		<!-- / #spTopGame --></div>
	<!-- / #spTopGameWrap --></div>
	
	<div id="spTopNewsWrap">
		<h2 id="spTopNewsTitle">最新のお知らせ</h2>
		<!-- 投稿ループここから -->
		<?php
$posts = get_posts("numberposts=10&category=&orderby=post_date&offset=0");
foreach ($posts as $post):
setup_postdata($post);
?>
		<ul id="spTopNews">
			<li>
				<a href="<?php the_permalink(); ?>">
					<p class="spTopNewsMtitle"><?php the_title(); ?></p>
					<p class="spTopNewsDate"><?php the_time('Y年n月j日(D)'); ?></p>
				</a>
			</li>
		</ul>
		<?php endforeach; ?>
		<!-- /投稿ループここまで -->
		<div id="spTopNewsMore">
			<a href="<?php bloginfo('url'); ?>/category/news/">お知らせをもっと見る</a>
		<!-- / #spTopNewsMore --></div> 
	<!-- / #spTopNewsWrap --></div>
	
	<div id="spTopBnrWrap">
		<a href="http://minimini.jp/sports/pc/index.html" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sp_bnr_spochan.png" alt="スポ☆チャン　リアルタイム速報" width="300" height="80"></a>
	<!-- / #spTopBnrWrap --></div>
	
<?php get_footer(); ?>