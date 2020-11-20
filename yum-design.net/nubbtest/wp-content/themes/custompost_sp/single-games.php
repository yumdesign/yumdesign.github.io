<?php
/*single-games.php*
	カスタム投稿タイプ用の個別ページ。single-***.php（***はカスタム投稿のスラッグ）という名前を付ければOK
	
 */
?>
<?php get_header(); ?>

<div id="spMain">

<?php if(have_posts()): while(have_posts()): the_post(); ?>

		<div id="spMainTitleWrap">
			<h1 id="spMainTitle"><?php
$taxonomy = gamescat; //分類で設定した名称
echo get_the_term_list( $post->ID, $taxonomy, ' ','' );
?></h1>
		<!-- / #spMainTitleWrap --></div>
		
		<div class="spPostWrap">
			<div class="spPostTitleWrap">
				<h2 class="spPostTitle"><?php the_title(); ?></h2>
				<p class="spPostDate"><?php the_time('Y年n月j日(D) H:i'); ?></p>
			<!-- / .spPostTitle --></div>
		
			<div class="spPostContents">
				<div class="spGamescoreWrap">
					<p><?php echo wp_get_attachment_image(get_post_meta($post->ID,"score",true),'large'); ?></p>
					<p><?php echo wp_get_attachment_image(get_post_meta($post->ID,"pitching_record",true),'large'); ?></p>
					<ul class="spGamesBatresult">
						<?php echo c2c_get_custom('home-run','<li>【本塁打】','</li>'); ?>  
						<?php echo c2c_get_custom('3base_hit','<li>【三塁打】','</li>'); ?>  
						<?php echo c2c_get_custom('2base_hit','<li>【二塁打】','</li>'); ?>
						<?php echo c2c_get_custom('base_stealing','<li>【盗塁】','</li>'); ?>
					</ul>
					<p><?php echo wp_get_attachment_image(get_post_meta($post->ID,"batting_record",true),'large'); ?></p>
				</div><!-- /.spGamescoreWrap -->
				
				<?php the_content();
				//投稿本文の出力 ?>
					
				<?php //ページ分割<!--nextpage-->を使った場合に、ページャーを出力
	wp_link_pages('before=<ul class="pager"><li>ページ</li>&after=</ul>&next_or_number=number&pagelink=<li>%</li>'); ?>	
			
			<!-- / .spPostContents --></div>
		<!-- / .spPostWrap --></div>
		
		<!-- ここからは、次のページ／前のページへのテキストリンクを出力するためのタグ -->
		<p class="spPagelink">
			<span class="spPageprev"><?php previous_post_link('%link'); ?></span>
			<span class="spPagenext"><?php next_post_link('%link'); ?></span>
		</p>
		<!-- /ページ送りのリンクここまで -->
		
<?php endwhile; endif; ?>
		
<!-- / #spMain --></div>

<?php get_footer(); ?>
<!-- single-games.php end -->