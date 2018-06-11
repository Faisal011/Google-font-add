<?php 

if ( ! function_exists( 'stock_crazycafe_google_fonts_url' ) ) :
/**
 * Register Google fonts.
 *
 * @return string Google fonts URL for the theme.
 */
function stock_crazycafe_google_fonts_url() {
    $fonts_url = '';
    $fonts     = array();
	$body_font_varint = cs_get_option('body_font_varint');
	$body_font_varint_procceed = implode(',', $body_font_varint);
    $body_subsets   = ':'.$body_font_varint_procceed.'';
	
	$heading_font_varint = cs_get_option('heading_font_varint');
	$heading_font_varint_procceed = implode(',', $heading_font_varint);
    $heading_subsets = ':'.$heading_font_varint_procceed.'';
	
	$body_font = cs_get_option('body_font')['family'];
	$body_font .= $body_subsets;
	
	$heading_font = cs_get_option('heading_font')['family'];
	$heading_font .= $heading_subsets;

    /* translators: If there are characters in your language that are not supported by this font, translate this to 'off'. Do not translate into your own language. */
    if ( 'off' !== esc_html_x( 'on', 'Karla font: on or off', 'textdomain' ) ) {
        $fonts[] = $body_font;
    }

    /* translators: If there are characters in your language that are not supported by this font, translate this to 'off'. Do not translate into your own language. */
    if ( 'off' !== esc_html_x( 'on', 'Lato font: on or off', 'textdomain' ) ) {
        $fonts[] = $heading_font;
    }

    if ( $fonts ) {
        $fonts_url = add_query_arg( array(
            'family' => urlencode( implode( '|', $fonts ) ),
        ), 'https://fonts.googleapis.com/css' );
		
    }

    return $fonts_url;
}
endif;


/**
 * Enqueue scripts and styles.
 */
function stock_crazycafe_prefix_scripts() {

    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style( 'stock-crazycafe-google-fonts', stock_crazycafe_google_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'stock_crazycafe_prefix_scripts' );

function stock_crazyxcafe_custom_style() {
	wp_enqueue_style(
		'stock-crazycafe-custom-style',
		get_template_directory_uri() . '/assets/css/custom-style.css'
	);
        $body_font = cs_get_option('body_font')['family'];
        $body_font_varint = cs_get_option('body_font')['variant'];
		$heading_font = cs_get_option('heading_font')['family'];
		$heading_font_varint = cs_get_option('heading_font')['variant'];
		$enable_box_layout = cs_get_option('enable_box_layout');
		$body_bg_color = cs_get_option('body_bg_color');
		$body_bg = cs_get_option('body_bg');
		$body_bg_array = wp_get_attachment_image_src($body_bg, 'large', false);
		$body_bg_repeat = cs_get_option('body_bg_repeat');
		$body_bg_scroll = cs_get_option('body_bg_scroll');
		$header_script = cs_get_option('header_script');
		$body_start_script = cs_get_option('body_start_script');
		$footer_bg_color = cs_get_option('footer_bg_color');
		$footer_text_color = cs_get_option('footer_text_color');
		$footer_heading_color = cs_get_option('footer_heading_color');
		
        $custom_css = 'body {font-family: '.$body_font.'; font-weight: '.$body_font_varint.'}
		h1, h2, h3, h4, h5, h6 {font-family: '.$heading_font.'; font-weight: '.$heading_font_varint.'}';
        
		if($enable_box_layout == true) {
			
		
			if(!empty($body_bg_color)) {
				$custom_css .= '
					body {background-color:'.$body_bg_color.'}
				';
			}
			
			
			if(!empty($body_bg)) {
				$custom_css .= '
					body {background-image:'.$body_bg_array[0].'}
				';
			}
			
			
			if(!empty($body_bg_repeat)) {
				$custom_css .= '
					body {background-repeat:url('.$body_bg_repeat.')}
				';
			}
			
			
			if(!empty($body_bg_scroll)) {
				$custom_css .= '
					body {background-attachment:'.$body_bg_scroll.'}
				';
			}
			
			
			if(!empty($footer_bg_color)) {
				$custom_css .= '
					.site-footer {background-color:'.$footer_bg_color.'}
				';
			}
			
			
			if(!empty($footer_text_color)) {
				$custom_css .= '
					.site-footer, .site-footer a {color:'.$footer_text_color.'}
				';
			}
			
			
			if(!empty($footer_heading_color)) {
				$custom_css .= '
					.site-footer h4.widget-title {color:'.$footer_heading_color.'}
				';
			}
			
			if(!empty($theme_color)) {
				$custom_css .= '
					input[type="submit"], button[type="submit"], .stock-cart span, .stock-breadcroum-area, .preloder-wraper, .stock-slide .owl-nav div:hover i.fa, .owl-nav div:hover i.fa, .mainmenu li ul li:hover a, .single-work-box .work-box-bg i.fa:hover, .vc_wp_custommenu li a:before, ul.stock-project-shorting li:before, .stock-cta-box.stock-cta-box-theme-2, .work-box-bg:after, .stock-service-box:hover .stock-service-icon {background-color:'.$theme_color.'}
					
					.mainmenu li:hover > a, a.stock-contact-box:hover i.fa, .stock-cart, .ul.stock-project-shorting-2 li.active, .stock-stat-box h1, .list-box-ul {color: '.$theme_color.'}
				';
			}
			
			if(!empty($theme_secodary_color)) {
				$custom_css .= '
					.site-footer h4.widget-title {color:'.$theme_secodary_color.'}
				';
			}
		}
		
		wp_add_inline_style( 'stock-crazycafe-custom-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'stock_crazyxcafe_custom_style' );

?>