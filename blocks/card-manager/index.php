<?php
/**
 * Card Manager Block
 *
 * @package Kurv_Knowledgebase_2026
 * @since 1.0.0
 */

// Block attributes
$heading      = isset( $attributes['heading'] ) ? $attributes['heading'] : 'Core Platform Capabilities';
$heading_level = isset( $attributes['headingLevel'] ) ? $attributes['headingLevel'] : 2;
$columns      = isset( $attributes['columns'] ) ? $attributes['columns'] : 3;
$intro_paragraph = isset( $attributes['introParagraph'] ) ? $attributes['introParagraph'] : '';

// Wrapper attributes
$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class' => 'card-manager-wrapper',
		'data-columns' => $columns,
	)
);

// Heading tag
$heading_tag = 'h' . $heading_level;
?>

<div <?php echo $wrapper_attributes; ?>>
	<?php if ( ! empty( $heading ) ) : ?>
		<<?php echo esc_attr( $heading_tag ); ?> class="card-manager-heading">
			<span class="heading-line heading-line-top"></span>
			<span class="heading-text"><?php echo esc_html( $heading ); ?></span>
			<span class="heading-line heading-line-bottom"></span>
		</<?php echo esc_attr( $heading_tag ); ?>>
	<?php endif; ?>
	
	<?php if ( ! empty( $intro_paragraph ) ) : ?>
		<p class="card-manager-intro"><?php echo esc_html( $intro_paragraph ); ?></p>
	<?php endif; ?>
	
	<div class="card-manager-container">
		<InnerBlocks 
			allowedBlocks="<?php echo esc_attr( wp_json_encode( array( 'kurv-knowledgebase-2026/card-item' ) ) ); ?>"
			template="<?php echo esc_attr( wp_json_encode( array() ) ); ?>"
			orientation="horizontal"
		/>
	</div>
</div>
