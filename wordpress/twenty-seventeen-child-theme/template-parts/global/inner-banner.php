<?php
/**
 * Inner page banner.
 *
 * Mirrors the homepage hero: page title and intro on the left, the quote form
 * on the right. Shown on every page except the homepage template.
 *
 * A page can override the banner image with its featured image.
 *
 * @package Twenty_Seventeen_Child
 */

defined( 'ABSPATH' ) || exit;

$we_image = has_post_thumbnail() ? get_post_thumbnail_id() : we_opt( 'opt_inner_image' );
$we_phone = we_opt( 'opt_phone' );
$we_tel   = 'tel:' . preg_replace( '/\s+/', '', (string) $we_phone );

if ( is_search() ) {
	$we_title = sprintf( __( 'Search results for %s', 'twentyseventeen-child' ), get_search_query() );
} elseif ( is_archive() ) {
	$we_title = get_the_archive_title();
} elseif ( is_home() ) {
	$we_title = single_post_title( '', false );
} else {
	$we_title = get_the_title();
}

$we_excerpt = ( is_singular() && has_excerpt() ) ? get_the_excerpt() : '';
?>
<section class="we-hero we-hero--inner">
	<div class="we-hero__bg">
		<?php we_the_image( $we_image, '', 'full' ); ?>
	</div>

	<div class="we-container">
		<div class="we-hero__grid">

			<div class="we-hero__content">
				<?php we_eyebrow( get_bloginfo( 'name' ) ); ?>
				<h1><?php echo esc_html( $we_title ); ?></h1>

				<?php if ( $we_excerpt ) : ?>
					<p class="we-hero__copy"><?php echo esc_html( $we_excerpt ); ?></p>
				<?php endif; ?>

				<div class="we-hero__ctas">
					<a href="#we-content" class="we-btn we-btn--lg"><i class="fa-solid fa-arrow-down-long"></i> <?php esc_html_e( 'Read More', 'twentyseventeen-child' ); ?></a>
					<?php if ( $we_phone ) : ?>
						<a href="<?php echo esc_url( $we_tel ); ?>" class="we-btn we-btn--light we-btn--lg"><i class="fa-solid fa-phone"></i> <?php echo esc_html( $we_phone ); ?></a>
					<?php endif; ?>
				</div>
			</div>

			<div class="we-quote-card">
				<?php if ( we_opt( 'opt_inner_form_tag' ) ) : ?>
					<span class="we-quote-card__tag"><?php echo esc_html( we_opt( 'opt_inner_form_tag' ) ); ?></span>
				<?php endif; ?>
				<h2><?php echo esc_html( we_opt( 'opt_inner_form_heading' ) ); ?></h2>
				<p class="we-quote-card__sub"><?php echo esc_html( we_opt( 'opt_inner_form_sub' ) ); ?></p>
				<?php we_form( we_opt( 'opt_inner_form_id' ) ); ?>
				<?php if ( we_opt( 'opt_inner_form_note' ) ) : ?>
					<p class="we-form-note"><?php echo esc_html( we_opt( 'opt_inner_form_note' ) ); ?></p>
				<?php endif; ?>
			</div>

		</div>
	</div>
</section>
<div id="we-content"></div>
