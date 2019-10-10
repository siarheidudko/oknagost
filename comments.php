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
	$headercolor = get_theme_mod('oknagost_header_background');
	$headertextcolor = get_theme_mod('oknagost_header_textcolor');
	$headermenubutton = get_theme_mod('oknagost_header_menubutton');
?>
<?php
	function theme_comment( $comment, $args, $depth ) {
		if('div' === $args['style']){
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		$classes = ' '.comment_class(empty( $args['has_children'])?'':'parent',null,null,false);
		echo '<';
			echo $tag, $classes; 
		echo 'id="comment-'.comment_ID().'">';
		
		if('div' != $args['style']){
			echo '<div id="div-comment-'.comment_ID().'" class="comment-body">';
		}
		echo '<div class="comment-meta commentmetadata" style="font-size:0.7em;">
			<a href="'.htmlspecialchars(get_comment_link($comment->comment_ID)).'">';
				printf(
					__( '%1$s at %2$s' ),
					get_comment_date(),
					get_comment_time()
				);
			echo '</a>';
			edit_comment_link(__( '(Edit)' ),'  ','');
		echo '</div>';
		
		echo '<div class="comment-author vcard">';
			if($args['avatar_size'] != 0){
				echo get_avatar($comment, $args['avatar_size']);
			}
			printf(
				__('<cite class="says"><b>%s</b></cite> <span class="says">:</span>'),
				get_comment_author_link()
			);		
		echo '</div>';
		if($comment->comment_approved == '0'){
			echo '<em class="comment-awaiting-moderation">
				'._e('Ваш комментарий ожидает модерации.').'
			</em><br/>';
		}
		comment_text();
		echo '<div class="reply" style="font-size:0.7em;">';
			comment_reply_link(
				array_merge(
					$args,
					array(
						'add_below' => $add_below,
						'depth'     => $depth,
						'max_depth' => $args['max_depth']
					)
				)
			);
		echo '</div>';
		echo '<hr style="';
			if($headertextcolor){ echo 'color: '.$headertextcolor.';'; }
			if($headertextcolor){ echo 'background-color: '.$headertextcolor.';'; }
		echo '" />';
		if('div' != $args['style']){
			echo '</div>';
		}
	}
	if(have_comments()){
		echo '<div id="comments" class="comments-area border rounded m-5 p-2" style="background-color:#ffffff;">';
			wp_list_comments(array('style' => 'div', 'callback'=>'theme_comment'));
		echo '</div>';
	} 
?>
<div id="addcomment" class="comments-area m-5">
	<?php 
		//см https://wp-kama.ru/function/comment_form
		//Заголовок
		$title_reply = __('Добавить отзыв');
		
		//Поля ввода
		$fields = array(
			'author' => '<p class="comment-form-author" style="width:300px;max-width:75%;">'.'<label for="author">'. __('Ваше имя').'</label> '.($req ? '<span class="required">*</span>' : '').'<input id="author" name="author" type="text" class="form-control" value="'.esc_attr($commenter['comment_author']).'" size="30"'.$aria_req.' /></p>',
			'email'  => '<p class="comment-form-email" style="width:300px;max-width:75%;"><label for="email">'. __('Ваш email').'</label> '.($req ? '<span class="required">*</span>' : '').'<input id="email" name="email" type="text" class="form-control" value="'.esc_attr($commenter['comment_author_email']).'" size="30"'.$aria_req .' /></p>'
		);
		
		//ввод отзыва
		$comment_field = '<p class="comment-form-comment"><textarea id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';
		
		//кнопка отзыва
		$submit_button = '<input name="%1$s" type="submit"  id="%2$s" class="%3$s btn btn-primary" style="';
		if($headertextcolor){ $submit_button = $submit_button.'color: '.$headertextcolor.';'; }
		if($headercolor){ $submit_button = $submit_button.'background-color: '.$headercolor.';'; }
		if($headertextcolor){ $submit_button = $submit_button.'border-color: '.$headertextcolor.';'; }
		$submit_button = $submit_button.'" value="Оставить отзыв">';
		
		comment_form(array('title_reply'=>$title_reply, 'fields'=>$fields, 'comment_field'=>$comment_field, 'submit_button'=>$submit_button)); 
	?>
</div>