<?php
/* sidebar.php *
	右側のサブカラム部分。
 */
?>
<!-- sidebar.php start -->
<div id="side">
	<div class="widget">
		<div class="menu-sidebar-container">
			<ul id="menu-sidebar" class="menu">
				<li id="sideabout"><a href="<?php bloginfo('url'); ?>/about/">日本大学野球部について</a>
					<ul class="sub-menu">
						<li><a href="<?php bloginfo('url'); ?>/about/#history">沿革</a></li>
						<li><a href="<?php bloginfo('url'); ?>/about/#record">記録</a></li>
						<li><a href="<?php bloginfo('url'); ?>/about/#access">施設案内</a></li>
						<li><a href="<?php bloginfo('url'); ?>/about/#ob_members">OB選手一覧</a></li>
					</ul>
				</li>
				<li id="sidemember"><a href="<?php bloginfo('url'); ?>/memberslist/">部員名鑑</a>
					<ul class="sub-menu">
						<li><a href="<?php bloginfo('url'); ?>/members_staff/">スタッフ紹介</a></li>
						<li><a href="<?php bloginfo('url'); ?>/members_pitcher/">部員紹介【投手】</a></li>
						<li><a href="<?php bloginfo('url'); ?>/members_catcher/">部員紹介【捕手】</a></li>
						<li><a href="<?php bloginfo('url'); ?>/members_infielder/">部員紹介【内野手】</a></li>
						<li><a href="<?php bloginfo('url'); ?>/members_outfielder/">部員紹介【外野手】</a></li>
					</ul>
				</li>
				<li id="sidenews"><a href="<?php bloginfo('url'); ?>/category/news/">お知らせ</a>
					<div class="dropdown_archive">
					<select name="archive-dropdown" onChange='document.location.href=this.options[this.selectedIndex].value;'>
						<option value=""><?php echo attribute_escape(__('Select Month')); ?></option>
						<?php wp_get_archives('type=monthly&format=option&show_post_count=1&cat=1'); ?> </select>
					</select>
					</div>
					<!--
					<ul class="sub-menu">	
						<?php wp_get_archives(); ?>
					</ul>
					-->
				</li>
				<li id="sidegame"><a href="<?php bloginfo('url'); ?>/league/">試合結果</a>
					<ul class="sub-menu">
						<li><a href="<?php bloginfo('url'); ?>/gamescat/springopen">春季オープン戦</a></li>
						<li><a href="<?php bloginfo('url'); ?>/gamescat/springleague">春季リーグ戦</a></li>
						<li><a href="<?php bloginfo('url'); ?>/gamescat/summeropen">夏季オープン戦</a></li>
						<li><a href="<?php bloginfo('url'); ?>/gamescat/rookie">新人戦・交流戦</a></li>
						<li><a href="<?php bloginfo('url'); ?>/gamescat/autumnleague">秋季リーグ戦</a></li>
					</ul>
				</li>
				<li id="sideob"><a href="<?php bloginfo('url'); ?>/category/ob/">桜門球友クラブ</a>
					<ul class="sub-menu">
						<li><a href="<?php bloginfo('url'); ?>/category/ob/">桜門球友クラブのお知らせ</a></li>
						<li><a href="<?php bloginfo('url'); ?>/ob_official/">役員一覧</a></li>
					</ul>
				</li>	
				<li id="sideblog"><a href="http://ameblo.jp/nu-baseball/" target="_blank">ブログ</a></li>			
			</ul>
		<!-- / .menu-sidebar-container --></div>
	<!-- / .widget --></div>
	<div class="widget">
		<h3>最新のお知らせ</h3>
		<ul class="side_latestnews">
			<?php wp_get_archives('type=postbypost&limit=5'); ?>
		</ul>
	<!-- / .widget --></div>

</div><!-- /#side -->
<!-- sidebar.php end -->