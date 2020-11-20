<?php
/*single-games.php*
	カスタム投稿タイプ用の個別ページ。single-***.php（***はカスタム投稿のスラッグ）という名前を付ければOK
	
 */
?>
<?php get_header(); ?>

<div id="main">

<?php if(have_posts()): while(have_posts()): the_post(); ?>

<div class="post">
<h2 class="posttitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<div class="postdate"><?php
$taxonomy = gamescat; //分類で設定した名称
echo get_the_term_list( $post->ID, $taxonomy, 'シーズン: ',' ','' );
?>&nbsp;｜&nbsp;<?php the_time('Y年n月j日(D) H:i'); ?></div>

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
</div><!-- /.gamescore_wrap -->

<?php the_content();
	//投稿本文の出力 ?>

	
<?php //ページ分割<!--nextpage-->を使った場合に、ページャーを出力
	wp_link_pages('before=<ul class="pager"><li>ページ</li>&after=</ul>&next_or_number=number&pagelink=<li>%</li>'); ?>
    

</div><!-- /.post -->

<p class="pagelink">
<span class="pageprev"><?php previous_post_link(); ?></span>

<span class="pagenext"><?php next_post_link(); ?></span>
</p>
<?php endwhile; endif; ?>

</div><!-- /#main -->

<?php get_sidebar();?>

<?php get_footer(); ?>
<!-- single-games.php end -->