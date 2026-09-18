<?php
/**
 * Homepage stats band with animated counters.
 *
 * @package Twenty_Seventeen_Child
 */

defined( 'ABSPATH' ) || exit;

$stats = we_rows( 'stats' );
if ( ! $stats ) {
	return;
}
?>
<section class="we-stats">
	<div class="we-container">
		<?php foreach ( $stats as $s ) : ?>
			<div class="we-stat" data-reveal>
				<i class="<?php echo esc_attr( $s['icon'] ); ?>"></i>
				<div>
					<div class="we-stat__num">
						<span class="we-count" data-to="<?php echo esc_attr( $s['number'] ); ?>"<?php echo ! empty( $s['decimals'] ) ? ' data-dec="' . esc_attr( $s['decimals'] ) . '"' : ''; ?>>0</span><?php echo esc_html( $s['suffix'] ); ?>
					</div>
					<div class="we-stat__label"><?php echo esc_html( $s['label'] ); ?></div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
