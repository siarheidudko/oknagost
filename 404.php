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

<?php get_header(); ?>

<head>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<style type="text/css">
	body{
		width: 100%;
		height: 100%;
		background: url(<?php echo get_stylesheet_directory_uri().'/img/404.jpg'; ?>) no-repeat;
		-moz-background-size: cover cover; /* Firefox 3.6+ */
		-webkit-background-size: cover cover; /* Safari 3.1+ и Chrome 4.0+ */
		-o-background-size: cover cover; /* Opera 9.6+ */
		background-size: cover cover; /* Современные браузеры */
	}
	#bodycontent {
		width:100%;
		height:100%;
		overflow:hidden;
		margin:0px;
		padding:0px;
		font-family:'Open Sans',sans-serif;
		font-size:16px;
	}
	#error{
		padding-top: 15%;
		color: <?php 
			$headertextcolor = get_theme_mod('oknagost_header_textcolor');
			if($headertextcolor){ echo $headertextcolor.';'; } else {echo '#375bff;';}
		?>
	}
	</style>
</head>

<div id="bodycontent">
	<div id="error">
		<center><h1>404 Not Found</h1></center>
	</div>
</div>

<?php 
	require 'theme_contacts.php';
	get_footer(); 
?>
