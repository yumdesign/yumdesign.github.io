<?php
/*
Template Name: カスタム分類表示用
	カスタム投稿タイプで投稿した記事一覧を表示させる為のページテンプレート。
*/
?>
<?php get_header(); ?>

<div id="main" class="page">

<h1 class="pagetitle">
<?php $catinfo = get_term_by('slug',$term,$taxonomy); ?>
<?php echo $catinfo->name; ?>
</h1>

<?php query_posts( array( //これで'goods'というカスタム投稿タイプの記事のループを呼び出してる。数字は、1ページに表示させる投稿の数。
	'post_type' => 'games',
	'posts_per_page' => 20,
)); ?>


<?php if(have_posts()): while(have_posts()): the_post(); ?>

<!-- 投稿ここから -->
<div class="post">

<dl class="archive_post_title">
<dt><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dt>
<dd><p class="postdate"><span class="postinfo"><?php the_time('Y年n月j日(D) H:i'); ?></p></dd>
</dl>

</div><!-- /.post -->
<?php endwhile; endif; ?>
<!-- /投稿ここまで -->

<?php //　ページ送りリンクを表示（「前の○件へ」の数字は自分で設定した数字に変えることを忘れずに！）
	posts_nav_link('｜', '<< 前の5件へ', '次の5件へ >>'); ?>

</div><!-- /#main -->

<?php get_sidebar();?>

<?php get_footer(); ?>
<!-- taxonomy.php end -->