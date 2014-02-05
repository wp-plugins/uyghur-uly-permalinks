<?php
/*
Plugin Name: uyghur ULY Permalinks (ئۇيغۇرچە مۇقىم ئۇلانمىلا)
Plugin URI: http://www.almas.biz
Description: بۇ قىستۇرما يازما تىمىسى، سەھىپە، خەتكۈچ قاتارلىقلارنىڭ «مۇقىم ئۇلانمىسى»،ياكى «باشقا نام»نى توشقىزمىسىڭىزمۇ ئاپتۇماتىك ھالدا ULY غا ئايلاندۇرۇپ بىرىدۇ
Author: xirwajim<xirwajim@gmail.com>
Version: 0.2
Author URI: http://APP.almas.biz
*/

define('ULY_PERMALINKS_VERSION', '0.2');

register_activation_hook(__FILE__,'ULYPermalinkActive'); 
register_deactivation_hook( __FILE__, 'ULYPermalinkDeactive' );

add_action('admin_menu', 'setULYPermalinkMenu');
add_filter('sanitize_title', 'getULYPermalink', 1);

function setULYPermalinkMenu() {
	add_options_page('ئۇيغۇرچە  مۇقىم ئۇلانمىلا تەڭشەش', 'ئۇيغۇرچە  مۇقىم ئۇلانمىلا', 'administrator', __FILE__, 'setULYPermalinkOptions');
	add_action( 'admin_init', 'ULYPermalinkRegister' );
}

function ULYPermalinkActive() {
	add_option('ULYPermalink_separator', '_');
	add_option('ULYPermalink_length', 100);
}

function ULYPermalinkDeactive() {
	delete_option('ULYPermalink_separator');
	delete_option('ULYPermalink_length');	
}

function ULYPermalinkRegister() {
	register_setting( 'ULYPermalink_settings', 'ULYPermalink_separator');
	register_setting( 'ULYPermalink_settings', 'ULYPermalink_length');
}

function setULYPermalinkOptions() {

if($_POST['reset_posts_name']){

		reset_posts_name_to_ULY();
	}
if($_POST['reset_pages_name']){

		reset_pages_name_to_ULY();
	}
if($_POST['reset_category_slug']){

		reset_category_slug_to_ULY();
	}
if($_POST['reset_tag_slug']){

		reset_tag_slug_to_ULY();
	}
if($_POST['recover_category_slug']){

		recover_category_slug_to_ULY();
	}
if($_POST['recover_tag_slug']){

		recover_tag_slug_to_ULY();
	}


?>
<?php if ( !empty($_POST['submit'] ) ) : ?>
<div id="message" class="updated"><p><strong><?php _e('يېڭىلاندى。', 'ULY-permalink') ?></strong></p></div>
<?php endif; ?>

<div class="wrap">
<div id="icon-options-general" class="icon32"><br /></div>
<h2>ئۇيغۇرچە  مۇقىم ئۇلانمىلا تەڭشەش</h2>
<p>
ھازىرقى نەشىرى:0.2<br />
تىخىمۇ  كۆپ ئۇچۇرلار <a href="http://www.almas.biz/">بۇ يەردە</a><br /> 
بۇ قىستۇرمىنڭ نورمال ئىشلىشى ئۇچۇن سىز چوقۇم <a href="options-permalink.php">مۇقىم ئۇلانما(permalink)</a> نىڭ ئىچىدىن بەزى تەڭشەشلەرنى ئىلىپ بىرىشىڭىز كىرەك . مەسىلەن /%postname%/ ،/%postname%.html دىگەندەك .يەنى سىز چوقۇم %postname% نى ئىشلىتىشىڭىز كىرەك . بولمىسا بۇ قىستۇرما كۇچكە ئىگە بولمايدۇ .
</p>
<p>بۇ قىستۇرما يازما تىمىسى، سەھىپە، خەتكۈچ قاتارلىقلارنىڭ «مۇقىم ئۇلانمىسى»،ياكى «باشقا نام»نى توشقىزمىسىڭىزمۇ ئاپتۇماتىك ھالدا ULY غا ئايلاندۇرۇپ بىرىدۇ . ھەمدە بۇ بۇندىن كېيىن مەشغۇلاتلارغا كۇچكە ئىگە . بۇندىن بۇرۇنقىنى ئۆزگەرتىش ئۈچۈن قايتىدىن تەھرىرلىشىڭىز كېرەك . بىزمۇ ھەم بۇندىن بۇرۇنقىلىرىنى ئۆزگەرتىشنى تەشەببۇس قىلمايمىز . </p>
 
<p>&nbsp;</p>

<h3 class="title">مۇقىم ئۇلانمىلا قائىدىسى</h3>

<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>

<table  class="form-table">
	<tr valign="top">
		<th scope="row"><label for="ULYPermalink_separator">سۆز ئۇلاش بەلگىسى</label></th>
		<td><select name="ULYPermalink_separator" id="ULYPermalink_separator">
			<option value="-" <?php echo (get_option('ULYPermalink_separator','-') == '-') ? ' selected' : ''; ?>>-</option>
			<option value="_" <?php echo (get_option('ULYPermalink_separator','_') == '_') ? ' selected' : ''; ?>>_</option>
			<option value="" <?php echo (get_option('ULYPermalink_separator','') == '') ? ' selected' : ''; ?>>ئىشلەتمەيمەن</option>
		</select> </td>
	</tr>
 				
	<tr valign="top">
		<th scope="row"><label for="ULYPermalink_length">ئۇزۇنلۇق چەكلىمىسى</label></th>
		<td><input name="ULYPermalink_length" type="text" id="ULYPermalink_length" value="<?php echo get_option('ULYPermalink_length',100); ?>" /> ئىشىپ كەتكەن قىسمىنى ئالمايدۇ</td>
	</tr>
</table>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="ULYPermalink_separator,ULYPermalink_length" />

<p><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></p>

 
</form>
<h3 class="title">توپ ئايلاندۇرۇش</h3>

<form method="post">


		<p class="submit">
         <input type="submit" name="reset_posts_name" value="بارىلىق يازمىلارنى ئايلاندۇرۇش" /> بارىلىق يازمىلارنىڭ باشقا نامىنى ULYغا ئايلاندۇرىدۇ 
       </p>
	   	<p class="submit">
         <input type="submit" name="reset_pages_name" value="بارىلىق بەتلەرنى ئايلاندۇرۇش " /> بارىلىق بەتلەرنىڭ باشقا نامىنى ULYغا ئايلاندۇرىدۇ 
       </p>
	 <p class="submit">
         <input type="submit" name="reset_tag_slug" value="بارىلىق خەتكۈشلەرنى ئايلاندۇرۇش" /> بارىلىق خەتكۈشلەرنىڭ باشقا نامىنى ULYغا ئايلاندۇرىدۇ 
       </p>
	    <p class="submit">
         <input type="submit" name="reset_category_slug" value="بارىلىق سەھىپىلەرنى ئايلاندۇرۇش" />بارىلىق سەھىپىلەرنىڭ باشقا نامىنى ULYغا ئايلاندۇرىدۇ 
       </p>

</form>
</div>

<?php
}

function getULYPermalink($strTitle) {
	$PPS = get_option('ULYPermalink_separator', '_');
	$PPL = get_option('ULYPermalink_length', 100);
	$result=getUyULYStr(trim($strTitle),$PPS);
	if($PPL>0) { $result=substr($result,0,$PPL); }
	return $result;
}


function reset_posts_name_to_ULY(){
    set_time_limit(0);
	global $wpdb;
	$posts = $wpdb->get_results("SELECT ID,post_title,post_name FROM $wpdb->posts WHERE post_status='publish' AND post_type='post' ORDER BY id ASC");
	$i=0;
	foreach ($posts as $post) {
		$new_postname = getULYPermalink($post->post_title);
		$sql = "UPDATE $wpdb->posts SET `post_name` = '{$new_postname}' WHERE id = '$post->ID'";
		$update = $wpdb->query($sql);
		$num += 1;
	}
		echo " <div class=\"updated\"><p>مۇۋاپپىقىيەتلىك بولدى</p></div>";
}

function reset_pages_name_to_ULY(){
    set_time_limit(0);
	global $wpdb;
	$posts = $wpdb->get_results("SELECT ID,post_title,post_name FROM $wpdb->posts WHERE post_status='publish' AND post_type='page' ORDER BY id ASC");
	$i=0;
	foreach ($posts as $post) {
		$new_postname = getULYPermalink($post->post_title);
		$sql = "UPDATE $wpdb->posts SET `post_name` = '{$new_postname}' WHERE id = '$post->ID'";
		$update = $wpdb->query($sql);
		$num += 1;
	}
	echo " <div class=\"updated\"><p>مۇۋاپپىقىيەتلىك بولدى</p></div>";
}

function reset_category_slug_to_ULY(){
    set_time_limit(0);
    $categories = get_terms('category',array(hide_empty=>'0'));
	$num = 0;
	foreach ($categories as $category) {
		wp_update_term($category->term_id, 'category', array('slug' => getULYPermalink($category->name) ) );
		$num += 1;
	}
		echo " <div class=\"updated\"><p>مۇۋاپپىقىيەتلىك بولدى</p></div>";
}

function reset_tag_slug_to_ULY(){
    set_time_limit(0);
    $tags = get_terms('post_tag',array(hide_empty=>'0'));
	$num = 0;
	foreach ($tags as $tag) {
		wp_update_term($tag->term_id, 'post_tag', array('slug' => getULYPermalink($tag->name) ) );
		$num += 1;
	}	echo " <div class=\"updated\"><p>مۇۋاپپىقىيەتلىك بولدى</p></div>";}

function recover_category_slug_to_ULY(){
    set_time_limit(0);
    $categories = get_terms('category',array(hide_empty=>'0'));
	$num = 0;
	foreach ($categories as $category) {
		wp_update_term($category->term_id, 'category', array('slug' => sanitize_title($category->name) ) );
		$num += 1;
	}
		echo " <div class=\"updated\"><p>مۇۋاپپىقىيەتلىك بولدى</p></div>";
}

function recover_tag_slug_to_ULY(){
    set_time_limit(0);
    $tags = get_terms('post_tag',array(hide_empty=>'0'));
	$num = 0;
	foreach ($tags as $tag) {
		wp_update_term($tag->term_id, 'post_tag', array('slug' => sanitize_title($tag->name) ) );
		$num += 1;
	}
	echo " <div class=\"updated\"><p>مۇۋاپپىقىيەتلىك بولدى</p></div>";
}

function getUyULYStr($text,$Space='-'){
		if(!$text)
		{
			return $text;
		}
		 $text = " ".$text;
        $uy = array(" ئا"," ئە"," ئې"," ئى"," ئو"," ئۇ"," ئۆ"," ئۈ","ا","ە","ې","ى","و","ۇ","ۆ","ۈ","ش","ڭ","غ","چ","ب","د","ف","گ","ھ","ج","ك","ل","م","ن","پ","ق","ر","س","ت","ۋ","ي","ز","خ","ژ","،","؟","؛"," ");
        $uly = array(" a"," e"," é"," i"," o"," u"," ö"," ü","a","e","é","i","o","u","ö","ü","sh","ng","gh","ch","b","d","f","g","h","j","k","l","m","n","p","q","r","s","t","w","y","z","x","J",",","?",";","$Space");
        $text = str_replace($uy, $uly, $text);
        return substr($text,1);
	}
?>