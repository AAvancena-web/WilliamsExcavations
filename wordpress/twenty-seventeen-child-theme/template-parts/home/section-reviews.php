<?php
/**
 * Homepage testimonial slider.
 *
 * @package Twenty_Seventeen_Child
 */

defined( 'ABSPATH' ) || exit;

$reviews = we_rows( 'reviews' );
if ( ! $reviews ) {
	return;
}
?>
<section class="we-section we-section--dark we-reviews">
	<div class="we-container">
		<div class="we-section-head we-section-head--center" data-reveal>
			<?php we_eyebrow( we_f( 'reviews_eyebrow' ) ); ?>
			<h2 class="we-h-lg"><?php echo esc_html( we_f( 'reviews_heading' ) ); ?></h2>
		</div>

		<div class="we-review-track" id="we-reviewTrack">
			<?php foreach ( $reviews as $i => $review ) : ?>
				<article class="we-review<?php echo 0 === $i ? ' we-is-active' : ''; ?>">
					<div class="we-review__stars">
						<?php for ( $s = 0; $s < (int) ( $review['rating'] ? $review['rating'] : 5 ); $s++ ) : ?>
							<i class="fa-solid fa-star"></i>
						<?php endfor; ?>
					</div>
					<p class="we-review__text"><?php echo esc_html( $review['text'] ); ?></p>
					<div class="we-review__who">
						<strong><?php echo esc_html( $review['name'] ); ?></strong>
						<span><?php echo esc_html( $review['location'] ); ?></span>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

		<div class="we-review-dots" id="we-reviewDots"></div>
	</div>
</section>
