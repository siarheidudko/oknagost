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

header('Content-Type: application/json; charset=utf-8');
try{
	$content = file_get_contents("php://input");
	$json = json_decode($content, TRUE);
	if(isset($json['message'])){
		//подключаю ядро wp
		include '../../../wp-load.php';
		
		$subject = 'Сообщение с сайта oknagost.by';
		$body = $json['message'];
		$headers = array('Content-Type: text/html; charset=UTF-8');
		$to = get_theme_mod('oknagost_top_email');
		if(isset($to)){
			if(wp_mail( $to, $subject, $body, $headers )){
				echo '{"status":"Сообщение отправлено."}';
			} else {
				echo '{"status":"Сообщение не отправлено."}';
			}
		} else {
			echo '{"status":"Не задан email обратной связи в настройках темы."}';
		}
	} else {
		echo '{"status":"Сообщение пустое."}';
	}
} catch (Exception $e) {
	echo '{"status":"'.$e->getMessage().'"}';
}
exit;
?>