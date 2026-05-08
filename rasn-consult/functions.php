<?php
/**
 * RASN Consult functions and definitions
 *
 * @package RASN_Consult
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Enqueue scripts and styles.
 */
function rasn_consult_scripts() {
	// Enqueue Bootstrap CSS
	wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3' );
	// Enqueue Theme Style
	wp_enqueue_style( 'rasn-consult-style', get_stylesheet_uri(), array('bootstrap-css'), '1.0.0' );
	// Enqueue Inter Font
	wp_enqueue_style( 'inter-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap', array(), null );

	// Enqueue Slick Slider CSS
	wp_enqueue_style('slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
	wp_enqueue_style('slick-theme-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css');

	// Enqueue FontAwesome
	wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');

	// Enqueue AOS CSS
	wp_enqueue_style('aos-css', 'https://unpkg.com/aos@2.3.1/dist/aos.css', array(), '2.3.1');

	// Enqueue Bootstrap Bundle JS
	wp_enqueue_script( 'bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), '5.3.3', true );
	// Enqueue Theme JS
	wp_enqueue_script('rasn-script', get_stylesheet_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0', true);
	// Enqueue Slick Slider JS
	wp_enqueue_script('slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '1.8.1', true);

	// Enqueue AOS JS
	wp_enqueue_script('aos-js', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), '2.3.1', true);
}
add_action( 'wp_enqueue_scripts', 'rasn_consult_scripts' );

/**
 * Register Theme Features
 */
function rasn_consult_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'rasn-consult' ),
		)
	);
}
add_action( 'after_setup_theme', 'rasn_consult_setup' );

/**
 * ACF Field Group: Page Header Options (per-page transparent header toggle)
 */
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key'   => 'group_page_header_options',
	'title' => 'Header Options',
	'fields' => array(
		array(
			'key'           => 'field_transparent_header',
			'label'         => 'Transparent Header',
			'name'          => 'transparent_header',
			'type'          => 'true_false',
			'instructions'  => 'Enable to make the header transparent over the page content.',
			'default_value' => 0,
			'ui'            => 1,
			'ui_on_text'    => 'Yes',
			'ui_off_text'   => 'No',
		),
		array(
			'key' => 'field_page_menu',
			'label' => 'Right Page Menu',
			'name' => 'page_menu',
			'type' => 'select',
			'instructions' => 'Select a menu for this page.',
			'choices' => array(),
			'return_format' => 'value',
			'ui' => 1,
            'allow_null' => true
		),
        array(
            'key' => 'field_header_button_style',
            'label' => 'Header Button Style',
            'name' => 'header_button_style',
            'type' => 'select',
            'instructions' => '',
            'choices' => array(
                'primary' => 'Blue Color',
                'secondary' => 'Green',
                'third' => 'Red'
            ),
            'return_format' => 'value',
            'ui' => 1,
            'default' => 'primary'
        )

	),
	'location' => array(
		array(
			array(
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => 'page',
			),
		),
	),
	'position'      => 'side',
	'style'         => 'default',
	'label_placement' => 'top',
));

endif;

/**
 * Register ACF Local Field Group for Flexible Layouts
 */
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_rasn_layouts',
	'title' => 'Page Layouts',
	'fields' => array(
		array(
			'key' => 'field_flexible_content',
			'label' => 'Flexible Content',
			'name' => 'flexible_content',
			'type' => 'flexible_content',
			'instructions' => 'Add layouts to build the page content.',
			'layouts' => array(
				// Layout: Hero
				'layout_hero' => array(
					'key' => 'layout_hero',
					'name' => 'hero',
					'label' => 'Hero',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_01',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_01',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
						array(
							'key' => 'field_hero_bg',
							'label' => 'Background Image',
							'name' => 'background_image',
							'type' => 'image',
							'return_format' => 'url',
							'preview_size' => 'medium',
						),
						array(
							'key' => 'field_hero_title',
							'label' => 'Title',
							'name' => 'title',
							'type' => 'textarea',
							'new_lines' => 'br',
						),
						array(
							'key' => 'field_hero_subtitle',
							'label' => 'Subtitle',
							'name' => 'subtitle',
							'type' => 'textarea',
							'new_lines' => 'br',
						),
						array(
							'key' => 'field_hero_cta_text',
							'label' => 'CTA Text',
							'name' => 'cta_text',
							'type' => 'text',
						),
						array(
							'key' => 'field_hero_cta_link',
							'label' => 'CTA Link',
							'name' => 'cta_link',
							'type' => 'link',
						),
					),
				),
				// Layout: About
				'layout_about' => array(
					'key' => 'layout_about',
					'name' => 'about',
					'label' => 'About Section',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_02',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_02',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
						array(
							'key' => 'field_about_tagline',
							'label' => 'Tagline',
							'name' => 'tagline',
							'type' => 'text',
						),
						array(
							'key' => 'field_about_work_title',
							'label' => 'We Work With Title',
							'name' => 'work_title',
							'type' => 'text',
						),
						array(
							'key' => 'field_about_work_list',
							'label' => 'We Work With List',
							'name' => 'work_list',
							'type' => 'repeater',
							'button_label' => 'Add Item',
							'layout' => 'table',
							'sub_fields' => array(
								array(
									'key' => 'field_about_work_item',
									'label' => 'Item',
									'name' => 'item',
									'type' => 'text',
								),
							),
						),
						array(
							'key' => 'field_about_description',
							'label' => 'Description',
							'name' => 'description',
							'type' => 'textarea',
							'new_lines' => 'br',
						),
						array(
							'key' => 'field_about_why_title',
							'label' => 'Why Choose Title',
							'name' => 'why_title',
							'type' => 'textarea',
							'new_lines' => 'br',
						),
						array(
							'key' => 'field_about_why_body',
							'label' => 'Why Choose Body',
							'name' => 'why_body',
							'type' => 'textarea',
							'new_lines' => 'br',
						),
						array(
							'key' => 'field_about_why_links',
							'label' => 'Why Choose Links',
							'name' => 'why_links',
							'type' => 'repeater',
							'button_label' => 'Add Link',
							'layout' => 'table',
							'sub_fields' => array(
								array(
									'key' => 'field_about_why_link',
									'label' => 'Link Object',
									'name' => 'link_object',
									'type' => 'link',
								),
							),
						),
						array(
							'key' => 'field_about_image',
							'label' => 'Image',
							'name' => 'image',
							'type' => 'image',
							'return_format' => 'url',
							'preview_size' => 'medium',
						),
					),
				),
				// Layout: Services
				'layout_services' => array(
					'key' => 'layout_services',
					'name' => 'services',
					'label' => 'Services Section',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_03',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_03',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
						array(
							'key' => 'field_services_title',
							'label' => 'Section Title',
							'name' => 'title',
							'type' => 'text',
							'default_value' => 'Services Offerings',
						),
						array(
							'key' => 'field_services_rows',
							'label' => 'Service Rows',
							'name' => 'service_rows',
							'type' => 'repeater',
							'button_label' => 'Add Row',
							'layout' => 'block',
							'sub_fields' => array(
								array(
									'key' => 'field_services_row_layout',
									'label' => 'Row Layout Style',
									'name' => 'row_layout',
									'type' => 'select',
									'choices' => array(
										'1_2' => 'Left Box (col-4) + Right Spanning Box (col-8)',
										'2_1' => 'Left Spanning Box (col-8) + Right Box (col-4)',
									),
									'default_value' => '1_2',
								),
								array(
									'key' => 'field_services_items',
									'label' => 'Services in this Row',
									'name' => 'services',
									'type' => 'repeater',
									'button_label' => 'Add Service',
									'layout' => 'row',
									'max' => 2, // Ensure structural match constraints
									'sub_fields' => array(
										array(
											'key' => 'field_service_number',
											'label' => 'Number (e.g. 01.)',
											'name' => 'number',
											'type' => 'text',
											'wrapper' => array('width' => '15'),
										),
										array(
											'key' => 'field_service_name',
											'label' => 'Service Name',
											'name' => 'name',
											'type' => 'text',
											'wrapper' => array('width' => '35'),
										),
										array(
											'key' => 'field_service_body',
											'label' => 'Description',
											'name' => 'body',
											'type' => 'textarea',
											'rows' => 3,
											'wrapper' => array('width' => '50'),
										),
										array(
											'key' => 'field_service_image',
											'label' => 'Service Image',
											'name' => 'image',
											'type' => 'image',
											'return_format' => 'url',
											'wrapper' => array('width' => '50'),
										),
										array(
											'key' => 'field_service_link',
											'label' => 'Service Link',
											'name' => 'link',
											'type' => 'link',
											'wrapper' => array('width' => '50'),
										),
									),
								),
							),
						),
					),
				),
                // Layout: Services V2
                'layout_services_v2' => array(
                    'key' => 'layout_services_v2',
                    'name' => 'services_v2',
                    'label' => 'Services Section V2',
                    'display' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_31',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_31',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
                    ),
                ),
				// Layout: Consulting Section
				'layout_consulting' => array(
					'key' => 'layout_consulting',
					'name' => 'consulting',
					'label' => 'Consulting Section',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_04',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_04',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
						array(
							'key' => 'field_consulting_title',
							'label' => 'Title',
							'name' => 'title',
							'type' => 'text',
							'default_value' => 'Digital Consulting For Growing Your Goals',
						),
						array(
							'key' => 'field_consulting_subtitle',
							'label' => 'Subtitle',
							'name' => 'subtitle',
							'type' => 'textarea',
							'rows' => 3,
							'default_value' => 'We help clients develop a digital strategy so they know what they need to do and why they need to do it.',
						),
						array(
							'key' => 'field_consulting_btn_text',
							'label' => 'Button Text',
							'name' => 'button_text',
							'type' => 'text',
							'default_value' => 'Know More',
						),
						array(
							'key' => 'field_consulting_btn_link',
							'label' => 'Button Link',
							'name' => 'button_link',
							'type' => 'link',
						),
						array(
							'key' => 'field_consulting_image',
							'label' => 'Mockup Image',
							'name' => 'image',
							'type' => 'image',
							'return_format' => 'url',
							'preview_size' => 'medium',
						),
					),
				),
				// Layout: 2 Columns Section
				'layout_2_columns' => array(
					'key' => 'layout_2_columns',
					'name' => '2_columns',
					'label' => '2 Columns',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_05',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_05',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
						array(
							'key' => 'field_2_cols_title',
							'label' => 'Title',
							'name' => 'title',
							'type' => 'text',
						),
						array(
							'key' => 'field_2_cols_background_color',
							'label' => 'BackgroundColor',
							'name' => 'background_color',
							'type' => 'color_picker',
							'default_value' => '#ffffff',
						),
						array(
							'key' => 'field_2_cols_image_position',
							'label' => 'Image Position',
							'name' => 'image_position',
							'type' => 'true_false',
							'default_value' => 1,
                            'ui_on_text' => 'Left',
                            'ui_off_text' => 'Right',
                            'ui' => 1,
						),
						array(
							'key' => 'field_2_cols_image',
							'label' => 'Image',
							'name' => 'image',
							'type' => 'image',
							'return_format' => 'url',
						),
						array(
							'key' => 'field_2_cols_content',
							'label' => 'Content',
							'name' => 'content',
							'type' => 'wysiwyg',
						),
						array(
							'key' => 'field_2_cols_buttons',
							'label' => 'Buttons',
							'name' => 'buttons',
							'type' => 'repeater',
							'layout' => 'table',
							'button_label' => 'Add Button',
							'sub_fields' => array(
								array(
									'key' => 'field_2_cols_button_link',
									'label' => 'Link',
									'name' => 'link',
									'type' => 'link',
								),
							),
						),
					),
				),
				// Layout: Testimonials Section
				'layout_testimonials' => array(
					'key' => 'layout_testimonials',
					'name' => 'testimonials',
					'label' => 'Testimonials Section',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_06',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_06',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
						array(
							'key' => 'field_testi_title',
							'label' => 'Section Title',
							'name' => 'title',
							'type' => 'text',
							'default_value' => 'Proven Results, Delighted Clients',
						),
						array(
							'key' => 'field_testi_lead',
							'label' => 'Lead Text (Subtitle)',
							'name' => 'lead_text',
							'type' => 'textarea',
							'rows' => 3,
						),
						array(
							'key' => 'field_testi_btn_text',
							'label' => 'CTA Button Text',
							'name' => 'button_text',
							'type' => 'text',
							'default_value' => 'Start Your Success Story',
						),
						array(
							'key' => 'field_testi_btn_link',
							'label' => 'CTA Button Link',
							'name' => 'button_link',
							'type' => 'link',
						),
						array(
							'key' => 'field_testi_slides',
							'label' => 'Testimonial Slides',
							'name' => 'slides',
							'type' => 'repeater',
							'layout' => 'block',
							'button_label' => 'Add Testimonial',
							'sub_fields' => array(
								array(
									'key' => 'field_testi_avatar',
									'label' => 'Avatar Image',
									'name' => 'avatar',
									'type' => 'image',
									'return_format' => 'url',
								),
								array(
									'key' => 'field_testi_quote',
									'label' => 'Quote Text',
									'name' => 'quote',
									'type' => 'textarea',
									'rows' => 4,
								),
								array(
									'key' => 'field_testi_name',
									'label' => 'Author Name',
									'name' => 'name',
									'type' => 'text',
								),
							),
						),
					),
				),
				// Layout: Clients Section
				'layout_clients' => array(
					'key' => 'layout_clients',
					'name' => 'clients',
					'label' => 'Clients Section',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_07',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_07',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
						array(
							'key' => 'field_client_title',
							'label' => 'Section Title',
							'name' => 'title',
							'type' => 'text',
							'default_value' => 'Our Clients',
						),
						array(
							'key' => 'field_client_lead',
							'label' => 'Lead Text',
							'name' => 'lead_text',
							'type' => 'textarea',
							'rows' => 3,
						),
						array(
							'key' => 'field_client_btn_text',
							'label' => 'CTA Button Text',
							'name' => 'button_text',
							'type' => 'text',
							'default_value' => 'Join Industry Leaders',
						),
						array(
							'key' => 'field_client_btn_link',
							'label' => 'CTA Button Link',
							'name' => 'button_link',
							'type' => 'link',
						),
						array(
							'key' => 'field_client_stats',
							'label' => 'Stats Bullets',
							'name' => 'stats',
							'type' => 'repeater',
							'layout' => 'table',
							'button_label' => 'Add Stat',
							'sub_fields' => array(
								array(
									'key' => 'field_client_stat_text',
									'label' => 'Stat Text',
									'name' => 'stat_text',
									'type' => 'text',
								),
							),
						),
						array(
							'key' => 'field_client_logos',
							'label' => 'Client Logos',
							'name' => 'logos',
							'type' => 'gallery',
							'return_format' => 'url',
							'insert' => 'append',
						),
					),
				),
                // Layout: Clients V2 Section
                'layout_clients_v2' => array(
                    'key' => 'layout_clients_v2',
                    'name' => 'clients_v2',
                    'label' => 'Clients V2 Section',
                    'display' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_33',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_33',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
                        array(
                            'key' => 'field_bg_color_inner_33',
                            'label' => 'Inner Wrapper Background Color',
                            'name' => 'inner_background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
                        array(
                            'key' => 'field_client_v2_title',
                            'label' => 'Section Title',
                            'name' => 'title',
                            'type' => 'text',
                            'default_value' => 'Our Clients',
                        ),
                        array(
                            'key' => 'field_client_v2_desc',
                            'label' => 'Description',
                            'name' => 'description',
                            'type' => 'textarea',
                            'rows' => 3,
                        ),
                        array(
                            'key' => 'field_client_v2_stats',
                            'label' => 'Stats Bullets',
                            'name' => 'stats',
                            'type' => 'repeater',
                            'layout' => 'table',
                            'button_label' => 'Add Stat',
                            'sub_fields' => array(
                                array(
                                    'key' => 'field_client_v2_stat_text',
                                    'label' => 'Stat Text',
                                    'name' => 'stat_text',
                                    'type' => 'text',
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_client_v2_logos',
                            'label' => 'Client Logos',
                            'name' => 'logos',
                            'type' => 'gallery',
                            'return_format' => 'url',
                            'insert' => 'append',
                        ),
                    ),
                ),
				// Layout: Feature Cards
				'layout_feature_cards' => array(
					'key'     => 'layout_feature_cards',
					'name'    => 'feature_cards',
					'label'   => 'Feature Cards',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_08',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_08',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
						array(
							'key'   => 'field_fc_title',
							'label' => 'Section Title',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_fc_subtitle',
							'label' => 'Section Subtitle',
							'name'  => 'subtitle',
							'type'  => 'text',
						),
						array(
							'key'          => 'field_fc_cards',
							'label'        => 'Cards',
							'name'         => 'cards',
							'type'         => 'repeater',
							'layout'       => 'block',
							'button_label' => 'Add Card',
							'sub_fields'   => array(
								array(
									'key'           => 'field_fc_card_image',
									'label'         => 'Image',
									'name'          => 'image',
									'type'          => 'image',
									'return_format' => 'url',
									'preview_size'  => 'medium',
								),
								array(
									'key'   => 'field_fc_card_title',
									'label' => 'Card Title',
									'name'  => 'title',
									'type'  => 'text',
								),
								array(
									'key'  => 'field_fc_card_link',
									'label' => 'Card Link',
									'name' => 'link',
									'type' => 'link',
								),
							),
						),
					),
				),
				// Layout: Features List (Why Choose Us)
				'layout_features_list' => array(
					'key'     => 'layout_features_list',
					'name'    => 'features_list',
					'label'   => 'Features List',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_09',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_09',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
						array(
							'key'   => 'field_fl_title',
							'label' => 'Left Column Title',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'            => 'field_fl_content',
							'label'          => 'Left Column Content',
							'name'           => 'content',
							'type'           => 'wysiwyg',
							'tabs'           => 'all',
							'toolbar'        => 'full',
							'media_upload'   => 0,
						),
						array(
							'key'          => 'field_fl_features',
							'label'        => 'Feature List',
							'name'         => 'features',
							'type'         => 'repeater',
							'layout'       => 'block',
							'button_label' => 'Add Feature',
							'sub_fields'   => array(
								array(
									'key'           => 'field_fl_icon',
									'label'         => 'Icon Image',
									'name'          => 'icon',
									'type'          => 'image',
									'return_format' => 'url',
									'preview_size'  => 'thumbnail',
								),
								array(
									'key'   => 'field_fl_feat_title',
									'label' => 'Feature Title',
									'name'  => 'feature_title',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_fl_feat_desc',
									'label' => 'Feature Description',
									'name'  => 'description',
									'type'  => 'textarea',
									'rows'  => 3,
								),
							),
						),
					),
				),
				// Layout: Contact Form
				'layout_contact_form' => array(
					'key'     => 'layout_contact_form',
					'name'    => 'contact_form',
					'label'   => 'Contact Form',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_10',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_10',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
						array(
							'key'           => 'field_cf_bg_color',
							'label'         => 'Background Color',
							'name'          => 'background_color',
							'type'          => 'color_picker',
							'default_value' => '#f8fafc',
						),
						array(
							'key'   => 'field_cf_title',
							'label' => 'Section Title',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'          => 'field_cf_content',
							'label'        => 'Intro Content',
							'name'         => 'content',
							'type'         => 'wysiwyg',
							'tabs'         => 'all',
							'toolbar'      => 'full',
							'media_upload' => 0,
						),
					),
				),
				// Layout: Blogs
				'layout_blogs' => array(
					'key'     => 'layout_blogs',
					'name'    => 'blogs',
					'label'   => 'Blogs Section',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_11',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_11',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
						array(
							'key'   => 'field_blogs_title',
							'label' => 'Title',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_blogs_subtitle',
							'label' => 'Subtitle',
							'name'  => 'subtitle',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_blogs_posts_per_page',
							'label' => 'Posts Per Page',
							'name'  => 'posts_per_page',
							'type'  => 'number',
							'default_value' => 3,
						),
					),
				),
				// Layout: Slider Gallery
				'layout_slider_gallery' => array(
					'key'     => 'layout_slider_gallery',
					'name'    => 'slider_gallery',
					'label'   => 'Slider Gallery',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_12',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_12',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
						array(
							'key'   => 'field_sg_title',
							'label' => 'Title',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_sg_description',
							'label' => 'Description',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 3,
						),
						array(
							'key'   => 'field_sg_gallery',
							'label' => 'Gallery Images',
							'name'  => 'gallery',
							'type'  => 'gallery',
							'return_format' => 'url',
							'preview_size'  => 'medium',
							'insert' => 'append',
						),
					),
				),
				// Layout: Product Hero
				'layout_product_hero' => array(
					'key'     => 'layout_product_hero',
					'name'    => 'product_hero',
					'label'   => 'Product Hero',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_13',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_13',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
						array(
							'key'          => 'field_ph_pills',
							'label'        => 'Pills',
							'name'         => 'pills',
							'type'         => 'repeater',
							'layout'       => 'table',
							'button_label' => 'Add Pill',
							'sub_fields'   => array(
								array(
									'key'   => 'field_ph_pill_text',
									'label' => 'Pill Text',
									'name'  => 'text',
									'type'  => 'text',
								),
							),
						),
						array(
							'key'   => 'field_ph_title',
							'label' => 'Title',
							'name'  => 'title',
							'type'  => 'textarea',
							'rows'  => 3,
							'instructions' => 'Use HTML like <span class="text-primary">...</span> for highlight.',
						),
						array(
							'key'   => 'field_ph_description',
							'label' => 'Description',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 4,
						),
						array(
							'key'          => 'field_ph_kpis',
							'label'        => 'KPIs / Features',
							'name'         => 'kpis',
							'type'         => 'repeater',
							'layout'       => 'block',
							'button_label' => 'Add KPI',
							'sub_fields'   => array(
								array(
									'key'   => 'field_ph_kpi_icon',
									'label' => 'Icon (Emoji or Text)',
									'name'  => 'icon',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_ph_kpi_title',
									'label' => 'Title',
									'name'  => 'title',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_ph_kpi_desc',
									'label' => 'Description',
									'name'  => 'description',
									'type'  => 'text',
								),
							),
						),
						array(
							'key'          => 'field_ph_buttons',
							'label'        => 'Buttons',
							'name'         => 'buttons',
							'type'         => 'repeater',
							'layout'       => 'table',
							'button_label' => 'Add Button',
							'sub_fields'   => array(
								array(
									'key'   => 'field_ph_btn_text',
									'label' => 'Button Text',
									'name'  => 'text',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_ph_btn_link',
									'label' => 'Button Link',
									'name'  => 'link',
									'type'  => 'link',
								),
								array(
									'key'   => 'field_ph_btn_style',
									'label' => 'Button Style',
									'name'  => 'style',
									'type'  => 'select',
									'choices' => array(
										'btn-brand' => 'Primary (Solid)',
										'btn-outline-brand' => 'Secondary (Outline)',
									),
									'default_value' => 'btn-brand',
								),
							),
						),
						array(
							'key'   => 'field_ph_tiny_text',
							'label' => 'Tiny Note Text',
							'name'  => 'tiny_text',
							'type'  => 'textarea',
							'rows'  => 2,
						),
						array(
							'key'   => 'field_ph_main_screenshot',
							'label' => 'Main Screenshot',
							'name'  => 'main_screenshot',
							'type'  => 'image',
							'return_format' => 'url',
							'preview_size'  => 'medium',
						),
						array(
							'key'          => 'field_ph_sec_screenshots',
							'label'        => 'Secondary Screenshots',
							'name'         => 'secondary_screenshots',
							'type'         => 'gallery',
							'return_format'=> 'url',
							'insert'       => 'append',
						),
					),
				),
				// Layout: Product Features Grid
				'layout_product_features_grid' => array(
					'key'     => 'layout_product_features_grid',
					'name'    => 'product_features_grid',
					'label'   => 'Product Features Grid',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_14',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_14',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
						array(
							'key'   => 'field_pfg_section_title',
							'label' => 'Section Title',
							'name'  => 'section_title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_pfg_section_description',
							'label' => 'Section Description',
							'name'  => 'section_description',
							'type'  => 'textarea',
							'rows'  => 3,
						),
						array(
							'key'          => 'field_pfg_features',
							'label'        => 'Features',
							'name'         => 'features',
							'type'         => 'repeater',
							'layout'       => 'block',
							'button_label' => 'Add Feature',
							'sub_fields'   => array(
								array(
									'key'   => 'field_pfg_feat_icon',
									'label' => 'Icon (Emoji or Text)',
									'name'  => 'icon',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_pfg_feat_title',
									'label' => 'Title',
									'name'  => 'title',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_pfg_feat_desc',
									'label' => 'Description',
									'name'  => 'description',
									'type'  => 'textarea',
									'rows'  => 2,
								),
							),
						),
					),
				),
				// Layout: Info List
				'layout_info_list' => array(
					'key'     => 'layout_info_list',
					'name'    => 'info_list',
					'label'   => 'Info List',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_15',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_15',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
						array(
							'key'   => 'field_il_title',
							'label' => 'Title',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_il_description',
							'label' => 'Description',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 3,
						),
						array(
							'key'          => 'field_il_list_items',
							'label'        => 'List Items',
							'name'         => 'list_items',
							'type'         => 'repeater',
							'layout'       => 'table',
							'button_label' => 'Add Item',
							'sub_fields'   => array(
								array(
									'key'   => 'field_il_list_text',
									'label' => 'Item Text',
									'name'  => 'text',
									'type'  => 'text',
									'instructions' => 'Basic HTML allowed (e.g. <strong>text</strong>).',
								),
							),
						),
						array(
							'key'   => 'field_il_feature_icon',
							'label' => 'Feature Icon (Emoji or Text)',
							'name'  => 'feature_icon',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_il_feature_title',
							'label' => 'Feature Title',
							'name'  => 'feature_title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_il_feature_desc',
							'label' => 'Feature Description',
							'name'  => 'feature_description',
							'type'  => 'textarea',
							'rows'  => 3,
						),
						array(
							'key'          => 'field_il_kpis',
							'label'        => 'KPIs',
							'name'         => 'kpis',
							'type'         => 'repeater',
							'layout'       => 'table',
							'button_label' => 'Add KPI',
							'sub_fields'   => array(
								array(
									'key'   => 'field_il_kpi_title',
									'label' => 'KPI Title',
									'name'  => 'title',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_il_kpi_desc',
									'label' => 'KPI Description',
									'name'  => 'description',
									'type'  => 'text',
								),
							),
						),
					),
				),
				// Layout: Info List 2 Columns
				'layout_info_list_2_columns' => array(
					'key'     => 'layout_info_list_2_columns',
					'name'    => 'info_list_2_columns',
					'label'   => 'Info List 2 Columns',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_16',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_16',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
						array(
							'key'   => 'field_il2_title',
							'label' => 'Section Title',
							'name'  => 'section_title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_il2_desc',
							'label' => 'Section Description',
							'name'  => 'section_description',
							'type'  => 'textarea',
							'rows'  => 3,
						),
						array(
							'key'          => 'field_il2_columns',
							'label'        => 'Columns',
							'name'         => 'columns',
							'type'         => 'repeater',
							'layout'       => 'block',
							'button_label' => 'Add Column',
							'max'          => 2,
							'sub_fields'   => array(
								array(
									'key'   => 'field_il2_col_title',
									'label' => 'Column Title',
									'name'  => 'title',
									'type'  => 'text',
								),
								array(
									'key'          => 'field_il2_col_list',
									'label'        => 'List Items',
									'name'         => 'list_items',
									'type'         => 'repeater',
									'layout'       => 'table',
									'button_label' => 'Add Item',
									'sub_fields'   => array(
										array(
											'key'   => 'field_il2_col_list_txt',
											'label' => 'Item Text',
											'name'  => 'text',
											'type'  => 'text',
											'instructions' => 'HTML allowed',
										),
									),
								),
							),
						),
					),
				),
				// Layout: Info Bills
				'layout_info_bills' => array(
					'key'     => 'layout_info_bills',
					'name'    => 'info_bills',
					'label'   => 'Info Bills',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_17',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_17',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
						array(
							'key'   => 'field_ib_title',
							'label' => 'Title',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_ib_description',
							'label' => 'Description',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 3,
						),
						array(
							'key'          => 'field_ib_bills',
							'label'        => 'Bills (Pills)',
							'name'         => 'bills',
							'type'         => 'repeater',
							'layout'       => 'table',
							'button_label' => 'Add Bill',
							'sub_fields'   => array(
								array(
									'key'   => 'field_ib_bill_text',
									'label' => 'Bill Text',
									'name'  => 'text',
									'type'  => 'text',
								),
							),
						),
					),
				),
				// Layout: Contact Us V2
				'layout_contact_us_v2' => array(
					'key'     => 'layout_contact_us_v2',
					'name'    => 'contact_us_v2',
					'label'   => 'Contact Us V2',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_18',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_18',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
						array(
							'key'   => 'field_cu2_title',
							'label' => 'Title',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_cu2_description',
							'label' => 'Description',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 3,
						),
						array(
							'key'   => 'field_cu2_form_shortcode',
							'label' => 'Form Shortcode',
							'name'  => 'form_shortcode',
							'type'  => 'text',
							'instructions' => 'Paste the shortcode for the form (e.g. Contact Form 7).',
						),
						array(
							'key'   => 'field_cu2_tiny_text',
							'label' => 'Tiny Footer Text',
							'name'  => 'tiny_text',
							'type'  => 'text',
							'default_value' => 'We reply within 1 business day.',
						),
					),
				),
				// Layout: Hero Landing
				'layout_hero_landing' => array(
					'key'     => 'layout_hero_landing',
					'name'    => 'hero_landing',
					'label'   => 'Hero Landing',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_30',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_19',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
						array(
							'key'   => 'field_hl_colors_schema',
							'label' => 'Colors Schema',
							'name'  => 'colors_schema',
                            'instructions' => 'change buttons and eyebrow look and feel',
							'type'  => 'select',
							'choices' => array(
								'primary'   => 'Blue Colors',
								'secondary' => 'Gray Colors',
								'third' => 'Red Colors',
							),
							'default_value' => 'primary',
						),
						array(
							'key'          => 'field_hl_eyebrow',
							'label'        => 'Eyebrow Text',
							'name'         => 'eyebrow_data',
							'type'         => 'repeater',
							'layout'       => 'table',
							'button_label' => 'Add Eyebrow',
							'sub_fields'   => array(
								array(
									'key'   => 'field_hl_eyebrow_text',
									'label' => 'Text',
									'name'  => 'text',
									'type'  => 'text',
								),
							),
						),
						array(
							'key'   => 'field_hl_title',
							'label' => 'Title',
							'name'  => 'title',
							'type'  => 'textarea',
							'rows'  => 3,
							'instructions' => 'Use HTML like <span>...</span> for gradient text.',
						),
						array(
							'key'   => 'field_hl_desc',
							'label' => 'Description',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 3,
						),
						array(
							'key'          => 'field_hl_features',
							'label'        => 'Features',
							'name'         => 'features',
							'type'         => 'repeater',
							'layout'       => 'table',
							'button_label' => 'Add Feature',
							'sub_fields'   => array(
								array(
									'key'   => 'field_hl_feat_text',
									'label' => 'Feature Text',
									'name'  => 'text',
									'type'  => 'text',
								),
							),
						),
						array(
							'key'          => 'field_hl_buttons',
							'label'        => 'Buttons',
							'name'         => 'buttons',
							'type'         => 'repeater',
							'layout'       => 'table',
							'button_label' => 'Add Button',
							'sub_fields'   => array(
								array(
									'key'   => 'field_hl_btn_text',
									'label' => 'Button Text',
									'name'  => 'text',
									'type'  => 'text',
								),
                                array(
                                    'key'   => 'field_popup_make',
                                    'label' => 'Open Popup',
                                    'name'  => 'open_popup',
                                    'type'  => 'text',
                                ),
								array(
									'key'   => 'field_hl_btn_icon',
									'label' => 'Icon',
									'name'  => 'icon',
									'type'  => 'font-awesome',
									'icon_sets' => array(
										0 => 'fas',
										1 => 'far',
										2 => 'fal',
										3 => 'fab',
									),
									'save_format' => 'element',
									'allow_null' => 1,
									'show_preview' => 1,
								),
								array(
									'key'   => 'field_hl_btn_link',
									'label' => 'Button Link',
									'name'  => 'link',
									'type'  => 'link',
								),
								array(
									'key'   => 'field_hl_btn_style',
									'label' => 'Button Style',
									'name'  => 'style',
									'type'  => 'select',
									'choices' => array(
										'btn-primary' => 'Primary (Solid)',
										'btn-outline-secondary' => 'Secondary (Outline)',
									),
									'default_value' => 'btn-primary',
								),
							),
						),
                        array(
                            'key'           => 'field_hl_show_app_download',
                            'label'         => 'Show App Download Buttons?',
                            'name'          => 'hl_show_app_download',
                            'type'          => 'true_false',
                            'ui'            => 1,
                            'default_value' => 0,
                            'ui_on_text' => 'Show',
                            'ui_off_text' => 'Hide',
                        ),
                        array(
                            'key' => 'field_hl_app_download_text',
                            'label' => 'Apps Download Text',
                            'name' => 'hl_app_download_text',
                            'type' => 'text',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field'    => 'field_hl_show_app_download',
                                        'operator' => '==',
                                        'value'    => '1',
                                    )
                                )
                            )
                        ),
                        array(
                            'key'   => 'field_hl_play_store_link',
                            'label' => 'Play Store Link',
                            'name'  => 'play_store_link',
                            'type'  => 'link',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field'    => 'field_hl_show_app_download',
                                        'operator' => '==',
                                        'value'    => '1',
                                    )
                                )
                            )
                        ),
                        array(
                            'key'   => 'field_hl_app_store_link',
                            'label' => 'Apple App Store Link',
                            'name'  => 'app_store_link',
                            'type'  => 'link',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field'    => 'field_hl_show_app_download',
                                        'operator' => '==',
                                        'value'    => '1',
                                    )
                                )
                            )
                        ),
                        array(
                            'key'           => 'field_hl_show_slider',
                            'label'         => 'Image / Slider',
                            'name'          => 'show_slider',
                            'type'          => 'true_false',
                            'ui'            => 1,
                            'default_value' => 0,
                            'ui_off_text' => 'Gallery Slider',
                            'ui_on_text' => 'Single Image',
                        ),
						array(
							'key'   => 'field_hl_image',
							'label' => 'Single Hero Image ',
							'name'  => 'image',
							'type'  => 'image',
							'return_format' => 'url',
							'preview_size'  => 'medium',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field'    => 'field_hl_show_slider',
                                        'operator' => '==',
                                        'value'    => '0',
                                    ),
                                ),
                            ),
						),
                        array(
                            'key'   => 'field_hl_slider',
                            'label' => 'Hero Image Slider',
                            'name'  => 'hl_slider',
                            'type'  => 'gallery',
                            'return_format' => 'url',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field'    => 'field_hl_show_slider',
                                        'operator' => '==',
                                        'value'    => '1',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key'   => 'field_hl_image_width',
                            'label' => 'Image Width (%)',
                            'name'  => 'hl_image_width',
                            'type'  => 'range',
                            'min'   => 1,
                            'max'   => 100,
                            'step'  => 1,
                            'default_value' => 100,
                            'append' => '%',
                        ),
						array(
							'key'           => 'field_hl_show_counters',
							'label'         => 'Show Counters',
							'name'          => 'show_counters',
							'type'          => 'true_false',
							'ui'            => 1,
							'default_value' => 0,
						),
						array(
							'key'          => 'field_hl_counters',
							'label'        => 'Counters',
							'name'         => 'counters',
							'type'         => 'repeater',
							'layout'       => 'table',
							'button_label' => 'Add Counter',
							'conditional_logic' => array(
								array(
									array(
										'field'    => 'field_hl_show_counters',
										'operator' => '==',
										'value'    => '1',
									),
								),
							),
							'sub_fields'   => array(
								array(
									'key'   => 'field_hl_target',
									'label' => 'Target Value',
									'name'  => 'target',
									'type'  => 'number',
								),
								array(
									'key'   => 'field_hl_suffix',
									'label' => 'Suffix',
									'name'  => 'suffix',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_hl_decimals',
									'label' => 'Decimals',
									'name'  => 'decimals',
									'type'  => 'number',
									'default_value' => 0,
								),
								array(
									'key'   => 'field_hl_label',
									'label' => 'Label',
									'name'  => 'label',
									'type'  => 'text',
								),
							),
						),
					),
				),
				// Layout: Feature Cards V2
				'layout_feature_cards_v2' => array(
					'key'     => 'layout_feature_cards_v2',
					'name'    => 'feature_cards_v2',
					'label'   => 'Feature Cards V2',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_19',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_20',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
                        array(
                            'key'   => 'features_v2_colors_schema',
                            'label' => 'Colors Schema',
                            'name'  => 'colors_schema',
                            'type'  => 'select',
                            'choices' => array(
                                'primary'   => 'Icons BG Blue',
                                'secondary' => 'Icons BG Green - Yellow',
                                'third' => 'Icons BG Light Gray',
                            ),
                            'default_value' => 'primary',
                        ),
						array(
							'key'   => 'field_fcv2_badge',
							'label' => 'Badge Text',
							'name'  => 'badge',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_fcv2_pre_title',
							'label' => 'Pre Title',
							'name'  => 'pre_title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_fcv2_main_title',
							'label' => 'Main Title',
							'name'  => 'main_title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_fcv2_subtitle',
							'label' => 'Subtitle',
							'name'  => 'subtitle',
							'type'  => 'textarea',
							'rows'  => 3,
						),
                        array(
                            'key'   => 'features_columns',
                            'label' => 'Features Columns',
                            'name'  => 'features_columns',
                            'type'  => 'select',
                            'choices' => array(
                                2   => '2 in a row',
                                3   => '3 in a row',
                                4   => '4 in a row',
                                5   => '5 in a row',
                            ),
                            'default_value' => 3,
                        ),
						array(
							'key'          => 'field_fcv2_features',
							'label'        => 'Features',
							'name'         => 'features',
							'type'         => 'repeater',
							'layout'       => 'table',
							'button_label' => 'Add Feature',
							'sub_fields'   => array(
                                array(
                                    'key'           => 'field_fcv2_icon_image_switch',
                                    'label'         => 'Show Icon or Image',
                                    'name'          => 'icon_image_switch',
                                    'type'          => 'true_false',
                                    'instructions'  => 'Enable to show icon, disable to show image.',
                                    'default_value' => 0,
                                    'ui' => 1,
                                    'ui_on_text'    => 'Image',
                                    'ui_off_text'   => 'Icon'
                                ),
								array(
									'key'   => 'field_fcv2_icon',
									'label' => 'Icon',
									'name'  => 'icon',
									'type'  => 'font-awesome',
									'icon_sets' => array(
										0 => 'fas',
										1 => 'far',
										2 => 'fal',
										3 => 'fab',
									),
									'save_format' => 'element',
									'allow_null' => 0,
									'show_preview' => 1,
                                    'conditional_logic' => array(
                                        array(
                                            array(
                                                'field'    => 'field_fcv2_icon_image_switch',
                                                'operator' => '==',
                                                'value'    => '0',
                                            )
                                        )
                                    )
								),
                                array(
                                    'key'           => 'field_fcv2_image',
                                    'label'         => 'Image',
                                    'name'          => 'fcv2_image',
                                    'type'          => 'image',
                                    'return_format' => 'url',
                                    'preview_size'  => 'thumbnail',
                                    'conditional_logic' => array(
                                        array(
                                            array(
                                                'field'    => 'field_fcv2_icon_image_switch',
                                                'operator' => '==',
                                                'value'    => '1',
                                            )
                                        )
                                    )
                                ),
								array(
									'key'   => 'field_fcv2_title',
									'label' => 'Title',
									'name'  => 'title',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_fcv2_description',
									'label' => 'Description',
									'name'  => 'description',
									'type'  => 'textarea',
									'rows'  => 2,
								),
							),
						),
					),
				),
				// Layout: CTA Module
				'layout_cta_module' => array(
					'key'     => 'layout_cta_module',
					'name'    => 'cta_module',
					'label'   => 'CTA Module',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_20',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_21',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '#fafbff',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
                        array(
                            'key'   => 'field_cta_image',
                            'label' => 'Background Image ',
                            'name'  => 'image',
                            'type'  => 'image',
                            'return_format' => 'url',
                            'preview_size'  => 'medium',
                            'conditional_logic' => 0,
                        ),
                        array(
                            'key'   => 'field_cta_border_radius',
                            'label' => 'Border Radius (px)',
                            'name'  => 'cta_border_radius',
                            'type'  => 'range',
                            'min'   => 1,
                            'max'   => 1000,
                            'step'  => 5,
                            'default_value' => 0,
                            'append' => 'px',
                        ),
                        array(
                            'key'           => 'field_cta_title_color',
                            'label'         => 'CTA Title Color',
                            'name'          => 'field_cta_title_color',
                            'type'          => 'color_picker',
                            'default_value' => '#000',
                        ),
						array(
							'key'   => 'field_cta_title',
							'label' => 'Title',
							'name'  => 'cta_title',
							'type'  => 'text',
						),
                        array(
                            'key'           => 'field_cta_desc_color',
                            'label'         => 'CTA Description Color',
                            'name'          => 'field_cta_desc_color',
                            'type'          => 'color_picker',
                            'default_value' => '#000',
                        ),
						array(
							'key'   => 'field_cta_description',
							'label' => 'Description',
							'name'  => 'cta_description',
							'type'  => 'textarea',
							'rows'  => 3,
						),
						array(
							'key'   => 'field_cta_btn_text',
							'label' => 'Button Text',
							'name'  => 'btn_text',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_cta_btn_link',
							'label' => 'Button Link',
							'name'  => 'btn_link',
							'type'  => 'link',
						),
						array(
							'key'   => 'field_cta_btn_icon',
							'label' => 'Button Icon',
							'name'  => 'btn_icon',
							'type'  => 'font-awesome',
							'icon_sets' => array(
								0 => 'fas',
								1 => 'far',
								2 => 'fal',
								3 => 'fab',
							),
							'save_format' => 'element',
							'allow_null' => 1,
							'show_preview' => 1,
						),
                        array(
                            'key'           => 'field_cta_btn_bg_color',
                            'label'         => 'Button Background Color',
                            'name'          => 'btn_bg_color',
                            'type'          => 'extended-color-picker',
                            'default_value' => '',
                        ),
                        array(
                            'key'           => 'field_cta_btn_text_color',
                            'label'         => 'Button Text Color',
                            'name'          => 'btn_text_color',
                            'type'          => 'color_picker',
                            'default_value' => '',
                        ),
					),
				),
				// Layout: Icon List With Image
				'layout_icon_list_image' => array(
					'key'     => 'layout_icon_list_image',
					'name'    => 'icon_list_with_image',
					'label'   => 'Icon List With Image',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_21',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_22',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
                        array(
                            'key'   => 'field_ili_align_image',
                            'label' => 'Align Image',
                            'name'  => 'align_image',
                            'type'  => 'select',
                            'choices' => array(
                                'left'  => 'Left',
                                'right' => 'Right',
                            ),
                            'default_value' => 'right',
                            'ui' => 1,
                        ),
						array(
							'key'   => 'field_ili_badge_text',
							'label' => 'Badge Text',
							'name'  => 'badge_text',
							'type'  => 'text',
						),
                        array(
                            'key'           => 'field_ili_badge_bg_color',
                            'label'         => 'Badge Background Color',
                            'name'          => 'badge_bg_color',
                            'type'          => 'color_picker',
                            'default_value' => '#ededfc',
                        ),
                        array(
                            'key'           => 'field_ili_badge_text_color',
                            'label'         => 'Badge Text Color',
                            'name'          => 'badge_text_color',
                            'type'          => 'color_picker',
                            'default_value' => '#6c63ff',
                        ),
                        array(
                            'key'          => 'field_ili_tags',
                            'label'        => 'Tags',
                            'name'         => 'ili_tags',
                            'type'         => 'repeater',
                            'layout'       => 'table',
                            'button_label' => 'Add Tag',
                            'max'          => 10,
                            'sub_fields'   => array(
                                array(
                                    'key'   => 'field_ili_tags_title',
                                    'label' => 'Tag Title',
                                    'name'  => 'ili_tag_title',
                                    'type'  => 'text',
                                ),
                            ),
                        ),
                        array(
                            'key'           => 'field_ili_tags_bg_color',
                            'label'         => 'Tags Background Color',
                            'name'          => 'ili_tags_bg_color',
                            'type'          => 'color_picker',
                            'default_value' => '#FEF2F2',
                        ),
                        array(
                            'key'           => 'field_ili_tags_text_color',
                            'label'         => 'Tags Text Color',
                            'name'          => 'ili_tags_text_color',
                            'type'          => 'color_picker',
                            'default_value' => '#B51B1B',
                        ),
						array(
							'key'   => 'field_ili_section_title',
							'label' => 'Title',
							'name'  => 'section_title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_ili_section_subtitle',
							'label' => 'Subtitle',
							'name'  => 'section_subtitle',
							'type'  => 'textarea',
							'rows'  => 2,
						),
						array(
							'key'   => 'field_ili_image',
							'label' => 'Image',
							'name'  => 'image',
							'type'  => 'image',
							'return_format' => 'url',
							'preview_size' => 'medium',
						),
						array(
							'key'   => 'field_ili_image_width',
							'label' => 'Image Width (%)',
							'name'  => 'image_width',
							'type'  => 'range',
							'min'   => 1,
							'max'   => 100,
							'step'  => 1,
							'default_value' => 100,
							'append' => '%',
						),
                        array(
                            'key'   => 'field_ili_steps_main_title',
                            'label' => 'Steps Main Title',
                            'name'  => 'steps_main_title',
                            'type'  => 'text',
                        ),
                        array(
                            'key'   => 'field_ili_steps_main_description',
                            'label' => 'Steps Main Description',
                            'name'  => 'steps_main_description',
                            'type'  => 'textarea',
                            'rows'  => 3,
                        ),
                        array(
                            'key'   => 'field_fcv2_icon_style',
                            'label' => 'Icon Style',
                            'name'  => 'icon_style',
                            'type'  => 'select',
                            'choices' => array(
                                'icons_with_background' => 'Icons with Background',
                                'simple_icons'          => 'Simple Icons',
                            ),
                            'default_value' => 'icons_with_background',
                            'return_format' => 'value',
                            'ui' => 1,
                        ),
						array(
							'key'          => 'field_ili_steps',
							'label'        => 'Steps/Items',
							'name'         => 'steps',
							'type'         => 'repeater',
							'layout'       => 'block',
							'button_label' => 'Add Step',
							'sub_fields'   => array(
								array(
									'key'   => 'field_ili_step_number',
									'label' => 'Step Number / Label',
									'name'  => 'step_number',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_ili_step_title',
									'label' => 'Title',
									'name'  => 'step_title',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_ili_step_description',
									'label' => 'Description',
									'name'  => 'step_description',
									'type'  => 'textarea',
									'rows'  => 3,
								),
								array(
									'key'   => 'field_ili_step_icon',
									'label' => 'Icon',
									'name'  => 'icon',
									'type'  => 'font-awesome',
									'icon_sets' => array(
										0 => 'fas',
										1 => 'far',
										2 => 'fal',
										3 => 'fab',
									),
									'save_format' => 'element',
									'allow_null' => 0,
									'show_preview' => 1,
								),
								array(
									'key'           => 'field_ili_step_icon_bg_color',
									'label'         => 'Icon Background Color',
									'name'          => 'icon_bg_color',
									'type'          => 'color_picker',
									'default_value' => '',
								),
								array(
									'key'           => 'field_ili_step_icon_color',
									'label'         => 'Icon Color',
									'name'          => 'icon_color',
									'type'          => 'color_picker',
									'default_value' => '',
								),
							),
						),
					),
				),
				// Layout: CTA Counters
				'layout_cta_counters' => array(
					'key'     => 'layout_cta_counters',
					'name'    => 'cta_counters',
					'label'   => 'CTA Counters',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_22',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_23',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
						array(
							'key'   => 'field_ctac_badge',
							'label' => 'Badge Text',
							'name'  => 'badge',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_ctac_title',
							'label' => 'Title',
							'name'  => 'title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_ctac_description',
							'label' => 'Description',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 3,
						),
						array(
							'key'          => 'field_ctac_counters',
							'label'        => 'Counters',
							'name'         => 'counters',
							'type'         => 'repeater',
							'layout'       => 'table',
							'button_label' => 'Add Counter',
							'sub_fields'   => array(
								array(
									'key'   => 'field_ctac_target',
									'label' => 'Target Value',
									'name'  => 'target',
									'type'  => 'number',
								),
								array(
									'key'   => 'field_ctac_suffix',
									'label' => 'Suffix',
									'name'  => 'suffix',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_ctac_decimals',
									'label' => 'Decimals',
									'name'  => 'decimals',
									'type'  => 'number',
									'default_value' => 0,
								),
								array(
									'key'   => 'field_ctac_label',
									'label' => 'Label',
									'name'  => 'label',
									'type'  => 'text',
								),
							),
						),
						array(
							'key'   => 'field_ctac_btn_text',
							'label' => 'Button Text',
							'name'  => 'btn_text',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_ctac_btn_link',
							'label' => 'Button Link',
							'name'  => 'btn_link',
							'type'  => 'link',
						),
						array(
							'key'   => 'field_ctac_btn_icon',
							'label' => 'Button Icon',
							'name'  => 'btn_icon',
							'type'  => 'font-awesome',
							'icon_sets' => array(
								0 => 'fas',
								1 => 'far',
								2 => 'fal',
								3 => 'fab',
							),
							'save_format' => 'element',
							'allow_null' => 1,
							'show_preview' => 1,
						),
					),
				),
				// Layout: Features List Admin
				'layout_features_list_admin' => array(
					'key'     => 'layout_features_list_admin',
					'name'    => 'features_list_admin',
					'label'   => 'Features List Admin',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_23',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_24',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
						array(
							'key'   => 'field_fla_badge',
							'label' => 'Badge Text',
							'name'  => 'badge',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_fla_title',
							'label' => 'Title',
							'name'  => 'title',
							'type'  => 'textarea',
							'rows'  => 3,
						),
						array(
							'key'   => 'field_fla_description',
							'label' => 'Description',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 3,
						),
						array(
							'key'          => 'field_fla_features',
							'label'        => 'Features',
							'name'         => 'features',
							'type'         => 'repeater',
							'layout'       => 'block',
							'button_label' => 'Add Feature',
							'sub_fields'   => array(
								array(
									'key'   => 'field_fla_feat_icon',
									'label' => 'Icon',
									'name'  => 'icon',
									'type'  => 'font-awesome',
									'icon_sets' => array('fas', 'far', 'fal', 'fab'),
									'save_format' => 'element',
									'allow_null' => 0,
									'show_preview' => 1,
								),
								array(
									'key'   => 'field_fla_feat_icon_color',
									'label' => 'Icon Background Color',
									'name'  => 'icon_bg_color',
									'type'  => 'select',
									'choices' => array(
										'red'    => 'Red',
										'green'  => 'Green',
										'yellow' => 'Yellow',
										'teal'   => 'Teal',
									),
									'default_value' => 'green',
								),
								array(
									'key'   => 'field_fla_feat_title',
									'label' => 'Feature Title',
									'name'  => 'title',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_fla_feat_desc',
									'label' => 'Feature Description',
									'name'  => 'description',
									'type'  => 'textarea',
									'rows'  => 2,
								),
							),
						),
						array(
							'key'   => 'field_fla_dashboard_title',
							'label' => 'Dashboard Title',
							'name'  => 'dashboard_title',
							'type'  => 'text',
							'default_value' => 'Executive Dashboard',
						),
						array(
							'key'          => 'field_fla_stat_tiles',
							'label'        => 'Stat Tiles',
							'name'         => 'stat_tiles',
							'type'         => 'repeater',
							'layout'       => 'table',
							'button_label' => 'Add Stat Tile',
							'max'          => 2,
							'sub_fields'   => array(
								array(
									'key'   => 'field_fla_stat_num',
									'label' => 'Number',
									'name'  => 'number',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_fla_stat_label',
									'label' => 'Label',
									'name'  => 'label',
									'type'  => 'text',
								),
							),
						),
						array(
							'key'          => 'field_fla_progress_items',
							'label'        => 'Progress Items',
							'name'         => 'progress_items',
							'type'         => 'repeater',
							'layout'       => 'table',
							'button_label' => 'Add Progress Item',
							'max'          => 2,
							'sub_fields'   => array(
								array(
									'key'   => 'field_fla_prog_label',
									'label' => 'Label',
									'name'  => 'label',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_fla_prog_percent',
									'label' => 'Percent',
									'name'  => 'percent',
									'type'  => 'number',
									'min'   => 0,
									'max'   => 100,
								),
							),
						),
						array(
							'key'          => 'field_fla_alerts',
							'label'        => 'Alerts',
							'name'         => 'alerts',
							'type'         => 'repeater',
							'layout'       => 'table',
							'button_label' => 'Add Alert',
							'max'          => 2,
							'sub_fields'   => array(
								array(
									'key'   => 'field_fla_alert_num',
									'label' => 'Number',
									'name'  => 'number',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_fla_alert_label',
									'label' => 'Label',
									'name'  => 'label',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_fla_alert_color',
									'label' => 'Color',
									'name'  => 'color',
									'type'  => 'select',
									'choices' => array(
										'orange' => 'Orange',
										'green'  => 'Green',
									),
									'default_value' => 'orange',
								),
							),
						),
					),
				),
				// Layout: Features List Projects
				'layout_features_list_projects' => array(
					'key'     => 'layout_features_list_projects',
					'name'    => 'features_list_projects',
					'label'   => 'Features List Projects',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_24',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_25',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
						array(
							'key'   => 'field_flp_badge',
							'label' => 'Badge Text',
							'name'  => 'badge',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_flp_title',
							'label' => 'Title',
							'name'  => 'title',
							'type'  => 'textarea',
							'rows'  => 3,
						),
						array(
							'key'   => 'field_flp_description',
							'label' => 'Description',
							'name'  => 'description',
							'type'  => 'textarea',
							'rows'  => 3,
						),
						array(
							'key'          => 'field_flp_features',
							'label'        => 'Features',
							'name'         => 'features',
							'type'         => 'repeater',
							'layout'       => 'block',
							'button_label' => 'Add Feature',
							'sub_fields'   => array(
								array(
									'key'   => 'field_flp_feat_icon',
									'label' => 'Icon',
									'name'  => 'icon',
									'type'  => 'font-awesome',
									'icon_sets' => array('fas', 'far', 'fal', 'fab'),
									'save_format' => 'element',
									'allow_null' => 0,
									'show_preview' => 1,
								),
								array(
									'key'   => 'field_flp_feat_icon_color',
									'label' => 'Icon Background Color',
									'name'  => 'icon_bg_color',
									'type'  => 'select',
									'choices' => array(
										'green'  => 'Green',
										'purple' => 'Purple',
										'orange' => 'Orange',
										'blue'   => 'Blue',
									),
									'default_value' => 'green',
								),
								array(
									'key'   => 'field_flp_feat_title',
									'label' => 'Feature Title',
									'name'  => 'title',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_flp_feat_desc',
									'label' => 'Feature Description',
									'name'  => 'description',
									'type'  => 'textarea',
									'rows'  => 2,
								),
							),
						),
						array(
							'key'   => 'field_flp_summary_card_title',
							'label' => 'Summary Card Title',
							'name'  => 'summary_card_title',
							'type'  => 'text',
							'default_value' => 'Monthly Summary',
						),
						array(
							'key'   => 'field_flp_summary_card_date',
							'label' => 'Summary Card Date',
							'name'  => 'summary_card_date',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_flp_actual_hours',
							'label' => 'Actual Hours',
							'name'  => 'actual_hours',
							'type'  => 'number',
							'step'  => 0.1,
						),
						array(
							'key'   => 'field_flp_expected_hours',
							'label' => 'Expected Hours',
							'name'  => 'expected_hours',
							'type'  => 'number',
							'step'  => 0.1,
						),
						array(
							'key'   => 'field_flp_overtime_note',
							'label' => 'Overtime Note',
							'name'  => 'overtime_note',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_flp_projects_title',
							'label' => 'Projects Title',
							'name'  => 'projects_title',
							'type'  => 'text',
							'default_value' => 'Active Projects',
						),
						array(
							'key'          => 'field_flp_projects',
							'label'        => 'Projects',
							'name'         => 'projects',
							'type'         => 'repeater',
							'layout'       => 'table',
							'button_label' => 'Add Project',
							'sub_fields'   => array(
								array(
									'key'   => 'field_flp_proj_name',
									'label' => 'Project Name',
									'name'  => 'name',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_flp_proj_hours',
									'label' => 'Hours',
									'name'  => 'hours',
									'type'  => 'text',
								),
							),
						),
					),
				),
				// Layout: Pricing Table
				'layout_pricing_table' => array(
					'key'     => 'layout_pricing_table',
					'name'    => 'pricing_table',
					'label'   => 'Pricing Table',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_25',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_26',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
                        array(
                            'key' => 'field_card_color_style',
                            'label' => 'Card Color Style',
                            'name' => 'card_color_style',
                            'type' => 'select',
                            'instructions' => '',
                            'choices' => array(
                                'primary' => 'Blue Style',
                                'secondary' => 'Gray Style',
                                'third' => 'Red Style'
                            ),
                            'return_format' => 'value',
                            'ui' => 1,
                            'default' => 'primary'
                        ),
						array(
							'key'   => 'field_pt_section_title',
							'label' => 'Section Title',
							'name'  => 'section_title',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_pt_section_subtitle',
							'label' => 'Section Subtitle',
							'name'  => 'section_subtitle',
							'type'  => 'textarea',
							'rows'  => 2,
						),
						array(
							'key'          => 'field_pt_cards',
							'label'        => 'Pricing Cards',
							'name'         => 'pricing_cards',
							'type'         => 'repeater',
							'layout'       => 'row',
							'button_label' => 'Add Card',
							'sub_fields'   => array(
								array(
									'key'   => 'field_pt_card_type',
									'label' => 'Card Type',
									'name'  => 'card_type',
									'type'  => 'select',
									'choices' => array(
										'standard' => 'Standard',
										'popular' => 'Popular',
										'enterprise' => 'Enterprise',
									),
									'default_value' => 'standard',
								),
								array(
									'key'   => 'field_pt_badge_text',
									'label' => 'Badge Text (For Popular)',
									'name'  => 'badge_text',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_pt_card_svg',
									'label' => 'Card Icon (SVG Media)',
									'name'  => 'card_svg',
									'type'  => 'image',
									'return_format' => 'url',
									'preview_size' => 'thumbnail',
								),
								array(
									'key'   => 'field_pt_user_tier',
									'label' => 'User Tier',
									'name'  => 'user_tier',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_pt_price_amount',
									'label' => 'Price Amount',
									'name'  => 'price_amount',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_pt_price_unit',
									'label' => 'Price Unit',
									'name'  => 'price_unit',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_pt_price_talk',
									'label' => 'Enterprise - Talk Text',
									'name'  => 'price_talk',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_pt_price_custom',
									'label' => 'Enterprise - Custom Subtext',
									'name'  => 'price_custom',
									'type'  => 'text',
								),
								array(
									'key'          => 'field_pt_features',
									'label'        => 'Features',
									'name'         => 'features',
									'type'         => 'repeater',
									'layout'       => 'table',
									'button_label' => 'Add Feature',
									'sub_fields'   => array(
										array(
											'key'   => 'field_pt_feature_text',
											'label' => 'Feature Text',
											'name'  => 'feature_text',
											'type'  => 'text',
										),
									),
								),
								array(
									'key'   => 'field_pt_btn_text',
									'label' => 'Button Text',
									'name'  => 'btn_text',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_pt_btn_link',
									'label' => 'Button Link',
									'name'  => 'btn_link',
									'type'  => 'link',
								),
								array(
									'key'   => 'field_pt_btn_icon',
									'label' => 'Button Icon',
									'name'  => 'btn_icon',
									'type'  => 'font-awesome',
									'icon_sets' => array(
										0 => 'fas',
										1 => 'far',
										2 => 'fal',
										3 => 'fab',
									),
									'save_format' => 'element',
									'allow_null' => 1,
									'show_preview' => 1,
								),
							),
						),
					),
				),
				// Layout: Features List Two Columns
				'layout_features_list_two_columns' => array(
					'key'     => 'layout_features_list_two_columns',
					'name'    => 'features_list_two_columns',
					'label'   => 'Features List Two Columns',
					'display' => 'block',
					'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_26',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_27',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
						// ── Header ──
						array(
							'key'   => 'field_fltc_badge',
							'label' => 'Badge Text',
							'name'  => 'badge',
							'type'  => 'text',
						),
						array(
							'key'          => 'field_fltc_title',
							'label'        => 'Title',
							'name'         => 'title',
							'type'         => 'textarea',
							'rows'         => 2,
							'instructions' => 'Use HTML e.g. <span>Highlighted</span> for colored text.',
						),
						array(
							'key'  => 'field_fltc_subtitle',
							'label' => 'Subtitle',
							'name'  => 'subtitle',
							'type'  => 'textarea',
							'rows'  => 3,
						),
						// ── LEFT: Feature Cards (repeater) ──
						array(
							'key'          => 'field_fltc_features',
							'label'        => 'Feature Cards',
							'name'         => 'features',
							'type'         => 'repeater',
							'layout'       => 'block',
							'button_label' => 'Add Feature Card',
							'sub_fields'   => array(
								array(
									'key'          => 'field_fltc_feat_icon',
									'label'        => 'Icon',
									'name'         => 'icon',
									'type'         => 'font-awesome',
									'icon_sets'    => array('fas', 'far', 'fal', 'fab'),
									'save_format'  => 'element',
									'allow_null'   => 0,
									'show_preview' => 1,
								),
								array(
									'key'           => 'field_fltc_feat_icon_color',
									'label'         => 'Icon Color',
									'name'          => 'icon_color',
									'type'          => 'select',
									'choices'       => array(
										'purple' => 'Purple',
										'blue'   => 'Blue',
										'green'  => 'Green',
										'orange' => 'Orange',
									),
									'default_value' => 'green',
								),
								array(
									'key'   => 'field_fltc_feat_title',
									'label' => 'Feature Title',
									'name'  => 'title',
									'type'  => 'text',
								),
								array(
									'key'  => 'field_fltc_feat_desc',
									'label' => 'Feature Description',
									'name'  => 'description',
									'type'  => 'textarea',
									'rows'  => 2,
								),
							),
						),
						// ── RIGHT: AI Assistant Card ──
						array(
							'key'           => 'field_fltc_card_title',
							'label'         => 'Card Header Title',
							'name'          => 'card_title',
							'type'          => 'text',
							'default_value' => 'AI Assistant in Action',
						),
						array(
							'key'          => 'field_fltc_card_rows',
							'label'        => 'Command / Response Rows',
							'name'         => 'card_rows',
							'type'         => 'repeater',
							'layout'       => 'block',
							'button_label' => 'Add Command / Response Pair',
							'sub_fields'   => array(
								array(
									'key'   => 'field_fltc_row_command',
									'label' => 'Command Text',
									'name'  => 'command_text',
									'type'  => 'text',
								),
								array(
									'key'   => 'field_fltc_row_response',
									'label' => 'Response Text',
									'name'  => 'response_text',
									'type'  => 'text',
								),
							),
						),
						// ── RIGHT: Footer Stats ──
						array(
							'key'           => 'field_fltc_footer_label',
							'label'         => 'Footer Label',
							'name'          => 'footer_label',
							'type'          => 'text',
							'default_value' => 'Productivity Boost',
						),
						array(
							'key'           => 'field_fltc_footer_value',
							'label'         => 'Footer Value',
							'name'          => 'footer_value',
							'type'          => 'text',
							'default_value' => '50%',
						),
						array(
							'key'           => 'field_fltc_footer_sub',
							'label'         => 'Footer Sub Text',
							'name'          => 'footer_sub',
							'type'          => 'text',
							'default_value' => 'Time saved on daily logging tasks',
						),
					),
				),
                // Layout: Feature Table
                'layout_feature_table' => array(
                    'key'     => 'layout_feature_table',
                    'name'    => 'feature_table',
                    'label'   => 'Feature Table',
                    'display' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_27',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_28',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
                        array(
                            'key'   => 'field_ftbl_badge_icon',
                            'label' => 'Badge Icon',
                            'name'  => 'badge_icon',
                            'type'  => 'font-awesome',
                            'icon_sets' => array('fas', 'far', 'fal', 'fab'),
                            'save_format' => 'class',
                        ),
                        array(
                            'key'   => 'field_ftbl_badge',
                            'label' => 'Badge Text',
                            'name'  => 'badge',
                            'type'  => 'text',
                        ),
                        array(
                            'key'   => 'field_ftbl_title',
                            'label' => 'Title',
                            'name'  => 'title',
                            'type'  => 'text',
                            'instructions' => 'Wrap the highlighted part in <span></span>',
                        ),
                        array(
                            'key'   => 'field_ftbl_subtitle',
                            'label' => 'Subtitle',
                            'name'  => 'subtitle',
                            'type'  => 'textarea',
                            'rows'  => 3,
                        ),
                        array(
                            'key'          => 'field_ftbl_cards',
                            'label'        => 'Cards',
                            'name'         => 'cards',
                            'type'         => 'repeater',
                            'layout'       => 'block',
                            'button_label' => 'Add Card',
                            'sub_fields'   => array(
                                array(
                                    'key'   => 'field_ftbl_card_icon',
                                    'label' => 'Icon',
                                    'name'  => 'icon',
                                    'type'  => 'font-awesome',
                                    'save_format' => 'class',
                                ),
                                array(
                                    'key'   => 'field_ftbl_card_icon_color',
                                    'label' => 'Icon Wrapper Color',
                                    'name'  => 'icon_color',
                                    'type'  => 'select',
                                    'choices' => array(
                                        'icon-green'  => 'Green',
                                        'icon-purple' => 'Purple',
                                        'icon-orange' => 'Orange',
                                    ),
                                ),
                                array(
                                    'key'   => 'field_ftbl_card_title',
                                    'label' => 'Card Title',
                                    'name'  => 'title',
                                    'type'  => 'text',
                                ),
                                array(
                                    'key'   => 'field_ftbl_card_desc',
                                    'label' => 'Card Description',
                                    'name'  => 'description',
                                    'type'  => 'textarea',
                                    'rows'  => 3,
                                ),
                                array(
                                    'key'   => 'field_ftbl_card_type',
                                    'label' => 'Card Type',
                                    'name'  => 'card_type',
                                    'type'  => 'select',
                                    'choices' => array(
                                        'balance_rows' => 'Balance Tracker Rows',
                                        'team_list'    => 'Team Member List',
                                        'holiday_list' => 'Holiday List',
                                    ),
                                    'default_value' => 'balance_rows',
                                ),
                                // Balance Rows Repeater
                                array(
                                    'key'          => 'field_ftbl_balance_rows',
                                    'label'        => 'Balance Rows',
                                    'name'         => 'balance_rows',
                                    'type'         => 'repeater',
                                    'layout'       => 'table',
                                    'conditional_logic' => array(
                                        array(
                                            array(
                                                'field'    => 'field_ftbl_card_type',
                                                'operator' => '==',
                                                'value'    => 'balance_rows',
                                            ),
                                        ),
                                    ),
                                    'sub_fields'   => array(
                                        array(
                                            'key'   => 'field_ftbl_b_label',
                                            'label' => 'Label',
                                            'name'  => 'label',
                                            'type'  => 'text',
                                        ),
                                        array(
                                            'key'   => 'field_ftbl_b_value',
                                            'label' => 'Value',
                                            'name'  => 'value',
                                            'type'  => 'text',
                                        ),
                                        array(
                                            'key'   => 'field_ftbl_b_color',
                                            'label' => 'Badge Color',
                                            'name'  => 'color',
                                            'type'  => 'select',
                                            'choices' => array(
                                                'badge-green'  => 'Green',
                                                'badge-blue'   => 'Blue',
                                                'badge-purple' => 'Purple',
                                            ),
                                        ),
                                    ),
                                ),
                                // Team List Repeater
                                array(
                                    'key'          => 'field_ftbl_team_list',
                                    'label'        => 'Team Members',
                                    'name'         => 'team_list',
                                    'type'         => 'repeater',
                                    'layout'       => 'table',
                                    'conditional_logic' => array(
                                        array(
                                            array(
                                                'field'    => 'field_ftbl_card_type',
                                                'operator' => '==',
                                                'value'    => 'team_list',
                                            ),
                                        ),
                                    ),
                                    'sub_fields'   => array(
                                        array(
                                            'key'   => 'field_ftbl_t_initials',
                                            'label' => 'Initials',
                                            'name'  => 'initials',
                                            'type'  => 'text',
                                        ),
                                        array(
                                            'key'   => 'field_ftbl_t_avatar_color',
                                            'label' => 'Avatar Color',
                                            'name'  => 'avatar_color',
                                            'type'  => 'select',
                                            'choices' => array(
                                                'av-jd' => 'Blue (JD style)',
                                                'av-sm' => 'Purple (SM style)',
                                                'av-rj' => 'Orange (RJ style)',
                                            ),
                                        ),
                                        array(
                                            'key'   => 'field_ftbl_t_name',
                                            'label' => 'Name',
                                            'name'  => 'name',
                                            'type'  => 'text',
                                        ),
                                        array(
                                            'key'   => 'field_ftbl_t_dates',
                                            'label' => 'Dates',
                                            'name'  => 'dates',
                                            'type'  => 'text',
                                        ),
                                    ),
                                ),
                                // Holiday List Repeater
                                array(
                                    'key'          => 'field_ftbl_holiday_list',
                                    'label'        => 'Holidays',
                                    'name'         => 'holiday_list',
                                    'type'         => 'repeater',
                                    'layout'       => 'table',
                                    'conditional_logic' => array(
                                        array(
                                            array(
                                                'field'    => 'field_ftbl_card_type',
                                                'operator' => '==',
                                                'value'    => 'holiday_list',
                                            ),
                                        ),
                                    ),
                                    'sub_fields'   => array(
                                        array(
                                            'key'   => 'field_ftbl_h_icon',
                                            'label' => 'Icon',
                                            'name'  => 'icon',
                                            'type'  => 'font-awesome',
                                            'save_format' => 'class',
                                        ),
                                        array(
                                            'key'   => 'field_ftbl_h_color',
                                            'label' => 'Row Color',
                                            'name'  => 'color',
                                            'type'  => 'select',
                                            'choices' => array(
                                                'pink'  => 'Pink',
                                                'blue'  => 'Blue',
                                                'green' => 'Green',
                                            ),
                                        ),
                                        array(
                                            'key'   => 'field_ftbl_h_name',
                                            'label' => 'Holiday Name',
                                            'name'  => 'name',
                                            'type'  => 'text',
                                        ),
                                        array(
                                            'key'   => 'field_ftbl_h_date',
                                            'label' => 'Date',
                                            'name'  => 'date',
                                            'type'  => 'text',
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
                // Layout: Icon Box
                'layout_icon_box' => array(
                    'key'     => 'layout_icon_box',
                    'name'    => 'icon_box',
                    'label'   => 'Icon Box',
                    'display' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_35',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_35',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
                        array(
                            'key'   => 'field_icon_box_title',
                            'label' => 'Title',
                            'name'  => 'title',
                            'type'  => 'text',
                        ),
                        array(
                            'key'   => 'field_icon_box_description',
                            'label' => 'Description',
                            'name'  => 'description',
                            'type'  => 'textarea',
                            'rows'  => 3,
                        ),
                        array(
                            'key'           => 'field_ib_show_number',
                            'label'         => 'Show Item Number',
                            'name'          => 'show_number',
                            'type'          => 'true_false',
                            'instructions'  => 'Enable to show item numbers (1., 2., 3., etc.) before the item text.',
                            'default_value' => 0,
                            'ui'            => 1,
                            'ui_on_text'    => 'Show',
                            'ui_off_text'   => 'Hide',
                        ),
                        array(
                            'key'          => 'field_ib_items',
                            'label'        => 'List Items',
                            'name'         => 'list_items',
                            'type'         => 'repeater',
                            'layout'       => 'table',
                            'button_label' => 'Add Item',
                            'sub_fields'   => array(
                                array(
                                    'key' => 'field_ib_icon',
                                    'label' => 'Icon',
                                    'name' => 'icon',
                                    'type' => 'font-awesome',
                                    'icon_sets' => array(
                                        0 => 'fas',
                                        1 => 'far',
                                        2 => 'fal',
                                        3 => 'fab',
                                    ),
                                    'custom_icon_set' => '',
                                    'default_label' => '',
                                    'default_value' => '',
                                    'save_format' => 'element',
                                    'allow_null' => 0,
                                    'show_preview' => 1,
                                    'enqueue_fa' => 0,
                                    'fa_live_preview' => '',
                                    'choices' => array(),
                                ),
                                array(
                                    'key'   => 'field_ib_list_text',
                                    'label' => 'Item Text',
                                    'name'  => 'title',
                                    'type'  => 'text',
                                    'instructions' => 'Basic HTML allowed (e.g. <strong>text</strong>).',
                                ),
                                array(
                                    'key'   => 'field_ib_list_description',
                                    'label' => 'Item Description',
                                    'name'  => 'description',
                                    'type'  => 'textarea',
                                    'rows'  => 3,
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_ib_icon_bg_color',
                            'label' => 'Icon Background Color',
                            'name' => 'icon_background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
                        array(
                            'key' => 'field_ib_icon_color',
                            'label' => 'Icon Color',
                            'name' => 'icon_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
                    ),
                ),
                // New Layout: Image Slider
                'layout_image_slider' => array(
                    'key' => 'layout_image_slider',
                    'name' => 'image_slider',
                    'label' => 'Image Slider',
                    'display' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_section_id_36',
                            'label' => 'Section ID',
                            'name' => 'section_id',
                            'type' => 'text',
                            'instructions' => 'use the ID with the right nav menu to scroll to section'
                        ),
                        array(
                            'key' => 'field_bg_color_36',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'extended-color-picker',
                            'default_value' => '',
                            'color_palette' => '',
                            'hide_palette' => 0,
                            'allow_in_bindings' => 1,
                        ),
                        array(
                            'key' => 'field_image_slider_title',
                            'label' => 'Title',
                            'name' => 'title',
                            'type' => 'text',
                        ),
                        array(
                            'key' => 'field_image_slider_sub_title',
                            'label' => 'Sub Title',
                            'name' => 'sub_title',
                            'type' => 'textarea',
                            'rows' => 3,
                            'new_lines' => 'br',
                        ),
                        array(
                            'key' => 'field_image_slider_slider',
                            'label' => 'Slider',
                            'name' => 'slider',
                            'type' => 'gallery',
                            'preview_size' => 'medium',
                            'insert' => 'append',
                            'library' => 'all',
                        ),
                    ),
                    'min' => '',
                    'max' => '',
                ),
                // New Layout: Hero Infographic
                'layout_hero_infographic' => array(
                    'key' => 'layout_hero_infographic',
                    'name' => 'hero_infographic',
                    'label' => 'Hero Infographic',
                    'display' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_hi_bg_image',
                            'label' => 'Background Image',
                            'name' => 'hi_background_image',
                            'type' => 'image',
                            'return_format' => 'url',
                            'preview_size' => 'medium',
                        ),
                        array(
                            'key'   => 'field_hi_title',
                            'label' => 'Title',
                            'name'  => 'title',
                            'type'  => 'textarea',
                            'rows'  => 3,
                            'instructions' => 'Use HTML like <span class="text-primary">...</span> for highlight.',
                        ),
                        array(
                            'key'   => 'field_hi_desc',
                            'label' => 'Description',
                            'name'  => 'description',
                            'type'  => 'textarea',
                            'rows'  => 3,
                        ),
                        array(
                            'key'          => 'field_hi_buttons',
                            'label'        => 'Buttons',
                            'name'         => 'buttons',
                            'type'         => 'repeater',
                            'layout'       => 'table',
                            'button_label' => 'Add Button',
                            'sub_fields'   => array(
                                array(
                                    'key'   => 'field_hi_btn_text',
                                    'label' => 'Button Text',
                                    'name'  => 'text',
                                    'type'  => 'text',
                                ),
                                array(
                                    'key'   => 'field_hi_popup_make',
                                    'label' => 'Open Popup',
                                    'name'  => 'open_popup',
                                    'type'  => 'text',
                                ),
                                array(
                                    'key'   => 'field_hi_btn_icon',
                                    'label' => 'Icon',
                                    'name'  => 'icon',
                                    'type'  => 'font-awesome',
                                    'icon_sets' => array(
                                        0 => 'fas',
                                        1 => 'far',
                                        2 => 'fal',
                                        3 => 'fab',
                                    ),
                                    'save_format' => 'element',
                                    'allow_null' => 1,
                                    'show_preview' => 1,
                                ),
                                array(
                                    'key'   => 'field_hi_btn_link',
                                    'label' => 'Button Link',
                                    'name'  => 'link',
                                    'type'  => 'link',
                                ),
                                array(
                                    'key'   => 'field_hi_btn_style',
                                    'label' => 'Button Style',
                                    'name'  => 'style',
                                    'type'  => 'select',
                                    'choices' => array(
                                        'btn-primary' => 'Primary (Solid)',
                                        'btn-primary-v2' => 'Primary (Solid V2)',
                                        'btn-outline-secondary' => 'Secondary (Outline)',
                                    ),
                                    'default_value' => 'btn-primary',
                                ),
                            ),
                        ),
                    ),
                    'min' => '',
                    'max' => '',
                ),
                // New Layout: Why Choose Us
                'layout_why_choose_us' => array(
                    'key' => 'layout_why_choose_us',
                    'name' => 'why_choose_us',
                    'label' => 'Why Choose Us',
                    'display' => 'block',
                    'sub_fields' => array(
                    ),
                    'min' => '',
                    'max' => '',
                ),
			),
			'button_label' => 'Add Row',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'page',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array(
		0 => 'the_content',
	),
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
));

acf_add_local_field_group(array(
	'key' => 'group_header_settings',
	'title' => 'Header Settings',
	'fields' => array(
		array(
			'key' => 'field_header_logo',
			'label' => 'Header Logo',
			'name' => 'header_logo',
			'type' => 'image',
			'return_format' => 'url',
			'preview_size' => 'medium',
		),
		array(
			'key' => 'field_header_btn_text',
			'label' => 'Button Text',
			'name' => 'header_button_text',
			'type' => 'text',
			'default_value' => 'Contact us',
		),
		array(
			'key' => 'field_header_btn_link',
			'label' => 'Button Link',
			'name' => 'header_button_link',
			'type' => 'link',
		),
		array(
			'key' => 'field_header_menu',
			'label' => 'OffCanvas Header Menu',
			'name' => 'header_menu',
			'type' => 'select',
			'instructions' => 'Select a menu to display in the header offcanvas drawer.',
			'choices' => array(),
			'return_format' => 'value',
			'ui' => 1,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-general-settings',
			),
		),
	),
	),
);

acf_add_local_field_group(array(
	'key' => 'group_footer_settings',
	'title' => 'Footer Settings',
	'fields' => array(
		array(
			'key' => 'field_footer_logo',
			'label' => 'Footer Logo',
			'name' => 'footer_logo',
			'type' => 'image',
			'return_format' => 'url',
		),
		array(
			'key' => 'field_footer_desc',
			'label' => 'Footer Description',
			'name' => 'footer_description',
			'type' => 'textarea',
			'rows' => 4,
		),
		array(
			'key' => 'field_footer_social',
			'label' => 'Social Links',
			'name' => 'footer_social_links',
			'type' => 'repeater',
			'layout' => 'table',
			'button_label' => 'Add Social Link',
			'sub_fields' => array(
				array(
					'key' => 'field_social_icon',
					'label' => 'Icon',
					'name' => 'icon',
					'type' => 'font-awesome',
					'icon_sets' => array(
						0 => 'fas',
						1 => 'far',
						2 => 'fal',
						3 => 'fab',
					),
					'custom_icon_set' => '',
					'default_label' => '',
					'default_value' => '',
					'save_format' => 'element',
					'allow_null' => 0,
					'show_preview' => 1,
					'enqueue_fa' => 0,
					'fa_live_preview' => '',
					'choices' => array(),
				),
				array(
					'key' => 'field_social_url',
					'label' => 'URL',
					'name' => 'url',
					'type' => 'url',
				),
				array(
					'key' => 'field_social_label',
					'label' => 'Aria Label',
					'name' => 'label',
					'type' => 'text',
				),
			),
		),
		array(
			'key' => 'field_footer_menu_1_title',
			'label' => 'Menu 1 Title',
			'name' => 'footer_menu_1_title',
			'type' => 'text',
			'default_value' => 'Quick Links',
		),
		array(
			'key' => 'field_footer_menu_1',
			'label' => 'Footer Menu 1',
			'name' => 'footer_menu_1',
			'type' => 'select',
			'instructions' => 'Select a menu to display for Menu 1.',
			'choices' => array(),
			'return_format' => 'value',
			'ui' => 1,
		),
		array(
			'key' => 'field_footer_menu_2_title',
			'label' => 'Menu 2 Title',
			'name' => 'footer_menu_2_title',
			'type' => 'text',
			'default_value' => 'Products',
		),
		array(
			'key' => 'field_footer_menu_2',
			'label' => 'Footer Menu 2',
			'name' => 'footer_menu_2',
			'type' => 'select',
			'instructions' => 'Select a menu to display for Menu 2.',
			'choices' => array(),
			'return_format' => 'value',
			'ui' => 1,
		),
		array(
			'key' => 'field_footer_contact_title',
			'label' => 'Contact Us Title',
			'name' => 'footer_contact_title',
			'type' => 'text',
			'default_value' => 'Contact Us',
		),
		array(
			'key' => 'field_footer_contact_info',
			'label' => 'Contact Info List',
			'name' => 'footer_contact_info',
			'type' => 'repeater',
			'layout' => 'block',
			'button_label' => 'Add Contact Item',
			'sub_fields' => array(
				array(
					'key' => 'field_contact_icon',
					'label' => 'Icon',
					'name' => 'icon',
					'type' => 'font-awesome',
					'icon_sets' => array(
						0 => 'fas',
						1 => 'far',
						2 => 'fal',
						3 => 'fab',
					),
					'custom_icon_set' => '',
					'default_label' => '',
					'default_value' => '',
					'save_format' => 'element',
					'allow_null' => 0,
					'show_preview' => 1,
					'enqueue_fa' => 0,
					'fa_live_preview' => '',
					'choices' => array(),
				),
				array(
					'key' => 'field_contact_text',
					'label' => 'Text',
					'name' => 'text',
					'type' => 'text',
				),
				array(
					'key' => 'field_contact_link',
					'label' => 'Link (e.g. mailto: or tel:)',
					'name' => 'link',
					'type' => 'text',
				),
			),
		),
		array(
			'key' => 'field_footer_copy',
			'label' => 'Copyright Text',
			'name' => 'footer_copyright',
			'type' => 'text',
			'default_value' => '© 2026 RASN Consult. All right reserved',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-general-settings',
			),
		),
	),
));

endif;

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title'    => 'Theme General Settings',
		'menu_title'    => 'Theme Settings',
		'menu_slug'     => 'theme-general-settings',
		'capability'    => 'edit_posts',
		'redirect'      => false
	));
}

require get_stylesheet_directory() . '/acf-helpers.php';

/**
 * AJAX Load More Posts
 */
function rasn_get_read_time( $content ) {
    $word_count = str_word_count( strip_tags( $content ) );
    $readingtime = ceil( $word_count / 200 );
    return ( $readingtime <= 1 ? '1' : $readingtime ) . ' min read';
}

function rasn_load_more_posts() {
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 3;
    
    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => $posts_per_page,
        'paged'          => $page,
    );
    
    $query = new WP_Query( $args );
    
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            get_template_part( 'template-parts/content', 'blog-card' );
        }
        wp_reset_postdata();
    }
    
    wp_die();
}
add_action( 'wp_ajax_rasn_load_more_posts', 'rasn_load_more_posts' );
add_action( 'wp_ajax_nopriv_rasn_load_more_posts', 'rasn_load_more_posts' );

/**
 * Add custom admin styles for ACF layout tooltip
 */
function rasn_custom_admin_styles() {
    echo '<style>
        .acf-tooltip.acf-fc-popup ul {
            overflow-y: scroll;
            max-height: 340px;
        }
       
        .acf-tooltip.acf-fc-popup ul li:hover a {
            color: #fff !important;
            background: #007cba !important;
        }
    </style>';
}
add_action('admin_head', 'rasn_custom_admin_styles');


