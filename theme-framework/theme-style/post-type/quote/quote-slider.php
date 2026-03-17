<?php
/**
 * @package 	WordPress
 * @subpackage 	The Newspaper
 * @version		1.0.3
 * 
 * Quote Slider Template
 * Created by CMSMasters
 * 
 */


?>
<!-- Start Quote Slider Article -->
<article class="cmsmasters_quote_inner">
<?php 
	if ($quote_name != '' || $quote_subtitle != '' || $quote_website != '' || $quote_link != '') {
		echo '<header class="cmsmasters_quote_header">' . 
			
			($quote_name != '' ? '<span class="cmsmasters_quote_title">' . '<svg fill="none" height="32" viewBox="0 0 32 32" width="32" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="m13.5 15c2.7614 0 5-2.2386 5-5 0-2.76142-2.2386-5-5-5s-5 2.23858-5 5c0 2.7614 2.2386 5 5 5zm0 2c1.1101 0 2.1085.0508 3 .1345v4.8655c0 1.593 1.2417 2.8961 2.81 2.9941-1.0288.6377-2.2422 1.0059-3.5417 1.0059h-4.5366c-3.71782 0-6.7317-3.0139-6.7317-6.7317 0-.3923.20566-.7527.56615-.9075 1.08579-.4663 3.77582-1.3608 8.43385-1.3608zm14.0452-1.2175c.0997-.3396.0156-.7217-.2523-.9896l-1.0858-1.0858c-.2679-.2679-.65-.352-.9896-.2523-.1555.0456-.302.1297-.4246.2523l-.7929.7929 1.1314 1.1314.2372.2372 1.1314 1.1314.7929-.7929c.1226-.1226.2067-.2691.2523-.4246zm-5.9594 1.1317-3.0858 3.0858v2.4861.0139h.0174 2.4826l3.0858-3.0858 1.4142-1.4142-1.0858-1.0858-.3284-.3284-1.0858-1.0858z" fill="#000" fill-rule="evenodd"/></svg>' . ' ' . esc_html($quote_name) . '</span>' : '') . 
			
			($quote_subtitle != '' ? '<span class="cmsmasters_quote_subtitle">' . esc_html($quote_subtitle) . '</span>' : '');
			
			if ($quote_website != '' || $quote_link != '') {
				echo '<span class="cmsmasters_quote_site">' . 
					($quote_link != '' ? '<a href="' . esc_url($quote_link) . '" target="_blank">' : '') . 
					
					($quote_website != '' ? esc_html($quote_website) : esc_html($quote_link)) . 
					
					($quote_link != '' ? '</a>' : '') . 
				'</span>';
			}
			
		echo '</header>';
	}
	
	
	echo cmsmasters_divpdel('<div class="cmsmasters_quote_content">' . 
		do_shortcode(wpautop(wp_kses(stripslashes($quote_content), 'post'))) . 
	'</div>');
	
	
	echo '<figure class="cmsmasters_quote_image">';
		if ($quote_image != '') {
			echo wp_get_attachment_image(strstr($quote_image, '|', true), 'cmsmasters-small-thumb');
		}
	echo '</figure>';
?>
</article>
<!-- Finish Quote Slider Article -->

