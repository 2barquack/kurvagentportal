<?php
/**
 * Kurv Knowledgebase 2026 functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Kurv_Knowledgebase_2026
 * @since Kurv Knowledgebase 2026 1.0
 */

// Adds theme support for post formats.
if ( ! function_exists( 'kurv_knowledgebase_2026_post_format_setup' ) ) :
	/**
	 * Adds theme support for post formats.
	 *
	 * @since Kurv Knowledgebase 2026 1.0
	 *
	 * @return void
	 */
	function kurv_knowledgebase_2026_post_format_setup() {
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	}
endif;
add_action( 'after_setup_theme', 'kurv_knowledgebase_2026_post_format_setup' );

// Enqueues editor-style.css in the editors.
if ( ! function_exists( 'kurv_knowledgebase_2026_editor_style' ) ) :
	/**
	 * Enqueues editor-style.css in the editors.
	 *
	 * @since Kurv Knowledgebase 2026 1.0
	 *
	 * @return void
	 */
	function kurv_knowledgebase_2026_editor_style() {
		add_editor_style( 'assets/css/editor-style.css' );
	}
endif;
add_action( 'after_setup_theme', 'kurv_knowledgebase_2026_editor_style' );

// Enqueues the theme stylesheet on the front.
if ( ! function_exists( 'kurv_knowledgebase_2026_enqueue_styles' ) ) :
	/**
	 * Enqueues the theme stylesheet on the front.
	 *
	 * @since Kurv Knowledgebase 2026 1.0
	 *
	 * @return void
	 */
	function kurv_knowledgebase_2026_enqueue_styles() {
		$suffix = SCRIPT_DEBUG ? '' : '.min';
		$src    = 'style' . $suffix . '.css';

		wp_enqueue_style(
			'kurv-knowledgebase-2026-style',
			get_parent_theme_file_uri( $src ),
			array(),
			wp_get_theme()->get( 'Version' )
		);
		wp_style_add_data(
			'kurv-knowledgebase-2026-style',
			'path',
			get_parent_theme_file_path( $src )
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'kurv_knowledgebase_2026_enqueue_styles' );

// Enqueues the theme JavaScript on the front.
if ( ! function_exists( 'kurv_knowledgebase_2026_enqueue_scripts' ) ) :
	/**
	 * Enqueues the theme JavaScript on the front.
	 *
	 * @since Kurv Knowledgebase 2026 1.0
	 *
	 * @return void
	 */
	function kurv_knowledgebase_2026_enqueue_scripts() {
		$js_file = get_parent_theme_file_path( 'assets/js/main.js' );
		
		// Only enqueue if the file exists (built by Vite)
		if ( file_exists( $js_file ) ) {
			wp_enqueue_script(
				'kurv-knowledgebase-2026-script',
				get_parent_theme_file_uri( 'assets/js/main.js' ),
				array(),
				wp_get_theme()->get( 'Version' ),
				true
			);
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'kurv_knowledgebase_2026_enqueue_scripts' );

// Registers custom block styles.
if ( ! function_exists( 'kurv_knowledgebase_2026_block_styles' ) ) :
	/**
	 * Registers custom block styles.
	 *
	 * @since Kurv Knowledgebase 2026 1.0
	 *
	 * @return void
	 */
	function kurv_knowledgebase_2026_block_styles() {
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'kurv-knowledgebase-2026' ),
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
	}
endif;
add_action( 'init', 'kurv_knowledgebase_2026_block_styles' );

// Registers pattern categories.
if ( ! function_exists( 'kurv_knowledgebase_2026_pattern_categories' ) ) :
	/**
	 * Registers pattern categories.
	 *
	 * @since Kurv Knowledgebase 2026 1.0
	 *
	 * @return void
	 */
	function kurv_knowledgebase_2026_pattern_categories() {

		register_block_pattern_category(
			'kb-patterns',
			array(
				'label'       => __( 'KB-Patterns', 'kurv-knowledgebase-2026' ),
				'description' => __( 'Custom patterns for Kurv Knowledgebase 2026 theme.', 'kurv-knowledgebase-2026' ),
			)
		);

		register_block_pattern_category(
			'kurv_knowledgebase_2026_page',
			array(
				'label'       => __( 'Pages', 'kurv-knowledgebase-2026' ),
				'description' => __( 'A collection of full page layouts.', 'kurv-knowledgebase-2026' ),
			)
		);

		register_block_pattern_category(
			'kurv_knowledgebase_2026_post-format',
			array(
				'label'       => __( 'Post formats', 'kurv-knowledgebase-2026' ),
				'description' => __( 'A collection of post format patterns.', 'kurv-knowledgebase-2026' ),
			)
		);
	}
endif;
add_action( 'init', 'kurv_knowledgebase_2026_pattern_categories' );

// Registers block binding sources.
if ( ! function_exists( 'kurv_knowledgebase_2026_register_block_bindings' ) ) :
	/**
	 * Registers the post format block binding source.
	 *
	 * @since Kurv Knowledgebase 2026 1.0
	 *
	 * @return void
	 */
	function kurv_knowledgebase_2026_register_block_bindings() {
		register_block_bindings_source(
			'kurv-knowledgebase-2026/format',
			array(
				'label'              => _x( 'Post format name', 'Label for the block binding placeholder in the editor', 'kurv-knowledgebase-2026' ),
				'get_value_callback' => 'kurv_knowledgebase_2026_format_binding',
			)
		);
	}
endif;
add_action( 'init', 'kurv_knowledgebase_2026_register_block_bindings' );

// Registers block binding callback function for the post format name.
if ( ! function_exists( 'kurv_knowledgebase_2026_format_binding' ) ) :
	/**
	 * Callback function for the post format name block binding source.
	 *
	 * @since Kurv Knowledgebase 2026 1.0
	 *
	 * @return string|void Post format name, or nothing if the format is 'standard'.
	 */
	function kurv_knowledgebase_2026_format_binding() {
		$post_format_slug = get_post_format();

		if ( $post_format_slug && 'standard' !== $post_format_slug ) {
			return get_post_format_string( $post_format_slug );
		}
	}
endif;

// Registers custom blocks.
if ( ! function_exists( 'kurv_knowledgebase_2026_register_blocks' ) ) :
	/**
	 * Registers custom Gutenberg blocks.
	 *
	 * @since Kurv Knowledgebase 2026 1.0
	 *
	 * @return void
	 */
	function kurv_knowledgebase_2026_register_blocks() {
		$blocks = array(
			'card-manager',
			'card-item',
		);

		foreach ( $blocks as $block ) {
			// Register as static block (no render_callback)
			// The block.json and save function handle rendering
			register_block_type( get_template_directory() . '/blocks/' . $block );
		}
	}
endif;
add_action( 'init', 'kurv_knowledgebase_2026_register_blocks' );
