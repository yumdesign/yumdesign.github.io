<?php
/* footer.php *
　すべてのページにおいて共通で読み込むフッターテンプレート。
 */
?>
<!-- footer.php start -->
<p class="pagetop"><a href="#wrapper">▲Pagetop</a></p>

<div id="footer">

<div class="footerWidget">
<?php
	//サイドバー3
	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(3) ) :
?>
<!--　ウィジェット3が使われていない時に表示する内容　-->   
	<div class="widget"> 
    <h3 class="side-title">カテゴリー</h3>
    <ul>
    <?php wp_list_categories('title_li='); ?>
    </ul>
    </div>
<!--　ここまで　-->    
<?php endif; ?>
</div>

<div class="footerWidget">
<?php
	//サイドバー4
	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(4) ) : 
?>
<!--　サイドバー4が使われていない時に表示する内容　-->
    <p>サイドバー4</p> 
<!--　ここまで　-->
<?php endif; ?>
</div>

<div class="footerWidget">
<?php
	//サイドバー5
	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(5) ) : 
?>
<!--　サイドバー5が使われていない時に表示する内容　-->
    <p>サイドバー5</p> 
<!--　ここまで　-->

<?php endif; ?>
</div>

<p class="copyright">Copyright(c)<a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>. All rights reserved.</p>
<p class="credit">Powered by <a href="http://ja.wordpress.org/">WordPress</a> / <a href="http://mypacecreator.net/theme/category/mypace-custom/">mypace custom theme</a></p>
</div><!-- /#footer -->

</div><!-- /#wrapper-->
<?php wp_footer(); ?>
</body>
</html>