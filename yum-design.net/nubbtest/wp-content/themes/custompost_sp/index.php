<?php
/*index.php*
	各条件にあてはまるテンプレートが無かった時に、最後に適用されるデフォルトテンプレート。
	このファイルはなるべくいじらないで残しておくと、カスタマイズに失敗した時の復旧が楽。
 */
?>
<?php get_header(); ?>

<div id="spMain">

<?php //　loop.phpを呼び出す
	get_template_part( 'loop' ); ?>

</div><!-- / #spMain -->


<?php get_footer(); ?>
<!-- index.php end -->