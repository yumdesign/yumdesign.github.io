<?php
/* functions.php *
	テーマにさまざまな付加機能を設定するためのファイル。
	
 */

// wp_head()の出力タグの消去
	remove_action('wp_head', 'wp_enqueue_scripts', 1);
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	remove_action('wp_head', 'feed_links_extra',3,0);
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'parent_post_rel_link');
	remove_action('wp_head', 'start_post_rel_link');
	remove_action('wp_head', 'rel_canonical');

// ウィジェット有効化 
	register_sidebars( 5, array( //ここの数字で許可するウィジェット数を指定
	//ウィジェット項目の前後に出力するタグ
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
	//ウィジェット項目のタイトル前後に出力するタグ
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

// カスタムメニュー有効化 
	register_nav_menus( array(
		'global' => 'グローバルナビゲーション',
	));
	add_theme_support( 'menus' );

//　背景画像をアップロードして変更できる機能を有効化
	add_custom_background();

//　アイキャッチ画像に対応
	add_theme_support( 'post-thumbnails' );
	//　↓width,height,切り抜き(true)orリサイズ(false)
	set_post_thumbnail_size( 650, 160, true );

//「続きを読む」クリック後のURLから#more-$id を削除
	function custom_content_more_link( $output ) {
		$output = preg_replace('/#more-[\d]+/i', '', $output );
		return $output;
	}
	add_filter( 'the_content_more_link', 'custom_content_more_link' );