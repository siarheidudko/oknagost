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

<?php wp_footer() ?>
<?php 
	$headercode = get_theme_mod('oknagost_footer_code');
	if($headercode)
		echo $headercode;
?>
</body>
</html> 