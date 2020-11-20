<?php
/* footer.php *
　すべてのページにおいて共通で読み込むフッターテンプレート。
 */
?>
<nav>
		<ul id="spTopNavi" class="accordion">
			<li>
      			<div class="spTopNaviListA"><a href="<?php bloginfo('url'); ?>/">ホーム</a></div></li>
      		<li>
			<li>
				<div class="spTopNaviList accordionHead">日本大学野球部について</div>
				<!--↓アコーディオンする部分。ここから↓-->
				<ul class="spTopNaviSubList">
					<li><a href="<?php bloginfo('url'); ?>/about/#history">沿革</a></li>
					<li><a href="<?php bloginfo('url'); ?>/about/#record">記録</a></li>
					<li><a href="<?php bloginfo('url'); ?>/about/#access">施設案内</a></li>
					<li><a href="<?php bloginfo('url'); ?>/about/#ob_members">OB選手一覧</a></li>
				</ul>
				 <!--↑アコーディオンする部分。ここまで↑-->
			</li>
      		<li>
      			<div class="spTopNaviList accordionHead">部員名鑑</div>
      			<!--↓アコーディオンする部分。ここから↓-->
      			<ul class="spTopNaviSubList">
					<li><a href="<?php bloginfo('url'); ?>/members_staff/">スタッフ紹介</a></li>
					<li><a href="<?php bloginfo('url'); ?>/members_pitcher/">部員紹介【投手】</a></li>
					<li><a href="<?php bloginfo('url'); ?>/members_catcher/">部員紹介【捕手】</a></li>
					<li><a href="<?php bloginfo('url'); ?>/members_infielder/">部員紹介【内野手】</a></li>
					<li><a href="<?php bloginfo('url'); ?>/members_outfielder/">部員紹介【外野手】</a></li>
				</ul>
      		</li>
      		<li>
      			<div class="spTopNaviListA"><a href="<?php bloginfo('url'); ?>/category/news/">お知らせ</a></div></li>
      		<li>
      			<div class="spTopNaviList accordionHead">試合結果</div>
      			<!--↓アコーディオンする部分。ここから↓-->
      			<ul class="spTopNaviSubList">
      				<li><a href="<?php bloginfo('url'); ?>/gamescat/springopen">春季オープン戦</a></li>
					<li><a href="<?php bloginfo('url'); ?>/gamescat/springleague">春季リーグ戦</a></li>
					<li><a href="<?php bloginfo('url'); ?>/gamescat/summeropen">夏季オープン戦</a></li>
					<li><a href="<?php bloginfo('url'); ?>/gamescat/rookie">新人戦</a></li>
					<li><a href="<?php bloginfo('url'); ?>/gamescat/autumnleague">秋季リーグ戦</a></li>
				</ul>
      		</li>
      		<li>
      			<div class="spTopNaviList accordionHead">桜門球友クラブ</div>
      			<!--↓アコーディオンする部分。ここから↓-->
      			<ul class="spTopNaviSubList">
      				<li><a href="<?php bloginfo('url'); ?>/category/ob/">桜門球友クラブのお知らせ</a></li>
					<li><a href="<?php bloginfo('url'); ?>/ob_official/">役員一覧</a></li>
				</ul>
      		</li>
			<li><div class="spTopNaviListA"><a href="http://ameblo.jp/nu-baseball/" target="_blank">ブログ</a></div></li>
		</ul>
	</nav>
	
	<ul id="spTopSubNavi">
		<li><a href="<?php bloginfo('url'); ?>/about/#access">交通アクセス</a></li>
		<li><a href="<?php bloginfo('url'); ?>/sitemap/">サイトマップ</a></li>
		<li><a href="<?php bloginfo('url'); ?>/links/">リンク</a></li>
		<li><a href="<?php bloginfo('url'); ?>/contact/">お問い合せ</a></li>
		<li><a href="http://www.nihon-u.ac.jp/privacy_policy/" target="_blank">個人情報保護</a></li>
		
	</ul>
	
	<div id="spBtnPC">
		<a href="<?php bloginfo('url'); ?>/?pc-switcher=1">PC版の表示に切り替え</a>
	<!-- / #spBtnPC --></div>
	
	<div class="spPagetop">
		<a href="#spWrap">ページの先頭へ</a>
	<!-- / .spPagetop --></div>
	
	<footer id="spFooter">
		<p id="footerCopy">&copy; <script type="text/javascript">  
    document.write(new Date().getFullYear());
  </script> NIHON UNIVERSITY BASEBALL TEAM.<br> All rights reserved.</p>
	</footer>
	
</div><!-- #spWrap -->
<script type='text/javascript' src='<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.pageslide.min.js'></script>
<script>
	/* Default pageslide, moves to the right */
	$(".first").pageslide();

	/* Slide to the left, and make it model (you'll have to call $.pageslide.close() to close) */
	$(".second").pageslide({ direction: "left", modal: true });
</script>

</body>
</html>