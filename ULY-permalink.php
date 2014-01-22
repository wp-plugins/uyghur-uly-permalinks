<?php
/*
Plugin Name: uyghur ULY Permalinks (ئۇيغۇرچە مۇقىم ئۇلانمىلا)
Plugin URI: http://www.almas.biz
Description: بۇ قىستۇرما يازما تىمىسى، سەھىپە، خەتكۈچ قاتارلىقلارنىڭ «مۇقىم ئۇلانمىسى»،ياكى «باشقا نام»نى توشقىزمىسىڭىزمۇ ئاپتۇماتىك ھالدا ULY غا ئايلاندۇرۇپ بىرىدۇ
Author: xirwajim<xirwajim@gmail.com>
Version: 0.1
Author URI: http://www.almas.biz
*/

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
?>
<div class="wrap">
<div id="icon-options-general" class="icon32"><br /></div>
<h2>ئۇيغۇرچە  مۇقىم ئۇلانمىلا تەڭشەش</h2>
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

</div>
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