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
	$headercolor = get_theme_mod('oknagost_header_background');
	$headertextcolor = get_theme_mod('oknagost_header_textcolor');
	$headermenubutton = get_theme_mod('oknagost_header_menubutton');
	$jur = get_theme_mod('oknagost_top_jur'); 
	$unp = get_theme_mod('oknagost_top_unp');
	$tel = get_theme_mod('oknagost_top_tel');
	$email = get_theme_mod('oknagost_top_email');
?>
<a id="contacts"></a>
<hr />
<div class="m-5" style="<?php
	if($headertextcolor){ echo 'color: '.$headertextcolor.';'; }
	?>">
<h3>Контакты </h3>
<?php
	if(!empty($jur))
		echo '<div>'.$jur.'</div>';
	if(!empty($unp))
		echo '<div>УНП '.$unp.'</div>';
	if(!empty($tel))
		echo '<div>Телефон: <a href="tel:'.$tel.'">'.$tel.'</a></div>';
	if(!empty($email))
		echo '<div>EMAIL: <a href="mailto:'.$email.'">'.$email.'</a></div>';
?>
</div>
<script>
	function sendMail(){
		let re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		let st = document.getElementById('statusMessage');
		if(document.getElementById('inputEmail') && document.getElementById('inputEmail').value && re.test(document.getElementById('inputEmail').value)){
			let email = document.getElementById('inputEmail').value;
			let message = document.getElementById('inputText').value;
			let link = <?php echo '"'.get_stylesheet_directory_uri().'/"';?>+"sendmail.php";
			st.innerHTML = 'Отправляется...';
			fetch(link, {
				method: 'POST',
				mode: 'cors',
				cache: 'no-cache',
				credentials: 'same-origin',
				headers: {
					'Content-Type': 'application/json; charset=UTF-8',
				},
				redirect: 'follow',
				referrer: 'no-referrer',
				body: JSON.stringify({message: message+'<br>'+'Обратная связь email: '+email})
			}).then(function(response){
				return response.json();
			}).then(function(answer){
				st.innerHTML = answer.status;
			}).catch(function(error){
				st.innerHTML = error.message;
			});
		} else {
			st.innerHTML = "Некорректный email.";
		}
	}
</script>
<div class="m-5" style="<?php
	if($headertextcolor){ echo 'color: '.$headertextcolor.';'; }
?>>">
	<h3>Отправить сообщение </h3>
	<div class="form-group m-auto">
		<table class="w-100" style="cols:2;<?php 
			if($headertextcolor){ echo 'color: '.$headertextcolor.';'; }
			if($headertextcolor){ echo 'border-color: '.$headertextcolor.';'; }
		?>">
			<tr>
				<td colspan="2">
					<label for="inputEmail">Введите свой email</label>
				</td>
			</tr>
			<tr>
				<td style="width:300px">
					<input type="email" class="form-control" id="inputEmail" placeholder="name@example.com">
				</td>
				<td>
					<button type="submit" class="btn btn-primary ml-5" style="<?php
						if($headertextcolor){ echo 'color: '.$headertextcolor.';'; }
						if($headercolor){ echo 'background-color: '.$headercolor.';'; }
						if($headertextcolor){ echo 'border-color: '.$headertextcolor.';'; }
					?>" onclick="sendMail();">Отправить</button>
				</td>
			</tr>
			<tr>
				<td>
					<text style="font-size:0.7em;" id="statusMessage"></text>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<label for="inputText">Введите сообщение</label>
					<textarea class="form-control" id="inputText" rows="3"></textarea>
				</td>
			</tr>
		</table>
	</div>
</div>