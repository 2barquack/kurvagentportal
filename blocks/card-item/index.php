<?php
/**
 * Card Item Block
 *
 * @package Kurv_Knowledgebase_2026
 * @since 1.0.0
 */

// Block attributes
$icon        = isset( $attributes['icon'] ) ? $attributes['icon'] : '⚡';
$title       = isset( $attributes['title'] ) ? $attributes['title'] : 'Card Title';
$title_level = isset( $attributes['titleLevel'] ) ? $attributes['titleLevel'] : 3;

// Wrapper attributes
$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class' => 'card-item',
	)
);

// Title tag
$title_tag = 'h' . $title_level;
?>

<div <?php echo $wrapper_attributes; ?>>
	<?php if ( ! empty( $icon ) ) : ?>
		<div class="card-item-icon">
			<?php echo esc_html( $icon ); ?>
		</div>
	<?php endif; ?>
	
	<?php if ( ! empty( $title ) ) : ?>
		<<?php echo esc_attr( $title_tag ); ?> class="card-item-title">
			<?php echo esc_html( $title ); ?>
		</<?php echo esc_attr( $title_tag ); ?>>
	<?php endif; ?>
	
	<div class="card-item-content">
		<InnerBlocks.Content />
	</div>
</div>
