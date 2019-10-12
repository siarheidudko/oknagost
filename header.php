<!--
**
 * Основная тема для сайта oknagost.by
 *
 * @package OknaGOST
 * @subpackage OknaGOST
 * @since 1.0
 * @version 1.0
 * @author Siarhei Dudko
 * @email admin@sergdudko.tk
 * @license GPL-2
 *
 -->

<!DOCTYPE html>
<html><head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri() ?>" />
    <?php
  		if(get_theme_mod('oknagost_autoseo')){
			echo '<meta name="description" content="'.get_bloginfo("description").'">';
			$keywords = array();
			$searchkey = array("\"", "'", "~", "`", "@", "#", "$", "%", "^", "&", "*", "(", ")", "-", "-", "+", "=", "№", ";", ":", "?", "<", ">", "{", "}", "[", "]", "\\", "|" , "/", ",", ".");
			$arr = explode(" ", str_replace($searchkey, "", mb_strtolower(get_page_by_path(get_page_uri(), 'OBJECT', array('post', 'page'))->post_title)));
			foreach ($arr as &$value) {
				if(array_search($value,$keywords) === false){
					$keywords[] = $value;
				}
			}
			if(get_bloginfo("description")){
				$arr2 = explode(" ", str_replace($searchkey, "", mb_strtolower(get_bloginfo("description"))));
				foreach ($arr2 as &$value2) {
					if(array_search($value2,$keywords) === false){
						$keywords[] = $value2;
					}
				}
			}
			echo '<meta name="keywords" content="'.implode($keywords, ",").'">';
        }
    ?>
	<title><?php echo get_bloginfo("description") . ' - ' . get_page_by_path(get_page_uri(), 'OBJECT', array('post', 'page'))->post_title; ?></title>
	<?php wp_head() ?>
	<?php
		$headercolor = get_theme_mod('oknagost_header_background');
		$headertextcolor = get_theme_mod('oknagost_header_textcolor');
		$headermenubutton = get_theme_mod('oknagost_header_menubutton');
	?>
	<style>
		body{ <?php 
			$backgroundimg = get_background_image();
			$backgroundcolor = get_background_color();
			if($backgroundcolor){
				echo 'background-color: #'.$backgroundcolor.';';
			}
			if($backgroundimg){
				echo 'background-image:url('.$backgroundimg.')';
			}
		?> }
		#thememenu {
			<?php
				if($headertextcolor){ echo 'color: '.$headertextcolor.';'; }
			?>
			max-width: 100%;
			overflow: hidden;
		}
		#thememenu a.active,
		#thememenu a:active {
			<?php
				if($headertextcolor){ echo 'color: '.$headertextcolor.';'; }
				if($headercolor){ echo 'background-color: '.$headercolor.';'; }
				if($headertextcolor){ echo 'border-color: '.$headertextcolor.';'; }
			?>
		}
		.custom-toggler.navbar-toggler {
			<?php if($headertextcolor){ echo 'border-color: '.$headertextcolor.';'; } ?>
		}
	</style>
	<?php 
		$headercode = get_theme_mod('oknagost_head_code');
		if($headercode)
			echo $headercode;
	?>
</head>
<body  <?php body_class() ?>>
<?php
	$headercode = get_theme_mod('oknagost_header_code');
	if($headercode)
		echo $headercode;
?>
<nav class="navbar navbar-expand-lg w-100 pt-0 d-flex flex-row <?php 
	$headerstyle = get_theme_mod('oknagost_header_style');
	switch($headerstyle){
		case 'dark':
			echo 'navbar-dark';
			break;
		case 'light':
			echo 'navbar-light';
			break;
		default:
			echo 'navbar-light';
			break;
	}
?>" style="<?php //position:fixed;
	if($headercolor){ echo 'background-color: '.$headercolor.';'; } 
	if($headertextcolor){ echo 'color: '.$headertextcolor.';'; } 
?>" aria-label="<?php esc_attr_e( 'Основное меню', 'oknagost' ); ?>">
	<a class="navbar-brand justify-content-start p-2"  style="max-width: 250px" href="<?php echo get_site_url(); ?>"><?php 
		$logotext = get_bloginfo("name");
		if(has_custom_logo()){
			$imglink = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
			echo '<img src="'.$imglink[0].'" style="max-width: 95%;" alt="logo">';
		}else if($logotext){
			echo $logotext;
		} else {
			echo 'Логотип';
		}
	?></a>
	<div class="justify-content-start pr-5 mr-auto" style="height: 50px;max-width:50%">
		<ul class="list-unstyled"><small>
			<?php 
				$jur = get_theme_mod('oknagost_top_jur'); 
				$unp = get_theme_mod('oknagost_top_unp');
				$tel = get_theme_mod('oknagost_top_tel');
				if(!empty($jur))
					echo '<li>'.$jur.'</li>';
				if(!empty($unp))
					echo '<li>УНП '.$unp.'</li>';
				if(!empty($tel))
					echo '<li><a href="tel:'.$tel.'">Тел.:'.$tel.'</a></li>';
			?>
		</small></ul>
	</div>
	<?php
		if(wp_is_mobile()){ //для мобилки обычную кнопку
			echo '<button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarText" style="max-width:100%;overflow:hidden;">
				<ul class="navbar-nav mr-auto">';
			$menu = wp_get_nav_menu_items(get_nav_menu_locations()['primary']);
			foreach( $menu as $page ){ 
				if(get_permalink() == ($page->url)){
					echo '<li class="nav-item text-truncate active"><a class="nav-link" href="'.$page->url.'">'.esc_html($page->title).'<span class="sr-only">(current)</span></a></li>';
				} else {
					echo '<li class="nav-item text-truncate"><a class="nav-link" href="'.$page->url.'">'.esc_html($page->title).'</a></li>';
				}
			}
			echo '<li class="nav-item text-truncate"><a class="nav-link" href="#contacts">Связаться с нами</a></li>';
			echo '</ul></div>';
		} else { //dropdown для десктопа
			echo '<div class="btn-group justify-content-end p-2" style="width:50%;max-width:300px;">
				<button type="button" class="btn btn-secondary dropdown-toggle text-truncate" style="overflow:hidden;';
			if($headermenubutton){ echo 'background-color:'.$headermenubutton.';'; };
			if($headertextcolor){ echo 'color: '.$headertextcolor.';'.'border-color: '.$headertextcolor.';'; }
			echo '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
			echo get_page_by_path(get_page_uri(), 'OBJECT', array('post', 'page'))->post_title;
			echo '</button>
				<div class="dropdown-menu dropdown-menu-right" id="thememenu">';
			$menu = wp_get_nav_menu_items(get_nav_menu_locations()['primary']);
			if($menu){
				foreach( $menu as $page ){
					if(get_permalink() == ($page->url)){
						echo '<a class="dropdown-item text-truncate active" href="'.$page->url.'"';
						if($headertextcolor){ echo ' style="color: '.$headertextcolor.';"'; }
						echo '>'.esc_html($page->title).'</a>';
					} else {
						echo '<a class="dropdown-item text-truncate" href="'.$page->url.'">'.esc_html($page->title).'</a>';
					}
				}
			}
			echo '<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#contacts">Связаться с нами</a>
				</div>
			</div>';
		}
	?>
</nav>