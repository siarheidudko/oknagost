<?php
/**
 * Основная тема для сайта oknagost.by
 *
 * @package OknaGOST
 * @subpackage OknaGOST
 * @since 1.0
 * @version 1.0
 * @author Siarhei Dudko
 * @email admin@sergdudko.tk
 * @license GPL-2
 */

function oknagost_wptuts_scripts_basic()  
{  
	wp_register_script( 'jquery', get_stylesheet_directory_uri() . '/js/jquery-3.4.0.min.js', '', '3.4.0' );  
    wp_enqueue_script( 'jquery' );
	
	wp_register_script( 'bootstrapminjs', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', '', '4.3.1' );  
    wp_enqueue_script( 'bootstrapminjs' );
	
	wp_register_style( 'bootstrapmincss', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', '', '4.3.1' );  
    wp_enqueue_style( 'bootstrapmincss' );
	
	wp_register_style( 'bootstrap-gridmincss', get_stylesheet_directory_uri() . '/css/bootstrap-grid.min.css', '', '4.3.1' );  
    wp_enqueue_style( 'bootstrap-gridmincss' );
	
	wp_register_style( 'bootstrap-rebootmincss', get_stylesheet_directory_uri() . '/css/bootstrap-reboot.min.css', '', '4.3.1' );  
    wp_enqueue_style( 'bootstrap-rebootmincss' );
}  
add_action( 'wp_enqueue_scripts', 'oknagost_wptuts_scripts_basic' );

function oknagost_delete_junk_from_header() {
    remove_action( 'wp_head', 'feed_links', 2 ); // Удаляет ссылки RSS-лент записи и комментариев
    remove_action( 'wp_head', 'feed_links_extra', 3 ); // Удаляет ссылки RSS-лент категорий и архивов
    
    remove_action( 'wp_head', 'rsd_link' ); // Удаляет RSD ссылку для удаленной публикации
    remove_action( 'wp_head', 'wlwmanifest_link' ); // Удаляет ссылку Windows для Live Writer
    
    remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0); // Удаляет короткую ссылку
    remove_action( 'wp_head', 'wp_generator' ); // Удаляет информацию о версии WordPress
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Удаляет ссылки на предыдущую и следующую статьи
    
    // отключение WordPress REST API
    remove_action( 'wp_head', 'rest_output_link_wp_head' ); 
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
}
add_filter( 'after_setup_theme', 'oknagost_delete_junk_from_header' );

function oknagost_theme_support() {
	//добавляю кастомный лого
	add_theme_support( 'custom-logo', [
		'height'      => 169,
		'width'       => 890,
		'flex-width'  => false,
		'flex-height' => false,
		'header-text' => 'oknagost',
	] );
	//добавляю кастомный фон
	add_theme_support( 'custom-background' );
	$defaults = array(
		'default-color'          => '',
		'default-image'          => '',
		'default-repeat'         => 'repeat', // повторять
		'default-position-x'     => 'left', // выровнять по левому краю
		'default-attachment'     => 'fixed', // фон прокручивается со страницей
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => ''
	);
	add_theme_support( 'custom-background', $defaults );
	//добавляю меню
	register_nav_menu( 'primary', 'Основное меню' );
}
add_filter( 'after_setup_theme', 'oknagost_theme_support' );

//добавляю настройки кастомайзера темы
function oknagost_customize_register($wp_customize) {
	//настройка темы
	$wp_customize->add_section( 'oknagost_customizer' , array(
		'title'      => __('Настройка темы','mytheme'),
		'priority'   => 30,
	));
	//стиль шапки
	$wp_customize->add_setting( 'oknagost_header_style' , array(
		'default' => 'dark',
	));
	//контроллер стиля шапки
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'oknagost_header_style_type', 
		array(
			'label'    => __( 'Стиль шапки', 'oknagost' ),
			'section'  => 'oknagost_customizer',
			'settings' => 'oknagost_header_style',
			'type'     => 'radio',
			'choices'  => array(
				'dark'  => 'Темный фон',
				'light' => 'Светлый фон',
			),
		)
	));
	//цвет шапки
	$wp_customize->add_setting( 'oknagost_header_background' , array(
		'default' => '#000000',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	//контроллер цвета шапки
	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 
		'oknagost_header_background_color', 
		array(
			'label'      => __( 'Цвет шапки', 'oknagost' ),
			'section'    => 'oknagost_customizer',
			'settings'   => 'oknagost_header_background',
			'priority'   => 1,
		)
	));
	//цвет текста на хидере
	$wp_customize->add_setting( 'oknagost_header_textcolor' , array(
		'default' => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	//контроллер цвета текста на хидере
	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 
		'oknagost_header_text_color', 
		array(
			'label'      => __( 'Цвет текста на шапке', 'oknagost' ),
			'section'    => 'oknagost_customizer',
			'settings'   => 'oknagost_header_textcolor',
			'priority'   => 1
		)
	));
	//цвет кнопки меню
	$wp_customize->add_setting( 'oknagost_header_menubutton' , array(
		'default' => '#000000',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	//контроллер цвета кнопки меню
	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 
		'oknagost_header_menu_button', 
		array(
			'label'      => __( 'Цвет кнопки Меню', 'oknagost' ),
			'section'    => 'oknagost_customizer',
			'settings'   => 'oknagost_header_menubutton',
			'priority'   => 1
		)
	));
	//цвет текста
	$wp_customize->add_setting( 'oknagost_body_textcolor' , array(
		'default' => '#000000',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	//контроллер цвета текста
	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 
		'oknagost_body_text_color', 
		array(
			'label'      => __( 'Цвет текста (базовый)', 'oknagost' ),
			'section'    => 'oknagost_customizer',
			'settings'   => 'oknagost_body_textcolor',
			'priority'   => 1
		)
	));
	//код внутри блока <HEAD></HEAD>
	$wp_customize->add_setting( 'oknagost_head_code' , array(
		'default' => '',
	));
	//контроллер кода внутри блока <HEAD></HEAD>
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'oknagost_head_code_text', 
		array(
			'label'    => __( 'HTML-код внутри блока <HEAD></HEAD>', 'oknagost' ),
			'section'  => 'oknagost_customizer',
			'settings' => 'oknagost_head_code',
			'type'     => 'textarea',
		)
	));
	//код в шапке
	$wp_customize->add_setting( 'oknagost_header_code' , array(
		'default' => '',
	));
	//контроллер кода в шапке
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'oknagost_header_code_text', 
		array(
			'label'    => __( 'HTML-код в шапке (над меню, сразу после <BODY>)', 'oknagost' ),
			'section'  => 'oknagost_customizer',
			'settings' => 'oknagost_header_code',
			'type'     => 'textarea',
		)
	));
	//код в подвале
	$wp_customize->add_setting( 'oknagost_footer_code' , array(
		'default' => '',
	));
	//контроллер кода в подвале
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'oknagost_footer_code_text', 
		array(
			'label'    => __( 'HTML-код в подвале (перед </BODY>)', 'oknagost' ),
			'section'  => 'oknagost_customizer',
			'settings' => 'oknagost_footer_code',
			'type'     => 'textarea',
		)
	));
	//autoseo    
    $wp_customize->add_setting(
		'oknagost_autoseo', 
		array(
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh',
			'default'    => '',
		)
	);
    $wp_customize->add_control(
		'enable_oknagost_autoseo', 
		array(
			'label'      => esc_html__( 'Включить autoSEO (теги description и keywords)', 'oknagost' ),
			'section'    => 'oknagost_customizer',
			'settings'   => 'oknagost_autoseo',
			'type'       => 'checkbox'
		) 
	);
	
	//настройка контактов
	$wp_customize->add_section('oknagost_contacts_section', array(
		'title'      => __('Настройка контактов', 'oknagost'),
		'priority'   => 10,
		'capability' => 'edit_theme_options',
	));
	//наименование юр.лица
	$wp_customize->add_setting('oknagost_top_jur', array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('oknagost_top_jur', array(
		'type'     => 'text',
		'priority' => 200,
		'section'  => 'oknagost_contacts_section',
		'label'    => __('Юр.лицо:', 'oknagost'),
	));
	//унп
	$wp_customize->add_setting('oknagost_top_unp', array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('oknagost_top_unp', array(
		'type'     => 'text',
		'priority' => 200,
		'section'  => 'oknagost_contacts_section',
		'label'    => __('УНП:', 'oknagost'),
	));
	//телефон
	$wp_customize->add_setting('oknagost_top_tel', array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('oknagost_top_tel', array(
		'type'     => 'text',
		'priority' => 200,
		'section'  => 'oknagost_contacts_section',
		'label'    => __('Тел:', 'oknagost'),
	));
	//email
	$wp_customize->add_setting('oknagost_top_email', array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('oknagost_top_email', array(
		'type'     => 'text',
		'priority' => 200,
		'section'  => 'oknagost_contacts_section',
		'label'    => __('EMAIL:', 'oknagost'),
	));
}
add_action( 'customize_register', 'oknagost_customize_register' );

/* Меняем картинку логотипа WP на странице входа */
function my_login_logo(){
	echo '<style type="text/css">#login h1 a { background: url('.get_stylesheet_directory_uri().'/img/admlogo.png) no-repeat 0 0 !important; }</style>';
}
add_action('login_head', 'my_login_logo');
/* Ставим ссыллку с логотипа на сайт, а не на wordpress.org */
add_filter( 'login_headerurl', create_function('', 'return get_home_url();') );
/* убираем title в логотипе "сайт работает на wordpress" */
add_filter( 'login_headertitle', create_function('', 'return false;') );