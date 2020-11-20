<?php
/*
Template Name: カスタム分類表示用
	カスタム投稿タイプで投稿した記事一覧を表示させる為のページテンプレート。
*/
?>
<?php get_header(); ?>

<div id="spMain">
		<div id="spMainTitleWrap">
			<h1 id="spMainTitle">
			<?php $catinfo = get_term_by('slug',$term,$taxonomy); ?>
			<?php echo $catinfo->name; ?>
			</h1>
		<!-- / #spMainTitleWrap --></div>
		
		<?php $paged = get_query_var('paged'); ?>
		<?php query_posts( array( //これで'goods'というカスタム投稿タイプの記事のループを呼び出してる。数字は、1ページに表示させる投稿の数。
		'post_type' => 'games',
		'posts_per_page' => 20,
		)); ?>

		<ul id="spPostList">
			<!-- 投稿ここから -->
			<?php if(have_posts()): while(have_posts()): the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>">
					<p class="spPostListTitle"><?php the_title(); ?></p>
					<p class="spPostListDate"><?php the_time('Y年n月j日(D) H:i'); ?></p>
				</a>
			</li>
			<?php endwhile; endif; ?>
			<!-- /投稿ここまで -->
		</ul>
		
		<div id="spGameNavlink">
			<?php //　ページ送りリンクを表示（「前の○件へ」の数字は自分で設定した数字に変えることを忘れずに！）
	posts_nav_link('｜', '<< 前の20件へ', '次の20件へ >>'); ?>
		</div>
	<!-- / #spMain --></div>

<?php get_footer(); ?>
<!-- taxonomy.php end -->