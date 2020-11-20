<?php
/* footer.php *
　すべてのページにおいて共通で読み込むフッターテンプレート。
 */
?>
<div class="pagetop"><a href="#" class="scroll rollOver"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/pagetop.gif" alt="ページの先頭へ" /></a></div>

<div class="spSwitch">
	<a href="<?php bloginfo('url'); ?>/?pc-switcher=0"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/btn_smswitch.png" alt="スマートフォン版の表示に切り替え" /></a>
</div>

</div><!-- / #wrapper_contents_bg -->
</div><!-- / #wrapper_contents -->

<div id="footer">
<p class="copyright">Copyright &copy; <?php echo date('Y'); ?> <a href="<?php bloginfo('url'); ?>">NIHON UNIVERSITY BASEBALL TEAM</a>. All rights reserved.</p>
<p class="credit">Powered by <a href="http://ja.wordpress.org/">WordPress</a> / <a href="http://mypacecreator.net/theme/category/mypace-custom/">mypace custom theme</a></p>
</div><!-- /#footer -->

</div><!-- /#wrapper-->
<?php wp_footer(); ?>
</body>
</html>