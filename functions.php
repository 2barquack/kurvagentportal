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

// Prevent WordPress auto-discovery from interfering with our explicit pattern registration.
// We handle pattern registration explicitly to ensure proper category assignment and block availability.
add_filter( 'theme_block_pattern_files', function( $files, $dirpath ) {
	// Remove our custom patterns from auto-discovery - we register them explicitly
	$our_patterns = array(
		'core-platform-capabilities.php',
		'application-pipeline-management.php',
		'portfolio-navigation-monitoring.php',
		'residual-projection-revenue-tracking.php',
	);
	
	foreach ( $our_patterns as $pattern_file ) {
		$key = array_search( $pattern_file, $files, true );
		if ( false !== $key ) {
			unset( $files[ $key ] );
		}
	}
	
	return $files;
}, 10, 2 );

// Clear pattern cache on theme activation/update and on init (for development)
add_action( 'after_switch_theme', function() {
	$theme = wp_get_theme();
	if ( method_exists( $theme, 'delete_pattern_cache' ) ) {
		$theme->delete_pattern_cache();
	}
} );

// Clear pattern cache on init (helps during development when patterns aren't showing)
add_action( 'init', function() {
	// Only clear cache if WP_DEBUG is enabled (development mode)
	if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
		$theme = wp_get_theme();
		if ( method_exists( $theme, 'delete_pattern_cache' ) ) {
			$theme->delete_pattern_cache();
		}
	}
}, 1 );

// Registers custom block patterns.
if ( ! function_exists( 'kurv_knowledgebase_2026_register_patterns' ) ) :
	/**
	 * Registers custom block patterns.
	 * 
	 * Note: WordPress auto-discovers patterns from /patterns directory,
	 * but we explicitly register our custom patterns to ensure they work
	 * correctly with our custom blocks and categories.
	 *
	 * @since Kurv Knowledgebase 2026 1.0
	 *
	 * @return void
	 */
	function kurv_knowledgebase_2026_register_patterns() {
		$registry = WP_Block_Patterns_Registry::get_instance();
		
		$patterns = array(
			'core-platform-capabilities',
			'application-pipeline-management',
			'portfolio-navigation-monitoring',
			'residual-projection-revenue-tracking',
		);

		foreach ( $patterns as $pattern ) {
			$pattern_file = get_template_directory() . '/patterns/' . $pattern . '.php';
			
			if ( ! file_exists( $pattern_file ) ) {
				continue;
			}

			// Read file content
			$file_content = file_get_contents( $pattern_file );
			
			// Extract metadata from file header using WordPress standard headers
			$pattern_data = get_file_data(
				$pattern_file,
				array(
					'title'       => 'Title',
					'slug'        => 'Slug',
					'description' => 'Description',
					'categories'  => 'Categories',
					'inserter'    => 'Inserter',
				)
			);

			// Validate required fields
			if ( empty( $pattern_data['title'] ) || empty( $pattern_data['slug'] ) ) {
				continue;
			}

			// Extract block markup content (everything after the closing ?>)
			$pattern_content = '';
			if ( preg_match( '/\?>\s*(.*)/s', $file_content, $matches ) ) {
				$pattern_content = trim( $matches[1] );
			}

			// Skip if no content found
			if ( empty( $pattern_content ) ) {
				continue;
			}

			// Parse categories - ensure kb-patterns is included
			$categories = array();
			if ( ! empty( $pattern_data['categories'] ) ) {
				$category_list = array_map( 'trim', explode( ',', $pattern_data['categories'] ) );
				$categories = array_filter( $category_list ); // Remove empty values
			}
			
			// Ensure kb-patterns category is always included
			if ( ! in_array( 'kb-patterns', $categories, true ) ) {
				$categories[] = 'kb-patterns';
			}

			// Check inserter setting (default to true if not specified)
			$inserter = true;
			if ( ! empty( $pattern_data['inserter'] ) ) {
				$inserter_val = strtolower( trim( $pattern_data['inserter'] ) );
				$inserter = in_array( $inserter_val, array( 'true', '1', 'yes' ), true );
			}

			// Unregister if already registered (from auto-discovery or previous registration)
			if ( $registry->is_registered( $pattern_data['slug'] ) ) {
				unregister_block_pattern( $pattern_data['slug'] );
			}

			// Register the pattern with all required properties
			$result = register_block_pattern(
				$pattern_data['slug'],
				array(
					'title'       => $pattern_data['title'],
					'description' => ! empty( $pattern_data['description'] ) ? $pattern_data['description'] : '',
					'content'     => $pattern_content,
					'categories'  => $categories,
					'inserter'    => $inserter,
				)
			);
		}
	}
endif;
// Register patterns after blocks are registered (priority 20 ensures blocks are loaded first)
add_action( 'init', 'kurv_knowledgebase_2026_register_patterns', 20 );

// Debug: Show pattern and block registration status in admin
// This helps verify that patterns and blocks are properly registered
add_action( 'admin_notices', function() {
	if ( ! current_user_can( 'edit_posts' ) ) {
		return;
	}
	
	// Only show in debug mode or when ?debug_patterns=1 is in URL
	if ( ! defined( 'WP_DEBUG' ) || ! WP_DEBUG ) {
		if ( ! isset( $_GET['debug_patterns'] ) || '1' !== $_GET['debug_patterns'] ) {
			return;
		}
	}
	
	$registry = WP_Block_Patterns_Registry::get_instance();
	$our_patterns = array(
		'kurv-knowledgebase-2026/core-platform-capabilities',
		'kurv-knowledgebase-2026/application-pipeline-management',
		'kurv-knowledgebase-2026/portfolio-navigation-monitoring',
		'kurv-knowledgebase-2026/residual-projection-revenue-tracking',
	);
	
	$registered_patterns = array();
	$missing_patterns = array();
	
	foreach ( $our_patterns as $slug ) {
		if ( $registry->is_registered( $slug ) ) {
			$pattern_data = $registry->get_registered( $slug );
			$registered_patterns[] = array(
				'slug' => $slug,
				'title' => isset( $pattern_data['title'] ) ? $pattern_data['title'] : 'Unknown',
				'categories' => isset( $pattern_data['categories'] ) ? $pattern_data['categories'] : array(),
				'inserter' => isset( $pattern_data['inserter'] ) ? $pattern_data['inserter'] : true,
			);
		} else {
			$missing_patterns[] = $slug;
		}
	}
	
	// Check block registration
	$block_registry = WP_Block_Type_Registry::get_instance();
	$our_blocks = array(
		'kurv-knowledgebase-2026/card-manager',
		'kurv-knowledgebase-2026/card-item',
	);
	
	$registered_blocks = array();
	$missing_blocks = array();
	
	foreach ( $our_blocks as $block_name ) {
		if ( $block_registry->is_registered( $block_name ) ) {
			$registered_blocks[] = $block_name;
		} else {
			$missing_blocks[] = $block_name;
		}
	}
	
	// Display debug information
	echo '<div class="notice notice-info" style="padding: 15px;">';
	echo '<h3 style="margin-top: 0;">Pattern & Block Registration Debug</h3>';
	
	// Patterns status
	if ( ! empty( $missing_patterns ) ) {
		echo '<p style="color: #d63638;"><strong>❌ Missing Patterns:</strong> ' . esc_html( implode( ', ', $missing_patterns ) ) . '</p>';
	} else {
		echo '<p style="color: #00a32a;"><strong>✅ All 4 patterns registered successfully!</strong></p>';
	}
	
	if ( ! empty( $registered_patterns ) ) {
		echo '<details style="margin-top: 10px;"><summary style="cursor: pointer; font-weight: bold;">Registered Patterns Details</summary><ul style="margin-left: 20px;">';
		foreach ( $registered_patterns as $pattern ) {
			echo '<li>';
			echo '<strong>' . esc_html( $pattern['title'] ) . '</strong> (' . esc_html( $pattern['slug'] ) . ')<br>';
			echo 'Categories: ' . esc_html( implode( ', ', $pattern['categories'] ) ) . '<br>';
			echo 'Inserter: ' . ( $pattern['inserter'] ? '✅ Enabled' : '❌ Disabled' );
			echo '</li>';
		}
		echo '</ul></details>';
	}
	
	// Blocks status
	if ( ! empty( $missing_blocks ) ) {
		echo '<p style="color: #d63638; margin-top: 15px;"><strong>❌ Missing Blocks:</strong> ' . esc_html( implode( ', ', $missing_blocks ) ) . '</p>';
	} else {
		echo '<p style="color: #00a32a; margin-top: 15px;"><strong>✅ All 2 blocks registered successfully!</strong></p>';
	}
	
	if ( ! empty( $registered_blocks ) ) {
		echo '<p style="margin-top: 10px;">Registered Blocks: ' . esc_html( implode( ', ', $registered_blocks ) ) . '</p>';
	}
	
	echo '<p style="margin-top: 15px; font-size: 12px; color: #666;">To hide this notice, disable WP_DEBUG or remove ?debug_patterns=1 from URL</p>';
	echo '</div>';
} );

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
// Register blocks early (priority 9) so they're available when patterns register (priority 20)
add_action( 'init', 'kurv_knowledgebase_2026_register_blocks', 9 );
