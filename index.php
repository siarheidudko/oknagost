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
?>

<?php 
	$bodytextcolor = get_theme_mod('oknagost_body_textcolor');
	get_header(); 
?>
<div id="actionscontent"<?php
	if($bodytextcolor){ echo ' style="color: '.$bodytextcolor.';"'; }
?>>
	<?php
		$actions = get_page_by_title( 'Акции', '', 'post' );
		if($actions){
			if($actions->post_status == 'publish')
				echo apply_filters('the_content', $actions->post_content);
		}
	?>
</div>
<div id="bodycontent"<?php
	if($bodytextcolor){ echo ' style="color: '.$bodytextcolor.';"'; }
?>>
	<?php
		echo apply_filters('the_content', get_post()->post_content);
		if(get_post()->post_title == 'Отзывы'){
			echo comments_template();
		}
	?>
</div>

<?php 
	require 'theme_contacts.php';
	get_footer(); 
?>
