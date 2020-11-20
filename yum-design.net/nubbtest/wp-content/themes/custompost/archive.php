<?php
/* category.php *
　アーカイブページ（投稿一覧）表示用のテンプレート。とりあえずindex.phpと同じにしてあります。
　「カテゴリー別アーカイブ」「タグ別アーカイブ」「カスタム分類別アーカイブ」「投稿者別アーカイブ」「年/月/日別アーカイブ」等々の表示に使います。
　このファイルに手を加えて、'category.php','tag.php','taxonomy.php','author.php',’date.php’等を作ってもOK!
 */
?>
<?php get_header(); ?>

<div id="main">

<!-- ページタイトル（条件により表示方法切替） -->

<h1 class="pagetitle">

<?php if(is_month()): ?>
<?php echo get_query_var('year');?>年<?php echo get_query_var('monthnum');?>月の
<?php endif; ?>

<?php if(is_category()): ?>
『<?php single_cat_title(); ?>』
<?php endif; ?>
一覧</h1>

<?php if(is_tag()): ?>
<h1 class="pagetitle">『<?php single_cat_title(); ?>』タグの付いた投稿</h1>
<?php endif; ?>

<?php if(is_author()): ?>
<h1 class="pagetitle">投稿者のアーカイブ</h1>
<?php endif; ?>

<?php if(is_search()): ?>
<h1 class="pagetitle">『 <?php the_search_query(); ?> 』を含む記事</h1>
<?php endif; ?>
<!--　ページタイトルここまで -->


<!-- 投稿ここから -->
<?php if(have_posts()): while(have_posts()): the_post(); ?>
<div class="post">

<h2 class="posttitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<p class="postdate"><span class="postinfo">
カテゴリー: <?php the_category(', ') ?><?php the_tags('｜タグ: ', ', ', ''); ?></span>&nbsp;｜&nbsp;<?php the_time('Y年n月j日(D) H:i'); ?></p>
<?php the_content();
	//投稿本文の出力（本文じゃなく抜粋がいい時はthe_excerptに変えればOK） ?>

</div><!-- /.post -->
<?php endwhile; endif; ?>
<!-- /投稿ここまで -->


<!-- ここからは、次のページ／前のページへのテキストリンクを出力するためのタグ -->
<p class="pagelink">
<span class="pageprev"><?php previous_posts_link('&laquo; 前のページ'); ?></span>
<span class="pagenext"><?php next_posts_link('次のページ &raquo;'); ?></span>
</p>
<!-- /ページ送りのリンクここまで -->


</div><!-- /#main -->

<?php get_sidebar();?>

<?php get_footer(); ?>
<!-- archive.php end -->