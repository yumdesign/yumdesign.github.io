<?php
/* functions.php *
	テーマにさまざまな付加機能を設定するためのファイル。
 */


/* 管理画面以外ではデフォルトのjQueryは読み込まずGoogle APIのものを読み込む */
function load_cdn() {
    if ( !is_admin() ) {
    wp_deregister_script('jquery'); // WordPressデフォルトで読み込まれるjQueryをキャンセル
    wp_enqueue_script('jquery','http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js'); // Google APIからmin版の最新のものを読み込んでいる
    }
}


/* 以下、その他のjQueryプラグインの読み込み */
wp_enqueue_script('urgentnews','/wp-content/themes/custompost/js/jquery.bxslider2.0.1.min.js',array('jquery'),'0.1.0');
wp_enqueue_script('scroll','/wp-content/themes/custompost/js/simplelib.min.js',array('jquery'),'0.1.0');
wp_enqueue_script('tile','/wp-content/themes/custompost/js/jquery.tile.js',array('jquery'),'0.1.0');
wp_enqueue_script('call','/wp-content/themes/custompost/js/common.js',array('jquery'),'0.1.0');

add_action('init', 'load_cdn');
?>