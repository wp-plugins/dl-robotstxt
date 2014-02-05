<?php
/*
Plugin Name: DL Robots.txt
Description: DL Robots.txt Позволяет редактировать содержимое вашего файла robots.txt и задавать оптимальные настройки для поисковых одним кликом мышки
Plugin URI: http://vcard.dd-l.name/wp-plugins/
Version: 1.0
Author: Dyadya Lesha (info@dd-l.name)
Author URI: http://dd-l.name
*/


// create custom plugin settings menu
add_action('admin_menu', 'baw_create_menu');

function baw_create_menu() {

	add_menu_page( 'dl-robots', 'DL Robots.txt', 'administrator', 'dl-robots-txt/options-page.php', '',  'dashicons-format-aside');

	//call register settings function
	add_action( 'admin_init', 'dl_robots_register_settings' );
}


// регистрируем настройки
function dl_robots_register_settings() {
	register_setting( 'dl-robots-settings', 'dl_robots_option' );
	register_setting( 'dl-robots-settings', 'blog_public' );
}

// Формируем страницу 
function dl_robots_menu_page() {

} 


add_filter( 'robots_txt' , 'dl_robots_change' , 10 , 2);

function dl_robots_change ( $source_text , $public ) {
	if ( '1' == $public ) {
		$source_text .= "\n###### DL Robots.txt #####\n" . get_option('dl_robots_option') . "\n";
	}
	return $source_text;
}