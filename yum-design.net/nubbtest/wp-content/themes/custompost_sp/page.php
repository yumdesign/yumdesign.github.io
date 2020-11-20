<?php
/* page.php *
	固定ページの出力用テンプレート。サイドバー無しの1カラム。
	WordPressを普通のサイトとして使う場合に相当お世話になるテンプレート。
 */
?>
<?php get_header(); ?>

<div id="spMain">

	<?php if(have_posts()): while(have_posts()): the_post(); ?>

		<div id="spPageTitleWrap">
			<h1 id="spPageTitle"><?php the_title(); ?></h1>
		<!-- / #spPageTitleWrap --></div>
		
		<div class="spPageWrap">
			<div class="spPostContents">
				<?php the_content();
	//投稿本文の出力 ?>
	
<?php //ページ分割<!--nextpage-->を使った場合に、ページャーを出力
	wp_link_pages('before=<ul class="pager"><li>ページ</li>&after=</ul>&next_or_number=number&pagelink=<li>%</li>'); ?>
			<!-- / .spPostContents --></div>
		<!-- / .spPageWrap --></div>
		
	<?php endwhile; endif; ?>		
	</div><!-- / #spMain -->

<?php get_footer(); ?>
<!-- page.php end -->
