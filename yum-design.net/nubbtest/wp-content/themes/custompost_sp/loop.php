<?php
/* loop.php *
	投稿のループ部分だけをまとめたファイル。
  　（ただし、ページタイトルの分岐は、個人的によく使うやつしか入れてません。他のが必要だったら自分で調べて書いてね！）
 */
?>
<?php if(have_posts()): while(have_posts()): the_post(); ?>

		<div id="spMainTitleWrap">
			<h1 id="spMainTitle">『<?php the_category(', ') ?>』</h1>
		<!-- / #spMainTitleWrap --></div>
		
		<div class="spPostWrap">
			<div class="spPostTitleWrap">
				<h2 class="spPostTitle"><?php the_title(); ?></h2>
				<p class="spPostDate"><?php the_time('Y年n月j日(D) H:i'); ?></p>
			<!-- / .spPostTitle --></div>
		
			<div class="spPostContents">
				<?php the_post_thumbnail(); 
	//アイキャッチ画像の出力 ?>

<?php the_content();
	//投稿本文の出力 ?>
	
			<!-- / .spPostContents --></div>
		<!-- / .spPostWrap --></div>
		
	<?php endwhile; endif; ?>

<!-- ここからは、次のページ／前のページへのテキストリンクを出力するためのタグ -->
		<p class="spPagelink">
			<span class="spPageprev"><?php previous_post_link('%link') ?></span>
			<span class="spPagenext"><?php next_post_link('%link') ?></span>
		</p>
		<!-- /ページ送りのリンクここまで -->

<!-- loop.php end -->