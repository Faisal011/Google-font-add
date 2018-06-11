<?php 

if ( ! defined( 'ABSPATH' ) ) { die; } 

function _stock_theme_metabox_page($options){
	 $options      = array(); 
$options[]    = array(
  'id'        => 'stock_page_options',
  'title'     => 'stock Page Options',
  'post_type' => 'page',
  'context'   => 'normal',
  'priority'  => 'high',
  'sections'  => array(
    array(
      'name'  => 'stock_page_options_meta',
      'icon'  => 'fa fa-cog',
      'fields' => array(
        array(
          'id'    => 'ebale_title',
          'type'  => 'switcher',
          'title' => 'Enable title',
          'default'    => true,
          'desc' => esc_html__('If you want title enable', 'stock-crazycafe'),
        ),
        array(
          'id'    => 'custom_title',
          'type'  => 'text',
          'title' => 'Custom Title',
          'dependency'   => array( 'ebale_title', '==', 'true' ),
          'desc' => esc_html__('If you want title content', 'stock-crazycafe'),
        ),
      ), 
    ), 
  ),
);
// Slide Metabox Options   

$options[]    = array(
  'id'        => 'stock_slide_options',
  'title'     => 'stock Slide Options',
  'post_type' => 'slide',
  'context'   => 'normal',
  'priority'  => 'high',
  'sections'  => array(

    // begin: a section
    array(
      'name'  => 'stock_slide_options_meta',

      // begin: fields
      'fields' => array(

      array(
		  'id'              => 'button',
		  'type'            => 'group',
		  'title'           => 'slide button',
		  'button_title'    => 'Add New',
		  'accordion_title' => 'Add New button',
		  'fields'          => array(
				array(
					'id'    => 'type',
					'type'  => 'select',
					'title' => 'button type',
					'options'        	=> array(
					'borded'       	=> 'Borded button',
					'boxed'     	=> 'Mercedes',
					),
				),
			array(
			  'id'    => 'text',
			  'type'  => 'text',
			  'title' => 'Button text',
			  'default' => 'Get a free consalt',
			),
			array(
			  'id'    => 'link_type',
			  'type'  => 'select',
			  'title' => 'Link type',
			  'options'        	=> array(
				'1'       	=> 'WordPress page',
				'2'     	=> 'Extarnal link',
			  ),
			),
			array(
			  'id'    => 'link_to_page',
			  'type'  => 'select',
			  'title' => 'Select page',
			  'options'    => 'page',
				'dependency'   => array( 'link_type', '==', '1' ),
			),
			array(
			  'id'    => 'link_to_extarnal',
			  'type'  => 'text',
			  'title' => 'type url',
				'dependency'   => array( 'link_type', '==', '2' ),
			),
		  ),
		),
		array(
		  'id'      => 'enable_overlay',
		  'type'    => 'switcher',
		  'title'   => 'Enable Overlay',
		  'default' => true
		),
		
		array(
		  'id'      => 'overlay_percentiz', // another unique id
		  'type'    => 'text',
		  'title'   => 'Overlay Percentiz',
		  'desc'    => 'This is an option',
		  'default' => '.7',
		    'dependency'   => array( 'enable_overlay', '==', 'true' ),
		),
		
		array(
		  'id'      => 'overlay_color',
		  'type'    => 'color_picker',
		  'title'   => 'Overlay color',
		  'default' => '#ffbc00',
		  'dependency'   => array( 'enable_overlay', '==', 'true' ),
		),
      ),
    ), 
  ),
);

  return $options;
}

add_filter( 'cs_metabox_options', '_stock_theme_metabox_page' );

function stock_theme_options($options) {
	$options      = array(); // remove old options

  $options[]    = array(
    'name'      => 'stock_crazycafe_header_settings',
    'title'     => 'First Section',
    'icon'      => 'fa fa-heart',
    'fields'    => array(
      array(
		  'id'              => 'header_icon_box',
		  'type'            => 'group',
		  'title'           => 'Header icon',
		  'button_title'    => 'Add New',
		  'accordion_title' => 'Add New Field',
		  'fields'          => array(
			array(
			  'id'    => 'title',
			  'type'  => 'text',
			  'title' => 'Title',
			),
			array(
			  'id'    => 'icon',
			  'type'  => 'icon',
			  'title' => 'Box Icon',
			),
			array(
			  'id'    => 'big_title',
			  'type'  => 'text',
			  'title' => 'big-title',
			),
			array(
			  'id'    => 'link',
			  'type'  => 'text',
			  'title' => 'Box Link',
			),
		  ),
		),
	)
  );

  $options[]    = array(
    'name'      => 'stock_crazycafe_logo_settings',
    'title'     => 'Logo Section',
    'icon'      => 'fa fa-heart',
    'fields'    => array(
      array(
		  'id'      => 'enable_image_logo',
		  'type'    => 'switcher',
		  'title'   => 'Enable Image Logo',
		  'default' => false
		),
      array(
		  'id'      => 'image_logo',
		  'type'    => 'image',
		  'title'   => 'Image Logo',
		  'dependency'   => array( 'enable_image_logo', '==', 'true' ),
		),
      array(
		  'id'      => 'logo_text',
		  'type'    => 'text',
		  'title'   => 'Logo Text',
		  'default' => 'stock',
		  'dependency'   => array( 'enable_image_logo', '==', 'false' ),
		),
      array(
		  'id'      => 'logo_max_height',
		  'type'    => 'text',
		  'title'   => 'Logo max height',
		  'default'		=>	'100',
		  'dependency'   => array( 'enable_image_logo', '==', 'true' ),
		),
	)
  );

  $options[]    = array(
    'name'      => 'stock_crazycafe_typography_settings',
    'title'     => 'Typography Section',
    'icon'      => 'fa fa-heart',
    'fields'    => array(
      array(
		  'id'        => 'body_font',
		  'type'      => 'typography',
		  'title'     => 'Body Font',
		  'default'   => array(
			'family'  => 'Roboto',
			'variant' => 'regular',
			'font'    => 'google', // this is helper for output
		  ),
		),
      array(
		  'id'       => 'body_font_varint',
		  'type'     => 'checkbox',
		  'title'    => 'Body Font Type',
		  'options'  => array(
			'100'  => '100',
			'100i'   => '100i',
			'200' => '200',
			'200i'    => '200i',
			'300'  => '300',
			'300i'  => '300i',
			'400'  => '400',
			'400i'  => '400i',
			'500'  => '500',
			'500i'  => '500i',
			'700'  => '700',
			'700i'  => '700i',
			'900'  => '900',
			'900i'  => '900i',
		  ),
		  'default'  => array( '400', '400i', '700','700i' )
		),
      array(
		  'id'        => 'heading_font',
		  'type'      => 'typography',
		  'title'     => 'Heading Font',
		  'default'   => array(
			'family'  => 'Noto Serif',
			'variant' => '700',
			'font'    => 'google', // this is helper for output
		  ),
		),
		
		array(
		  'id'       => 'heading_font_varint',
		  'type'     => 'checkbox',
		  'title'    => 'heading Font Type',
		  'options'  => array(
			'100'  => '100',
			'100i'   => '100i',
			'200' => '200',
			'200i'    => '200i',
			'300'  => '300',
			'300i'  => '300i',
			'400'  => '400',
			'400i'  => '400i',
			'500'  => '500',
			'500i'  => '500i',
			'700'  => '700',
			'700i'  => '700i',
			'900'  => '900',
			'900i'  => '900i',
		  ),
		  'default'  => array( '400', '400i', '700','700i' )
		),
	)
  );

  $options[]    = array(
    'name'      => 'stock_crazycafe_styleing_settings',
    'title'     => 'Styleing Section',
    'icon'      => 'fa fa-heart',
    'fields'    => array(
	array(
		  'id'      => 'theme_color',
		  'type'    => 'color_picker',
		  'title'   => 'Theme Color',
		  'default' => '#1e73be',
		),
		
	  array(
		  'id'      => 'theme_secodary_color',
		  'type'    => 'color_picker',
		  'title'   => 'Theme Secondary Color',
		  'default' => '#eeee22',
		),
      array(
		  'id'      => 'enable_preloder',
		  'type'    => 'switcher',
		  'title'   => 'Enable Pleloder',
		  'default' => true
		),
      array(
		  'id'      => 'enable_box_layout',
		  'type'    => 'switcher',
		  'title'   => 'Enable Box Layout',
		  'default' => false
		),
      array(
		  'id'    => 'body_bg_color',
		  'type'  => 'color_picker',
		  'title' => 'Body Background Color',
		  'dependency'   => array( 'enable_box_layout', '==', 'true' ),
		),
      array(
		  'id'    => 'body_bg',
		  'type'  => 'image',
		  'title' => 'Body Background Image',
		  'dependency'   => array( 'enable_box_layout', '==', 'true' ),
		),
      array(
		  'id'             => 'body_bg_repeat',
		  'type'           => 'select',
		  'title'          => 'Body Background Repeat',
		  'default'			=> 'repeat',
		  'options'        => array(
			'repeat'          => 'Repeat',
			'no-repeat'     => 'No Repeat',
			'cover'         => 'Cover',
		  ),
		  'dependency'   => array( 'enable_box_layout', '==', 'true' ),
		),
      array(
		  'id'             => 'body_bg_scroll',
		  'type'           => 'select',
		  'title'          => 'Body Background scroll',
		  'default'			=> 'scroll',
		  'options'        => array(
			'scroll'        	=> 'Scroll',
			'fixx'     			=> 'Fixx',
		  ),
		  'dependency'   => array( 'enable_box_layout', '==', 'true' ),
		),
	)
  );

  $options[]    = array(
    'name'      => 'stock_crazycafe_blog_settings',
    'title'     => 'Blog Section',
    'icon'      => 'fa fa-heart',
    'fields'    => array(
      array(
		  'id'      => 'post_by',
		  'type'    => 'switcher',
		  'title'   => 'Display Post By',
		  'default' => true
		),
      array(
		  'id'      => 'post_date',
		  'type'    => 'switcher',
		  'title'   => 'Post Date',
		  'default' => true
		),
      array(
		  'id'      => 'display_comment',
		  'type'    => 'switcher',
		  'title'   => 'Display Comment Cout',
		  'default' => true
		),
      array(
		  'id'      => 'display_post_in_catagory',
		  'type'    => 'switcher',
		  'title'   => 'Display Post In Catagory',
		  'default' => true
		),
      array(
		  'id'      => 'display_post_in_tag',
		  'type'    => 'switcher',
		  'title'   => 'Display Post In Tag',
		  'default' => true
		),
      array(
		  'id'      => 'enable_next_link',
		  'type'    => 'switcher',
		  'title'   => 'Enable Next Previous Link On Single Post',
		  'default' => true
		),
	)
  );

  $options[]    = array(
    'name'      => 'stock_crazycafe_footer_settings',
    'title'     => 'Footer Section',
    'icon'      => 'fa fa-heart',
    'fields'    => array(
      array(
		  'id'      => 'footer_bg_color',
		  'type'    => 'color_picker',
		  'title'   => 'Footer Background',
		  'default' => '#222222',
		),
      array(
		  'id'      => 'footer_text_color',
		  'type'    => 'color_picker',
		  'title'   => 'Footer Text Color',
		  'default' => '#ffffff',
		),
      array(
		  'id'      => 'footer_heading_color',
		  'type'    => 'color_picker',
		  'title'   => 'Footer Heading Color',
		  'default' => '#f1F1F1',
		),
      array(
		  'id'      => 'footer_copyright',
		  'type'    => 'textarea',
		  'title'   => 'Footer CopyRight Area',
		  'default' => 'Copyright 2017 all right received',
		),
	)
  );
  
   $options[]    = array(
    'name'      => 'stock_crazycafe_socail_settings',
    'title'     => 'Socail Link',
    'icon'      => 'fa fa-heart',
    'fields'    => array(
      array(
		  'id'              => 'socail_link',
		  'type'            => 'group',
		  'title'           => 'Socail Link',
		  'button_title'    => 'Add New',
		  'accordion_title' => 'Add New Field',
		  'fields'          => array(
			array(
			  'id'    => 'socail_links',
			  'type'  => 'text',
			  'title' => 'Socail Link',
			),
			array(
			  'id'    => 'socail_Icon',
			  'type'  => 'icon',
			  'title' => 'Socail Icon',
			),
		  ),
		),
	)
  );
  
   $options[]    = array(
    'name'      => 'stock_crazycafe_script_settings',
    'title'     => 'Script Section',
    'icon'      => 'fa fa-heart',
    'fields'    => array(
      array(
		  'id'      => 'header_script',
		  'type'    => 'textarea',
		  'sanitize' => false,
		  'title'   => 'Header Script',
		  'desc'	=> 'Script gose before closing </head>'
		),
      array(
		  'id'      => 'body_start_script',
		  'type'    => 'textarea',
		  'sanitize' => false,
		  'title'   => 'Body Script',
		  'desc'	=> 'Script gose after closing <body>'
		),
      array(
		  'id'      => 'body_end_script',
		  'type'    => 'textarea',
		  'sanitize' => false,
		  'title'   => 'Footer Script',
		  'desc'	=> 'Script gose after closing </body>'
		),
	)
  );

  return $options;
}

add_filter( 'cs_framework_options', 'stock_theme_options' );

function stock_theme_options_setting($settings) {
	$settings           = array(
	  'menu_title'      => 'Theme Options',
	  'menu_type'       => 'theme', // menu, submenu, options, theme, etc.
	  'menu_slug'       => 'stock-theme-options',
	  'ajax_save'       => true,
	  'show_reset_all'  => true,
	  'framework_title' => 'Stock <small>by Codestar</small>',
	);
	
	return $settings;
}

add_filter( 'cs_framework_settings', 'stock_theme_options_setting' );

?>