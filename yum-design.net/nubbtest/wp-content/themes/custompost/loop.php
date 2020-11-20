<?php
/* loop.php *
	投稿のループ部分だけをまとめたファイル。
  　（ただし、ページタイトルの分岐は、個人的によく使うやつしか入れてません。他のが必要だったら自分で調べて書いてね！）
 */
?>
<!-- 投稿ループここから -->
<?php if(have_posts()): while(have_posts()): the_post(); ?>

<div class="post">
<h2 class="posttitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<p class="postdate"><span class="postinfo">
カテゴリー: <?php the_category(', ') ?><?php the_tags('｜タグ: ', ', ', ''); ?></span>&nbsp;｜&nbsp;<?php the_time('Y年n月j日(D) H:i'); ?></p>


<?php the_post_thumbnail(); 
	//アイキャッチ画像の出力 ?>

<?php the_content();
	//投稿本文の出力（本文じゃなく抜粋がいい時はthe_excerptに変えればOK） ?>

</div><!-- /.post -->

<?php endwhile; endif; ?>
<!-- /投稿ループここまで -->

<!-- ここからは、次のページ／前のページへのテキストリンクを出力するためのタグ -->
<p class="pagelink">
<span class="pageprev"><?php previous_posts_link('&laquo; 前のページ'); ?></span>
<span class="pagenext"><?php next_posts_link('次のページ &raquo;'); ?></span>
</p>
<!-- /ページ送りのリンクここまで -->

<!-- loop.php end -->