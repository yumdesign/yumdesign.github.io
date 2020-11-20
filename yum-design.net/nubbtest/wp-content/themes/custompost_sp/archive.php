<?php
/* category.php *
　アーカイブページ（投稿一覧）表示用のテンプレート。とりあえずindex.phpと同じにしてあります。
　「カテゴリー別アーカイブ」「タグ別アーカイブ」「カスタム分類別アーカイブ」「投稿者別アーカイブ」「年/月/日別アーカイブ」等々の表示に使います。
　このファイルに手を加えて、'category.php','tag.php','taxonomy.php','author.php',’date.php’等を作ってもOK!
 */
?>
<?php get_header(); ?>

	<div id="spMain">
		<!-- ページタイトル（条件により表示方法切替） -->
		
		<div id="spMainTitleWrap">
			<h1 id="spMainTitle">
			<?php if(is_month()): ?>
			<?php echo get_query_var('year');?>年<?php echo get_query_var('monthnum');?>月の
			<?php endif; ?>

			<?php if(is_category()): ?>
			『<?php single_cat_title(); ?>』
			<?php endif; ?>
			一覧		
			</h1>
			
			<?php if(is_tag()): ?>
			<h1 class="pagetitle">『<?php single_cat_title(); ?>』タグの付いた投稿</h1>
			<?php endif; ?>

			<?php if(is_author()): ?>
			<h1 class="pagetitle">投稿者のアーカイブ</h1>
			<?php endif; ?>

			<?php if(is_search()): ?>
			<h1 class="pagetitle">『 <?php the_search_query(); ?> 』を含む記事</h1>
			<?php endif; ?>		
		<!-- / #spMainTitleWrap --></div>
		<!--　ページタイトルここまで -->
		
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

		<!-- ここからは、次のページ／前のページへのテキストリンクを出力するためのタグ -->
		<p class="spPagelink">
			<span class="spPageprev"><?php previous_posts_link('前のページ'); ?></span>
			<span class="spPagenext"><?php next_posts_link('次のページ'); ?></span>
		</p>
		<!-- /ページ送りのリンクここまで -->
		
	<!-- / #spMain --></div>


<?php get_footer(); ?>
<!-- archive.php end -->