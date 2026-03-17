<?php
/**
 * @package 	WordPress
 * @subpackage 	The Newspaper Child
 * @version		1.0.3
 * 
 * Child Theme Functions File
 * Created by CMSMasters
 * 
 */


function the_newspaper_child_enqueue_styles() {
    wp_enqueue_style('the-newspaper-child-style', get_stylesheet_uri(), array(), '1.0.2', 'screen, print');
}

add_action('wp_enqueue_scripts', 'the_newspaper_child_enqueue_styles', 11);


function force_post_layout_settings($post_id) {
    // Only run for standard 'post' type, not pages or projects
    if (get_post_type($post_id) != 'post') {
        return;
    }

    // 1. Force Right Sidebar Layout
    // Key: cmsmasters_layout | Value: r_sidebar
    update_post_meta($post_id, 'cmsmasters_layout', 'r_sidebar');

    // 2. Force the specific "Post Sidebar"
    // Key: cmsmasters_sidebar_id | Value: post-sidebar 
    // Note: Verify 'post-sidebar' matches the ID in Theme Settings > Elements
    update_post_meta($post_id, 'cmsmasters_sidebar_id', 'post-sidebar');
}

// Fire the function whenever a post is created or updated
add_action('save_post', 'force_post_layout_settings');


/**
 * Child Theme Share Button
 */
function the_newspaper_child_share_button() {
	if (!is_singular()) {
		return;
	}
	
	$title = get_the_title();
	$url = get_permalink();
	
	echo '<div class="cmsmasters_child_share_wrap">' . 
		'<button class="cmsmasters_child_share_button" data-title="' . esc_attr($title) . '" data-url="' . esc_url($url) . '">' .
            '<svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m494.533 172.016-115.899-115.899c-9.563-9.563-19.263-14.412-28.829-14.412-13.135 0-28.472 9.99-28.472 38.146v39.457c-84.204 3.67-162.839 38.203-222.815 98.176-63.524 63.52-98.512 147.975-98.518 237.809 0 6.454 4.128 12.186 10.25 14.229 1.563.521 3.163.772 4.748.772 4.627 0 9.106-2.147 11.994-5.991 70.819-94.266 177.439-149.975 294.341-154.373v38.85c0 28.154 15.337 38.146 28.471 38.146h.003c9.565 0 19.265-4.849 28.827-14.411l115.898-115.901c11.265-11.261 17.468-26.283 17.468-42.299 0-16.013-6.203-31.036-17.467-42.299z"/></svg>'.
			'Поделиться' . 
		'</button>' . 
	'</div>';
}

add_action('wp_footer', function() {
	?>
	<script type="text/javascript">
	(function() {
		document.addEventListener('click', function(event) {
			if (event.target.classList.contains('cmsmasters_child_share_button')) {
				const button = event.target;
				const title = button.getAttribute('data-title');
				const url = button.getAttribute('data-url');
				
				if (navigator.share) {
					navigator.share({
						title: title,
						url: url
					}).catch(function(error) {
						console.log('Error sharing', error);
					});
				} else {
					const dummy = document.createElement('input');
					document.body.appendChild(dummy);
					dummy.value = url;
					dummy.select();
					document.execCommand('copy');
					document.body.removeChild(dummy);
					alert('Ссылка скопирована в буфер обмена');
				}
			}
		});
	})();
	</script>
	<?php
});


/**
 * Change 'By' to SVG icon
 */
add_filter('gettext', function($translated_text, $text, $domain) {
	if ($domain === 'the-newspaper' && $text === 'By') {
		return 'THE_NEWSPAPER_AUTHOR_SVG_ICON';
	}
	
	return $translated_text;
}, 20, 3);


add_filter('pre_kses', function($string) {
	$svg = '<svg fill="none" height="32" viewBox="0 0 32 32" width="32" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="m13.5 15c2.7614 0 5-2.2386 5-5 0-2.76142-2.2386-5-5-5s-5 2.23858-5 5c0 2.7614 2.2386 5 5 5zm0 2c1.1101 0 2.1085.0508 3 .1345v4.8655c0 1.593 1.2417 2.8961 2.81 2.9941-1.0288.6377-2.2422 1.0059-3.5417 1.0059h-4.5366c-3.71782 0-6.7317-3.0139-6.7317-6.7317 0-.3923.20566-.7527.56615-.9075 1.08579-.4663 3.77582-1.3608 8.43385-1.3608zm14.0452-1.2175c.0997-.3396.0156-.7217-.2523-.9896l-1.0858-1.0858c-.2679-.2679-.65-.352-.9896-.2523-.1555.0456-.302.1297-.4246.2523l-.7929.7929 1.1314 1.1314.2372.2372 1.1314 1.1314.7929-.7929c.1226-.1226.2067-.2691.2523-.4246zm-5.9594 1.1317-3.0858 3.0858v2.4861.0139h.0174 2.4826l3.0858-3.0858 1.4142-1.4142-1.0858-1.0858-.3284-.3284-1.0858-1.0858z" fill="#000" fill-rule="evenodd"/></svg>';
	
	return str_replace('THE_NEWSPAPER_AUTHOR_SVG_ICON', $svg, $string);
}, 20);


add_filter('wp_kses_allowed_html', function($tags, $context) {
	if ($context === 'post') {
		$tags['svg'] = array( 
			'fill' => true, 
			'height' => true, 
			'viewbox' => true, 
			'width' => true, 
			'xmlns' => true 
		);
		
		$tags['path'] = array( 
			'clip-rule' => true, 
			'd' => true, 
			'fill' => true, 
			'fill-rule' => true 
		);
	}
	
	return $tags;
}, 10, 2);

?>