<?php
/**
 * Title: Footer with columns
 * Slug: kurv-knowledgebase-2026/footer-columns
 * Categories: footer
 * Block Types: core/template-part/footer
 * Description: Footer columns with title, tagline and links.
 *
 * @package WordPress
 * @subpackage Kurv_Knowledgebase_2026
 * @since Kurv Knowledgebase 2026 1.0
 */

?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:group {"align":"full","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"top"}} -->
		<div class="wp-block-group alignfull">
			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
				<!-- wp:site-title {"level":2,"fontSize":"xx-large"} /-->
				<!-- wp:site-tagline /-->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|80"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
			<div class="wp-block-group">
				<!-- wp:group {"style":{"spacing":{"padding":{"right":"0","left":"0"}}},"layout":{"type":"constrained"}} -->
				<div class="wp-block-group" style="padding-right:0;padding-left:0">
					<!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"700"}},"fontSize":"medium"} -->
					<h3 class="wp-block-heading has-medium-font-size" style="font-style:normal;font-weight:700"><?php esc_html_e( 'Stories', 'kurv-knowledgebase-2026' ); ?></h3>
					<!-- /wp:heading -->
					<!-- wp:navigation {"overlayMenu":"never","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"fontSize":"medium","layout":{"type":"flex","orientation":"vertical"},"ariaLabel":"<?php esc_attr_e( 'Stories', 'kurv-knowledgebase-2026' ); ?>"} -->
						<!-- wp:navigation-link {"label":"<?php esc_html_e( 'Blog', 'kurv-knowledgebase-2026' ); ?>","url":"#"} /-->
						<!-- wp:navigation-link {"label":"<?php esc_html_e( 'About', 'kurv-knowledgebase-2026' ); ?>","url":"#"} /-->
						<!-- wp:navigation-link {"label":"<?php esc_html_e( 'FAQs', 'kurv-knowledgebase-2026' ); ?>","url":"#"} /-->
						<!-- wp:navigation-link {"label":"<?php esc_html_e( 'Authors', 'kurv-knowledgebase-2026' ); ?>","url":"#"} /-->
					<!-- /wp:navigation -->
				</div>
				<!-- /wp:group -->
				<!-- wp:group {"style":{"spacing":{"padding":{"right":"0","left":"0"}}},"layout":{"type":"constrained"}} -->
				<div class="wp-block-group" style="padding-right:0;padding-left:0">
					<!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"700"}},"fontSize":"medium"} -->
					<h3 class="wp-block-heading has-medium-font-size" style="font-style:normal;font-weight:700"><?php echo esc_html_x( 'Fleurs', 'Example brand name.', 'kurv-knowledgebase-2026' ); ?></h3>
					<!-- /wp:heading -->
					<!-- wp:navigation {"overlayMenu":"never","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"fontSize":"medium","layout":{"type":"flex","orientation":"vertical"},"ariaLabel":"<?php esc_attr_e( 'Featured', 'kurv-knowledgebase-2026' ); ?>"} -->
						<!-- wp:navigation-link {"label":"<?php esc_html_e( 'Events', 'kurv-knowledgebase-2026' ); ?>","url":"#"} /-->
						<!-- wp:navigation-link {"label":"<?php esc_html_e( 'Shop', 'kurv-knowledgebase-2026' ); ?>","url":"#"} /-->
						<!-- wp:navigation-link {"label":"<?php esc_html_e( 'Patterns', 'kurv-knowledgebase-2026' ); ?>","url":"#"} /-->
						<!-- wp:navigation-link {"label":"<?php esc_html_e( 'Themes', 'kurv-knowledgebase-2026' ); ?>","url":"#"} /-->
					<!-- /wp:navigation -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
		<!-- wp:spacer {"height":"var:preset|spacing|60"} -->
		<div style="height:var(--wp--preset--spacing--60)" aria-hidden="true" class="wp-block-spacer"></div>
		<!-- /wp:spacer -->
		<!-- wp:group {"align":"full","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
		<div class="wp-block-group alignfull">
			<!-- wp:paragraph {"fontSize":"small"} -->
			<p class="has-small-font-size"><?php esc_html_e( 'Kurv Knowledgebase 2026', 'kurv-knowledgebase-2026' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"fontSize":"small"} -->
			<p class="has-small-font-size">
			<?php
			printf(
				/* translators: Designed with WordPress. %s: WordPress link. */
				esc_html__( 'Designed with %s', 'kurv-knowledgebase-2026' ),
				'<a href="' . esc_url( __( 'https://wordpress.org', 'kurv-knowledgebase-2026' ) ) . '" rel="nofollow">WordPress</a>'
			);
			?>
			</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
