<?php
/* 404.php *
　リンク先のページがなかった場合に表示されるエラー画面。
 */
?>
<?php get_header(); ?>

<div id="spMain">
		<div id="spPageTitleWrap">
			<h1 id="spPageTitle">ページが見つかりません</h1>
		<!-- / #spPageTitleWrap --></div>
		
		<div class="spPageWrap">
			<div class="spPostContents">
				<p>大変申し訳ございません。<br />
				お探しのページは削除されたか、名前が変更されたか、一時的に利用できない可能性があります。<br />
				以下のURLをクリックして、このブログのトップページにお戻りください。</p>
				<p><a href="<?php echo get_settings('home'); ?>/"><?php echo get_settings('home'); ?>/</a></p>

			<!-- / .spPostContents --></div>
		<!-- / .spPageWrap --></div>
			
	</div><!-- / #spMain -->

<?php get_footer(); ?>
<!-- 404.php end -->